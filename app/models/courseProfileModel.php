<?php

class CourseProfileModel extends Database
{
    // Returns course details
    public function getCourseDetails($course_id)
    {
        $query = "SELECT * FROM course WHERE course_id='$course_id'";
        $result = mysqli_query($GLOBALS["db"], $query);

        return mysqli_fetch_assoc($result);
    }

    // Returns assigned lecturer details of a particular course
    public function getLecturerNames($course_id)
    {
        $query = "SELECT CONCAT(first_name, ' ', last_name) AS name FROM user INNER JOIN course_registration_lec WHERE user.user_id=lecturer_id AND course_id='$course_id'";
        $result = mysqli_query($GLOBALS["db"], $query);

        return $result;
    }

    // Returns student count of a particular course
    public function getStudentCount($course_id)
    {
        $query = "SELECT COUNT(course_id) AS num FROM course_registration_stu WHERE course_id='$course_id'";
        $result = mysqli_query($GLOBALS["db"], $query);

        return mysqli_fetch_assoc($result)["num"];
    }

    // Delete course id
    public function deleteCourse($course_id)
    {
        $query = "DELETE FROM course WHERE course_id='$course_id'";
        $result = mysqli_query($GLOBALS["db"], $query);

        return $result;
    }
}
