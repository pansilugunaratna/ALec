<?php
$sessionId = $data["bread"]["sessionDetails"]["session_id"];
$sessionName = $data["bread"]["sessionDetails"]["session_name"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Live Forum</title>

    <!-- CSS File HOME-->
    <?php linkCSS("live_forum"); ?>

    <!-- Shortcut Icon -->
    <?php shortIcon("logo1.jpg"); ?>

</head>

<body>
    <?php linkPhp("navigationBarLecturer"); ?>

    <!--    breadcrumb-->
    <ul class="breadcrumb">
        <li><a href="http://localhost/ALec/lecturerDashboard">Home</a></li>

        <li><a href="http://localhost/ALec/displaySessionsList/index">Sessions</a></li>

        <?php
        echo
        "
        <li><a href='http://localhost/ALec/viewSession/index/{$sessionId}'>$sessionName</a></li>
        ";
        ?>

        <li>Live Forum</li>
    </ul>

    <div class="details-content">

        <div class="header-container">
            <header>Live Forum</header>
        </div>

        <div class="questions-container">

            <?php

            while ($row = mysqli_fetch_assoc($data["questionDetails"])) {

                echo
                "
                <div class='question'>
                    <input type='hidden' value='{$row['question_id']}'>
                    <span class='text'>
                        {$row['question']}
                        <span class='name'>{$row["name"]}</span>
                        <span class='name'>{$row['post_time']}</span>
                    </span>
                    <span class='vote'>
                        <i class='fa fa-thumbs-o-up vote-highlight' aria-hidden='true'></i>
                        <span class='votes-count'>{$row['points']}</span>
                    </span>
                </div>
                ";
            }

            ?>

        </div>

    </div>

    <?php linkPhp("footer"); ?>

    <?php linkPhp("notificationView"); ?>

    <?php linkJS("lib/jquery-3.6.0.min"); ?>

    <?php linkJS("notification") ?>

</body>

</html>