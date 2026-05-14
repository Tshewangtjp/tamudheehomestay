<style>
  .custom-alert {
    position: fixed;
    top: 110px;
    right: 10px;
    z-index: 1;
  }
</style>
</head>
<body>
<style>
    /* === Preloader Styles === */
    #preloader {
      position: fixed;
      inset: 0;
      background-color: inherit;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      transition: opacity 0.6s ease;
    }

    .preloader-box {
      text-align: center;
      animation: fadeIn 1s ease;
    }

    .logo {
      width: 70px;
      height: 70px;
      object-fit: contain;
      margin-bottom: 20px;
    }

    .spinner {
      width: 40px;
      height: 40px;
      border: 5px solid rgba(255, 255, 255, 0.2);
      border-top-color: #00c476 ;
      border-radius: 50%;
      margin: 0 auto 20px;
      animation: spin 1s linear infinite;
    }

    .progress-container {
      width: 250px;
      height: 10px;
      background-color: #333;
      border-radius: 5px;
      margin: 0 auto 10px;
      overflow: hidden;
    }

    .progress-bar {
      width: 0%;
      height: 100%;
      background-color: #00c476 ;
      transition: width 0.3s ease;
    }

    .progress-text {
      font-size: 14px;
      font-weight: 500;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.95);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }
    
  </style>

<!-- Preloader -->
<div id="preloader">
  <div class="preloader-box">
    <img src="../assets/images/favicon.jpg" alt="Logo" class="logo" />
    <div class="spinner"></div>
    <div class="progress-container">
      <div class="progress-bar" id="progress-bar"></div>
    </div>
    <p class="progress-text" id="progress-text">Loading 0%</p>
  </div>
</div>



  <nav id="nav-bar" class="navbar navbar-expand-lg px-lg-3 py-lg-2 shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brands me-auto text-decoration-none" href="index.php"><?php echo $setting_r['site_title'] ?></a>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column p-0" style="font-size: 18px;">
          <ul class="navbar-nav justify-content-center align-items-center flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-links mx-lg-2" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-links mx-lg-2" href="../room.php">Room</a>
            </li>
            <li class="nav-item">
              <a class="nav-links mx-lg-2" href="activities.php">Activities</a>
            </li>
            <li class="nav-item">
              <a class="nav-links mx-lg-2" href="../aboutus.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-links mx-lg-2" href="../contactus.php">Contact Us</a>
            </li>

          </ul>

        </div>
      </div>

      <div class="d-flex flex-row align-items-center">
        <input type="checkbox" class="checkbox" id="checkbox">
        <label for="checkbox" class="checkbox-label">
          <i class="fas fa-moon"></i>
          <i class="fas fa-sun"></i>
          <span class="ball"></span>
        </label>
        <br>
        <br>
        <br>
        <br>
        <?php
      
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
          $path = USER_IMG_PATH;
          echo <<<data
          <div class="btn-group">
            <button type="button" class="btn shadow-none dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="$path$_SESSION[uPic]" alt="User" class="rounded-circle" width="35" height="35">
             
            </button>
              <style>
        .dropdown-menu .dropdown-item.active,
        .dropdown-menu .dropdown-item:hover {
          background-color: #00c476;
          color: #fff;
        }
      </style>

            <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 mt-2">
              <li class="dropdown-header fw-bold text-muted px-3">$_SESSION[uName]</li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person me-2"></i>Profile</a></li>
              <li><a class="dropdown-item" href="bookings.php"><i class="bi bi-journal-bookmark me-2"></i>Bookings</a></li>
              <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
            </ul>
          </div>
      data;
        
        } else {
          echo <<<data
                  <a href="" data-bs-toggle="modal" data-bs-target="#loginModal" class="login_button">Login</a>
                  data;
        }
        ?>

      </div>

      <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon shadow-none"></span>
      </button>
    </div>

  </nav>
  <hr>
  <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow-lg">
      <form id="login_form" class="p-4">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title d-flex align-items-center w-100">
            <i class="bi bi-person-circle fs-3 me-2"></i>
            <span class="fw-bold">User Login</span>
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body pt-0">

          <!-- Floating Email/Mobile Field -->
          <div class="form-floating mb-3">
            <input type="text" name="email_mob" class="form-control" id="email_mob" placeholder="Email or Mobile" required>
            <label for="email_mob">Email address / Mobile No</label>
          </div>

          <!-- Floating Password Field -->
          <div class="form-floating mb-2">
            <input type="password" name="pass" class="form-control" id="pass" placeholder="Password" required>
            <label for="pass">Password</label>
          </div>

          <!-- Show Password Toggle -->
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="showPasswordCheck" onclick="toggleLoginPassword()">
            <label class="form-check-label text-muted" for="showPasswordCheck">
              Show Password
            </label>
          </div>

          <!-- Login & Forgot -->
          <div class="d-flex align-items-center justify-content-between mb-3">
            <button type="submit" class="btn custom-bg px-4 shadow-sm">Login</button>
            <button type="button" class="btn btn-link text-decoration-none text-muted px-0" data-bs-toggle="modal" data-bs-target="#forgotModal">Forgot Password?</button>
          </div>

          <!-- Sign Up -->
          <div class="text-center mb-2">
            <small class="text-muted">Don't have an account yet?
              <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" class="text-decoration-none">Sign Up</a>
            </small>
          </div>

          <!-- Admin Login -->
          <div class="text-center">
            <a href="../admin/index.php" class="btn btn-outline-success w-100 shadow-sm mt-2">Login as Admin</a>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function toggleLoginPassword() {
    const input = document.getElementById('pass');
    input.type = input.type === 'pass' ? 'text' : 'pass';
  }
</script>





  

  <!-- Registration Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow-lg">
      <form id="register_form" class="p-4">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-circle fs-3 me-2"></i>
            <span class="fw-bold">User Registration</span>
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body pt-0">
          <span class="badge bg-light text-dark mb-3 lh-base text-wrap">
            Note: Your details must match with your ID (Aadhar card, Passport, Driving license, etc.) which will be required during booking.
          </span>

          <div class="row g-3">

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="name" class="form-control" id="regName" placeholder="Name" required>
                <label for="regName">Full Name</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" name="email" class="form-control" id="regEmail" placeholder="Email Address" required>
                <label for="regEmail">Email Address</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="tel" name="phonenum" class="form-control" id="regPhone" placeholder="Phone Number" required>
                <label for="regPhone">Phone Number (+91 etc.)</label>
              </div>
            </div>

            <div class="col-md-6">
              <label for="regPicture" class="form-label">Profile Picture</label>
              <input type="file" accept=".jpg, .jpeg, .png, .webp" name="profile" class="form-control" id="regPicture" required>
            </div>

            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control" name="address" id="regAddress" placeholder="Address" style="height: 80px" required></textarea>
                <label for="regAddress">Address</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" class="form-control" name="pincode" id="regPincode" placeholder="Pincode" required>
                <label for="regPincode">Pincode / Zipcode</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="date" class="form-control" name="dob" id="regDOB" placeholder="Date of Birth" required>
                <label for="regDOB">Date of Birth</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="password" name="pass" class="form-control" id="regPass" placeholder="Password" required>
                <label for="regPass">Password</label>
              </div>
              <!-- Password Rules -->
              <ul class="list-unstyled small text-muted mt-1" id="password_rules">
                <li id="rule-length">• Minimum 8 characters</li>
                <li id="rule-uppercase">• At least one uppercase letter</li>
                <li id="rule-number">• At least one number</li>
                <li id="rule-special">• At least one special character (!@#$%^&*)</li>
              </ul>
              <div id="strengthMsg" class="small mt-1"></div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="password" name="cpass" class="form-control" id="regCPass" placeholder="Confirm Password" required>
                <label for="regCPass">Confirm Password</label>
              </div>
              <div id="matchMsg" class="small mt-1"></div>
            </div>

            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="regShowPass" onclick="toggleRegisterPassword()">
                <label class="form-check-label text-muted" for="regShowPass">
                  Show Passwords
                </label>
              </div>
            </div>

          </div>

          <div class="text-center mt-4">
            <button type="submit" class="btn btn-success w-100">Register</button>
            <p class="mt-3 mb-0">
              <small class="text-muted">Already have an account?
                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-decoration-none">Sign In</a>
              </small>
            </p>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- JavaScript -->
<script>
  function toggleRegisterPassword() {
    const pass = document.getElementById('regPass');
    const cpass = document.getElementById('regCPass');
    const type = pass.type === 'password' ? 'text' : 'password';
    pass.type = cpass.type = type;
  }

  const regPass = document.getElementById('regPass');
  const regCPass = document.getElementById('regCPass');
  const strengthMsg = document.getElementById('strengthMsg');
  const matchMsg = document.getElementById('matchMsg');

  const ruleLength = document.getElementById('rule-length');
  const ruleUppercase = document.getElementById('rule-uppercase');
  const ruleNumber = document.getElementById('rule-number');
  const ruleSpecial = document.getElementById('rule-special');

  regPass.addEventListener('input', () => {
    const val = regPass.value;
    let strength = 0;

    // Rule checks
    if (val.length >= 8) {
      ruleLength.style.color = 'green';
      strength++;
    } else {
      ruleLength.style.color = 'red';
    }

    if (/[A-Z]/.test(val)) {
      ruleUppercase.style.color = 'green';
      strength++;
    } else {
      ruleUppercase.style.color = 'red';
    }

    if (/\d/.test(val)) {
      ruleNumber.style.color = 'green';
      strength++;
    } else {
      ruleNumber.style.color = 'red';
    }
    if (/[^A-Za-z0-9]/.test(val)) {
  ruleSpecial.style.color = 'green';
  strength++;
} else {
  ruleSpecial.style.color = 'red';
}

    if (val.length === 0) {
      strengthMsg.innerText = '';
    } else if (strength === 1) {
      strengthMsg.innerText = 'Weak';
      strengthMsg.style.color = 'red';
    } else if (strength === 2) {
      strengthMsg.innerText = 'Moderate';
      strengthMsg.style.color = 'orange';
    } else if (strength === 3) {
      strengthMsg.innerText = 'Strong';
      strengthMsg.style.color = 'green';
    }
  });

  regCPass.addEventListener('input', () => {
    if (regCPass.value === regPass.value) {
      matchMsg.innerText = 'Passwords match';
      matchMsg.style.color = 'green';
    } else {
      matchMsg.innerText = 'Passwords do not match';
      matchMsg.style.color = 'red';
    }
  });

  document.getElementById('register_form').addEventListener('submit', function (e) {
    const val = regPass.value;
    const hasLength = val.length >= 8;
    const hasUpper = /[A-Z]/.test(val);
    const hasNumber = /\d/.test(val);
    const passMatch = regPass.value === regCPass.value;
    const hasSpecial = /[^A-Za-z0-9]/.test(val);

    if (!(hasLength && hasUpper && hasNumber && hasSpecial)) {
      e.preventDefault();
  alert('error','Password must be at least 8 characters, include an uppercase letter, a number, and a special character.');
  regPass.focus();
  return;
}

    if (!passMatch) {
      e.preventDefault();
      alert('error','Passwords do not match.');
      regCPass.focus();
    }
  });
</script>



  <div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 rounded-4 shadow-lg">
        <form id="forgot_form" class="p-4">
          <div class="modal-header border-0 pb-0">
            <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-envelope-lock fs-3 me-2 text-primary"></i>
              <span class="fw-bold">Forgot Password</span>
            </h5>
          </div>

          <div class="modal-body pt-0">
            <span class="badge bg-light text-dark mb-3 lh-base text-wrap">
              Note: A password reset link will be sent to your registered email address.
            </span>

            <!-- Floating Label Email -->
            <div class="form-floating mb-4">
              <input type="email" name="email" class="form-control" id="forgotEmail" placeholder="Email address" required>
              <label for="forgotEmail">Email address</label>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end gap-2">
              <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#loginModal">Cancel</button>
              <button type="submit" class="btn btn-success">Send Link</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>