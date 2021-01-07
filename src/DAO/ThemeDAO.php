<?php

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Theme.php";
require_once "{$link}";

class ThemeDAO
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
            die("Erreur: Connection ThemeDAO");
        }
    }


    /**
     * @param int $id
     * @return false|Theme
     */
    public function getThemeById(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM `theme` WHERE `id_theme` = ?");
        $stmt->bind_param("i", $id);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                return $this->createTheme($result->fetch_assoc());
            }
        }

        return false;
    }


    /**
     * @param int $limit
     * @param int $offset
     * @return array|false
     */
    public function getThemes(int $limit = 100, int $offset = 0) {
        $stmt = $this->connection->prepare("SELECT * FROM `theme` LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                $array = array();
                while($row = $result->fetch_assoc()) {
                    array_push($array, $this->createTheme($row));
                }
                return $array;
            }
        }

        return false;
    }

    /**
     * @param string $name
     * @return false|Theme
     */
    public function createNewTheme(string $name) {
        $stmt = $this->connection->prepare("INSERT INTO `theme` (`id_theme`, `name`) VALUES (NULL, ?)");
        $stmt->bind_param("s", $name);

        return $stmt->execute() === true ? new Theme($this->connection->insert_id, $name) : false;
    }


    /**
     * @param int $id
     * @param string $name
     * @return false|Theme
     */
    public function updateTheme(int $id, string $name) {
        $stmt = $this->connection->prepare("UPDATE `theme` SET `name` = ? WHERE id_theme = ?");
        $stmt->bind_param("si", $name, $id);

        return $stmt->execute() === true ? new Theme($id, $name) : false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function removeTheme(int $id): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM `theme` WHERE id_theme = ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    /**
     * @param $array
     * @return false|Theme
     */
    private function createTheme($array)
    {
        return !empty($array) ? new Theme($array['id_theme'], $array['name']) : false;
    }

    public function close() {
        mysqli_close($this->connection);
    }
}