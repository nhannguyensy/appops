<?php
// Include the MongoDB library
include "includes/header.php";
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

// Retrieve the documents
$documents = $collection->find([], ['limit' => $resultsPerPage, 'skip' => $skip]);

// Display the documents
foreach ($documents as $document) {
    echo '<p>';
    print_r($document);
    echo '</p>';
}

// Calculate the total number of pages
$totalDocuments = $collection->count();
$totalPages = ceil($totalDocuments / $resultsPerPage);

// Display pagination links
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href=\"?page=$i\">Page $i</a> ";
}
?>
<?php include "includes/footer.php";?>
