<!DOCTYPE html>
<html lang="en" data-bs-theme="" id="htmlPage">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php require('partials/links.php'); ?>
  <title>About Us | <?php echo $setting_r['site_title']; ?> - Trusted Homestay in Sikkim</title>

  <!-- SEO Meta Tags -->
  <meta name="description" content="Discover the story of <?php echo $setting_r['site_title']; ?> - a top-rated homestay in Sikkim known for warm hospitality, scenic views, and cozy accommodations.">
  <meta name="keywords" content="About <?php echo $setting_r['site_title']; ?>, Sikkim Homestay, Hotel in Sikkim, Rooms in Sikkim, Sikkim Tourism, Best Homestay in Sikkim">
  <meta name="author" content="<?php echo $setting_r['site_title']; ?>">

  <!-- Canonical & Alternate -->
  <link rel="canonical" href="https://www.tamudheehomestay.com/aboutus.php" />
  <link rel="alternate" hreflang="en-IN" href="https://www.tamudheehomestay.com/aboutus.php" />

  <!-- Open Graph -->
  <meta property="og:title" content="About Us | <?php echo $setting_r['site_title']; ?>">
  <meta property="og:description" content="Discover more about <?php echo $setting_r['site_title']; ?>, your comfortable homestay in Sikkim with modern amenities and local hospitality.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.tamudheehomestay.com/aboutus.php">
  <meta property="og:image" content="https://www.tamudheehomestay.com/assets/images/favicon.jpg">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="About Us | <?php echo $setting_r['site_title']; ?>">
  <meta name="twitter:description" content="Explore the story of <?php echo $setting_r['site_title']; ?>, a beautiful homestay in Sikkim with top-notch service and cozy rooms.">
  <meta name="twitter:image" content="https://www.tamudheehomestay.com/assets/images/favicon.jpg">

  <!-- Structured Data: LodgingBusiness -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "LodgingBusiness",
    "name": "<?php echo $setting_r['site_title']; ?>",
    "image": "https://www.tamudheehomestay.com/assets/images/favicon.jpg",
    "telephone": "+91<?php echo $contact_r['pn1']; ?>",
    "email": "<?php echo $contact_r['email']; ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?php echo $contact_r['address']; ?>",
      "addressCountry": "IN"
    },
    "url": "https://www.tamudheehomestay.com/aboutus.php"
  }
  </script>

  <!-- Custom Styles -->
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    .h-font {
      font-size: 2.5rem;
      font-weight: 700;
    }

   

    .about-section {
      padding: 60px 20px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .about-section img {
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .box {
      background-color: #fff;
      border-top: 4px solid #28a745;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
      transition: transform 0.3s ease;
    }

    .box:hover {
      transform: translateY(-5px);
    }

    .box h4 {
      font-size: 1.2rem;
      font-weight: 600;
      margin-top: 15px;
      color: #333;
    }

    .box img {
      width: 60px;
      height: auto;
    }

    @media (max-width: 767px) {
      .h-font {
        font-size: 2rem;
      }
    }
  </style>

 

  <?php require('partials/header.php'); ?>

  <!-- Page Title -->
  <div class="my-5 text-center" data-aos="fade-down">
    <h2 class="fw-bold h-font">ABOUT US</h2>
    
  </div>

  <!-- About Content -->
  <div class="container about-section mb-5" data-aos="fade-up">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 mb-4" data-aos="fade-right">
        <h3 class="mb-3"><?php echo $setting_r['site_title']; ?></h3>
        <p><?php echo ($setting_r['site_about']); ?></p>
      </div>
      <div class="col-lg-5" data-aos="fade-left">
        <img src="assets/images/favicon.jpg" style="width: 400px;" class="img-fluid" alt="<?php echo $setting_r['site_title']; ?>">
      </div>
    </div>
  </div>

  <!-- Stats Boxes -->
  <div class="container mb-5">
    <div class="row text-center g-4">
      <div class="col-lg-3 col-md-6" data-aos="zoom-in">
        <div class="box p-4">
          <img src="assets/images/about/hotel.jpg" alt="Rooms">
          <h4>10+ ROOMS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
        <div class="box p-4">
          <img src="assets/images/about/customers.jpg" alt="Customers">
          <h4>100+ CUSTOMERS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
        <div class="box p-4">
          <img src="assets/images/about/rating.jpg" alt="Reviews">
          <h4>100+ REVIEWS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
        <div class="box p-4">
          <img src="assets/images/about/staff.jpg" alt="Staff">
          <h4>5+ STAFF</h4>
        </div>
      </div>
    </div>
  </div>

  <?php require('partials/footer.php'); ?>

 
  <script>
    AOS.init({
      duration: 1000,
      once: true
    });
  </script>
</body>
</html>
