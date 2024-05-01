<?php
use GuzzleHttp\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create a new Guzzle client
$client = new Client([
    'base_uri' => 'http://api.smartpayvn.com/',
]);

// Create a new Monolog logger
$logger = new Logger('active');
$logger->pushHandler(new StreamHandler('./logs/active.log', Logger::INFO));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phoneNumber = $_POST['phone_number'];

    try {
        $response = $client->post('removenumber', [
            'form_params' => [
                'phone_number' => $phoneNumber,
            ],
        ]);

        $logger->info("Phone number {$phoneNumber} submitted to the API.");
    } catch (\Exception $e) {
        $logger->error("Error submitting phone number {$phoneNumber}: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Phone Number Submission</title>
</head>
<body>
    <h1>Submit Phone Number</h1>
    <form method="post">
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>

