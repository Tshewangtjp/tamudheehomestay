<?php
require('admin/partials/db_config.php');
require('admin/partials/essentials.php');
require('vendor/autoload.php');

use Razorpay\Api\Api;
use Razorpay\Api\Errors\ApiError;

define('RAZORPAY_KEY_ID', 'rzp_test_wNBTtODoOE7090');
define('RAZORPAY_KEY_SECRET', 'cpG5P5oeeU2fWr0InaKt5Rxt');

date_default_timezone_set("Asia/Kolkata");
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('room.php');
    exit;
}

if (isset($_POST['pay_now'])) {
    try {
        $ORDER_ID = 'ORD_' . $_SESSION['uId'] . random_int(11111, 99999999);
        $CUST_ID = $_SESSION['uId'];
        $TXN_AMOUNT = $_SESSION['room']['payment'] * 100; // in paise

        $razorpay = new Api(RAZORPAY_KEY_ID, RAZORPAY_KEY_SECRET);

        // Create Razorpay Order
        $order = $razorpay->order->create([
            'receipt' => $ORDER_ID,
            'amount' => $TXN_AMOUNT,
            'currency' => 'INR',
            'payment_capture' => 1
        ]);

        $razorpay_order_id = $order['id'];

        // Insert booking_order
        $frm_data = filteration($_POST);
        $query1 = "INSERT INTO booking_order(user_id, room_id, check_in, check_out, order_id, razorpay_order_id, booking_status, trans_amt, trans_status) 
                   VALUES (?, ?, ?, ?, ?, ?, 'pending', ?, 'pending')";
        insert($query1, [
            $CUST_ID,
            $_SESSION['room']['id'],
            $frm_data['checkin'],
            $frm_data['checkout'],
            $ORDER_ID,
            $razorpay_order_id,
            $_SESSION['room']['payment']
        ], 'isssssd');

        $booking_id = mysqli_insert_id($con);

        // Insert booking_details
        $query2 = "INSERT INTO booking_details(booking_id, room_name, price, total_pay, user_name, email, phonenum, address, adult, children)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        insert($query2, [
            $booking_id,
            $_SESSION['room']['name'],
            $_SESSION['room']['price'],
            $_SESSION['room']['payment'],
            $frm_data['name'],
            $frm_data['email'],
            $frm_data['phonenum'],
            $frm_data['address'],
            $frm_data['adult'],
            $frm_data['children']
        ], 'isssssssss');

        // Prepare Razorpay Checkout JSON
        $data = [
            "key" => RAZORPAY_KEY_ID,
            "amount" => $TXN_AMOUNT,
            "currency" => "INR",
            "name" => "Tamudhee Homestay",
            "description" => "Room Booking Payment",
            "image" => "https://www.tamudheehomestay.com/assets/images/favicon.jpg",
            "order_id" => $razorpay_order_id,
            "callback_url" => "pay_response.php",
            "prefill" => [
                "name" => $frm_data['name'],
                "email" => $frm_data['email'],
                "contact" => $frm_data['phonenum']
            ],
            "notes" => [
                "merchant_order_id" => $ORDER_ID
            ],
            "theme" => [
                "color" => "#F37254"
            ]
        ];

        $json = json_encode($data, JSON_UNESCAPED_SLASHES);

        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Redirecting to Razorpay...</title>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        </head>
        <body>
            <p style='text-align:center;'>Redirecting to Razorpay...</p>
            <script src='https://checkout.razorpay.com/v1/checkout.js'></script>
            <script>
                var options = $json;

                options.modal = {
                    ondismiss: function() {
                        let cancelUrl = 'pay_status.php?status=failed&reason=' + encodeURIComponent('Payment cancelled by user') + '&order=' + encodeURIComponent(options.order_id);
                        window.location.href = cancelUrl;
                    }
                };

                var rzp = new Razorpay(options);

                rzp.on('payment.failed', function(response) {
                    let redirectUrl = 'pay_status.php?status=failed' +
                                      '&reason=' + encodeURIComponent(response.error.description || 'Unknown error') +
                                      '&order=' + encodeURIComponent(options.order_id);
                    window.location.href = redirectUrl;
                });

                document.addEventListener('DOMContentLoaded', function() {
                    rzp.open();
                });
            </script>
        </body>
        </html>";
        exit();

    } catch (ApiError $e) {
        echo "Razorpay Error: " . htmlspecialchars($e->getMessage());
    } catch (Exception $e) {
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
}