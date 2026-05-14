<?php
require('../admin/partials/db_config.php');
require('../admin/partials/essentials.php');
date_default_timezone_set("Asia/Kolkata");

session_start();

if (isset($_GET['fetch_room'])) {

    //check availability data decode
    $chk_avail = json_decode($_GET['chk_avail'], true);

    //checkin and checkout filter validation
    if ($chk_avail['checkin'] != '' && $chk_avail['checkout'] != '') {
        $today_date = new DateTime(date("Y-m-d"));
        $checkin_date = new DateTime($chk_avail['checkin']);
        $checkout_date = new DateTime($chk_avail['checkout']);

        if ($checkin_date >= $checkout_date) {
            echo "
            <div class='container mt-5'>
              <div class='bg-danger text-white text-center p-4 rounded shadow-sm'>
                <h2 class='fw-bold mb-2'><i class='bi bi-exclamation-triangle me-2'></i>Invalid Dates Entered!</h2>
                <p class='mb-0'>Your check-in date must be before your check-out date. Please try again.</p>
              </div>
            </div>";
            exit;
        } elseif ($checkin_date < $today_date) {
            echo "
            <div class='container mt-5'>
              <div class='bg-danger text-white text-center p-4 rounded shadow-sm'>
                <h2 class='fw-bold mb-2'><i class='bi bi-exclamation-triangle me-2'></i>Invalid Dates Entered!</h2>
                <p class='mb-0'>Check-in date cannot be in the past. Please select a valid date.</p>
              </div>
            </div>";
            exit;
        }
    }


    // guests data decode
    $guests = json_decode($_GET['guests'],true);

    $adult = ($guests['adult']!='') ? $guests['adult'] : 0;
    $children = ($guests['children']!='') ? $guests['children'] : 0;

    // facilities data decode
   $facility_list = json_decode($_GET['facility_list'],true);

   

    // count no of room and output variable to store room cards
    $count_rooms = 0;
    $output = "";

    // Get site settings
    $setting_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
    $setting_r = mysqli_fetch_assoc(mysqli_query($con, $setting_q));

    // Fetch rooms
    $room_res = select("SELECT * FROM `rooms` WHERE `adult`>=? AND `children`>=? AND `status`=? AND `removed`=? ORDER BY `id` DESC", [$adult,$children,1, 0], 'iiii');

    while ($room_data = mysqli_fetch_assoc($room_res)) {

        // Check availability if dates provided
        if ($chk_avail['checkin'] != '' && $chk_avail['checkout'] != '') {
            $tb_query = "SELECT COUNT(*) AS `total_bookings` FROM `booking_order`
                         WHERE booking_status=? AND room_id=? AND check_out > ? AND check_in < ?";
            $values = ['booked', $room_data['id'], $chk_avail['checkin'], $chk_avail['checkout']];
            $tb_fetch = mysqli_fetch_assoc(select($tb_query, $values, 'siss'));

            if (($room_data['quantity'] - $tb_fetch['total_bookings']) == 0) {
                continue;
            }
        }

            // Fetch facilities with filter

            $fac_count=0;
         
            $fac_q = mysqli_query($con, "SELECT f.name, f.id FROM `facilities` f
                                         INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
                                       WHERE rfac.room_id = '$room_data[id]'");
            $facilities_data = "";
            while ($fac_row = mysqli_fetch_assoc($fac_q)) {
              if(in_array($fac_row['id'],$facility_list['facilities']) ){
                  $fac_count++;
              }
                $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1 shadow-sm'>$fac_row[name]</span>";
            }
  
            if(count($facility_list['facilities'])!=$fac_count){
              continue;
            }

      

      

        // Room image (thumbnail)
        $room_thumb = ROOM_IMG_PATH . "thumbnail.png";
        $thumb_q = mysqli_query($con, "SELECT * FROM `room_images`
                                       WHERE `room_id`='$room_data[id]' AND `thumb`='1'");
        if (mysqli_num_rows($thumb_q) > 0) {
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOM_IMG_PATH . $thumb_res['image'];
        }

        // Book Now Button
        $book_btn = "";
        if (!$setting_r['shutdown']) {
            $login = (isset($_SESSION['login']) && $_SESSION['login'] == true) ? 1 : 0;
            $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-success btn-sm w-100 shadow-none custom-btn mb-2'>Book Now</button>";
        }

        // Room card HTML
        $output .= "
        <div class='card mb-4 border-0 shadow' data-aos='zoom-in-up'>
            <div class='row g-0 p-3 align-items-center'>
                <div class='col-md-5 mb-3 mb-md-0'>
                    <img src='$room_thumb' alt='$room_data[name] image' class='img-fluid rounded room-img'>
                </div>
                <div class='col-md-5 px-lg-3 px-md-3 px-0'>
                    <h5 class='mb-3'>$room_data[name]</h5>
                    <div class='facilities mb-3'>
                        <h6 class='mb-1'>Room Amenities</h6>
                        $facilities_data
                    </div>
                    <div class='guests'>
                        <h6 class='mb-1'>Guests</h6>
                        <span class='badge rounded-pill bg-light text-dark text-wrap'>$room_data[adult] Adult</span>
                        <span class='badge rounded-pill bg-light text-dark text-wrap'>$room_data[children] Children</span>
                    </div>
                </div>
                <div class='col-md-2 mt-4 mt-md-0 text-center'>
                    <h6 class='mb-4 card-price'>₹$room_data[price] per night</h6>
                    $book_btn
                    <a href='room_details.php?id=$room_data[id]' class='btn btn-outline-primary btn-sm w-100 custom-btn'>More details</a>
                </div>
            </div>
        </div>";
        $count_rooms++;
        
    }

    // Output results or fallback
    if ($count_rooms > 0) {
        echo $output;
    } else {
        echo "
        <div class='d-flex justify-content-center align-items-center my-5'>
            <div class='alert alert-warning text-center shadow-sm p-4' role='alert' style='max-width: 500px;'>
                <i class='bi bi-exclamation-triangle-fill text-warning fs-3'></i>
                <h4 class='mt-3 mb-2 text-danger'>No Rooms to Show</h4>
                <p class='mb-3 text-muted'>Currently, there are no available rooms. Please check back later or modify your search criteria.</p>
                <a href='index.php' class='btn btn-outline-success'>
                    <i class='bi bi-arrow-left-circle me-1'></i> Back to Home
                </a>
            </div>
        </div>";
    }
}
?>
