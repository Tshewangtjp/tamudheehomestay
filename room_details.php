<!DOCTYPE html>
<html lang="en" data-bs-theme="" id="htmlPage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <title><?php echo $room_name . ' | ' . $setting_r['site_title']; ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($room_desc); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($room_keywords); ?>">
    <meta name="author" content="Your Hotel Name">
    <meta property="og:title" content="<?php echo htmlspecialchars($room_name); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($room_desc); ?>">
    <meta property="og:image" content="<?php echo $room_image; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($room_name); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($room_desc); ?>">
    <meta name="twitter:image" content="<?php echo $room_image; ?>">
    <link rel="canonical" href="<?php echo "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "HotelRoom",
      "name": "<?php echo $room_name; ?>",
      "description": "<?php echo htmlspecialchars($room_desc); ?>",
      "image": "<?php echo $room_image; ?>",
      "offers": {
        "@type": "Offer",
        "price": "<?php echo $room_data['price']; ?>",
        "priceCurrency": "INR",
        "availability": "https://schema.org/InStock"
      }
    }
    </script>
    

    <?php require('partials/header.php'); ?>

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
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold" data-aos="fade-down"><?php echo $room_data['name'] ?></h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-success text-decoration-none">HOME</a>
                    <span> > </span>
                    <a class="text-success text-decoration-none" href="room.php">ROOMS</a>
                    <span> > </span>
                    <a class="text-uppercase text-success"><?php echo $room_data['name'] ?></a>
                </div>
            </div>

            <div class="col-lg-7 col-md-7 px-4" data-aos="zoom-in">
                <div id="roomCarousel" class="carousel slide">
                    <div class="carousel-inner rounded shadow-sm">
                        <?php
                        $room_img = ROOM_IMG_PATH . "thumbnail.png";
                        $img_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]'");
                        if (mysqli_num_rows($img_q) > 0) {
                            $active_class = 'active';
                            while ($img_res = mysqli_fetch_assoc($img_q)) {
                                echo "<div class='carousel-item $active_class'>
                  <img src='" . ROOM_IMG_PATH . $img_res['image'] . "' class='d-block w-100 rounded' style='height: 500px;'>
                </div>";
                                $active_class = '';
                            }
                        } else {
                            echo "<div class='carousel-item active'>
                <img src='$room_img' class='d-block w-100 rounded'>
              </div>";
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-lg-5 col-md-12 px-4" data-aos="fade-left">
                <div class='card mb-4 border-0 shadow-sm rounded-4'>
                    <div class="card-body">
                        <h4 class='mb-4 text-success'>₹<?php echo $room_data['price']; ?> per night</h4>
                        <?php
                        $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review` WHERE `room_id`='$room_data[id]' ORDER BY `sr_no` DESC LIMIT 30";

                        $rating_res = mysqli_query($con, $rating_q);
                        $rating_fetch = mysqli_fetch_assoc($rating_res);

                        $rating_data = "";

                        if ($rating_fetch['avg_rating'] != NULL) {


                            for ($i = 0; $i < $rating_fetch['avg_rating']; $i++) {
                                $rating_data .= " <i class='bi bi-star-fill text-warning'></i>";
                            }
                        }

                        echo <<<rating
                        <div class='mb-3'>
                        $rating_data
                        </div>
                    rating;
                        ?>


                        <h6 class='mb-3 text-muted'>Room Facilities</h6>
                        <?php
                        $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");
                        while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                            echo "<span class='badge rounded-pill bg-light text-dark me-1 mb-1'>$fac_row[name]</span> ";
                        }
                        ?>

                        <h6 class='mt-4 mb-2 text-muted'>Guests</h6>
                        <span class='badge rounded-pill bg-light text-dark me-2'><?php echo $room_data['adult']; ?> Adult</span>
                        <span class='badge rounded-pill bg-light text-dark'><?php echo $room_data['children']; ?> Children</span>

                        <h6 class='mt-4 mb-2 text-muted'>Area</h6>
                        <span class='badge rounded-pill bg-light text-dark'><?php echo $room_data['area']; ?> sq. ft.</span>

                        <?php
                        if (!$setting_r['shutdown']) {
                            $login = isset($_SESSION['login']) && $_SESSION['login'] == true ? 1 : 0;
                            echo "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-success mt-4 w-100 shadow-sm'><i class='bi bi-calendar-check'></i> Book Now</button>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4 px-4" data-aos="fade-up">
                <h5 class="mb-3 fw-semibold">Description</h5>
                <p class="text-muted"><?php echo $room_data['desc']; ?></p>
            </div>

            <div class="col-12 mt-4 px-4" data-aos="fade-up">
                <h5 class="mb-3 fw-semibold">Reviews & Ratings</h5>
                <?php
                $review_q = "SELECT rr.*, uc.name AS uname, uc.profile, r.name AS rname 
                                FROM `rating_review` rr
                                INNER JOIN `user_cred` uc ON rr.user_id = uc.id
                                INNER JOIN `rooms` r ON rr.room_id = r.id
                                WHERE rr.room_id = '$room_data[id]'
                                ORDER BY rr.sr_no DESC LIMIT 7";
                $review_res = mysqli_query($con, $review_q);
                $img_path = USER_IMG_PATH;

                if (mysqli_num_rows($review_res) == 0) {
                    echo '<div class="container" style="min-height: 300px;">
                <div class="d-flex justify-content-center align-items-center h-100" data-aos="fade-up">
                    <div class="text-center rounded-4 p-5 shadow-sm">
                    <i class="bi bi-chat-left-dots fs-1 text-success mb-3"></i>
                    <h5 class="mb-2 text-success">No reviews yet!</h5>
                    <p class="mb-3">Be the first to share your experience with us.</p>
                    <a href="bookings.php" class="btn btn-outline-success btn-sm">Write a Review</a>
                    </div>
                </div>
                </div>


                ';
                } else {
                    while ($row = mysqli_fetch_assoc($review_res)) {
                        $stars = str_repeat("<i class='bi bi-star-fill text-warning'></i> ", $row['rating']);
                        echo <<<review
                        <div class="p-4 rounded shadow-sm mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="$img_path$row[profile]" class="me-2" style="width: 30px; height: 30px; border-radius: 50%;">
                            <h6 class="m-0">$row[uname]</h6>
                        </div>
                        <p class="mb-1 text-muted">$row[review]</p>
                        <div class="rating">$stars</div>
                    </div>
                    review;
                    }
                } 
                ?>


                
                <!-- Add more dynamic reviews here -->
            </div>
        </div>
    </div>

    <br><br>
    <hr>

    <?php require('partials/footer.php'); ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true
        });
    </script>
</body>

</html>