<!DOCTYPE html>
<html lang="en" data-bs-theme="" id="htmlPage">
<head>
    <?php require('partials/links.php'); ?>
    <?php
    if (!isset($_GET['id'])) {
        redirect('rooms.php');
    }

    $data = filteration($_GET);
    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

    if (mysqli_num_rows($room_res) == 0) {
        redirect('room.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);

    // SEO Variables
    $room_name = $room_data['name'];
    $room_desc = substr(strip_tags($room_data['desc']), 0, 160);
    $room_keywords_arr = mysqli_fetch_all(mysqli_query($con, "SELECT name FROM facilities INNER JOIN room_facilities ON facilities.id = room_facilities.facilities_id WHERE room_facilities.room_id = '$room_data[id]'"), MYSQLI_ASSOC);
    $room_keywords = implode(', ', array_map(function ($f) {
        return $f['name'];
    }, $room_keywords_arr));

    $room_image = ROOM_IMG_PATH . 'thumbnail.png';
    $img_q = mysqli_query($con, "SELECT image FROM `room_images` WHERE `room_id`='$room_data[id]' LIMIT 1");
    if (mysqli_num_rows($img_q) > 0) {
        $img_res = mysqli_fetch_assoc($img_q);
        $room_image = ROOM_IMG_PATH . $img_res['image'];
    }
    ?>
      <title>Confirm Your Stay | <?php echo $room_name . ' | ' . $setting_r['site_title']; ?> - Secure Room Booking</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Confirm your stay at <?php echo $setting_r['site_title']; ?>. Book <?php echo $room_data['name']; ?> securely with real-time availability, simple steps, and best prices.">
    <meta name="keywords" content="Confirm booking, <?php echo $room_data['name']; ?>, book room <?php echo $setting_r['site_title']; ?>, Sikkim hotel, homestay booking, room availability, online hotel reservation, secure hotel booking">
    <meta name="author" content="<?php echo $setting_r['site_title']; ?>">

    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="Confirm Booking | <?php echo $room_data['name']; ?> - <?php echo $setting_r['site_title']; ?>">
    <meta property="og:description" content="Easily confirm your stay at <?php echo $setting_r['site_title']; ?>. Book <?php echo $room_data['name']; ?> online with instant confirmation.">
    <meta property="og:image" content="<?php echo $room_thumb; ?>">
    <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Confirm Booking | <?php echo $room_data['name']; ?> - <?php echo $setting_r['site_title']; ?>">
    <meta name="twitter:description" content="Secure your room at <?php echo $setting_r['site_title']; ?>. Book <?php echo $room_data['name']; ?> online with confidence.">
    <meta name="twitter:image" content="<?php echo $room_thumb; ?>">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.tamudheehomestay.com">

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LodgingBusiness",
        "name": "<?php echo $setting_r['site_title']; ?>",
        "url": "<?php echo 'https://' . $_SERVER['HTTP_HOST']; ?>",
        "image": "<?php echo $room_thumb; ?>",
        "description": "Confirm your room booking for <?php echo $room_data['name']; ?> at <?php echo $setting_r['site_title']; ?> in Sikkim. Safe, fast, and simple online reservation.",
        "address": {
            "@type": "PostalAddress",
            "addressRegion": "Sikkim",
            "addressCountry": "IN"
        },
        "priceRange": "₹<?php echo $room_data['price']; ?> per night"
    }
    </script>
    

<?php require('partials/header.php'); ?>

<?php
if (!isset($_GET['id']) || $setting_r['shutdown'] == true) {
    redirect('rooms.php');
} else if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('room.php');
}

$data = filteration($_GET);
$room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

if (mysqli_num_rows($room_res) == 0) {
    redirect('room.php');
}

$room_data = mysqli_fetch_assoc($room_res);
$_SESSION['room'] = [
    "id" => $room_data['id'],
    "name" => $room_data['name'],
    "price" => $room_data['price'],
    "payment" => null,
    "available" => false,
];

$user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], "i");
$user_data = mysqli_fetch_assoc($user_res);
?>

<div class="container">
    <div class="row">
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold">CONFIRM BOOKING</h2>
            <div style="font-size: 14px;">
                <a href="index.php" class="text-success text-decoration-none">HOME</a> >
                <a href="room.php" class="text-success text-decoration-none">ROOMS</a> >
                <span class="text-uppercase text-success"><?php echo $room_data['name'] ?></span>
            </div>
        </div>

        <div class="col-lg-7 px-4">
            <?php
            $room_thumb = ROOM_IMG_PATH . "thumbnail.png";
            $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");
            if (mysqli_num_rows($thumb_q) > 0) {
                $thumb_res = mysqli_fetch_assoc($thumb_q);
                $room_thumb = ROOM_IMG_PATH . $thumb_res['image'];
            }
            echo "<div class='card p-3 shadow-sm rounded'><img src='$room_thumb' class='img-fluid rounded mb-3' alt='Image of <?php echo $room_data[name]; ?>'><h5>$room_data[name]</h5><h6>₹$room_data[price] per night</h6></div>";
            ?>
        </div>

        <div class="col-lg-5 px-4">
            <div class="card mb-4 border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" id="progressBar" style="width: 33%;"></div>
                        </div>
                        <div class="text-center mt-2">
                            <span id="stepLabel">Step 1 of 3</span>
                        </div>
                    </div>

                    <form action="pay_now.php" method="POST" id="booking_form">
                        <div id="step1" class="step active">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input name="email" type="email" value="<?php echo $user_data['email'] ?>" class="form-control shadow-none" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input name="phonenum" type="text" value="<?php echo $user_data['phonenum'] ?>" class="form-control shadow-none" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control shadow-none" name="address" required><?php echo $user_data['address'] ?></textarea>
                            </div>
                            <button type="button" class="btn btn-success w-100" onclick="nextStep(2)">Next</button>
                        </div>

                        <div id="step2" class="step">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Check-In</label>
                                    <input name="checkin" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Check-Out</label>
                                    <input name="checkout" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Adult</label>
                                    <input name="adult" type="number" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Children</label>
                                    <input name="children" type="number" class="form-control shadow-none" required>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-secondary" onclick="nextStep(1)">Back</button>
                            <button type="button" class="btn btn-success float-end" onclick="nextStep(3)">Next</button>
                        </div>

                        <div id="step3" class="step">
                            <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status"></div>
                            <h6 id="pay_info" class="mb-3 text-danger">Provide check-in & check-out date!</h6>
                            <button type="button" class="btn btn-outline-secondary" onclick="nextStep(2)">Back</button>
                            <button type="button" class="btn btn-success float-end" onclick="openSummaryModal()" id="reviewBtn" disabled>Review & Pay</button>
                        </div>

                        <!-- Summary Modal -->
                        <div class="modal fade" id="summaryModal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">Booking Summary</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body" id="summaryBody"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                        <button type="submit"  name="pay_now" class="btn btn-success">Confirm & Pay</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('partials/footer.php'); ?>

<script>
const booking_form = document.getElementById('booking_form');
const info_loader = document.getElementById('info_loader');
const pay_info = document.getElementById('pay_info');
const reviewBtn = document.getElementById('reviewBtn');

function nextStep(step) {
    document.querySelectorAll('.step').forEach(stepDiv => stepDiv.classList.remove('active'));
    document.getElementById('step' + step).classList.add('active');
    document.getElementById('progressBar').style.width = (step * 33) + '%';
    document.getElementById('stepLabel').innerText = `Step ${step} of 3`;
}

function check_availability() {
    let checkin_val = booking_form.elements['checkin'].value;
    let checkout_val = booking_form.elements['checkout'].value;
    reviewBtn.setAttribute('disabled', true);

    if (checkin_val && checkout_val) {
        pay_info.classList.add('d-none');
        info_loader.classList.remove('d-none');

        let data = new FormData();
        data.append('check_availability', '');
        data.append('check_in', checkin_val);
        data.append('check_out', checkout_val);

        fetch('ajax/confirm_booking.php', {
            method: 'POST',
            body: data
        })
        .then(res => res.json())
        .then(data => {
            if (data.status == 'check_in_out_equal') {
    pay_info.innerText = "Check-in and check-out cannot be the same.";
    pay_info.classList.add('text-danger');
    pay_info.style.color = '';
} else if (data.status == 'check_out_earlier') {
    pay_info.innerText = "Check-out before check-in.";
    pay_info.classList.add('text-danger');
    pay_info.style.color = '';
} else if (data.status == 'check_in_earlier') {
    pay_info.innerText = "Check-in before today.";
    pay_info.classList.add('text-danger');
    pay_info.style.color = '';
} else if (data.status == 'unavailable') {
    pay_info.innerText = "Room not available on those dates.";
    pay_info.classList.add('text-danger');
    pay_info.style.color = '';
} else {
    pay_info.innerHTML = `✔️ Nights: <b>${data.days}</b><br>Total: ₹<b>${data.payment}</b>`;
    pay_info.classList.remove('text-danger');
    pay_info.style.color = 'inherit';
    reviewBtn.removeAttribute('disabled');
}

            pay_info.classList.remove('d-none');
            info_loader.classList.add('d-none');
        });
    }
}

function openSummaryModal() {
    const f = booking_form.elements;
    document.getElementById('summaryBody').innerHTML = `
        <p><strong>Name:</strong> ${f['name'].value}</p>
        <p><strong>Email:</strong> ${f['email'].value}</p>
        <p><strong>Phone:</strong> ${f['phonenum'].value}</p>
        <p><strong>Room:</strong> <?php echo $room_data['name']; ?></p>
        <p><strong>Check-in:</strong> ${f['checkin'].value}</p>
        <p><strong>Check-out:</strong> ${f['checkout'].value}</p>
        <p><strong>Guests:</strong> ${f['adult'].value} Adult(s), ${f['children'].value} Children</p>
        <p><strong>Address:</strong><br>${f['address'].value}</p>
    `;
    new bootstrap.Modal(document.getElementById('summaryModal')).show();
}
</script>

<style>
.step {
    display: none;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.4s ease-in-out;
}
.step.active {
    display: block;
    opacity: 1;
    transform: translateY(0);
}
</style>
</body>

</html>