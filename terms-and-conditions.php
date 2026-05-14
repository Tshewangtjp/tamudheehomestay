<!DOCTYPE html>
<html lang="en" data-bs-theme="" id="htmlPage">
<head>
  <?php require('partials/links.php'); ?>
  <title>Terms & Conditions || <?php echo htmlspecialchars($setting_r['site_title']); ?></title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Read the Terms & Conditions of <?php echo htmlspecialchars($setting_r['site_title']); ?> to understand our rules, user responsibilities, and legal guidelines.">
  <meta name="keywords" content="Terms and Conditions, Website Policies, <?php echo htmlspecialchars($setting_r['site_title']); ?>, User Agreement, Legal, Privacy">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://www.tamudheehomestay.com/terms-and-conditions.php" />
  
  <!-- Open Graph -->
  <meta property="og:title" content="Terms & Conditions | <?php echo htmlspecialchars($setting_r['site_title']); ?>" />
  <meta property="og:description" content="Review the terms and policies that govern your use of <?php echo htmlspecialchars($setting_r['site_title']); ?>." />
  <meta property="og:image" content="https://www.tamudheehomestay.com/assets/images/favicon.jpg" />
  <meta property="og:url" content="https://www.tamudheehomestay.com/terms-and-conditions.php" />
  <meta property="og:type" content="website" />

  <!-- Twitter Cards -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Terms & Conditions | <?php echo htmlspecialchars($setting_r['site_title']); ?>" />
  <meta name="twitter:description" content="Explore the legal terms, conditions, and policies of using <?php echo htmlspecialchars($setting_r['site_title']); ?>." />
  <meta name="twitter:image" content="https://www.tamudheehomestay.com/assets/images/favicon.jpg" />

  <!-- Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Terms & Conditions",
    "url": "https://www.tamudheehomestay.com/terms-and-conditions.php",
    "description": "Read the Terms & Conditions for using <?php echo htmlspecialchars($setting_r['site_title']); ?>.",
    "publisher": {
      "@type": "Organization",
      "name": "<?php echo htmlspecialchars($setting_r['site_title']); ?>"
    }
  }
  </script>




  

<?php require('partials/header.php'); ?>
  <style>
  
    header.experience {
      position: relative;
      height: 450px;
      background: url('assets/images/Sikkim-India-1.jpg') center center/cover no-repeat;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 0 20px;
    }

    header.experience::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.45);
      backdrop-filter: blur(3px);
      z-index: 1;
    }

    .experience .caption {
      position: relative;
      z-index: 2;
    }

    .experience h1 {
      font-size: 3.5rem;
      letter-spacing: 2px;
      margin-bottom: 0.3rem;
    }

    .experience p {
      font-size: 1.3rem;
      opacity: 0.9;
   
    }

    .section-padding {
      padding: 80px 20px;
      max-width: 900px;
      margin: 0 auto 80px auto;
      border-radius: 20px;
      box-shadow: 0 30px 45px rgba(0, 0, 0, 0.07);
    }

    .section-subtitle {
      font-size: 1.75rem;
      font-weight: 700;
      color: #00c476;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .section-subtitle i {
      font-size: 1.9rem;
      color: #00b364;
    }

    ul.pu-li {
      list-style: none;
      padding-left: 0;
    }

    ul.pu-li li {
      position: relative;
      padding-left: 32px;
      margin-bottom: 1.4rem;
      font-size: 1.1rem;
    }

    ul.pu-li li::before {
      content: '\f058';
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      color: #00c476;
      position: absolute;
      left: 0;
      top: 0.25rem;
      font-size: 1rem;
    }

    .linkss {
      color: #00c476;
      font-weight: 600;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .linkss:hover {
      color: #007a4d;
      text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .experience h1 {
        font-size: 2.8rem;
      }
      .section-padding {
        padding: 50px 15px;
        margin-bottom: 50px;
      }
      ul.pu-li li {
        font-size: 1rem;
      }
    }

    @media (max-width: 480px) {
      .experience h1 {
        font-size: 2.2rem;
      }
      .section-subtitle {
        font-size: 1.4rem;
      }
    }
  </style>

<!-- Hero Section -->
<header class="experience" role="banner" aria-label="Page header">
  <div class="caption" data-aos="fade-up">
    <h1 class="fw-bold"><?php echo htmlspecialchars($setting_r['site_title']); ?></h1>
    <p class="lead">Terms & Conditions</p>
  </div>
</header>

<!-- Terms Section -->
<section class="section-padding" aria-labelledby="terms-title">
  <h2 id="terms-title" class="visually-hidden">Terms & Conditions</h2>
  <article class="mb-5" aria-label="General terms and conditions">
    <h3 class="section-subtitle"><i class="fas fa-globe"></i> General</h3>
    <ul class="pu-li">
      <li>The website <a class="linkss" href="https://yourdomain.com" target="_blank" rel="noopener noreferrer">https://yourdomain.com</a> is owned and operated by <?php echo htmlspecialchars($setting_r['site_title']); ?>. Use of the site implies your agreement to these terms and policies.</li>
      <li><?php echo htmlspecialchars($setting_r['site_title']); ?> reserves the right to update or change any content, services, or terms at any time without prior notice. Continued use constitutes acceptance of the updated terms.</li>
      <li>By using this website, you confirm that you are at least 18 years old or have parental/guardian consent.</li>
      <li>You agree to use the website only for lawful purposes and not to engage in activities that may harm the site or other users.</li>
    </ul>
  </article>

  <article class="mb-5" aria-label="Intellectual property">
    <h3 class="section-subtitle"><i class="fas fa-copyright"></i> Intellectual Property</h3>
    <ul class="pu-li">
      <li>All content, including text, images, logos, graphics, and software on this site, is the property of <?php echo htmlspecialchars($setting_r['site_title']); ?> or its licensors and protected by copyright and trademark laws.</li>
      <li>Users may not copy, reproduce, distribute, or create derivative works without express written permission.</li>
      <li>Any unauthorized use of site content may result in legal action.</li>
    </ul>
  </article>

  <article class="mb-5" aria-label="User content">
    <h3 class="section-subtitle"><i class="fas fa-users"></i> User Content</h3>
    <ul class="pu-li">
      <li>Users are responsible for any content they submit, upload, or post on the site.</li>
      <li><?php echo htmlspecialchars($setting_r['site_title']); ?> reserves the right to remove or modify any user content deemed inappropriate, offensive, or violating these terms.</li>
      <li>By posting content, you grant us a non-exclusive, worldwide, royalty-free license to use, reproduce, and display such content.</li>
    </ul>
  </article>

  <article class="mb-5" aria-label="Indemnity">
    <h3 class="section-subtitle"><i class="fas fa-shield-halved"></i> Indemnity</h3>
    <ul class="pu-li">
      <li>You agree to indemnify, defend, and hold harmless <?php echo htmlspecialchars($setting_r['site_title']); ?>, its affiliates, and employees from any claims, damages, liabilities, and expenses arising from your use of the site or violation of these terms.</li>
    </ul>
  </article>

  <article class="mb-5" aria-label="Availability">
    <h3 class="section-subtitle"><i class="fas fa-server"></i> Availability</h3>
    <ul class="pu-li">
      <li><?php echo htmlspecialchars($setting_r['site_title']); ?> strives to ensure the website is available and functioning correctly but does not guarantee uninterrupted access or error-free performance.</li>
      <li>We are not liable for any downtime or disruptions.</li>
    </ul>
  </article>

  <article class="mb-5" aria-label="Hyperlinks">
    <h3 class="section-subtitle"><i class="fas fa-link"></i> Hyperlinks</h3>
    <ul class="pu-li">
      <li>This site may contain links to third-party websites. These links are provided for your convenience only.</li>
      <li><?php echo htmlspecialchars($setting_r['site_title']); ?> does not endorse or assume responsibility for content, privacy policies, or practices of external sites.</li>
    </ul>
  </article>

  <article class="mb-5" aria-label="Disclaimer">
    <h3 class="section-subtitle"><i class="fas fa-exclamation-triangle"></i> Disclaimer</h3>
    <ul class="pu-li">
      <li>The content on this website is provided “as is” without warranties of any kind, either express or implied.</li>
      <li><?php echo htmlspecialchars($setting_r['site_title']); ?> is not responsible for any damages or losses resulting from the use or inability to use the site.</li>
    </ul>
  </article>

  <article class="mb-5" aria-label="Privacy">
    <h3 class="section-subtitle"><i class="fas fa-user-shield"></i> Privacy</h3>
    <ul class="pu-li">
      <li>Your privacy is important to us. Please review our <a class="linkss" href="privacy&policy.php" target="_blank" rel="noopener noreferrer">Privacy Policy</a> to understand how we collect, use, and protect your data.</li>
    </ul>
  </article>

  <article class="mb-5" aria-label="Limitation of Liability">
    <h3 class="section-subtitle"><i class="fas fa-ban"></i> Limitation of Liability</h3>
    <ul class="pu-li">
      <li>Under no circumstances shall <?php echo htmlspecialchars($setting_r['site_title']); ?>, its directors, employees, or affiliates be liable for any indirect, incidental, special, or consequential damages arising out of or in connection with the use of the site.</li>
    </ul>
  </article>

  <article class="mb-5" aria-label="Governing Law">
    <h3 class="section-subtitle"><i class="fas fa-gavel"></i> Governing Law</h3>
    <ul class="pu-li">
      <li>These terms shall be governed by and construed in accordance with the laws of the jurisdiction where <?php echo htmlspecialchars($setting_r['site_title']); ?> is based.</li>
      <li>Any disputes arising from these terms or use of the site will be resolved exclusively in the courts located within that jurisdiction.</li>
    </ul>
  </article>

  <article aria-label="Contact Information">
    <h3 class="section-subtitle"><i class="fas fa-envelope"></i> Contact Us</h3>
    <p>If you have any questions about these Terms & Conditions, please contact us at <a class="linkss" href="mailto:<?php echo $contact_r['email'] ?>"><?php echo $contact_r['email'] ?></a></p>
  </article>
</section>
<br>

<?php require('partials/footer.php'); ?>

<script>
  AOS.init({ duration: 800, once: true });
</script>
</body>
</html>
