<?php

// 1 = edit quiz
// 2 = schedule quiz

class PreviewQuiz extends AlecFramework
{
    public function __construct()
    {
        $this->authorization("lec");
        $this->helper("linker");
        $this->previewQuizModel = $this->model("previewQuizModel");
    }

    // Preview quiz
    public function index($quizId)
    {
        $data["success"] = "";

        $successSignal = $this->getSession("successMessageStatus");

        if (isset($successSignal)) {
            if ($successSignal == "1") {
                $data["success"] = "Quiz Edited Successfully";
            } else if ($successSignal == "2") {
                $data["success"] = "Quiz Scheduled Successfully";
            }
            $this->unsetSession("successMessageStatus");
        }

        $data["bread"]["courseDetails"] = $this->previewQuizModel->getCourseDetails($quizId);
        $data["courseName"] = $this->previewQuizModel->getCourseName($quizId);
        $data["quizDetails"] = $this->previewQuizModel->getQuizDetails($quizId);
        $data["questions"] = $this->previewQuizModel->getQuizQuestionsSummary($quizId);
        $data["questionChoices"] = $this->previewQuizModel->getQuizQuestionChoices($quizId);
        $data["quizPublishStatus"] = $this->previewQuizModel->checkQuizPublishStatus($quizId);

        $this->view("lecturer/previewQuizView", $data);
    }

    // Schedule the quiz
    public function submit($quizId)
    {
        // var_dump($_POST);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $publishDateTime = str_replace("T", " ", $_POST["publishdatetime"]) . ":00";
            $closeDateTime = str_replace("T", " ", $_POST["closedatetime"])  . ":00";
            $duration = $_POST["time-picker"];

            // echo $publishDateTime . "<br>";
            // echo $closeDateTime . "<br>";
            // echo $duration . "<br>";

            $this->previewQuizModel->updateDateTimeQuiz($quizId, $publishDateTime, $closeDateTime, $duration);
        }

        $this->setSession("successMessageStatus", 2);

        $this->redirect("previewQuiz/index/{$quizId}");
    }

    // Delete the quiz
    public function delete($quizId)
    {
        $courseId = $this->previewQuizModel->deleteQuiz($quizId);

        $this->redirect("lecturerTopicPage/index/{$courseId}");
    }

    // Unpublish the quiz
    public function unpublish($quizId)
    {
        $this->previewQuizModel->setUnpublish($quizId);
        $this->redirect("previewQuiz/index/{$quizId}");
    }
}
