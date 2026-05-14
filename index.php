    <!DOCTYPE html>
    <html lang="en" data-bs-theme="" id="htmlPage">

    <head>
      <?php require('partials/links.php'); ?>
      <title>Welcome to <?php echo $setting_r['site_title'] ?> | Best Homestay in Sikkim</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- SEO Meta Tags -->
      <meta name="description" content="Experience the charm of Sikkim at <?php echo $setting_r['site_title'] ?>. Enjoy luxurious accommodations, breathtaking views, authentic local cuisine, and unforgettable memories. Book now!">
      <meta name="keywords" content="Sikkim homestay, Borong homestay, Sikkim hotel, book hotel in Sikkim, Himalayan stay, Sikkim rooms, family vacation Sikkim">
      <meta name="author" content="<?php echo $setting_r['site_title'] ?>">
      <meta name="robots" content="index, follow">
      <link rel="canonical" href="https://www.tamudheehomestay.com">

      <!-- Open Graph Meta Tags -->
      <meta property="og:type" content="website">
      <meta property="og:title" content="<?php echo $setting_r['site_title'] ?> - Best Homestay in Sikkim">
      <meta property="og:description" content="Discover scenic beauty, comfortable rooms, and top activities in Sikkim. Book your stay at <?php echo $setting_r['site_title'] ?> today!">
      <meta property="og:image" content="https://www.tamudheehomestay.com/assets/images/favicon.jpg">
      <meta property="og:url" content="https://www.tamudheehomestay.com">

      <!-- Twitter Meta Tags -->
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="<?php echo $setting_r['site_title'] ?> - Best Homestay in Sikkim">
      <meta name="twitter:description" content="Experience a peaceful stay with panoramic views and warm hospitality in Sikkim. Book now!">
      <meta name="twitter:image" content="https://www.tamudheehomestay.com/assets/images/favicon.jpg">



      <!-- Local Business Schema -->
      <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "LodgingBusiness",
          "name": "<?php echo $setting_r['site_title'] ?>",
          "image": "https://www.tamudheehomestay.com/assets/images/favicon.jpg",
          "description": "Best homestay in Sikkim with serene views and authentic hospitality.",
          "address": {
            "@type": "PostalAddress",
            "addressLocality": "Borong",
            "addressRegion": "Sikkim",
            "addressCountry": "India"
          },
          "url": "https://www.tamudheehomestay.com/assets/images/favicon.jpg",
          "telephone": "+91<?php echo $contact_r['pn1'] ?>"
        }
      </script>



      <?php require('partials/header.php'); ?>
      <!--Carousel-->
      <div class="container-fluid px-lg-4 mt-4" data-aos="fade-up">
        <div class="swiper swiper-container">

          <div class="swiper-wrapper">
            <?php
            $res = selectAll('carousel');
            while ($row = mysqli_fetch_assoc($res)) {
              $path = CAROUSEL_IMG_PATH;
              echo <<<data
    <div class="swiper-slide">
    <img src="$path$row[image]" alt="carousel image" class="w-100 d-block" height="450px" />
    </div>
    data;
            }
            ?>



          </div>
        </div>
      </div>
      <hr>

      <!--Check availability form -->
      <div class="container availability-form" data-aos="fade-down">
        <div class="row">
          <div class="col-lg-12 p-4 shadow rounded">
            <h5 class="mb-4">Check Booking Availability</h5>
            <form action="room.php">
              <div class="row align-items-end">
                <div class="col-lg-3 mb-3">
                  <label class="form-label" style="font-weight: 500;">Check-in</label>
                  <input type="date" class="form-control shadow-none" name="checkin" required>
                </div>
                <div class="col-lg-3 mb-3">
                  <label class="form-label" style="font-weight: 500;">Check-out</label>
                  <input type="date" class="form-control shadow-none" name="checkout" required>
                </div>
                <div class="col-lg-3 mb-3">
                  <label class="form-label" style="font-weight: 500;">Adult</label>
                  <select class="form-select shadow-none" name="adult">
                    <option selected>Adult</option>
                    <?php
                    $guests_q = mysqli_query($con, "SELECT MAX(adult) AS `max_adult`, MAX(children) AS `max_children` FROM `rooms` WHERE `status`='1' AND `removed`='0'");

                    $guests_res = mysqli_fetch_assoc($guests_q);

                    for ($i = 1; $i <= $guests_res['max_adult']; $i++) {
                      echo "<option value='$i'>$i</option>";
                    }
                    ?>



                  </select>
                </div>
                <div class="col-lg-2 mb-3">
                  <label class="form-label" style="font-weight: 500;">Children</label>

                  <select class="form-select shadow-none" id="children" name="children">
                    <option selected>Children</option>
                    <?php
                    for ($i = 1; $i <= $guests_res['max_children']; $i++) {
                      echo "<option value='$i'>$i</option>";
                    }

                    ?>
                  </select>
                </div>
                <input type="hidden" name="check_availability">
                <div class="col-lg-1 mb-lg-3 mt-2">
                  <button type="submit" class="btn shadow-none custom-bg"><i class="bi bi-search"></i></button>
                  <style>
                    .custom-bg {
                      background-color: #00c476;
                      height: 40px;
                    }

                    .custom-bg:hover {
                      background-color: #25d366;
                    }
                  </style>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <section class="fdb-block">
        <div class="container pt-5 px-4 px-lg-0 mx-auto" id="intro">
          <div class="row align-items-center">

            <!-- Image Grid -->
            <div class="col-lg-6 col-md-6 order-2 order-md-1 mt-4 pt-2 mt-sm-0 opt-sm-0" data-aos="fade-right">
              <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-6">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 mt-4 pt-2">
                      <div class="card work-desk rounded border-0 shadow-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="100">
                        <img src="assets/images/Sikkim-India-1.jpg" class="img-fluid" style="height: 300px; object-fit: cover;" alt="Sikkim Image 1">
                        <div class="img-overlay bg-dark"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 col-md-6 col-6">
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <div class="card work-desk rounded border-0 shadow-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="200">
                        <img src="assets/images/sikkim2.jpg" class="img-fluid" style="height: 300px; object-fit: cover;" alt="Sikkim Image 2">
                        <div class="img-overlay bg-dark"></div>
                      </div>
                    </div>

                    <div class="col-lg-12 col-md-12 mt-4 pt-2">
                      <div class="card work-desk rounded border-0 shadow-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="300">
                        <img src="assets/images/sikkim3.webp" class="img-fluid" style="height: 300px; object-fit: cover;" alt="Sikkim Image 3">
                        <div class="img-overlay bg-dark"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Text Content -->
            <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2" data-aos="fade-left">
              <div class="ml-lg-5">
                <h1 class="legend-header">SIKKIM</h1>

                <p class="legend-para">
                  Bordered by the Tibet Autonomous Region of China, Bhutan, Nepal, and West Bengal, Sikkim has long been regarded as one of the last Himalayan utopias. Although the state in India's northeast is small, its vertical terrain makes it slow to traverse, so it can take hours to travel what looks like a short distance. Because of its remoteness and the fact that permits are sometimes required, Sikkim isn't the most accessible area to visit, but it is filled with gorgeous gems that adventurous travelers won't want to miss.
                </p>
                <br>
                <p class="legend-para">
                  The area is certainly one of the most energetic and soothing to the soul with its mountainous beauty and ancient Tibetan Buddhist culture. Don't miss the top attractions in Sikkim, from monasteries galore to giant Buddha statues, river rafting adventures, wildlife sanctuaries, and plenty more.
                </p>
                <br>
                <p class="legend-para">
                  Sikkim is renowned for its astounding variety of animals—including nearly 550 species of birds and 700 species of butterflies. The state also boasts 600 varieties of orchids and 30 species of rhododendron. Check with the Tourism and Civil Aviation Department regarding tours, or explore gorgeous landscapes, flowers, and wildlife on your own at any of the many sanctuaries.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>


      <br>
      <br>
      <!---Room--->
      <div class="container py-5">
        <div class="row mb-5">
          <div class="col-lg-12 text-center">
            <h1 class="legend-header mb-3">OUR ROOM</h1>
            <p class="text-muted fs-5">Choose from our best rooms tailored for your comfort</p>
          </div>
        </div>

        <div class="row justify-content-center">
          <?php
          $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3", [1, 0], 'ii');

          $animation_index = 0; // for stagger delay

          if (mysqli_num_rows($room_res) == 0) {
            echo '<div class="container py-5" style="min-height: 300px;">
  <div class="d-flex justify-content-center align-items-center h-100" data-aos="fade-up">
    <div class="text-center bg-danger border border-2 border-light shadow-lg rounded-4 px-5 py-4" style="max-width: 500px;">
      <div class="mb-3">
        <i class="bi bi-door-closed-fill fs-1 text-muted"></i>
      </div>
      <h4 class="fw-semibold  mb-2">No Active Rooms Found</h4>
      <p class="text-muted mb-4">
        There are currently no rooms available or active in the system. Please wait admin to add a new room or check back later.
      </p>
    </div>
  </div>
</div>



';
          } else {

            while ($room_data = mysqli_fetch_assoc($room_res)) {
              // get facilities
              $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f
        INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
        WHERE rfac.room_id = '$room_data[id]'");

              $facilities_data = "";
              while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1 shadow-sm'>
          $fac_row[name]
        </span>";
              }

              //get thumbnail
              $room_thumb = ROOM_IMG_PATH . "thumbnail.png";
              $thumb_q = mysqli_query($con, "SELECT * FROM `room_images`
        WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

              if (mysqli_num_rows($thumb_q) > 0) {
                $thumb_res = mysqli_fetch_assoc($thumb_q);
                $room_thumb = ROOM_IMG_PATH . $thumb_res['image'];
              }

              $book_btn = "";
              if (!$setting_r['shutdown']) {
                $login = 0;
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                  $login = 1;
                }
                $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-success btn-sm shadow-sm'>Book Now</button>";
              }

              $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review` WHERE `room_id`='$room_data[id]' ORDER BY `sr_no` DESC LIMIT 30";
              $rating_res = mysqli_query($con, $rating_q);
              $rating_fetch = mysqli_fetch_assoc($rating_res);

              $rating_data = "";
              if ($rating_fetch['avg_rating'] != NULL) {
                $rating_data = '<h6 class="mb-2 fw-semibold">Rating</h6>';
                for ($i = 0; $i < $rating_fetch['avg_rating']; $i++) {
                  $rating_data .= "<i class='bi bi-star-fill text-warning'></i>";
                }
              }

              $animation_index++;

              echo <<<ROOM
      <div class="col-lg-4 col-md-6 mb-4 gsap-room-card" data-index="$animation_index">
        <div class="card room-card shadow-sm border-0 h-100">
          <div class="img-wrapper overflow-hidden rounded-top">
            <img src="$room_thumb" alt="$room_data[name]" class="card-img-top room-img">
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-bold">$room_data[name]</h5>
            <h6 class="mb-3">₹$room_data[price] <small class="text-muted fw-normal">per night</small></h6>

            <div class="facilities mb-3">
              <h6 class="mb-2 fw-semibold">Room Amenities</h6>
              $facilities_data
            </div>

            <div class="guests mb-3">
              <h6 class="mb-2 fw-semibold">Guests</h6>
              <span class="badge rounded-pill bg-light text-dark me-2 shadow-sm">
                <i class="bi bi-people-fill me-1"></i> $room_data[adult] Adult
              </span>
              <span class="badge rounded-pill bg-light text-dark shadow-sm">
                <i class="bi bi-people-fill me-1"></i> $room_data[children] Children
              </span>
            </div>

            <div class="rating mb-4">
              <div class="fs-5">$rating_data</div>
            </div>

            <div class="mt-auto d-flex justify-content-between">
              $book_btn
              <a href="room_details.php?id=$room_data[id]" class="btn btn-outline-danger btn-sm shadow-sm">More details</a>
            </div>
          </div>
        </div>
      </div>
      ROOM;
            }
          }
          ?>
        </div>

        <div class="text-center mt-5">
          <a href="room.php" class="btn btn-success btn-lg shadow-sm fw-bold">More Rooms &raquo;</a>
        </div>
      </div>






      <style>
        .legend-header {
          font-size: 2.75rem;
          letter-spacing: 0.1em;
          color: rgb(8, 232, 138);
        }

        .room-card {
          border-radius: 15px;
          transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .room-card:hover {
          transform: translateY(-10px);
          box-shadow: 0 15px 30px rgba(27, 67, 50, 0.3);
        }

        .img-wrapper {
          height: 250px;
        }

        .room-img {
          height: 100%;
          object-fit: cover;
          transition: transform 0.5s ease;
        }

        .img-wrapper:hover .room-img {
          transform: scale(1.1);
        }

        .facilities .badge {
          font-size: 0.85rem;
        }

        .guests .badge {
          font-size: 0.9rem;
        }

        .rating i {
          margin-right: 2px;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
          .img-wrapper {
            height: 200px;
          }
        }
      </style>






      <!-- HEAD SECTION -->


      <style>
        .hero-section {
          position: relative;
          background-image: url('assets/images/Sikkim-India-1.jpg');

          /* ✅ Update this path if needed */
          background-size: cover;
          background-position: center;
          background-attachment: fixed;
          height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
          z-index: 1;
          text-align: center;

        }

        .hero-overlay {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: 1;
        }

        .hero-content {
          position: relative;
          z-index: 2;
          max-width: 850px;
          padding: 2rem;
        }

        .legend-header {

          font-size: 3.5rem;

        }

        .legend-subtext {
          font-size: 1.5rem;

          margin-bottom: 1.2rem;
          font-weight: 500;
          min-height: 2rem;
        }

        .legend-para {
          font-size: 1.1rem;
          line-height: 1.8;

          padding: 1.5rem;
          border-radius: 10px;
          text-align: justify;
        }



        /* Responsive */
        @media (max-width: 992px) {
          .hero-content {
            padding: 2rem 1.5rem;
          }

          .legend-header {
            font-size: 2.8rem;
          }

          .legend-subtext {
            font-size: 1.3rem;
          }

          .legend-para {
            font-size: 1rem;
            padding: 1rem;
          }
        }

        @media (max-width: 576px) {
          .hero-section {
            height: auto;
            /* Let height be dynamic for short screens */
            padding: 3rem 1rem;
          }

          .hero-content {
            padding: 1.5rem 1rem;
          }

          .legend-header {
            font-size: 2rem;
          }

          .legend-subtext {
            font-size: 1rem;
          }

          .legend-para {
            font-size: 0.95rem;
            padding: 1rem 0.5rem;
          }

          /* Remove background-attachment fixed on mobile for performance */
          .hero-section {
            background-attachment: scroll;
          }
        }
      </style>

      <!-- ✅ HERO SECTION -->
      <section class="hero-section">
        <div class="hero-overlay"></div>

        <div class="hero-content" data-aos="fade-up">
          <!-- Title -->
          <div class="legend-header"
            data-aos="fade-down"
            data-aos-delay="100"
            data-aos-duration="1200">
            <?php echo $setting_r['site_title']; ?>
          </div>

          <!-- Typing Effect Subheading -->
          <div class="legend-subtext"
            data-aos="fade-up"
            data-aos-delay="300"
            data-aos-duration="1000">
            <span id="typed-subheading"></span>
          </div>

          <!-- Paragraph -->
          <p class="legend-para"
            data-aos="fade-in"
            data-aos-delay="500"
            data-aos-duration="1400">
            Welcome to <strong><?php echo $setting_r['site_title']; ?></strong> and welcome to Sikkim — designed to win your heart.
            Our homestay nestled in the lap of the mighty Himalayas is built with love and understated elegance,
            immersed in the warmth and simplicity of a second home that is close to your heart.
            <br><br>
            Borong’s spectacular natural landscape — seasoned by snow-capped mountains, forests, exotic local cuisine, and warm communities —
            will impress you more than you imagine. If you're looking for a unique combination of nature, culture, and cuisine,
            you're in the right place.
            <br><br>
            Our dedicated team will ensure your stay is blissful and memorable. May you bring back cherished memories
            from your visit with us and the beautiful land of Sikkim.
          </p>

          <!-- CTA Button -->
          <a href="room.php"
            class="btn btn-light mt-4 px-4 py-2"
            data-aos="zoom-in"
            data-aos-delay="700"
            data-aos-duration="1000">
            Explore Rooms
          </a>
        </div>
      </section>



      <div class="col-lg-12">
        <div class="section-title">
          <span>What We Do</span>
          <h2>Discover Our Activities</h2>
        </div>
      </div>
      <div class="container">
        <div class="grid1">
          <div class="row">
            <?php
            // Replace with your actual DB connection variable
            $res = mysqli_query($con, "SELECT * FROM `activities` ORDER BY `date` DESC LIMIT 6");
            $path = ACTIVITY_IMG_PATH;

            $index = 0;
            if (mysqli_num_rows($res) == 0) {
              echo '<div class="container py-5" style="min-height: 300px;">
  <div class="d-flex justify-content-center align-items-center h-100" data-aos="fade-up">
    <div class="text-center bg-warning border border-danger shadow-lg rounded-4 px-5 py-4" style="max-width: 520px;">
      <div class="mb-3">
        <i class="bi bi-exclamation-triangle-fill fs-1 text-danger"></i>
      </div>
      <h4 class="fw-bold text-danger mb-2">No Active Activities</h4>
      <p class="text-secondary mb-4">
        There are currently no activities available or active in the system.<br>
        Please wait for the admin to add new activities or check back later.
      </p>
    </div>
  </div>
</div>
  
  
  
  ';
            } else {
              while ($row = mysqli_fetch_assoc($res)) {
                $index++;
                echo <<<data
        <div class="col-lg-4 col-md-4 col-sm-6 col-6 p-1 gsap-activity-item" data-index="$index">
          <div class="gwrapper">
            <a href="#">
              <div class="item" alt="$row[name]" style="background-image: url($path$row[picture]);"></div>
              <h2>$row[name]</h2>
            </a>
          </div>
        </div>
        data;
              }
            }
            ?>
          </div>
        </div>
        <div class="col-lg-12 text-center mt-5">
          <a href="activities.php" class="btn text-white fw-bold shadow-none custom-bg">More Activities>>></a>
        </div>
      </div>
      <br>
      <br>










      <!-- Testimonials Section -->
      <div class="container my-5" id="testimonials">
        <div class="col-lg-12 text-center mb-4" data-aos="fade-up">
          <div class="section-title">
            <span class="fw-semibold">Testimonials</span>
            <h2 class="fw-bold">What Our Customers Say</h2>
          </div>
        </div>
        <style>
          .testimonial-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
          }

          .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
          }
        </style>

        <div class="swiper swiper-testimonials" data-aos="fade-up" data-aos-delay="200">
          <div class="swiper-wrapper mb-5">
            <?php
            $review_q = "SELECT rr.*, uc.name AS uname, uc.profile, r.name AS rname 
                   FROM `rating_review` rr
                   INNER JOIN `user_cred` uc ON rr.user_id = uc.id
                   INNER JOIN `rooms` r ON rr.room_id = r.id
                   ORDER BY rr.sr_no DESC LIMIT 7";
            $review_res = mysqli_query($con, $review_q);
            $img_path = USER_IMG_PATH;

            if (mysqli_num_rows($review_res) == 0) {
              echo '<div class="container" style="min-height: 300px;">
  <div class="d-flex justify-content-center align-items-center h-100" data-aos="fade-up">
    <div class="text-center rounded-4 p-5 shadow-lg border border-success-subtle">
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


                echo <<<HTML
          <div class="swiper-slide">
            <div class="card shadow-sm border-0 rounded-4 p-4 h-100 testimonial-card" data-aos="zoom-in">
              <div class="d-flex align-items-center mb-3">
                <img src="$img_path$row[profile]" loading="lazy" class="rounded-circle me-3" width="50" height="50" alt="$row[uname]">
                <h6 class="m-0">$row[uname]</h6>
              </div>
              <p class="text-muted small">"$row[review]"</p>
              <div class="rating">
                $stars
              </div>
            </div>
          </div>
HTML;
              }
            }
            ?>
          </div>

          <!-- Swiper Pagination -->
          <div class="swiper-pagination mt-4"></div>
        </div>
      </div>

      <br>
      <br>

      <div class="col-lg-12">
        <div class="section-title">
          <span>Sikkim</span>
          <h2>Places to visit in sikkim</h2>
        </div>
      </div>
      <section id="places" class="places section">

        <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

          <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": "auto",
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 1,
                    "spaceBetween": 40
                  },
                  "1200": {
                    "slidesPerView": 3,
                    "spaceBetween": 1
                  }
                }
              }
            </script>
            <div class="swiper-wrapper">

              <?php
              $res = selectAll('place');
              if (mysqli_num_rows($res) == 0) {
                echo '<div class="container py-5" style="min-height: 300px;">
  <div class="d-flex justify-content-center align-items-center h-100" data-aos="fade-up">
    <div class="text-center p-5 rounded-4 shadow-lg border border-success-subtle" style="max-width: 500px;">
      <div class="mb-4">
        <i class="bi bi-geo-alt-slash fs-1 text-success"></i>
      </div>
      <h4 class="mb-2 text-success fw-semibold">No place to show!</h4>
      <p class="text-muted mb-4">Looks like there’s nothing here yet. Please wait for admin to update!</p>
    </div>
  </div>
</div>



';
              } else {
                while ($row = mysqli_fetch_assoc($res)) {
                  $path = PLACE_IMG_PATH;
                  echo <<<data
              <div class="swiper-slide place-item d-flex flex-column justify-content-end" alt="$row[name]" style="background-image: url($path$row[picture])">
                <h3>$row[name]</h3>
                <p class="description">
                  $row[desc]
                </p>
              </div>
             data;
                }
              }
              ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>

        </div>

      </section><!-- /places Section -->
      <br>
      <br>
      <br>



      <div class="container">
        <div class="col-lg-12">
          <div class="section-title">
            <span>REACH US</span>
            <h2 style="text-align: center;">GETTING HERE</h2>
          </div>
        </div>
        <div id="map-container-google-2 shadow" class="z-depth-1-half map-container">
          <iframe title="map" src="<?php echo $contact_r['iframe'] ?>" frameborder="0" style="border:0" allowfullscreen="" width="100%" height="500px">
          </iframe>
        </div>
      </div>
      <br>
      <br>
      <br>


      <!-- Gallery Section -->
      <section id="gallery" class="gallery section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <p><span>Check</span> <span class="description-title">Our Gallery</span></p>
          <h2>Gallery</h2>

        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": "auto",
                "centeredSlides": true,
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 1,
                    "spaceBetween": 0
                  },
                  "768": {
                    "slidesPerView": 3,
                    "spaceBetween": 20
                  },
                  "1200": {
                    "slidesPerView": 5,
                    "spaceBetween": 20
                  }
                }
              }
            </script>
            <div class="swiper-wrapper align-items-center">
              <?php
              $res = selectAll('gallery');
              if (mysqli_num_rows($res) == 0) {
                echo '<div class="container py-5" style="min-height: 300px;">
  <div class="d-flex justify-content-center align-items-center h-100" data-aos="fade-up">
    <div class="text-center p-5 rounded-4 shadow-lg border border-success-subtle" style="max-width: 500px;">
      <div class="mb-4">
        <i class="bi bi-images fs-1 text-success"></i>
      </div>
      <h4 class="mb-2 text-success fw-semibold">No Image to show!</h4>
      <p class="text-muted mb-4">Looks like there’s nothing here yet. Please wait for admin to update!</p>
    </div>
  </div>
</div>



';
              } else {
                while ($row = mysqli_fetch_assoc($res)) {
                  $path = GALLERY_IMG_PATH;
                  echo <<<data
                  <div class="swiper-slide">
                  <a class="glightbox" data-gallery="images-gallery" 
                  href="$path$row[image]">
                  <img src="$path$row[image]" class="img-fluid" alt="Gallery Images"></a>
                  </div>
                  data;
                }
              }
              ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>

        </div>

      </section><!-- /Gallery Section -->

      <!---Password Reset--->
      <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <form id="recovery_form" method="post">
              <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center">
                  <i class="bi bi-shield-lock fs-3 me-2"></i> Set Up A New Password
                </h5>
              </div>
              <div class="modal-body">

                <div class="mb-3">
                  <label class="form-label">New Password</label>
                  <input type="password" name="pass" id="newPass" class="form-control shadow-none" placeholder="Enter Your New Password" required>
                  <input type="hidden" name="email">
                  <input type="hidden" name="token">
                  <ul class="list-unstyled small text-muted mt-2" id="password_rules">
                    <li id="rule_length">• Minimum 8 characters</li>
                    <li id="rule_uppercase">• At least one uppercase letter</li>
                    <li id="rule_number">• At least one number</li>
                    <li id="rule_special">• At least one special character (!@#$%^&*)</li>
                  </ul>
                </div>

                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="showPass" onclick="togglePasswordVisibility()">
                  <label class="form-check-label text-muted" for="showPass">Show Password</label>
                </div>



                <div class="mb-2 text-end">
                  <button type="button" class="btn btn-danger shadow-none" data-bs-dismiss="modal">CANCEL</button>
                  <button type="submit" class="btn btn-success shadow-none">SUBMIT</button>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
      </body>
      <script>
        function togglePasswordVisibility() {
          const newPass = document.getElementById('newPass');
          newPass.type = newPass.type === 'password' ? 'text' : 'password';
        }

        // Password strength checker
        const newPassInput = document.getElementById('newPass');
        newPassInput.addEventListener('input', validatePasswordRules);

        function validatePasswordRules() {
          const val = newPassInput.value;
          document.getElementById('rule_length').style.color = val.length >= 8 ? 'green' : 'red';
          document.getElementById('rule_uppercase').style.color = /[A-Z]/.test(val) ? 'green' : 'red';
          document.getElementById('rule_number').style.color = /\d/.test(val) ? 'green' : 'red';
          document.getElementById('rule_special').style.color = /[!@#$%^&*]/.test(val) ? 'green' : 'red';
        }

        // Form submission validation
        document.getElementById('recovery_form').addEventListener('submit', function(e) {
          const password = newPassInput.value;
          const isValid =
            password.length >= 8 &&
            /[A-Z]/.test(password) &&
            /\d/.test(password) &&
            /[!@#$%^&*]/.test(password);

          if (!isValid) {
            e.preventDefault();
            alert('Password must meet all the required conditions.');
          }
        });
      </script>






      <!-- GSAP and ScrollTrigger -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

      <script>
        gsap.registerPlugin(ScrollTrigger);

        gsap.utils.toArray('.gsap-room-card').forEach((card, i) => {
          gsap.from(card, {
            scrollTrigger: {
              trigger: card,
              start: "top 80%",
              toggleActions: "play none none none",
            },
            opacity: 0,
            y: 50,
            duration: 1,
            delay: i * 0.2,
            ease: "power3.out"
          });
        });



        gsap.utils.toArray('.gsap-activity-item').forEach((item, i) => {
          gsap.from(item, {
            scrollTrigger: {
              trigger: item,
              start: "top 85%",
              toggleActions: "play none none none",
            },
            opacity: 0,
            scale: 0.9,
            y: 30,
            duration: 0.8,
            delay: i * 0.15,
            ease: "power2.out"
          });
        });
      </script>

      <?php require('partials/footer.php'); ?>
      <?php
      if (isset($_GET['account_recovery'])) {
        $data = filteration($_GET);

        $t_date = date("Y-m-d");

        $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1", [$data['email'], $data['token'], $t_date], 'sss');

        if (mysqli_num_rows($query) == 1) {
          echo <<<showModal
      <script>
      var myModal = document.getElementById('recoveryModal');

      myModal.querySelector("input[name='email']").value = '$data[email]';
      myModal.querySelector("input[name='token']").value = '$data[token]';
      var modal = bootstrap.Modal.getOrCreateInstance(myModal);
      modal.show();
      </script>
      showModal;
        } else {
          alert("error", "Invalid or Expired Link!");
        }
      }
      ?>

      <script>
        let recovery_form = document.getElementById('recovery_form');
        recovery_form.addEventListener('submit', (e) => {
          e.preventDefault();


          let data = new FormData();
          data.append('email', recovery_form.elements['email'].value);
          data.append('token', recovery_form.elements['token'].value);
          data.append('pass', recovery_form.elements['pass'].value);
          data.append('recover_user', '');



          var myModal = document.getElementById('recoveryModal');
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "ajax/login_register.php", true);

          xhr.onload = function() {
            if (this.responseText == 'failed') {
              alert('error', "Account Reset failed!");
            } else {
              alert('success', "Account Password Reset Successful");
              recovery_form.reset();
            }
          }
          xhr.send(data);



        });
      </script>

      <script>
        (function() {
          "use strict";





          /**
           * Animation on scroll function and init
           */
          function aosInit() {
            AOS.init({
              duration: 600,
              easing: 'ease-in-out',
              once: true,
              mirror: false
            });
          }
          window.addEventListener('load', aosInit);

          /**
           * Initiate glightbox
           */
          const glightbox = GLightbox({
            selector: '.glightbox'
          });

          /**
           * Initiate Pure Counter
           */
          new PureCounter();

          /**
           * Init swiper sliders
           */
          function initSwiper() {
            document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
              let config = JSON.parse(
                swiperElement.querySelector(".swiper-config").innerHTML.trim()
              );

              if (swiperElement.classList.contains("swiper-tab")) {
                initSwiperWithCustomPagination(swiperElement, config);
              } else {
                new Swiper(swiperElement, config);
              }
            });
          }

          window.addEventListener("load", initSwiper);

          document.addEventListener("DOMContentLoaded", function() {
            new Typed("#typed-subheading", {
              strings: [
                "HOME LIKE HOMESTAY IN SIKKIM",
                "EXPERIENCE PEACE IN BORONG",
                "YOUR SECOND HOME IN THE HIMALAYAS"
              ],
              typeSpeed: 60,
              backSpeed: 30,
              backDelay: 2000,
              loop: true,
              showCursor: true,
              cursorChar: '|'
            });
          });







        })();
      </script>