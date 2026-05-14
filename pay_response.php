<?php
ob_start(); // Start output buffering to avoid header issues

require('admin/partials/db_config.php');
require('admin/partials/essentials.php');
require('vendor/autoload.php');

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

// Razorpay credentials
define('RAZORPAY_KEY_ID', 'rzp_live_ueSqCCWfoTs319');
define('RAZORPAY_KEY_SECRET', 'X83bblIG5Mj8l47aPwUvW37L');

session_start();



// Rebuild session if user not logged in
function regenerate_session($uid) {
    $user_q = select("SELECT * FROM user_cred WHERE id=? LIMIT 1", [$uid], 'i');
    $user_fetch = mysqli_fetch_assoc($user_q);

    $_SESSION['login'] = true;
    $_SESSION['uId'] = $user_fetch['id'];
    $_SESSION['uName'] = $user_fetch['name'];
    $_SESSION['uPic'] = $user_fetch['profile'];
    $_SESSION['uPhone'] = $user_fetch['phonenum'];
    $_SESSION['uEmail'] = $user_fetch['email'];
}

// Main payment verification logic
if (
    isset($_POST['razorpay_payment_id']) &&
    isset($_POST['razorpay_order_id']) &&
    isset($_POST['razorpay_signature'])
) {
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $razorpay_order_id = $_POST['razorpay_order_id'];
    $razorpay_signature = $_POST['razorpay_signature'];

    $api = new Api(RAZORPAY_KEY_ID, RAZORPAY_KEY_SECRET);

    try {
        file_put_contents('razorpay_debug_log.txt', "Verifying signature...\n", FILE_APPEND);

        // 1. Signature Verification
        $api->utility->verifyPaymentSignature([
            'razorpay_order_id' => $razorpay_order_id,
            'razorpay_payment_id' => $razorpay_payment_id,
            'razorpay_signature' => $razorpay_signature
        ]);

        // 2. Fetch Payment
        $payment = $api->payment->fetch($razorpay_payment_id);
        $amount_paid = $payment->amount / 100;
        $payment_status = $payment->status;

        file_put_contents('razorpay_debug_log.txt', "Payment fetched: $razorpay_payment_id - Status: $payment_status\n", FILE_APPEND);

        // 3. Get booking from DB
        $res = select("SELECT * FROM booking_order WHERE razorpay_order_id=?", [$razorpay_order_id], 's');

        if ($res->num_rows == 1) {
            $row = mysqli_fetch_assoc($res);
            $booking_id = $row['booking_id'];
            $order_id = $row['order_id'];
            $user_id = $row['user_id'];

            if (!(isset($_SESSION['login']) && $_SESSION['login'] === true)) {
                regenerate_session($user_id);
            }

            // 4. Success case
            if ($payment_status === 'captured') {
                $update = update("UPDATE booking_order SET 
                    booking_status='booked',
                    trans_id=?, 
                    trans_amt=?, 
                    trans_status='TXN_SUCCESS',
                    trans_resp_msg='Payment Successful',
                    razorpay_payment_id=?
                    WHERE booking_id=?",
                    [$razorpay_payment_id, $amount_paid, $razorpay_payment_id, $booking_id],
                    'sdsi');

                if ($update) {
                    unset($_SESSION['room']);
                    file_put_contents('razorpay_debug_log.txt', "Redirecting to success page\n", FILE_APPEND);
                    redirect("pay_status.php?order=" . urlencode($order_id) . "&payment_id=" . urlencode($razorpay_payment_id) . "&status=success");
                } else {
                    file_put_contents('razorpay_failed_log.txt', "DB update failed on success for booking_id $booking_id\n", FILE_APPEND);
                    redirect("pay_status.php?order=" . urlencode($order_id) . "&status=failed&reason=db_error");
                }

            } else {
                // Failed status
                $fail_msg = 'Payment status: ' . $payment_status;

                $fail_update = update("UPDATE booking_order SET 
                    booking_status='payment failed',
                    trans_status='TXN_FAILURE',
                    trans_resp_msg=?, 
                    razorpay_payment_id=?
                    WHERE booking_id=?",
                    [$fail_msg, $razorpay_payment_id, $booking_id],
                    'ssi');

                if (!$fail_update) {
                    file_put_contents('razorpay_failed_log.txt', "DB update failed on failure for booking_id $booking_id\n", FILE_APPEND);
                }

                redirect("pay_status.php?order=" . urlencode($order_id) . "&status=failed&reason=" . urlencode($fail_msg));
            }

        } else {
            file_put_contents('razorpay_failed_log.txt', "No booking found for razorpay_order_id: $razorpay_order_id\n", FILE_APPEND);
            redirect("index.php?err=invalid_order");
        }

    } catch (SignatureVerificationError $e) {
        $error_msg = "Signature Verification Error: " . $e->getMessage();

        $chk = select("SELECT booking_id FROM booking_order WHERE razorpay_order_id=?", [$razorpay_order_id], 's');

        if ($chk->num_rows == 1) {
            $fail_update = update("UPDATE booking_order SET 
                booking_status='payment failed',
                trans_status='TXN_FAILURE',
                trans_resp_msg=? 
                WHERE razorpay_order_id=?",
                [$error_msg, $razorpay_order_id], 'ss');

            if (!$fail_update) {
                file_put_contents('razorpay_failed_log.txt', "DB update failed in signature error for order_id: $razorpay_order_id\n", FILE_APPEND);
            }
        } else {
            file_put_contents('razorpay_failed_log.txt', "Booking not found in signature error for order_id: $razorpay_order_id\n", FILE_APPEND);
        }

        file_put_contents('razorpay_failed_log.txt', date("Y-m-d H:i:s") . " - Signature Error - " . print_r($_POST, true) . "\n", FILE_APPEND);

        redirect("pay_status.php?order=" . urlencode($razorpay_order_id) . "&status=failed&reason=" . urlencode($error_msg));
    }
} else {
    file_put_contents('razorpay_failed_log.txt', date("Y-m-d H:i:s") . " - POST data not received\n", FILE_APPEND);
    redirect("index.php?err=no_data");
}
?>
