<?php
$sessionId = $data["bread"]["sessionDetails"]["session_id"];
$sessionName = $data["bread"]["sessionDetails"]["session_name"];
$questionCount = $data["question"]["question_count"];

$courseDetails = $data["bread"]["courseDetails"];
$courseCode = explode("-", $courseDetails["course_name"])[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Preview Poll</title>

    <!-- CSS File HOME-->
    <?php linkCSS("show_poll_openText"); ?>

    <!-- Shortcut Icon -->
    <?php shortIcon("logo1.jpg"); ?>

</head>

<body>

    <?php linkPhp("navigationBarLecturer"); ?>

    <!--    breadcrumb-->
    <ul class="breadcrumb">
        <li><a href="http://localhost/ALec/studentDashboard/index">Home</a></li>
        <li><a href="http://localhost/ALec/studentCoursePage/index">MyCourses</a></li>
        <?php
        echo
        "
        <li><a href='http://localhost/ALec/studentTopicPage/index/{$courseDetails['course_id']}'>{$courseCode}</a></li>

        <li><a href='http://localhost/ALec/myCourseSessionsList/index/{$courseDetails['course_id']}'>Sessions</a></li>
        ";
        ?>
        <li>Preview Poll</li>
    </ul>

    <div class="details-content">

        <div class="container">
            <div class="heading"></div>

            <div class="content">
                <div class="questions-container">

                    <?php
                    echo
                    "
                        <span class='participant-row'>
                            <i class='fa fa-users' aria-hidden='true'></i>
                            {$data["question"]["question_count"]}
                        </span>
                        <span class='question'>
                            {$data["question"]["question"]}
                        </span>
                    ";
                    ?>

                    <div class="answer-container">

                        <?php

                        while ($row = mysqli_fetch_assoc($data["answers"])) {
                            $precentage = $row["answer_count"] * 100 / $questionCount;
                            $precentage = round($precentage, 2);

                            echo
                            "
                            <div class='row'>
                                <div class='answer-label'>{$row["answer"]}</div>
                                <div class='answer'>
                                    <div class='answer-progress pressed' style='width: {$precentage}%'></div>
                                </div>
                                <div class='percentage'>{$precentage}%</div>
                            </div>
                            ";
                        }

                        ?>


                    </div>
                </div>
            </div>

            <div class="button-container">
                <div class="answer">Answer: <?php echo $data["question"]["answer"]; ?></div>
                <button type="button" value="Create Session" class="save-btn" onclick="location.href='<?php echo BASEURL . "/myCourseSessionsList/index/{$courseDetails['course_id']}" ?>'">
                    Done
                </button>
            </div>

        </div>
    </div>

    <?php linkPhp("footer"); ?>

    <?php linkPhp("notificationView"); ?>

    <?php linkJS("lib/jquery-3.6.0.min"); ?>

    <?php linkJS("notification") ?>

</body>

</html>