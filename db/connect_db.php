<?php
namespace App\db;

use PDO;
use PDOException;

$user = 'main';
$password = 'main';
$host = 'localhost';
$dbname = 'app';
$port = 65341;

//$dsn = 'pgsql:dbname=app;host=localhost';
$dsn = "pgsql:host=".$host.";port=".$port.";dbname=".$dbname;
try {
    $db = new PDO($dsn,$user,$password);
}
catch(PDOException $e) {
    die($e->getMessage());
}

/*
$sql = 'SELECT * FROM coating';
foreach ($db->query($sql) as $row){
    echo $row['id'] . "\t";
    echo $row['title']. "\t";
}
*/

/*
$db = pg_connect("host=127.0.0.1 port=65341 dbname=app user=main password=main")
or die('Не удалось соединиться: ' . pg_last_error());
*/
/*
$res = pg_query($db, "SELECT * FROM coating");
if (!$res) {
   echo "Ошибка вывода данных";
}

$rows = pg_fetch_assoc($res);
var_dump($rows);
*/

