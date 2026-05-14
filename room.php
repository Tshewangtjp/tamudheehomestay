<!DOCTYPE html>
<html lang="en" data-bs-theme="" id="htmlPage">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php require('partials/links.php'); ?>
   <title>Book Affordable Rooms in Sikkim | <?php echo $setting_r['site_title'] ?></title>

  <meta name="title" content="Rooms for Rent in Sikkim | <?php echo $setting_r['site_title'] ?>">
  <meta name="description" content="Book top-rated rooms in Sikkim at <?php echo $setting_r['site_title'] ?>. Choose by dates, guests, and amenities. Ideal for couples, families & solo travelers.">
  <meta name="keywords" content="book hotel room Sikkim, <?php echo $setting_r['site_title'] ?>, homestay in Sikkim, affordable rooms, guest house">
  <meta name="author" content="<?php echo $setting_r['site_title'] ?>">
  <meta name="robots" content="index, follow">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.tamudheehomestay.com/room.php">
  <meta property="og:title" content="Rooms in Sikkim | <?php echo $setting_r['site_title'] ?>">
  <meta property="og:description" content="Explore a variety of affordable rooms with great amenities at <?php echo $setting_r['site_title'] ?>.">
  <meta property="og:image" content="https://www.tamudheehomestay.com/images/room/thumbnail.png">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="https://www.tamudheehomestay.com/room.php">
  <meta property="twitter:title" content="Rooms in Sikkim | <?php echo $setting_r['site_title'] ?>">
  <meta property="twitter:description" content="Explore a variety of affordable rooms with great amenities at <?php echo $setting_r['site_title'] ?>.">
  <meta property="twitter:image" content="https://www.tamudheehomestay.com/images/rooms-banner.jpg">

  <link rel="canonical" href="https://www.tamudheehomestay.com/room.php">

  <!-- Schema Markup -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Hotel",
    "name": "<?php echo $setting_r['site_title'] ?>",
    "description": "Affordable rooms with modern amenities in Sikkim.",
    "image": "https://www.tamudheehomestay.com/images/room/thumbnail.png",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Sikkim",
      "addressCountry": "IN"
    },
    "url": "https://www.tamudheehomestay.com/room.php"
  }
  </script>


  <style>
    /* Loader */
    #loader {
      width: 4rem;
      height: 4rem;
      border-width: 0.4em;
      animation: spinGlow 1.2s linear infinite;
      box-shadow: 0 0 12px rgba(0, 196, 118, 0.5);
    }

    @keyframes spinGlow {
      0% {
        transform: rotate(0deg);
        box-shadow: 0 0 8px rgba(0, 196, 118, 0.3);
      }

      50% {
        box-shadow: 0 0 16px rgba(0, 196, 118, 0.8);
      }

      100% {
        transform: rotate(360deg);
        box-shadow: 0 0 8px rgba(0, 196, 118, 0.3);
      }
    }

    .loading-text {
      font-weight: 500;
      color: #00c476;
      text-align: center;
      font-size: 1.1rem;
      animation: fadeIn 1.2s ease-in-out infinite alternate;
    }

    @keyframes fadeIn {
      from {
        opacity: 0.3;
      }

      to {
        opacity: 1;
      }
    }

    .h-line {
      width: 80px;
      height: 3px;
      margin: 10px auto;
    }

    .filter-title {
      font-size: 14px;
      font-weight: 600;
    }

    .room-card .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .room-card .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .room-img {
      height: 220px;
      object-fit: cover;
      transition: 0.3s ease;
    }

    .room-img:hover {
      filter: grayscale(90%);
      transform: scale(1.02);
    }

    .badge {
      font-size: 13px;
    }

    .custom-btn {
      font-size: 14px;
      padding: 6px 10px;
    }

    .card-price {
      font-weight: 600;
      color: #28a745;
    }

    .form-check-label:hover {
      color: rgb(22, 228, 70);
      transition: color 0.2s;
    }

    .form-check-input:checked {
      background-color: rgb(13, 253, 93);
      border-color: rgb(6, 224, 25);
      transition: all 0.2s ease-in-out;
    }
  </style>

  <?php require('partials/header.php'); 
   $checkin_default ="";
   $checkout_default = "";
   $adult_default = "";
   $children_default =  "";
   
   if(isset($_GET['check_availability']))
   {
     $frm_data = filteration($_GET);

     $checkin_default = $frm_data['checkin'];
     $checkout_default = $frm_data['checkout'];
     $adult_default = $frm_data['adult'];
     $children_default = $frm_data['children'];
   }
  ?>

  <div class="my-5 px-4" data-aos="fade-down">
    <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
    <div class="h-line"></div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <!-- FILTER SIDEBAR -->
      <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
        <nav class="navbar navbar-expand-lg rounded shadow" data-aos="fade-right">
          <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2">FILTERS</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">

              <!-- Availability -->
              <div class="border p-3 rounded mb-3" data-aos="fade-up">
                <h5 class="d-flex justify-content-between filter-title">
                  <span>CHECK AVAILABILITY</span>
                  <button id="chk_avail_btn" onclick="chk_avail_clear()" class="btn btn-sm shadow-none d-none">Reset</button>
                </h5>
                <label class="form-label">Check-in</label>
                <input type="date" class="form-control shadow-none mb-3" value="<?php echo $checkin_default ?>" id="checkin" onchange="chk_avail_filter()">
                <label class="form-label">Check-Out</label>
                <input type="date" class="form-control shadow-none" value="<?php echo $checkout_default ?>" id="checkout" onchange="chk_avail_filter()">
              </div>

              <!-- Facilities -->
              <div class="border p-3 rounded mb-3" data-aos="fade-up" data-aos-delay="100">
                <h5 class="d-flex justify-content-between filter-title">
                  <span>ROOM AMENITIES</span>
                  <button id="facilities_btn" onclick="facilities_clear()" class="btn btn-sm shadow-none d-none">Reset</button>
                </h5>
                <?php
                $facilities_q = selectAll('facilities');
                while ($row = mysqli_fetch_assoc($facilities_q)) {
                  echo <<<HTML
                    <div class="form-check mb-3 ps-0 d-flex align-items-center">
                      <input type="checkbox" onclick="fetch_room()" name="facilities" value="$row[id]" id="$row[id]" class="form-check-input shadow-sm me-2 mt-0" style="width: 1.2em; height: 1.2em;">
                      <label class="form-check-label fw-medium" for="$row[id]">$row[name]</label>
                    </div>
                  HTML;
                }
                ?>
              </div>

              <!-- Guests -->
              <div class="border p-3 rounded mb-3" data-aos="fade-up" data-aos-delay="200">
                <h5 class="d-flex justify-content-between filter-title">
                  <span>GUESTS</span>
                  <button id="guests_btn" onclick="guests_clear()" class="btn btn-sm shadow-none d-none">Reset</button>
                </h5>
                <div class="d-flex">
                  <div class="me-3">
                    <label class="form-label">Adult</label>
                    <input type="number" min="1" id="adult" value="<?php echo $adult_default?>" oninput="guests_filter()" class="form-control shadow-none">
                  </div>
                  <div>
                    <label class="form-label">Children</label>
                    <input type="number" min="0" id="children" value="<?php echo $children_default?>" oninput="guests_filter()" class="form-control shadow-none">
                  </div>
                </div>
              </div>

            </div>
          </div>
        </nav>
      </div>

      <!-- ROOM LISTING -->
      <div class="col-lg-9 col-md-12 px-4 room-card" id="rooms_data"></div>
    </div>
  </div>

  <?php require('partials/footer.php'); ?>

  <!-- AOS JS -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init({ duration: 800, once: true });</script>

  <script>
    const rooms_data = document.getElementById('rooms_data');
    const checkin = document.getElementById('checkin');
    const checkout = document.getElementById('checkout');
    const chk_avail_btn = document.getElementById('chk_avail_btn');
    const adult = document.getElementById('adult');
    const children = document.getElementById('children');
    const guests_btn = document.getElementById('guests_btn');
    const facilities_btn = document.getElementById('facilities_btn');

    function fetch_room() {
      const chk_avail = JSON.stringify({
        checkin: checkin.value,
        checkout: checkout.value
      });

      const guests = JSON.stringify({
        adult: adult.value,
        children: children.value
      });

      let facility_list = { facilities: [] };
      document.querySelectorAll('[name="facilities"]:checked').forEach(facility => {
        facility_list.facilities.push(facility.value);
      });

      facilities_btn.classList.toggle('d-none', facility_list.facilities.length === 0);
      const facilitiesJSON = JSON.stringify(facility_list);

      const xhr = new XMLHttpRequest();
      xhr.open('GET', `ajax/room.php?fetch_room&chk_avail=${chk_avail}&guests=${guests}&facility_list=${facilitiesJSON}`, true);

      xhr.onprogress = () => {
        rooms_data.innerHTML = `
          <div class='d-flex flex-column align-items-center justify-content-center'>
            <div class='spinner-border text-success mb-3' id='loader'></div>
            <div class='loading-text'>Please wait...</div>
          </div>`;
      };

      xhr.onload = function () {
        rooms_data.innerHTML = this.responseText;
      };
      xhr.send();
    }

    function chk_avail_filter() {
      if (checkin.value && checkout.value) {
        fetch_room();
        chk_avail_btn.classList.remove('d-none');
      }
    }

    function chk_avail_clear() {
      checkin.value = '';
      checkout.value = '';
      chk_avail_btn.classList.add('d-none');
      fetch_room();
    }

    function guests_filter() {
      if (adult.value || children.value) {
        fetch_room();
        guests_btn.classList.remove('d-none');
      }
    }

    function guests_clear() {
      adult.value = '';
      children.value = '';
      guests_btn.classList.add('d-none');
      fetch_room();
    }

    function facilities_clear() {
      document.querySelectorAll('[name="facilities"]:checked').forEach(cb => cb.checked = false);
      facilities_btn.classList.add('d-none');
      fetch_room();
    }

    window.onload = function(){
        fetch_room();
    }
    
  </script>



</body>

</html>
