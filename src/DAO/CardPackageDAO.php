<?php

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "CardPackage.php";
require_once "{$link}";

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . "CardDAO.php";
require_once "{$link}";

class CardPackageDAO
{

    /**
     * @var mysqli
     */
    private $connection;
    private $card_dao;

    public function __construct()
    {
        $link = dirname(__FILE__) . DIRECTORY_SEPARATOR . "Connection.php";
        require "{$link}";

        if (isset($the_quiz_connect)) {
            $this->connection = $the_quiz_connect;
            $this->card_dao = new CardDAO();
        }
        else {
            die("Erreur: Connection CardDAO");
        }
    }


    /**
     * @param int $id
     * @return CardPackage|false
     */
    public function getCardPackageById(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM `card_package` WHERE `id_card_package` = ?");
        $stmt->bind_param("i", $id);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                return $this->createCardPackage($result->fetch_assoc());
            }
        }

        return false;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return CardPackage[]|false
     */
    public function getCardPackages(int $limit = 50, int $offset = 0) {
        $stmt = $this->connection->prepare("SELECT * FROM `card_package` LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                $array = array();
                while($row = $result->fetch_assoc()) {
                    array_push($array, $this->createCardPackage($row));
                }
                return $array;
            }
        }

        return false;
    }

    /**
     * @param string $name
     * @param string $description
     * @param string $image_name
     * @param string $background_name
     * @param array $themes
     * @return CardPackage|false
     */
    public function createNewCardPackage(string $name, string $description, string $image_name, string $background_name, array $themes) {
        $str_themes  = "";
        foreach ($themes as $t) {$str_themes = $str_themes . "," . $t;}
        $str_themes = trim($str_themes, ",");

        $stmt = $this->connection->prepare("INSERT INTO `card_package` (`id_card_package`, `name`, `description`, `themes`) VALUES (NULL, ?, ?, ?)");
        $stmt->bind_param("sss", $name, $description, $str_themes);

        if($stmt->execute() === false) {
            return false;
        }

        $id_card_package = $this->connection->insert_id;

        $stmt = $this->connection->prepare("INSERT INTO `card_package_image` (`id_package_image`, `id_card_package`, `name`) VALUES (NULL, ?, ?)");
        $stmt->bind_param("is", $id_card_package, $image_name);
        $stmt->execute();

        $stmt = $this->connection->prepare("INSERT INTO `card_package_background` (`id_background`, `id_card_package`, `name`) VALUES (NULL, ?, ?)");
        $stmt->bind_param("is", $id_card_package, $background_name);
        $stmt->execute();

        return new CardPackage($id_card_package, $name, $description, $background_name, $image_name, array(), $themes);
    }


    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $image_name
     * @param string $background_name
     * @param array $themes
     * @return CardPackage|false
     */
    public function updateCard(int $id, string $name, string $description, string $image_name, string $background_name, array $themes) {
        $str_themes  = "";
        foreach ($themes as $t) {$str_themes = $str_themes . "," . $t;}
        $str_themes = trim($str_themes, ",");

        $stmt = $this->connection->prepare("UPDATE `card_package` SET `name` = ?, `description` = ?, `themes` = ? WHERE id_card_package = ?");
        $stmt->bind_param("sssi", $name, $description, $str_themes, $id);

        if($stmt->execute() === false) {
            return false;
        }
        $cards = $this->card_dao->getCardsFromPackage($id);
        if($cards === false) {
            return false;
        }

        $stmt = $this->connection->prepare("UPDATE `card_package_image` SET `name` = ? WHERE id_card_package = ?");
        $stmt->bind_param("s", $image_name);
        $stmt->execute();

        $stmt = $this->connection->prepare("UPDATE `card_package_background` SET `name` = ? WHERE id_card_package = ?");
        $stmt->bind_param("s", $background_name);
        $stmt->execute();

        return new CardPackage($id, $name, $description, $background_name, $image_name, $cards, $themes);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function removeCard(int $id): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM `card_package` WHERE id_card_package = ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    private function createCardPackage($array)
    {
        if(empty($array)) {
            return false;
        }

        $cards = $this->card_dao->getCardsFromPackage($array['id_card_package']);
        if($cards === false) {
            return false;
        }

        $themes = strlen($array['themes']) === 0 ? array() : explode(",", $array['themes']);

        $image = "";
        $background = "";

        $stmt = $this->connection->prepare("SELECT name FROM `card_package_image` WHERE `id_card_package` = ?");
        $stmt->bind_param("i", $array['id_card_package']);
        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                $r = $result->fetch_assoc();
                if(!empty($r)) {
                    $image = $r['name'];
                }
            }
        }

        $stmt = $this->connection->prepare("SELECT name FROM `card_package_background` WHERE `id_card_package` = ?");
        $stmt->bind_param("i", $array['id_card_package']);
        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                $r = $result->fetch_assoc();
                if(!empty($r)) {
                    $background = $r['name'];
                }
            }
        }

        return new CardPackage($array['id_card_package'], $array['name'], $array['description'], $background, $image, $cards, $themes);
    }

    public function close() {
        mysqli_close($this->connection);
        $this->card_dao->close();
    }
}