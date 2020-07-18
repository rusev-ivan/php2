<?php
require __DIR__ . '/../autoload.php';

$db = new \App\Db();
$sql = 'SELECT * FROM news';
$result = $db->execute($sql,[]);

var_dump($result);