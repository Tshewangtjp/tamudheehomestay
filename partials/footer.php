<!-- Remove the container if you want to extend the Footer to full width. -->
<div class="container-fluid my-20" style="width: 100%;">
  <!-- Footer -->
  <footer class="mt-auto text-lg-start">
    <a href="" class="goto-top d-flex align-items-center justify-content-center">
      <i class="bi bi-arrow-up"></i>
    </a>
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">
              <?php echo $setting_r['site_title'] ?>
            </h6>
            <p>
              <?php echo $setting_r['site_about'] ?>
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />
          <style>
            #explore {
              color: #039e60;
              text-decoration: none;
              cursor: pointer;
            }

            #explore:hover {
              text-decoration: #039e60 underline;
            }
          </style>
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Explore</h6>
            <p>
              <a href="../faq.php" id="explore">FAQ</a>
            </p>
            <p>
              <a id="explore" href="../terms-and-conditions.php">Terms & Condition</a>
            </p>
            <p>
              <a id="explore" href="../privacy-policy.php">Privacy Policy</a>
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />


          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
            <p><i class="fas fa-home mr-3"></i> <?php echo $contact_r['address'] ?></p>
            <p><i class="fas fa-envelope mr-3"></i> <?php echo $contact_r['email'] ?></p>
            <p><i class="fas fa-phone mr-3"></i> +91 <?php echo $contact_r['pn1'] ?></p>
            <?php
            if ($contact_r['pn2'] != '') {
              echo <<<data
                        <p><i class="fas fa-phone mr-3"></i> +91 $contact_r[pn2]</p>
                        data;
            } ?>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Opening hours</h6>

            <table class="table text-center text-white">
              <tbody class="font-weight-normal">
                <tr>
                  <td>Mon - Thu:</td>
                  <td>24/7</td>
                </tr>
                <tr>
                  <td>Fri - Sat:</td>
                  <td>24/7</td>
                </tr>
                <tr>
                  <td>Sunday:</td>
                  <td>24/7</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->
    </div>
    <!-- Grid container -->
    <hr>
    <!-- Copyright -->
    <div class="footer_copyright p-7">
      <large>&copy; <?= date('Y') ?> All rights reserved by <?= htmlspecialchars($setting_r['site_title']) ?></large>
      <br>
      <small>Designed and Developed with ❤️ by <a
          href="https://wa.link/45mriz"><span></span>Tshewang</a></small>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</div>



<script>
  function alert(type, msg, position = 'body') {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        `;

    if (position == 'body') {
      document.body.append(element);
      element.classList.add('custom-alert');
    } else {
      document.getElementById(position).appendChild(element);
    }
    setTimeout(remAlert, 3000);
  }

  function remAlert() {
    document.getElementsByClassName('alert')[0].remove();
  }

  function setActive() {
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for (i = 0; i < a_tags.length; i++) {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if (document.location.href.indexOf(file_name) >= 0) {
        a_tags[i].classList.add('active');
      }
    }
  }








  let register_form = document.getElementById('register_form');

  register_form.addEventListener('submit', function(e) {
    e.preventDefault();


    let data = new FormData();

    data.append('name', register_form.elements['name'].value);
    data.append('email', register_form.elements['email'].value);
    data.append('phonenum', register_form.elements['phonenum'].value);
    data.append('address', register_form.elements['address'].value);
    data.append('pincode', register_form.elements['pincode'].value);
    data.append('dob', register_form.elements['dob'].value);
    data.append('pass', register_form.elements['pass'].value);
    data.append('cpass', register_form.elements['cpass'].value);
    data.append('profile', register_form.elements['profile'].files[0]);
    data.append('register', '');

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/login_register.php', true);



    xhr.onload = function() {
      if (this.responseText == 'pass_mismatch') {
        alert('error', "Password Mismatch!");
      } else if (this.responseText == 'email_already') {
        alert('error', "Email is already registered!");
      } else if (this.responseText == 'phone_already') {
        alert('error', "Phone Number is already registered!");
      } else if (this.responseText == 'inv_img') {
        alert('error', "Only JPG, JPEG, WEBP AND PNG are allowed!");
      } else if (this.responseText == 'upload_failed') {
        alert('error', "Image upload failed! Try again later");
      } else if (this.responseText == 'ins_failed') {
        alert('error', "Registration failed! Try again later");
      } else {
        alert('success', "Registration successful. Please Login!");
        register_form.reset();
      }

    }

    xhr.send(data);

  });

  let login_form = document.getElementById('login_form');

  login_form.addEventListener('submit', (e) => {
    e.preventDefault();


    let data = new FormData();
    data.append('login', '');
    data.append('email_mob', login_form.elements['email_mob'].value);
    data.append('pass', login_form.elements['pass'].value);


    var myModal = document.getElementById('loginModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);

    xhr.onload = function() {
      if (this.responseText == 'inv_email_mob') {
        alert('error', "Invalid Email or Mobile Number");
      } else if (this.responseText == 'inactive') {
        alert('error', "Account Suspended! Please Contact Admin");
      } else if (this.responseText == 'invalid_pass') {
        alert('error', "Incorrect Password!");
      } else {
        let fileurl = window.location.href.split('/').pop().split('?').shift();
        if (fileurl == 'room_details.php') {
          window.location = window.location.href;
        } else {
          window.location = window.location.pathname;
        }

      }


    }
    xhr.send(data);



  });

  let forgot_form = document.getElementById('forgot_form');

  forgot_form.addEventListener('submit', function(e) {
    e.preventDefault();


    let data = new FormData();

    data.append('email', forgot_form.elements['email'].value);
    data.append('forgot_pass', '');

    var myModal = document.getElementById('forgotModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/login_register.php', true);



    xhr.onload = function() {
      if (this.responseText == 'inv_email') {
        alert('error', "Invalid Email");
      } else if (this.responseText == 'inactive') {
        alert('error', "Account Suspended! Please Contact Admin");
      } else if (this.responseText == 'mail_failed') {
        alert('error', "Cannot send email. Server down!");
      } else if (this.responseText == 'upload_failed') {
        alert('error', "Account recovery failed. Server down!");
      } else {
        alert('success', "Reset link send to email! Check your inbox or spam");
        forgot_form.reset();
      }

    }

    xhr.send(data);

  });

  function checkLoginToBook(status, room_id) {
    if (status) {
      window.location.href = 'confirm_booking.php?id=' + room_id;
    } else {
      alert('error', 'Please login to book room!');
    }
  }

 




  setActive();
</script>






<script>
  const preloader = document.getElementById('preloader');
  const progressBar = document.getElementById('progress-bar');
  const progressText = document.getElementById('progress-text');

  const assets = document.images;
  const totalAssets = assets.length;
  let loadedAssets = 0;

  if (totalAssets === 0) {
    finishPreloader();
  } else {
    for (let i = 0; i < totalAssets; i++) {
      const tempImg = new Image();
      tempImg.onload = tempImg.onerror = () => {
        loadedAssets++;
        const percent = Math.round((loadedAssets / totalAssets) * 100);
        progressBar.style.width = percent + '%';
        progressText.innerText = `Loading ${percent}%`;
        if (loadedAssets === totalAssets) {
          finishPreloader();
        }
      };
      tempImg.src = assets[i].src;
    }
  }

  function finishPreloader() {
    setTimeout(() => {
      preloader.style.opacity = '0';
      preloader.style.pointerEvents = 'none';
      setTimeout(() => preloader.remove(), 600);
    }, 500);
  }
</script>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="../assets/js/theme.js"></script>
<script src="../assets/js/swiper.js"></script>
<script src="../assets/vendor/aos/aos.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>