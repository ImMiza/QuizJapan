<?php
$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "DAO" . DIRECTORY_SEPARATOR . "Connection.php";
require_once "{$link}";

if (isset($the_quiz_connect)) {
    if(!isset($_POST['package'])) {
        echo json_encode(array("error" => "package is null"));
        $the_quiz_connect->close();
        exit(1);
    }

    if(!isset($_POST['id_card'])) {
        echo json_encode(array("error" => "id_card is null"));
        $the_quiz_connect->close();
        exit(1);
    }

    if(!isset($_POST['question'])) {
        echo json_encode(array("error" => "question is null"));
        $the_quiz_connect->close();
        exit(1);
    }

    $id_package = $_POST['package'];
    $id_card = $_POST['id_card'];
    $answer = $_POST['question'];

    $stmt = $the_quiz_connect->prepare("SELECT * FROM `card` WHERE `id_card_package` = ? ORDER BY id_card");
    $stmt->bind_param("i", $id_package);

    if(!$stmt->execute()) {
        echo json_encode(array("error" => "stmt execution error"));
        $the_quiz_connect->close();
        exit(1);
    }

    $result_cards = $stmt->get_result();

    $correct = false;
    $finish = true;
    $next = false;
    $body = "";
    $question_number = 0;
    $amount_question = $result_cards->num_rows;
    $stop = false;

    while (($row = $result_cards->fetch_assoc()) !== null && $stop === false) {
        $question_number = $question_number  + 1;
        if($next == true) {
            $finish = false;
            $body = array("id_card" => $row['id_card'], "card_question" => $row['question'], "card_answer" => $row['answer'], "fake_answers" => explode(",", $row['fake_answers']));
            $stop = true;
        }

        if($row['id_card'] == $id_card) {
            if($row['answer'] == $answer) {
                $correct = true;
            }
            $next = true;
        }
    }

    echo json_encode(array("correct" => $correct, "finish" => $finish, "next_question_number" => $question_number, "amount_question" => $amount_question, "next_card" => $body));

    $the_quiz_connect->close();
}