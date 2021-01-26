<?php

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "CardPackage.php";
require_once "{$link}";

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . "CardDAO.php";
require_once "{$link}";

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . "UserDAO.php";
require_once "{$link}";

class CardPackageDAO
{

    /**
     * @var mysqli
     */
    private $connection;
    private $card_dao;
    private $user_dao;

    public function __construct()
    {
        $link = dirname(__FILE__) . DIRECTORY_SEPARATOR . "Connection.php";
        require "{$link}";

        if (isset($the_quiz_connect)) {
            $this->connection = $the_quiz_connect;
            $this->card_dao = new CardDAO();
            $this->user_dao = new UserDAO();
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
     * @param $id_creator
     * @param int $limit
     * @param int $offset
     * @return array|false
     */
    public function getCardPackagesByCreator($id_creator, $limit = 50, $offset = 0) {
        $stmt = $this->connection->prepare("SELECT * FROM `card_package` WHERE creator = ? LIMIT ? OFFSET ?");
        $stmt->bind_param("iii", $id_creator,$limit, $offset);

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
     * @param $id_creator
     * @return int
     */
    public function getCardPackagesAmountByCreator($id_creator): int
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) AS amount FROM `card_package` WHERE creator = ?");
        $stmt->bind_param("i", $id_creator);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                $row = $result->fetch_assoc();
                if(!empty($row)) {
                    return $row['amount'];
                }
            }
        }

        return 0;
    }

    /**
     * @param string $name_or_theme
     * @param int $limit
     * @param int $offset
     * @return CardPackage[]|false
     */
    public function searchCardPackage(string $name_or_theme, int $limit = 50, $offset = 0) {
        $stmt = $this->connection->prepare("SELECT * FROM `card_package` WHERE LOWER(name) LIKE '%" . $name_or_theme . "%' OR LOWER(themes) LIKE '%" . $name_or_theme . "%' LIMIT ? OFFSET ?");
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
     * @return int
     */
    public function getCardPackagesAmount(): int
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) AS amount FROM `card_package`");

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                $row = $result->fetch_assoc();
                if(!empty($row)) {
                    return $row['amount'];
                }
            }
        }

        return 0;
    }

    /**
     * @param string $name
     * @param string $description
     * @param string $image_name
     * @param string $background_name
     * @param array $themes
     * @param int $id_creator
     * @return CardPackage|false
     */
    public function createNewCardPackage(string $name, string $description, string $image_name, string $background_name, array $themes, int $id_creator) {
        $str_themes  = "";
        foreach ($themes as $t) {$str_themes = $str_themes . "," . $t;}
        $str_themes = trim($str_themes, ",");

        $stmt = $this->connection->prepare("INSERT INTO `card_package` (`id_card_package`, `name`, `description`, `themes`, `creator`) VALUES (NULL, ?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $description, $str_themes, $id_creator);

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

        $user = $this->user_dao->getUserById($id_creator);
        return new CardPackage($id_card_package, $name, $description, $background_name, $image_name, array(), $themes, $user);
    }


    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $image_name
     * @param string $background_name
     * @param array $themes
     * @param int $id_creator
     * @return CardPackage|false
     */
    public function updateCard(int $id, string $name, string $description, string $image_name, string $background_name, array $themes, int $id_creator) {
        $str_themes  = "";
        foreach ($themes as $t) {$str_themes = $str_themes . "," . $t;}
        $str_themes = trim($str_themes, ",");

        $stmt = $this->connection->prepare("UPDATE `card_package` SET `name` = ?, `description` = ?, `themes` = ?, `creator` = ? WHERE id_card_package = ?");
        $stmt->bind_param("sssi", $name, $description, $str_themes, $id_creator, $id);

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

        $user = $this->user_dao->getUserById($id_creator);
        return new CardPackage($id, $name, $description, $background_name, $image_name, $cards, $themes, $user);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function removeCardPackage(int $id): bool
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

        $user = $this->user_dao->getUserById($array['creator']);
        if($user === false) {
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

        return new CardPackage($array['id_card_package'], $array['name'], $array['description'], $background, $image, $cards, $themes, $user);
    }

    public function close() {
        mysqli_close($this->connection);
        $this->card_dao->close();
        $this->user_dao->close();
    }
}