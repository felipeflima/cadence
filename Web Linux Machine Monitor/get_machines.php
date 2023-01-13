<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "cadence");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Build the query
$query = "SELECT * FROM Machine";

// Execute the query
$result = mysqli_query($conn, $query);

// Fetch the data from the result set
$machines = array();
while ($row = mysqli_fetch_assoc($result)) {
    $machines[] = $row;
    }
    
    // Return the data as a JSON object
    echo json_encode($machines);
    
    mysqli_close($conn);
?>