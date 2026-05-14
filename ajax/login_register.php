<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../admin/partials/db_config.php');
require('../admin/partials/essentials.php');

date_default_timezone_set("Asia/Kolkata");

// Updated send_mail function to include username in email greeting
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../partials/phpmailer/src/PHPMailer.php';
require '../partials/phpmailer/src/SMTP.php';
require '../partials/phpmailer/src/Exception.php';



function send_mail($uemail, $username, $token)
{
    $contact_q = "SELECT * FROM contact_details WHERE sr_no=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));

    $setting_q = "SELECT * FROM settings WHERE sr_no=?";
    $values = [1];
    $setting_r = mysqli_fetch_assoc(select($setting_q, $values, 'i'));

    $siteTitle = $setting_r['site_title'];
    $contactAddress = $contact_r['address'];
    $resetLink = SITE_URL . "index.php?account_recovery&email=" . urlencode($uemail) . "&token=" . urlencode($token);

    $htmlContent = "
    <body style='margin: 0; padding: 0; background: linear-gradient(to right, #e0f7fa, #fce4ec); font-family: Segoe UI, Tahoma, Geneva, Verdana, sans-serif;'>
    <table width='100%' cellpadding='0' cellspacing='0' style='padding: 40px 0;'>
        <tr>
        <td align='center'>
            <table width='600' cellpadding='0' cellspacing='0' style='background-color: #ffffff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); overflow: hidden;'>
            
            <tr><td style='text-align: center; padding: 40px 20px 10px;'><h2>$siteTitle</h2></td></tr>
            <tr><td style='text-align: center; font-size: 28px; font-weight: 600; color: #333; padding: 10px 30px;'>🔒 Password Reset!</td></tr>
            <tr><td style='padding: 10px 40px 0; font-size: 17px; color: #555; line-height: 1.7;'>Hello <strong>$username</strong>,<br><br>We noticed a request to change your homestay password. If this was you, click below to reset your password securely.</td></tr>
            <tr><td style='text-align: center; padding: 30px 40px;'><a href='$resetLink' style='background: linear-gradient(to right, #009688, #4db6ac); color: #fff; padding: 14px 30px; font-size: 16px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block;'>Change My Password</a></td></tr>
            <tr><td style='padding: 0 40px 30px; font-size: 15px; color: #666; line-height: 1.6;'>If you didn't make this request, you can safely ignore this email. No changes will be made to your account.<br><br>This link will expire in 24 hours. If it's no longer valid, you can always <a href='#' style='color: #0ddd72; text-decoration: underline;'>request another</a>.<br><br>If you’ve requested multiple resets, please click the link in the most recent email.</td></tr>
            <tr><td style='padding: 0 40px 40px; font-size: 15px; color: #555;'>Best,<br><strong>$siteTitle Team</strong></td></tr>
            <tr><td style='background-color: #f8f9fa; text-align: center; font-size: 13px; color: #999; padding: 25px 30px;'><strong>$siteTitle</strong> &nbsp;| <strong>$contactAddress</strong><br><em>Please do not reply to this email.</em></td></tr>

            </table>
        </td>
        </tr>
    </table>
    </body>
    ";

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // e.g., smtp.yourdomain.com
        $mail->SMTPAuth = true;
        $mail->Username = 'tamudheehomestay2025@gmail.com'; // SMTP username
        $mail->Password = 'cadr iayg wxhl vzmb'; // App-specific password or SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('tamudheehomestay2025@gmail.com', 'Tamdhee Homestay');
        $mail->addAddress($uemail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Forgot Password Link';
        $mail->Body = $htmlContent;

        $mail->send();
        return 1;
    } catch (Exception $e) {
        return 0;
    }
}

if (isset($_POST['register'])) {
    $data = filteration($_POST);

    if ($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }

    $u_exist = select(
        "SELECT * FROM user_cred WHERE email=? OR phonenum=? LIMIT 1",
        [$data['email'], $data['phonenum']],
        "ss"
    );

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    } else if ($img == 'upload_failed') {
        echo 'upload_failed';
        exit;
    }

    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    $query = "INSERT INTO user_cred(name, email, phonenum, profile, address, pincode, dob, password) VALUES (?,?,?,?,?,?,?,?)";
    $values = [$data['name'], $data['email'], $data['phonenum'], $img, $data['address'], $data['pincode'], $data['dob'], $enc_pass];

    if (insert($query, $values, 'ssssssss')) {
        echo 1;
    } else {
        echo 'ins_failed';
    }
}

if (isset($_POST['login'])) {
    $data = filteration($_POST);

    $u_exist = select(
        "SELECT * FROM user_cred WHERE email=? OR phonenum=? LIMIT 1",
        [$data['email_mob'], $data['email_mob']],
        "ss"
    );

    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email_mob';
        exit;
    }

    $u_fetch = mysqli_fetch_assoc($u_exist);

    if ($u_fetch['status'] == 0) {
        echo 'inactive';
        exit; // <--- Important to stop further processing
    }

    if (!password_verify($data['pass'], $u_fetch['password'])) {
        echo 'invalid_pass';
        exit;
    }

    session_start();
    $_SESSION['login'] = true;
    $_SESSION['uId'] = $u_fetch['id'];
    $_SESSION['uName'] = $u_fetch['name'];
    $_SESSION['uPic'] = $u_fetch['profile'];
    $_SESSION['uPhone'] = $u_fetch['phonenum'];

    echo 1;
}


if (isset($_POST['forgot_pass'])) {
    $data = filteration($_POST);

    $u_exist = select(
        "SELECT * FROM user_cred WHERE email=? LIMIT 1",
        [$data['email']],
        "s"
    );

    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email';
        exit;
    }

    $u_fetch = mysqli_fetch_assoc($u_exist);

    if ($u_fetch['status'] == 0) {
        echo 'inactive';
        exit; // <--- Important to stop further processing
    }

    // Send reset email
    $token = bin2hex(random_bytes(16));

    if (!send_mail($data['email'], $u_fetch['name'], $token)) {
        echo 'mail_failed';
        exit;
    }

    $date = date("Y-m-d"); // Use 4-digit year

    $upd = update(
        "UPDATE user_cred SET token=?, t_expire=? WHERE id=?",
        [$token, $date, $u_fetch['id']],
        "ssi"
    );

    if ($upd) {
        echo 1;
    } else {
        echo 'upd_failed';
    }
}


if (isset($_POST['recover_user'])) {
    $data = filteration($_POST);


    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    $query = "UPDATE user_cred SET password=?, token=?, t_expire=? WHERE email=? AND token=?";

    $values = [$enc_pass, null, null, $data['email'], $data['token']];

    if (update($query, $values, 'sssss')) {
        echo 1;
    } else {
        echo 'failed';
    }
}
