<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://admin:TyLLxEgnJGxR6kGF@10.1.20.20:27017");
$db = $client->appops;
$collection = $db->servers;

$collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($_GET['id'])]);

header('Location: listserver.php');
exit;
