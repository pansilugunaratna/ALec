<?php

class LecturerForumTopic extends AlecFramework
{
    public function __construct()
    {
        $this->authorization("lec");
        $this->helper("linker");
        $this->lecturerForumTopicModel = $this->model("lecturerForumTopicModel");
        $this->notificationBasicModel = $this->model("notificationBasicModel");
    }

    public function index($courseId)
    {
        $data["forumDetails"] = $this->lecturerForumTopicModel->getForumDetails($courseId);

        $forumId = $data["forumDetails"]["forum_id"];
        $userId = $this->getSession("userId");

        $data["topicDiscussionDetails"] =
            $this->lecturerForumTopicModel->getTopicDiscussionDetails($forumId);

        $data["replyDiscussionDetails"] =
            $this->lecturerForumTopicModel->getReplyDiscussionDetails($forumId);

        $data["pointsGivenTopics"] = $this->lecturerForumTopicModel->getPointsGivenTopics($userId, $forumId);

        $this->view("lecturer/lecturerForumTopicView", $data);
    }

    // 0 = remove marks
    // 1 = add marks
    public function toggleMarksTopic($topicId, $signal)
    {
        $userId = $this->getSession("userId");
        $this->lecturerForumTopicModel->changeMarksTopic($userId, $topicId, $signal);

        if ($signal == "1") {
            $courseId = $this->notificationBasicModel->getCourseId($topicId);

            $courseName = $this->notificationBasicModel->getCourseName($courseId);
            $postTime = $this->lecturerForumTopicModel->getMarksGivenTime($userId, $topicId);

            $userName = $this->notificationBasicModel->getUserRealName($userId);
            $message = "You received points from " . $userName;

            $studentLink = BASEURL . "/studentForumTopicDiscussion/index/{$topicId}";

            $this->lecturerForumTopicModel->setForumTopicNotificationStudentSingle($courseName, $studentLink, $postTime, $topicId, $message);
        }
    }
}
