<!DOCTYPE html>
<html lang="en" data-bs-theme="" id="htmlPage">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

   <?php require('partials/links.php'); ?>
  <title>Privacy Policy | <?php echo $setting_r['site_title']?> - Sikkim Homestay Booking</title>

  <!-- SEO Meta Tags -->
  <meta name="description" content="View the privacy policy of <?php echo $setting_r['site_title']?> to learn how your personal data is collected, used, and protected during your Sikkim homestay experience.">
  <meta name="keywords" content="Privacy Policy, <?php echo $setting_r['site_title']?>, Data Protection, Guest Privacy, Hotel Website, Booking Information, Sikkim Stay">
  <meta name="robots" content="index, follow">
  <meta name="author" content="<?php echo $setting_r['site_title']?>">
  <meta name="language" content="English">
  <meta name="geo.region" content="IN-SK" />
  <meta name="geo.placename" content="Sikkim, India" />

  <!-- Open Graph / Facebook -->
  <meta property="og:title" content="Privacy Policy | <?php echo $setting_r['site_title']?> - Sikkim Homestay Booking" />
  <meta property="og:description" content="We are committed to protecting your personal data. Read our privacy policy for complete details." />
  <meta property="og:image" content="https://www.tamudheehomestay.com/assets/images/favicon.jpg" />
  <meta property="og:url" content="https://www.tamudheehomestay.com/privacy-policy.php" />
  <meta property="og:type" content="website" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Privacy Policy | <?php echo $setting_r['site_title']?> - Sikkim Homestay Booking">
  <meta name="twitter:description" content="Your privacy is important to us. Learn more about how we collect, use, and protect your information.">
  <meta name="twitter:image" content="https://www.tamudheehomestay.com/assets/images/favicon.jpg">

  <!-- Canonical URL -->
  <link rel="canonical" href="https://www.tamudheehomestay.com/privacy-policy.php" />

  <!-- Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "PrivacyPolicy",
    "name": "Privacy Policy",
    "url": "https://www.tamudheehomestay.com/privacy-policy.php",
    "description": "This privacy policy explains how <?php echo $setting_r['site_title']?> collects and protects personal data during your Sikkim homestay booking and stay.",
    "publisher": {
      "@type": "Organization",
      "name": "<?php echo $setting_r['site_title']?>",
      "url": "https://www.tamudheehomestay.com",
      "logo": {
        "@type": "ImageObject",
        "url": "https://www.tamudheehomestay.com/assets/images/favicon.jpg"
      }
    }
  }
  </script>





<?php require('partials/header.php'); ?>
  <style>
    header.experience {
      position: relative;
      height: 500px;
      background: url('assets/images/Sikkim-India-1.jpg') center center/cover no-repeat;
      color: white;
    }
  
    header.experience::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(2px);
    }
    .experience .caption {
      position: relative;
      z-index: 1;
      padding-top: 150px;
    }

    .faq-section {
      padding: 60px 0;
    }

    .section-subtitle{
        color: #00c476;
    }
  </style>

<!-- Hero Section -->
<header class="experience text-center d-flex align-items-center justify-content-center">
  <div class="caption">
    <div class="container">
      <h1 class="display-4 fw-bold"><?php echo $setting_r['site_title']?></h1>
      <p class="lead">Privacy Policy</p>
    </div>
  </div>
</header>

<section class="section-padding shadow-sm rounded mx-auto mt-5 mb-5" style="max-width: 900px;">
  <div class="container">
    <div class="row">
      
      <!-- 1. Introduction -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">1. Introduction</p>
        <ul class="pu-li">
          <li>Welcome to <b><?php echo $setting_r['site_title']?></b>. We value your privacy and are committed to protecting your personal information. This Privacy Policy outlines how we handle your data when you interact with our website or services.</li>
        </ul>
      </div>

      <!-- 2. What Information We Collect -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">2. What Information We Collect</p>
        <ul class="pu-li">
          <li>Name, contact details, ID proof, travel preferences, and booking details provided during reservations.</li>
          <li>Technical data such as IP address, browser type, and usage behavior via cookies.</li>
        </ul>
      </div>

      <!-- 3. How We Collect Your Data -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">3. How We Collect Your Data</p>
        <ul class="pu-li">
          <li>Through direct interactions (e.g., booking form, email, phone).</li>
          <li>Automatically via website technologies like cookies and analytics tools.</li>
        </ul>
      </div>

      <!-- 4. Why We Collect Your Data -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">4. Why We Collect Your Data</p>
        <ul class="pu-li">
          <li>To manage your bookings, personalize your experience, and improve our hospitality services.</li>
        </ul>
      </div>

      <!-- 5. Use of Cookies -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">5. Use of Cookies</p>
        <ul class="pu-li">
          <li>Cookies help us improve your browsing experience by remembering your preferences. You may disable them via your browser.</li>
        </ul>
      </div>

      <!-- 6. Booking & Payment Details -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">6. Booking & Payment Details</p>
        <ul class="pu-li">
          <li>We securely collect and process booking information. Payment details are processed via trusted third-party gateways.</li>
        </ul>
      </div>

      <!-- 7. Email Communications -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">7. Email Communications</p>
        <ul class="pu-li">
          <li>We may send you booking confirmations, updates, and promotional offers. You can unsubscribe anytime.</li>
        </ul>
      </div>

      <!-- 8. Third-Party Services -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">8. Third-Party Services</p>
        <ul class="pu-li">
          <li>We may share limited data with service providers (e.g., payment processors, email marketing platforms) strictly for operational needs.</li>
        </ul>
      </div>

      <!-- 9. Data Retention -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">9. Data Retention</p>
        <ul class="pu-li">
          <li>We retain personal information only as long as necessary to fulfill the purpose it was collected for.</li>
        </ul>
      </div>

      <!-- 10. Your Rights -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">10. Your Rights</p>
        <ul class="pu-li">
          <li>You have the right to access, update, or delete your data. Contact us anytime to exercise your rights.</li>
        </ul>
      </div>

      <!-- 11. Data Security -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">11. Data Security</p>
        <ul class="pu-li">
          <li>We implement industry-standard encryption and security practices to protect your data from unauthorized access.</li>
        </ul>
      </div>

      <!-- 12. Local Guest Privacy -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">12. Local Guest Privacy</p>
        <ul class="pu-li">
          <li>Guest IDs and address proofs are collected per legal requirements and are securely stored with restricted access.</li>
        </ul>
      </div>

      <!-- 13. Child Privacy -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">13. Child Privacy</p>
        <ul class="pu-li">
          <li>We do not knowingly collect data from individuals under the age of 13 without parental consent.</li>
        </ul>
      </div>

      <!-- 14. Social Media -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">14. Social Media</p>
        <ul class="pu-li">
          <li>Any interaction via our social media pages is subject to the privacy policies of the respective platforms.</li>
        </ul>
      </div>

      <!-- 15. CCTV & Surveillance -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">15. CCTV & Surveillance</p>
        <ul class="pu-li">
          <li>We use CCTV in common areas for guest safety and security. Recordings are securely stored and not used for any other purpose.</li>
        </ul>
      </div>

      <!-- 16. Legal Compliance -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">16. Legal Compliance</p>
        <ul class="pu-li">
          <li>We may disclose your data if required by law or in response to valid legal processes or governmental requests.</li>
        </ul>
      </div>

      <!-- 17. Links to Other Sites -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">17. Links to Other Sites</p>
        <ul class="pu-li">
          <li>Our site may contain links to other websites. We are not responsible for their privacy practices.</li>
        </ul>
      </div>

      <!-- 18. Changes to this Policy -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">18. Changes to this Policy</p>
        <ul class="pu-li">
          <li>We may update this Privacy Policy occasionally. Changes will be reflected on this page with a revised effective date.</li>
        </ul>
      </div>

      <!-- 19. Grievance Redressal -->
      <div class="col-12 mb-4">
        <p class="section-subtitle">19. Grievance Redressal</p>
        <ul class="pu-li">
          <li>If you have concerns about your privacy or this policy, please email us at <b style="color: #00c476;"><?php echo $contact_r['email']?></b>.</li>
        </ul>
      </div>

      <!-- 20. Contact Details -->
      <div class="col-12">
        <p class="section-subtitle">20. Contact Details</p>
        <ul class="pu-li">
            <b>
          <li><?php echo $setting_r['site_title']?><br><?php echo $contact_r['address']?><br>Email: <?php echo $contact_r['email']?><br>Phone: +91-<?php echo $contact_r['pn1']?></li>
          </b>
        </ul>
      </div>

    </div>
  </div>
</section>


<?php require('partials/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
