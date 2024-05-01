<?php
include "includes/header.php";
require 'vendor/autoload.php';
use GuzzleHttp\Client;

function handlePostRequest() {
    $phoneNumber = $_POST['phone_number'] ?? null;
    if (!$phoneNumber) {
        return;
    }

    $client = new Client(['base_uri' => 'http://10.1.1.158:5001/']);
    $response = $client->request('POST', 'api?key=' . $phoneNumber);
    $responseBody = $response->getBody()->getContents();

    $message = $responseBody == 'Successfully' ? 'Reset Successfully' : 'Nil or Failed';
    echo "<script type='text/javascript'>alert('$message');</script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handlePostRequest();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Remove Phone Number</title>
</head>
<body>
    <h1>Remove Phone Number</h1>
    <form method="post">
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
<?php include "includes/footer.php";?>
