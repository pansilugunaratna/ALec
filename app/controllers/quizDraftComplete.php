<?php

class QuizDraftComplete extends AlecFramework
{
    public function __construct()
    {
        $this->authorization("lec");
        $this->helper("linker");
        $this->previewQuizModel = $this->model("previewQuizModel");
        $this->editQuizModel = $this->model("editQuizModel");
    }

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

        $this->view("lecturer/previewDraftQuizView", $data);
    }

    public function delete($quizId)
    {
        $this->previewQuizModel->deleteQuiz($quizId);

        $this->redirect("quizDraft/index");
    }

    public function editView($quizId)
    {
        $data["bread"]["courseDetails"] = $this->editQuizModel->getCourseDetails($quizId);
        $data["quizId"] = $quizId;
        $data["quizQuestionSummary"] = $this->editQuizModel->getQuizQuestionsSummary($quizId);
        $data["quizQuestionChoices"] = $this->editQuizModel->getQuizQuestionChoices($quizId);

        $this->view("lecturer/editDraftQuizView", $data);
    }

    public function submit($quizId)
    {
        // var_dump($_POST);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quizQuestionSummary = $this->editQuizModel->getQuizQuestionsSummary($quizId);
            $quizQuestionChoices = $this->editQuizModel->getQuizQuestionChoices($quizId);

            while ($row = mysqli_fetch_assoc($quizQuestionSummary)) {

                if (!isset($_POST["q_$row[question_no]"])) {
                    $this->editQuizModel->deleteQuestion($row["question_no"]);
                    continue;
                }

                $question = $_POST["q_$row[question_no]"];
                $type = "mcq-s";

                if (isset($_POST["check_$row[question_no]"])) {
                    $type = "mcq-m";
                }

                $this->editQuizModel->updateQuestion($row["question_no"], $question, $type);

                $count = $row["count"];

                for ($i = 1; $i <= $count; $i++) {
                    $choiceRow = mysqli_fetch_assoc($quizQuestionChoices);

                    if (!isset($_POST["choice_$choiceRow[choice_id]"])) {
                        $this->editQuizModel->deleteAnswer($choiceRow["choice_id"]);
                        continue;
                    }

                    $choice = $_POST["choice_$choiceRow[choice_id]"];
                    $points = $_POST["points_$choiceRow[choice_id]"];

                    $this->editQuizModel->updateChoice($choiceRow["choice_id"], $choice, $points);
                }
            }

            $count = $_POST["new-question-count"];

            for ($i = 1; $i <= $count; $i++) {
                $question = $_POST["q_{$i}"];
                $type = $_POST["{$i}_type"];

                // echo $question;
                // echo $type;
                // return 0;

                if ($type == "mcq") {
                    if (isset($_POST["q_{$i}_type"])) {
                        $type = "mcq-m";
                    } else {
                        $type = "mcq-s";
                    }
                }

                $questionId = $this->editQuizModel->insertQuizQuestion($quizId, $question, $type);

                if ($type == "short ans") {
                    $choice = $_POST["q_{$i}_choice_1"];

                    $this->editQuizModel->insertChoice($questionId, $quizId, $choice, 100);
                } else if ($type == "mcq-m" or $type == "mcq-s") {
                    $j = 1;

                    while (isset($_POST["q_{$i}_choice_$j"]) && !empty($_POST["q_{$i}_choice_$j"])) {
                        if (isset($_POST["q_{$i}_points_$j"]) && !empty($_POST["q_{$i}_points_$j"])) {
                            $choice = chop($_POST["q_{$i}_choice_$j"]);
                            $points = chop($_POST["q_{$i}_points_$j"], "%");

                            $this->editQuizModel->insertChoice($questionId, $quizId, $choice, $points);
                        }

                        $j++;
                    }
                }
            }
        }

        $this->setSession("successMessageStatus", 1);
        $this->redirect("quizDraftComplete/index/{$quizId}");
    }

    //Create a quiz
    public function create($quizId)
    {
        $this->editQuizModel->updateQuizStatus($quizId);
        $this->redirect("quizDraft/index");
    }
}
