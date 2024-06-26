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

// Retrieve the documents
$documents = $collection->find([], ['limit' => $resultsPerPage, 'skip' => $skip]);

// Start the table
echo '<table>';
echo '<tr><th>ID</th><th>Hostname</th><th>IP Address</th><th>Description</th><th>Actions</th></tr>';

// Display the documents
foreach ($documents as $document) {
    echo '<tr>';
    echo '<td>' . $document['_id'] . '</td>';
    echo '<td>' . $document['hostname'] . '</td>';
    echo '<td>' . $document['ip address'] . '</td>';
    echo '<td>' . $document['description'] . '</td>';
    echo '<td>';
    echo '<a href="edit.php?id=' . $document['_id'] . '">Edit</a>'; // Edit button
    echo '<a href="delete.php?id=' . $document['_id'] . '">Delete</a>'; // Delete button
    echo '</td>';
    echo '</tr>';
}

// End the table
echo '</table>';

// Add button
echo '<a href="add.php">Add</a>';
//Filter button
<a href="filter.php"><button>Filter</button></a>

// Calculate the total number of pages
$totalDocuments = $collection->count();
$totalPages = ceil($totalDocuments / $resultsPerPage);

// Display pagination links
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href=\"?page=$i\">Page $i</a> ";
}
?>