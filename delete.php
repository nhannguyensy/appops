<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://admin:TyLLxEgnJGxR6kGF@10.1.20.20:27017");
$db = $client->appops;
$collection = $db->servers;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($_POST['id'])]);
    header('Location: listserver.php');
    exit;
}

$document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($_GET['id'])]);
?>

<script>
function confirmDelete() {
    return confirm('Are you sure you want to delete this record?');
}
</script>

<form method="POST" onsubmit="return confirmDelete();">
    <input type="hidden" name="id" value="<?php echo $document['_id']; ?>">
    <input type="submit" value="Delete">
</form>
