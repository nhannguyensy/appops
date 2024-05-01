<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://admin:TyLLxEgnJGxR6kGF@10.1.20.20:27017");
$db = $client->appops;
$collection = $db->servers;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($_POST['id'])],
        ['$set' => ['hostname' => $_POST['hostname'], 'ip address' => $_POST['ip_address'], 'description' => $_POST['description']]]
    );
    header('Location: listserver.php');
    exit;
}

$document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($_GET['id'])]);
?>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $document['_id']; ?>">
    <label for="hostname">Hostname:</label><br>
    <input type="text" id="hostname" name="hostname" value="<?php echo $document['hostname']; ?>"><br>
    <label for="ip_address">IP Address:</label><br>
    <input type="text" id="ip_address" name="ip_address" value="<?php echo $document['ip address']; ?>"><br>
    <label for="description">Description:</label><br>
    <input type="text" id="description" name="description" value="<?php echo $document['description']; ?>"><br>
    <input type="submit" value="Submit">
</form>
