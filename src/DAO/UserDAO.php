<?php

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . "PermissionDAO.php";
require_once "{$link}";

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "User.php";
require_once "{$link}";

class UserDAO
{

    public static $ADMIN_PERMISSION = 1;
    public static $USER_PERMISSION = 2;
    /**
     * @var mysqli
     */
    private $connection;

    /**
     * @var PermissionDAO
     */
    private $permission_dao;

    public function __construct()
    {
        $link = dirname(__FILE__) . DIRECTORY_SEPARATOR . "Connection.php";
        require "{$link}";

        if (isset($the_quiz_connect)) {
            $this->connection = $the_quiz_connect;
            $this->permission_dao = new PermissionDAO();
        }
        else {
            die("Erreur: Connection PermissionDAO");
        }
    }


    /**
     * @param int $id
     * @return false|User
     */
    public function getUserById(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM `user` WHERE `id_user` = ?");
        $stmt->bind_param("i", $id);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                return $this->createUser($result->fetch_assoc());
            }
        }

        return false;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return User[]|false
     */
    public function getUsers(int $limit = 100, int $offset = 0) {
        $stmt = $this->connection->prepare("SELECT * FROM `user` LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                $array = array();
                while($row = $result->fetch_assoc()) {
                    array_push($array, $this->createUser($row));
                }
                return $array;
            }
        }

        return false;
    }

    /**
     * @param int $limit
     * @return User[]|false
     */
    public function getRank(int $limit = 10) {
        $stmt = $this->connection->prepare("SELECT * FROM `user` ORDER BY `points` DESC LIMIT ?");
        $stmt->bind_param("i", $limit);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                $array = array();
                while($row = $result->fetch_assoc()) {
                    array_push($array, $this->createUser($row));
                }
                return $array;
            }
        }

        return false;
    }

    /**
     * @param string $last_name
     * @param string $first_name
     * @param string $pseudo
     * @param string $birth_date
     * @param string $email
     * @param string $mdp
     * @param int $id_permission
     * @param int $points
     * @return false|User
     */
    public function createNewUser(string $last_name, string $first_name, string $pseudo, string $birth_date, string $email, string $mdp, int $id_permission, int $points) {
        $stmt = $this->connection->prepare("INSERT INTO `user` (`id_user`, `last_name`, `first_name`, `pseudo`, `birth_date`, `email`, `mdp`, `id_permission`, `points`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
        $mdp = $this->encrypt($mdp);
        $stmt->bind_param("ssssssii", $last_name, $first_name, $pseudo, $birth_date, $email, $mdp, $id_permission, $points);

        $permission = $this->permission_dao->getPermissionById($id_permission);

        return $stmt->execute() === true && $permission !== false ? new User($this->connection->insert_id, $last_name, $first_name, $pseudo, $birth_date, $email, $permission, $points) : false;
    }

    /**
     * @param int $id
     * @param string $last_name
     * @param string $first_name
     * @param string $pseudo
     * @param string $birth_date
     * @param string $email
     * @param int $id_permission
     * @param int $points
     * @return false|User
     */
    public function updateUser(int $id, string $last_name, string $first_name, string $pseudo, string $birth_date, string $email, int $id_permission, int $points) {
        $stmt = $this->connection->prepare("UPDATE `user` SET `last_name` = ?, `first_name` = ?, `pseudo` = ?, `birth_date` = ?, `email` = ?, `id_permission` = ?, `points` = ? WHERE id_user = ?");
        $stmt->bind_param("sssssiii", $last_name, $first_name, $pseudo, $birth_date, $email, $id_permission, $points, $id);

        $permission = $this->permission_dao->getPermissionById($id_permission);

        return $stmt->execute() === true && $permission !== false ? new User($this->connection->insert_id, $last_name, $first_name, $pseudo, $birth_date, $email, $permission, $points) : false;
    }

    /**
     * @param int $id
     * @param string $newPassword
     * @return false|User
     */
    public function updatePassword(int $id, string $newPassword) {
        $newPassword = $this->encrypt($newPassword);
        $stmt = $this->connection->prepare("UPDATE `user` SET `mdp` = ? WHERE id_user = ?");
        $stmt->bind_param("si", $newPassword, $id);

        return $stmt->execute() === true ? $this->getUserById($id) : false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function removeUser(int $id): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM `user` WHERE id_user = ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    /**
     * @param string $pseudo
     * @return bool
     */
    public function pseudoIsAlreadyTaken(string $pseudo): bool
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) AS amount FROM `user` WHERE `pseudo` = ?");
        $stmt->bind_param("s", $pseudo);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                return $result->fetch_assoc()['amount'] >= 1;
            }
        }

        return true;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function emailIsAlreadyTaken(string $email): bool
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) AS amount FROM `user` WHERE `email` = ?");
        $stmt->bind_param("s", $email);
        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                return $result->fetch_assoc()['amount'] >= 1;
            }
        }

        return false;
    }

    /**
     * @param $email
     * @param $mdp
     * @return false|User
     */
    public function getUser($email, $mdp) {
        $mdp = $this->encrypt($mdp);
        $stmt = $this->connection->prepare("SELECT * FROM `user` WHERE `email` = ? AND `mdp` = ?");
        $stmt->bind_param("ss", $email, $mdp);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                return $this->createUser($result->fetch_assoc());
            }
        }

        return false;
    }

    /**
     * @param $array
     * @return false|User
     */
    private function createUser($array)
    {
        if(empty($array)) {
            return false;
        }

        $permission = $this->permission_dao->getPermissionById($array['id_permission']);
        return $permission !== false ? new User($array['id_user'], $array['last_name'], $array['first_name'], $array['pseudo'], $array['birth_date'], $array['email'], $permission, $array['points']) : false;
    }

    /**
     * @param $mdp
     * @return string
     */
    private function encrypt($mdp): string
    {
        return hash("sha256", $mdp);
    }


    public function close() {
        mysqli_close($this->connection);
        $this->permission_dao->close();
    }
}