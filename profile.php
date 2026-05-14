<!-- profile.php -->
<!DOCTYPE html>
<html lang="en" data-bs-theme="" id="htmlPage">

<head>
  <?php require('partials/links.php'); ?>
   <title>Profile - Manage Your Account || <?php echo htmlspecialchars($setting_r['site_title']); ?></title>

  <!-- Primary Meta Tags -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Manage your profile, update personal information, change your profile picture, and secure your account on <?php echo htmlspecialchars($setting_r['site_title']); ?>." />
  <meta name="keywords" content="user profile, account settings, change password, update profile picture, personal information, <?php echo htmlspecialchars($setting_r['site_title']); ?>" />
  <meta name="author" content="<?php echo htmlspecialchars($setting_r['site_title']); ?>" />
  
  <!-- Open Graph / Facebook -->
  <meta property="og:title" content="Profile - Manage Your Account || <?php echo htmlspecialchars($setting_r['site_title']); ?>" />
  <meta property="og:description" content="Update your profile details, profile photo, and password securely on <?php echo htmlspecialchars($setting_r['site_title']); ?>." />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://www.tamudheehomestay.com" />
  <meta property="og:site_name" content="<?php echo htmlspecialchars($setting_r['site_title']); ?>" />
  
  <!-- Twitter -->
  <meta name="twitter:title" content="Profile - Manage Your Account || <?php echo htmlspecialchars($setting_r['site_title']); ?>" />
  <meta name="twitter:description" content="Update your profile details, profile photo, and password securely on <?php echo htmlspecialchars($setting_r['site_title']); ?>." />
  <meta name="twitter:card" content="summary" />

  <?php
  require('partials/header.php');
  if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
  }
  $u_exist = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 's');
  if (mysqli_num_rows($u_exist) == 0) {
    redirect('index.php');
  }
  $u_fetch = mysqli_fetch_assoc($u_exist);
  ?>




  <div class="container py-5">
    <div class="row g-4">

      <div class="col-12 my-5 px-4">
        <h2 class="fw-bold">PROFILE</h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-success text-decoration-none">HOME</a>
          <span> > </span>
          <a class="text-success text-decoration-none" href="profile.php">PROFILE</a>
        </div>
      </div>

      <!-- Basic Info -->
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title fw-bold mb-3"><i class="bi bi-person-lines-fill me-2"></i>Basic Information</h5>
            <form id="info_form">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Full Name</label>
                  <input type="text" name="name" class="form-control" required value="<?= $u_fetch['name'] ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Phone Number</label>
                  <input type="text" name="phonenum" class="form-control" required value="<?= $u_fetch['phonenum'] ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Date of Birth</label>
                  <input type="date" name="dob" class="form-control" required value="<?= $u_fetch['dob'] ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Pincode / Zip</label>
                  <input type="text" name="pincode" class="form-control" required value="<?= $u_fetch['pincode'] ?>">
                </div>
                <div class="col-12">
                  <label class="form-label">Address</label>
                  <textarea name="address" class="form-control" rows="2" required><?= $u_fetch['address'] ?></textarea>
                </div>
                <div class="col-12 text-end">
                  <button type="submit" class="btn btn-success px-4">Save Changes</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Profile Picture -->
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold mb-3"><i class="bi bi-image me-2"></i>Profile Picture</h5>
            <img src="<?= USER_IMG_PATH . $u_fetch['profile'] ?>" class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover;">
            <form id="profile_form">
              <div class="mb-3 text-start">
                <label class="form-label">New Picture</label>
                <input type="file" accept=".jpg, .jpeg, .png, .webp" name="profile" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-success w-100">Update Photo</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Password Change -->
      <div class="col-lg-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title fw-bold mb-3">
              <i class="bi bi-key-fill me-2"></i>Change Password
            </h5>
            <form id="pass_form">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" name="new_pass" class="form-control" id="newPass" placeholder="New Password" required>
                    <label for="newPass">New Password</label>
                  </div>
                  <ul class="list-unstyled small text-muted mt-1" id="password_rules">
                    <li id="rule_length">• Minimum 8 characters</li>
                    <li id="rule_uppercase">• At least one uppercase letter</li>
                    <li id="rule_number">• At least one number</li>
                    <li id="rule_special">• At least one special character (!@#$%^&*)</li>
                  </ul>
                  <div id="strengthsMsg" class="small mt-1"></div>
                </div>

                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" name="confirm_pass" class="form-control" id="confirmPass" placeholder="Confirm Password" required>
                    <label for="confirmPass">Confirm Password</label>
                  </div>
                  <div id="matchsMsg" class="small mt-1"></div>
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="showPass" onclick="togglePasswordVisibility()">
                    <label class="form-check-label text-muted" for="showPass">
                      Show Passwords
                    </label>
                  </div>
                </div>

                <div class="col-12 text-end">
                  <button type="submit" class="btn btn-success px-4">Update Password</button>
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

  </script>

  <!-- Scripts -->
  <script>
    function togglePasswordVisibility() {
      const pass = document.getElementById('newPass');
      const cpass = document.getElementById('confirmPass');
      const type = pass.type === 'password' ? 'text' : 'password';
      pass.type = cpass.type = type;
    }

    const newPass = document.getElementById('newPass');
    const confirmPass = document.getElementById('confirmPass');
    const strengthsMsg = document.getElementById('strengthsMsg');
    const matchsMsg = document.getElementById('matchsMsg');

    const rule_length = document.getElementById('rule_length');
    const rule_uppercase = document.getElementById('rule_uppercase');
    const rule_number = document.getElementById('rule_number');
    const rule_special = document.getElementById('rule_special');

    newPass.addEventListener('input', () => {
      const val = newPass.value;
      let strength = 0;

      // Rule checks
      if (val.length >= 8) {
        rule_length.style.color = 'green';
        strength++;
      } else {
        rule_length.style.color = 'red';
      }

      if (/[A-Z]/.test(val)) {
        rule_uppercase.style.color = 'green';
        strength++;
      } else {
        rule_uppercase.style.color = 'red';
      }

      if (/\d/.test(val)) {
        rule_number.style.color = 'green';
        strength++;
      } else {
        rule_number.style.color = 'red';
      }

      if (/[^A-Za-z0-9]/.test(val)) {
        rule_special.style.color = 'green';
        strength++;
      } else {
        rule_special.style.color = 'red';
      }

      if (val.length === 0) {
        strengthsMsg.innerText = '';
      } else if (strength === 1) {
        strengthsMsg.innerText = 'Weak';
        strengthsMsg.style.color = 'red';
      } else if (strength === 2) {
        strengthsMsg.innerText = 'Moderate';
        strengthsMsg.style.color = 'orange';
      } else if (strength === 3) {
        strengthsMsg.innerText = 'Strong';
        strengthsMsg.style.color = 'green';
      }
    });

    confirmPass.addEventListener('input', () => {
      if (confirmPass.value === newPass.value) {
        matchsMsg.innerText = 'Passwords match';
        matchsMsg.style.color = 'green';
      } else {
        matchsMsg.innerText = 'Passwords do not match';
        matchsMsg.style.color = 'red';
      }
    });

    const pass_form = document.getElementById('pass_form');

    pass_form.addEventListener('submit', function(e) {
      e.preventDefault();

      const val = newPass.value;
      const hasLength = val.length >= 8;
      const hasUpper = /[A-Z]/.test(val);
      const hasNumber = /\d/.test(val);
      const passMatch = newPass.value === confirmPass.value;

      const hasSpecial = /[^A-Za-z0-9]/.test(val);

      if (!(hasLength && hasUpper && hasNumber && hasSpecial)) {
        alert('error', 'Password must be at least 8 characters, include an uppercase letter, a number, and a special character!');
        newPass.focus();
        return;
      }



      if (!passMatch) {
        alert('error', 'Passwords do not match!');
        confirmPass.focus();
        return;
      }

      let data = new FormData();
      data.append('pass_form', '');
      data.append('new_pass', newPass.value);
      data.append('confirm_pass', confirmPass.value);

      let xhr = new XMLHttpRequest();
      xhr.open('POST', 'ajax/profile.php', true);

      xhr.onload = function() {
        if (this.responseText == 'mismatch') {
          alert('error', "Password do not match!");
        } else if (this.responseText == 0) {
          alert('error', "Updation failed!");
        } else {
          alert('success', "Changes saved!");
          pass_form.reset();
          strengthsMsg.innerText = '';
          matchsMsg.innerText = '';
          rule_length.style.color = '';
          rule_uppercase.style.color = '';
          rule_number.style.color = '';
        }

      };

      xhr.send(data);
    });

    let info_form = document.getElementById('info_form');

    info_form.addEventListener('submit', function(e) {
      e.preventDefault();

      let data = new FormData();
      data.append('info_form', '');
      data.append('name', info_form.elements['name'].value);
      data.append('phonenum', info_form.elements['phonenum'].value);
      data.append('address', info_form.elements['address'].value);
      data.append('pincode', info_form.elements['pincode'].value);
      data.append('dob', info_form.elements['dob'].value);

      let xhr = new XMLHttpRequest();
      xhr.open('POST', 'ajax/profile.php', true);


      xhr.onload = function() {
        if (this.responseText == 'phone_already') {
          alert('error', "Phone Number is already registered!");
        } else if (this.responseText == 0) {
          alert('error', "No Changes Made!")
        } else {
          alert('success', 'Changes saved!');
        }
      }

      xhr.send(data);

    });

    let profile_form = document.getElementById('profile_form');

    profile_form.addEventListener('submit', function(e) {
      e.preventDefault();

      let data = new FormData();
      data.append('profile_form', '');
      data.append('profile', profile_form.elements['profile'].files[0]);
      let xhr = new XMLHttpRequest();
      xhr.open('POST', 'ajax/profile.php', true);


      xhr.onload = function() {

        if (this.responseText == 'inv_img') {
          alert('error', "Only JPG, JPEG, WEBP AND PNG are allowed!");
        } else if (this.responseText == 'upload_failed') {
          alert('error', "Image upload failed! Try again later");
        } else if (this.responseText == 0) {
          alert('error', "Profile Picture Updation Failed!");
        } else {
          window.location.href = window.location.pathname;

        }
      }

      xhr.send(data);

    });
  </script>

</body>

</html>