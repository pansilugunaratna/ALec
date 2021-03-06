<?php

// 1 = add a new topic

class LecturerTopicPage extends AlecFramework
{
    public function __construct()
    {
        $this->authorization("lec");
        $this->helper("linker");
        $this->lecturerTopicPageModel = $this->model("lecturerTopicPageModel");
    }

    // Display course page with topics
    public function index($courseId)
    {
        $data["success"] = "";
        $successSignal = $this->getSession("successMessageStatus");

        if (isset($successSignal)) {
            if ($successSignal == "1") {
                $data["success"] = "Topic Added Successfully";
            }
            $this->unsetSession("successMessageStatus");
        }

        $data["bread"]["courseId"] = $courseId;
        $data["courseDetails"] = $this->lecturerTopicPageModel->getCourseDetails($courseId);
        $data["topicDetails"] = $this->lecturerTopicPageModel->getTopicDetails($courseId);
        $data["topicQuizSummary"] = $this->lecturerTopicPageModel->getQuizCount($courseId);
        $data["quizDetails"] = $this->lecturerTopicPageModel->getQuizDetails($courseId);

        $this->view("lecturer/lecturerTopicPageView", $data);
    }

    // Delete a topic
    public function deleteTopic($topicId)
    {
        $courseId = $this->lecturerTopicPageModel->getCourseId($topicId);
        $this->lecturerTopicPageModel->deleteTopic($topicId);

        $this->redirect("lecturerTopicPage/index/{$courseId}");
    }

    // Edit a topic
    public function updateTopicName($topicId)
    {
        // print_r($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $topicName = $_POST["topicName"];

            $this->lecturerTopicPageModel->editTopic($topicId, $topicName);
        }

        // Get course id to move to another page
        $courseId = $this->lecturerTopicPageModel->getCourseId($topicId);

        $this->redirect("lecturerTopicPage/index/{$courseId}");
    }
}
