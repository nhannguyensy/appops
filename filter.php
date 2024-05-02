<?php
// Include the MongoDB library
require 'vendor/autoload.php';

// Connect to MongoDB with authentication
$client = new MongoDB\Client("mongodb://admin:TyLLxEgnJGxR6kGF@10.1.20.20:27017");

// Select a database
$db = $client->appops;

// Select a collection
$collection = $db->servers;

// Define the number of results per page
$resultsPerPage = 50;

// Get the current page number (default to 1 if not set)
$pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the number of documents to skip based on the current page number
$skip = ($pageNumber - 1) * $resultsPerPage;

// Get the filter condition from the form
$filter = isset($_POST['filter']) ? $_POST['filter'] : '';

// Retrieve the documents that match the filter condition
$documents = $collection->find([$filter => ['$exists' => true]], ['limit' => $resultsPerPage, 'skip' => $skip]);

// Start the table
echo '<table>';
echo '<tr><th>ID</th><th>Hostname</th><th>IP Address</th><th>Description</th></tr>';

// Display the documents
foreach ($documents as $document) {
    echo '<tr>';
    echo '<td>' . $document['_id'] . '</td>';
    echo '<td>' . $document['hostname'] . '</td>';
    echo '<td>' . $document['ip address'] . '</td>';
    echo '<td>' . $document['description'] . '</td>';
    echo '</tr>';
}

// End the table
echo '</table>';

// Display the filter form
echo '<form method="POST">';
echo '<input type="text" name="filter">';
echo '<input type="submit" value="Filter">';
echo '</form>';

// Calculate the total number of pages
$totalDocuments = $collection->count();
$totalPages = ceil($totalDocuments / $resultsPerPage);

// Display pagination links
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href=\"?page=$i\">Page $i</a> ";
}
?>
