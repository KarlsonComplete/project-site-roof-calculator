<?php

# include data base
require '../../db/connect_db.php'

/*
if (isset($_POST['id']) && !empty($_POST['id'])){
    $id = (int)$_POST['id'];
    $query = $db->query("SELECT * FROM material_type WHERE coating_id = $id");
   echo "<select name='command'>";
    while ($row = $query->fetch()){
        echo "<option value='($row->id)'>($row->title)</option>";
    }
    echo "</<select>";
}
else{

}
*/
/*
switch ($_POST['action']){

    case "showMaterialForInsert":
        echo '<select size="1" name="region" onchange="javascript:selectTypeMaterial();">';
        $rows = $db->query('SELECT * FROM material_type WHERE coating_id=? ORDER BY title ASC', $_POST['coating_id']);
        foreach ($rows as $numRow => $row) {
            echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
        };
        echo '</select>';
        break;

    case "showCityForInsert":
        echo '<select size="1" name="city">';
        $rows = $db->query('SELECT * FROM tbl_city WHERE id_region=? ORDER BY city ASC', $_POST['id_region']);
        foreach ($rows as $numRow => $row) {
            echo '<option value="'.$row['id_city'].'">'.$row['city'].'</option>';
        };
        echo '</select>';
        break;

}
*/
?>