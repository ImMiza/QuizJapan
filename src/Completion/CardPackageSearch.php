<?php
$link = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "DAO" . DIRECTORY_SEPARATOR . "Connection.php";
require_once "{$link}";

if (isset($the_quiz_connect)) {
    if (isset($_GET['term'])) {
        $array = array();
        $input = $_GET['term'];
        $input = strtolower($input);

        $stmt = $the_quiz_connect->prepare("SELECT name, themes FROM `card_package` WHERE LOWER(name) LIKE '%" . $input . "%' OR LOWER(themes) LIKE '%" . $input . "%' LIMIT 30");
        $stmt->execute();

        $result = $stmt->get_result();

        $names = array();
        $themes = array();
        while ($row = $result->fetch_assoc()) {
            if (in_array($row['name'], $names) === false) {
                array_push($names , $row['name']);
            }

            $list = explode(",", $row['themes']);
            if($list === false) {
                continue;
            }

            foreach ($list as $word) {
                $word = strtolower($word);
                if ($word != "" && strpos($word, $input) !== false && in_array($word, $themes) === false) {
                    array_push($themes, $word);
                }
            }
        }

        foreach ($names as $n) {
            array_push($array, array("label" => $n, "category" => "Nom :"));
        }
        foreach ($themes as $th) {
            array_push($array, array("label" => $th, "category" => "Themes :"));
        }

        echo json_encode($array);
    }
    $the_quiz_connect->close();
}