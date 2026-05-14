<?php
require('partials/links.php');
require('partials/header.php');
session_start();

// Read and sanitize input
$status = $_GET['status'] ?? '';
$order_id = htmlspecialchars($_GET['order'] ?? '');
$payment_id = htmlspecialchars($_GET['payment_id'] ?? '');
$fail_reason = htmlspecialchars($_GET['reason'] ?? 'Unknown failure');

// Redirect if invalid
if (!in_array($status, ['success', 'failed']) || !$order_id) {
    header("Location: index.php");
    exit;
}

// If failed, update booking status
if ($status === 'failed') {
    $check = select("SELECT * FROM booking_order WHERE razorpay_order_id=?", [$order_id], 's');
    if ($check && $check->num_rows == 1) {
        $row = mysqli_fetch_assoc($check);
        if ($row['booking_status'] === 'pending') {
            update("UPDATE booking_order SET 
                booking_status='payment failed',
                trans_status='TXN_FAILURE',
                trans_resp_msg=?, 
                razorpay_payment_id=?
                WHERE razorpay_order_id=?",
                [$fail_reason, $payment_id, $order_id], 'sss');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" id="htmlPage">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Booking Status</title>
  <style>
 

    .status-wrapper {
      min-height: 80vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .status-card {
      
      border-radius: 20px red;
      padding: 3rem;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 600px;
      text-align: center;
      transition: transform 0.3s;
    }

    .status-card:hover {
      transform: translateY(-4px);
    }

    .status-icon {
      font-size: 64px;
      margin-bottom: 1rem;
    }

    .status-title {
      font-size: 1.8rem;
      font-weight: 600;
    }

    .status-message {
      font-size: 1.1rem;
      margin: 0.75rem 0 1.5rem;
      color: inherit;
    }

    .status-details {
      text-align: left;
      font-size: 0.95rem;
      border-radius: 12px;
      padding: 1rem;
      margin-bottom: 1.5rem;
    }

    .status-details p {
      margin: 0.3rem 0;
    }

    .btn-custom {
      border-radius: 50px;
      padding: 0.6rem 1.5rem;
      font-weight: 500;
      transition: 0.3s;
    }

    .btn-custom:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>

<div class="container status-wrapper">
  <div class="status-card animate__animated animate__fadeInUp">

    <?php if ($status === "success"): ?>
      <div class="status-icon text-success">
        <i class="bi bi-check-circle-fill"></i>
      </div>
      <div class="status-title text-success">Payment Successful</div>
      <div class="status-message">Your booking is confirmed. Thank you for choosing <strong>Tamudhee Homestay</strong>.</div>
      <div class="status-details">
        <p><strong>Order ID:</strong> <?= $order_id ?></p>
        <p><strong>Payment ID:</strong> <?= $payment_id ?></p>
      </div>
      <a href="bookings.php" class="btn btn-success btn-custom">
        <i class="bi bi-calendar-check me-2"></i>View My Bookings
      </a>

    <?php else: ?>
      <div class="status-icon text-danger">
        <i class="bi bi-x-circle-fill"></i>
      </div>
      <div class="status-title text-danger">Payment Failed</div>
      <div class="status-message">We couldn’t complete your transaction. Please try again.</div>
      <div class="status-details">
        <p><strong>Order ID:</strong> <?= $order_id ?></p>
        <p><strong>Reason:</strong> <?= $fail_reason ?></p>
      </div>
      <a href="room.php" class="btn btn-outline-danger btn-custom">
        <i class="bi bi-arrow-repeat me-2"></i>Try Again
      </a>
    <?php endif; ?>

  </div>
</div>

<hr class="my-5">
<?php require('partials/footer.php'); ?>
</body>
</html>
