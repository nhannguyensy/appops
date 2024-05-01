<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://admin:TyLLxEgnJGxR6kGF@10.1.20.20:27017");
$db = $client->appops;
$collection = $db->servers;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $collection->insertOne(['hostname' => $_POST['hostname'], 'ip address' => $_POST['ip_address'], 'description' => $_POST['description']]);
    header('Location: listserver.php');
    exit;
}
?>

<form method="POST">
    <label for="hostname">Hostname:</label><br>
    <input type="text" id="hostname" name="hostname"><br>
    <label for="ip_address">IP Address:</label><br>
    <input type="text" id="ip_address" name="ip_address"><br>
    <label for="description">Description:</label><br>
    <input type="text" id="description" name="description"><br>
    <input type="submit" value="Submit">
</form>
