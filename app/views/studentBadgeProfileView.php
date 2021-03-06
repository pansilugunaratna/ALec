<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View User</title>

    <!-- CSS File HOME-->
    <?php linkCSS("profile_details"); ?>

    <?php linkCSS("modal_styles"); ?>

    <?php linkCSS("success_message"); ?>

    <!-- Shortcut Icon -->
    <?php shortIcon("logo1.jpg"); ?>

</head>

<body>


    <?php

    if ($data["loggedUserType"] == "lec") {
        linkPhp("navigationBarLecturer");
    } else if ($data["loggedUserType"] == "stu") {
        linkPhp("navigationBarStudent");
    }

    ?>

    <?php linkPhp("successMessage");
    printSucessMsg($data["success"]); ?>

    <!--    breadcrumb-->
    <ul class="breadcrumb">
        <li><a href="http://localhost/ALec/lecturerDashboard/index">Home</a></li>
        <li><a href="http://localhost/ALec/leaderboard/index">Leaderboard</a></li>
        <li>Student Profile</li>
    </ul>

    <div class="details-content">
        <div class="user-details-container">

            <div class="header-bar">
                <img <?php srcIMG("user_avatar.png"); ?> alt="User image">
                <div class="bio">
                    <span><?php echo $data["userDetails"]["name"]; ?></span>
                    <span><?php echo "Student"; ?></span>
                    <span><?php echo $data["userDetails"]["regNo"]; ?></span>
                </div>
            </div>

            <!-- Details Container include small separate boxes of button content, user details, assigned courses and badges earned-->
            <div class="details-container">

                <div class="horizontal-container">
                    <div class="pvt-details">
                        <span class="heading">User Details</span>
                        <span><strong>Full Name : </strong><?php echo $data["userDetails"]["name"]; ?></span>
                        <?php
                        if ($data["userDetails"]["type"] == "Student") {
                            echo "<span><strong>Given Name : </strong> {$data["userDetails"]["randomName"]} </span>";
                        }
                        ?>
                        <span><strong>Email : </strong><?php echo $data["userDetails"]["email"]; ?></span>
                        <span><strong>Telephone No : </strong><?php echo $data["userDetails"]["tele"]; ?></span>
                    </div>

                    <div class="course-details">
                        <span class="heading">Course Details</span>
                        <div class="course-content">
                            <?php

                            while ($row = mysqli_fetch_assoc($data["courseDetails"])) {
                                echo "<span>{$row['course_name']}</span>";
                            }

                            ?>
                        </div>
                    </div>

                </div>

                <div class="badge-details">
                    <span class="heading">Badges</span>
                    <div class="badges">

                        <?php

                        while ($row = mysqli_fetch_assoc($data["badgeDetails"])) {
                            echo
                            "
                            <div class='badge'>
                                <input type='hidden' class='badge-id' value='{$row['badge_id']}'>
                                <img src='http://localhost/ALec/public/badge_pic/{$row['badge_image']}' alt='Badge Image' class='badge-image'>
                                <span>{$row['badge_name']}</span>
                                <span class='issuer'>{$row['lec_name']}</span>
                            </div>
                            ";
                        }
                        ?>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <?php linkPhp("footer"); ?>

    <?php linkPhp("notificationView"); ?>

    <?php linkJS("lib/jquery-3.6.0.min"); ?>

    <?php linkJS("notification") ?>

</body>

</html>