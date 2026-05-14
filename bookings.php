<!DOCTYPE html>
<html lang="en" data-bs-theme="" id="htmlPage">

<head>
    <?php require('partials/links.php'); ?>
    <title>Your Bookings | <?php echo $setting_r['site_title']; ?> - View and Manage Hotel Reservations</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View and manage your hotel bookings at <?php echo $setting_r['site_title']; ?>. Download invoices, rate your stay, or cancel reservations easily.">
    <meta name="keywords" content="hotel bookings, room reservations, <?php echo $setting_r['site_title']; ?> bookings, cancel hotel booking, download invoice, hotel review">
    <meta name="author" content="<?php echo $setting_r['site_title']; ?>">
    <meta name="robots" content="noindex, follow">
    <link rel="canonical" href="https://www.tamudheehomestay.com/bookings.php">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Your Bookings | <?php echo $setting_r['site_title']; ?>">
    <meta property="og:description" content="Manage your bookings, download invoices and submit reviews.">
    <meta property="og:url" content="https://www.tamudheehomestay.com/bookings.php">
    <meta property="og:image" content="https://www.tamudheehomestay.com/assets/images/">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Your Bookings | <?php echo $setting_r['site_title']; ?>">
    <meta name="twitter:description" content="Manage your bookings, download invoices and submit reviews.">
    <meta name="twitter:image" content="https://www.tamudheehomestay.com/assets/images/">



    <style>
        .card {
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.4em 0.75em;
        }

        .btn-sm {
            font-size: 0.85rem;
        }

        .card-title {
            font-size: 1.2rem;
        }

        .booking-info p {
            margin-bottom: 0.4rem;
        }

        .empty-message {
            font-size: 1.1rem;
        }
    </style>


<body>
    <?php require('partials/header.php');

    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">BOOKINGS</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-success text-decoration-none">HOME</a>
                    <span> > </span>
                    <a class="text-success text-decoration-none" href="room.php">BOOKINGS</a>
                </div>
            </div>

            <?php
            $query = "SELECT bo.*, bd.* FROM `booking_order` bo
                      INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
                      WHERE ((bo.booking_status='booked') OR(bo.booking_status='cancelled') OR
                      (bo.booking_status='payment failed')) 
                      AND (bo.user_id=?) 
                      ORDER BY bo.booking_id DESC";

            $result = select($query, [$_SESSION['uId']], 'i');

            if (mysqli_num_rows($result) == 0) {
                echo "<div class='col-12 text-center my-5'>
                        <p class='text-muted empty-message'>You haven't made any bookings yet.</p>
                        <a href='room.php' class='btn btn-success mt-3'><i class='bi bi-door-open'></i> Browse Rooms</a>
                      </div>";
            }

            while ($data = mysqli_fetch_assoc($result)) {
                $date = date("d-m-Y H:i:s", strtotime($data['datentime']));
                $checkin = date("d-m-Y H:i:s", strtotime($data['check_in']));
                $checkout = date("d-m-Y H:i:s", strtotime($data['check_out']));

                $status_bg = "";
                $btn = "";

                if ($data['booking_status'] == 'booked') {
                    $status_bg = "bg-success";

                    if ($data['arrival'] == 1) {
                        $btn = "
                            <a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-outline-success btn-sm'>
                                <i class='bi bi-file-earmark-pdf'></i> Download PDF
                            </a>";
                        if ($data['rate_review'] == 0) {
                            $btn .= "<button onclick='review_room($data[booking_id],$data[room_id])' class='btn btn-outline-warning btn-sm ms-2' data-bs-toggle='modal' data-bs-target='#reviewModal'>
                                <i class='bi bi-star'></i> Rate & Review
                            </button>";
                        }
                    } else {
                        $btn = "
                            <button onclick='cancel_booking($data[booking_id])' class='btn btn-outline-danger btn-sm'>
                                <i class='bi bi-x-circle'></i> Cancel
                            </button>";
                    }
                } else if ($data['booking_status'] == 'cancelled') {
                    $status_bg = "bg-danger";
                    if ($data['refund'] == 0) {
                        $btn = "<span class='badge bg-primary'><i class='bi bi-clock-history'></i> Refund in process</span>";
                    } else {
                        $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-outline-success btn-sm'>
                                    <i class='bi bi-file-earmark-pdf'></i> Download PDF
                                </a>";
                    }
                } else {
                    $status_bg = "bg-warning";
                    $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-outline-success btn-sm'>
                                <i class='bi bi-file-earmark-pdf'></i> Download PDF
                            </a>";
                }

                echo <<<bookings
                <div class='col-md-6 col-lg-4 mb-4'>
                    <div class='card border-0 shadow-sm h-100'>
                        <div class='card-body booking-info'>
                            <h5 class='card-title text-success'>$data[room_name]</h5>
                            <h6 class='text-muted mb-3'>₹$data[price] <small>/ night</small></h6>

                            <p><i class='bi bi-calendar-check'></i> <b>Check-in:</b> $checkin</p>
                            <p><i class='bi bi-calendar-x'></i> <b>Check-out:</b> $checkout</p>
                            <p><b>Total:</b> ₹$data[price]</p>
                            <p><b>Order ID:</b> $data[order_id]</p>
                            <p><b>Booking ID:</b> $data[booking_id]</p>
                            <p><b>Date:</b> $date</p>

                            <div class='mb-3'>
                                <span class='badge $status_bg text-capitalize'><i class='bi bi-info-circle-fill me-1'></i> $data[booking_status]</span>
                            </div>

                            <div class='d-flex flex-wrap gap-2'>
                                $btn
                            </div>
                        </div>
                    </div>
                </div>
                bookings;
            }
            ?>
        </div>
    </div>

    <div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <form id="review_form" class="p-4">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title d-flex align-items-center w-100">
                            <i class="bi bi-chat-square-heart fs-3 me-2"></i>
                            <span class="fw-bold">Rate & Review</span>
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body pt-0">

                        <!-- Floating Email/Mobile Field -->
                        <div class="form-floating mb-3">
                            <select class="form-select shadow-none" name="rating">
                                <option value="5">Excellent</option>
                                <option value="4">Good</option>
                                <option value="3">Normal</option>
                                <option value="2">Poor</option>
                                <option value="1">Bad</option>
                            </select>
                            <label>Rating</label>
                        </div>

                        <!-- Floating Password Field -->
                        <div class="form-floating mb-2">
                            <textarea name="review" rows="3" class="form-control" required></textarea>
                            <label>Review</label>
                        </div>
                        <input type="hidden" name="booking_id">
                        <input type="hidden" name="room_id">


                        <div class="text-end">
                            <button type="submit" class="btn custom-bg px-4 shadow-sm">SUBMIT</button>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>

    <hr>

    <?php
    if (isset($_GET['cancel_status'])) {
        alert('success', 'Booking Cancelled!');
    } else if (isset($_GET['review_status'])) {
        alert('success', 'Thank you for rating & review!');
    }
    ?>

    <?php require('partials/footer.php'); ?>

    <script>
        function cancel_booking(id) {
            if (confirm('Are you sure to cancel booking?')) {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'ajax/cancel_booking.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    if (this.responseText == 1) {
                        window.location.href = "bookings.php?cancel_status=true";
                    } else {
                        alert('error', 'Cancellation failed!');
                    }
                }

                xhr.send('cancel_booking&id=' + id);
            }
        }

        let review_form = document.getElementById('review_form');

        function review_room(bid, rid) {
            review_form.elements['booking_id'].value = bid;
            review_form.elements['room_id'].value = rid;
        }

        review_form.addEventListener('submit', function(e) {
            e.preventDefault();

            let data = new FormData();

            data.append('review_form', '');
            data.append('rating', review_form.elements['rating'].value);
            data.append('review', review_form.elements['review'].value);
            data.append('booking_id', review_form.elements['booking_id'].value);
            data.append('room_id', review_form.elements['room_id'].value);


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/review_room.php", true);


            xhr.onload = function() {

                if (this.responseText == 1) {
                    window.location.href = 'bookings.php?review_status=true';
                } else {
                    var myModal = document.getElementById('reviewModal');
                    var modal = bootstrap.Modal.getInstance(myModal);
                    modal.hide();

                    alert('error', "Rating & Review Failed!");

                }

            }


            xhr.send(data);
        });
    </script>
</body>

</html>