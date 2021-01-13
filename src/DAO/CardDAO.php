<?php

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Card.php";
require_once "{$link}";

class CardDAO
{

    /**
     * @var mysqli
     */
    private $connection;

    public function __construct()
    {
        $link = dirname(__FILE__) . DIRECTORY_SEPARATOR . "Connection.php";
        require "{$link}";

        if (isset($the_quiz_connect)) {
            $this->connection = $the_quiz_connect;
        }
        else {
            die("Erreur: Connection CardDAO");
        }
    }

    /**
     * @param int $id
     * @return Card|false
     */
    public function getCardById(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM `card` WHERE `id_card` = ?");
        $stmt->bind_param("i", $id);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                return $this->createCard($result->fetch_assoc());
            }
        }

        return false;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Card[]|false
     */
    public function getCards(int $limit = 100, int $offset = 0) {
        $stmt = $this->connection->prepare("SELECT * FROM `card` LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                $array = array();
                while($row = $result->fetch_assoc()) {
                    array_push($array, $this->createCard($row));
                }
                return $array;
            }
        }

        return false;
    }

    /**
     * @param int $id_card_package
     * @return Card[]|false
     */
    public function getCardsFromPackage(int $id_card_package) {
        $stmt = $this->connection->prepare("SELECT * FROM `card` WHERE `id_card_package` = ?");
        $stmt->bind_param("i", $id_card_package);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                $array = array();
                while($row = $result->fetch_assoc()) {
                    array_push($array, $this->createCard($row));
                }
                return $array;
            }
        }

        return false;
    }

    /**
     * @param int $id_card_package
     * @param string $question
     * @param string $answer
     * @param array $fake_answers
     * @return Card|false
     */
    public function createNewCard(int $id_card_package, string $question, string $answer, array $fake_answers) {
        $fakeAnswers = "";
        foreach ($fake_answers as $fa) {$fakeAnswers = $fakeAnswers . "," . $fa;}
        $fakeAnswers = trim($fakeAnswers, ",");

        $stmt = $this->connection->prepare("INSERT INTO `card` (`id_card`, `id_card_package`, `question`, `answer`, `fake_answers`) VALUES (NULL, ?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_card_package, $question, $answer, $fakeAnswers);

        return $stmt->execute() === true ? new Card($this->connection->insert_id, $question, $answer, $fake_answers) : false;
    }

    /**
     * @param int $id
     * @param int $id_card_package
     * @param string $question
     * @param string $answer
     * @param array $fake_answers
     * @return Card|false
     */
    public function updateCard(int $id, int $id_card_package, string $question, string $answer, array $fake_answers) {
        $fakeAnswers = "";
        foreach ($fake_answers as $fa) {$fakeAnswers = $fakeAnswers . "," . $fa;}
        $fakeAnswers = trim($fakeAnswers, ",");

        $stmt = $this->connection->prepare("UPDATE `card` SET `id_card_package` = ?, `question` = ?, `answer` = ?, `fake_answers` = ? WHERE id_card = ?");
        $stmt->bind_param("isssi", $id_card_package, $question, $answer, $fakeAnswers, $id);

        return $stmt->execute() === true ? new Card($id, $question, $answer, $fake_answers) : false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function removeCard(int $id): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM `card` WHERE id_card = ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    /**
     * @param $array
     * @return Card|false
     */
    private function createCard($array)
    {
        if(empty($array)) {
            return false;
        }

        $fakes = strlen($array['fake_answers']) === 0 ? array() : explode(",", $array['fake_answers']);
        return new Card($array['id_card'], $array['question'], $array['answer'], $fakes);
    }


    public function close() {
        mysqli_close($this->connection);
    }
}