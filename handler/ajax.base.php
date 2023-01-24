<?php

use App\db;

# include data base
require '../db/connect_db.php';

/*
$rows = $db->query('SELECT * FROM type_of_select_material');
foreach ($rows as $numRow => $row){
    echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
}
*/

switch ($_POST['action']) {

    case "showMaterialForInsert":
        echo '<select size="1" name="material_type" onchange="selectTypeCoating();">';
        $rows =$db->query('SELECT * FROM material_type WHERE coating_id=? ORDER BY title ASC', $_POST['id_coating']);
        foreach ($rows as $numRow => $row) {
            echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
        }
        echo '</select>';
        break;

    case "showCityForInsert":
        echo '<select size="1" name="select_material" >';
        $rows = $db->query('SELECT * FROM type_of_select_material WHERE material_type_id=? ORDER BY title ASC', $_POST['id_material']);
        foreach ($rows as $numRow => $row) {
            echo '<option value="' . $row['id_city'] . '">' . $row['city'] . '</option>';
        }
        echo '</select>';
        break;

}

