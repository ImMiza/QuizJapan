<?php

$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Permission.php";
require_once "{$link}";

class PermissionDAO
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
            die("Erreur: Connection PermissionDAO");
        }
    }


    /**
     * @param int $id
     * @return Permission|false
     */
    public function getPermissionById(int $id): Permission
    {
        $stmt = $this->connection->prepare("SELECT * FROM `permission` WHERE `id_permission` = ?");
        $stmt->bind_param("i", $id);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                return $this->createPermission($result->fetch_assoc());
            }
        }

        return false;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array|false
     */
    public function getPermissions(int $limit = 100, int $offset = 0) {
        $stmt = $this->connection->prepare("SELECT * FROM `permission` LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result !== false) {
                $array = array();
                while($row = $result->fetch_assoc()) {
                    array_push($array, $this->createPermission($row));
                }
                return $array;
            }
        }

        return false;
    }

    /**
     * @param string $name
     * @param bool $has_admin_access
     * @return false|Permission
     */
    public function createNewPermission(string $name, bool $has_admin_access) {
        $stmt = $this->connection->prepare("INSERT INTO `permission` (`id_permission`, `name`, `admin_access`) VALUES (NULL, ?, ?)");
        $admin_access = $has_admin_access === true ? 0 : 1;
        $stmt->bind_param("si", $name, $admin_access);

        return $stmt->execute() === true ? new Permission($this->connection->insert_id, $name, $has_admin_access) : false;
    }

    /**
     * @param int $id
     * @param string $name
     * @param bool $has_admin_access
     * @return false|Permission
     */
    public function updatePermission(int $id, string $name, bool $has_admin_access) {
        $stmt = $this->connection->prepare("UPDATE `permission` SET `name` = ?, `admin_access` = ? WHERE id_permission = ?");
        $admin_access = $has_admin_access === true ? 0 : 1;
        $stmt->bind_param("sii", $name, $admin_access, $id);

        return $stmt->execute() === true ? new Permission($this->connection->insert_id, $name, $has_admin_access) : false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function removePermission(int $id): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM `permission` WHERE id_permission = ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    /**
     * @param $array
     * @return Permission
     */
    private function createPermission($array): Permission
    {
        return new Permission($array['id_permission'], $array['name'], $array['admin_access'] == 0);
    }

    public function close() {
        mysqli_close($this->connection);
    }
}