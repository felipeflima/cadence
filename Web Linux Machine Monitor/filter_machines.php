<?php
    // Connect to the database
    
    $conn = mysqli_connect("localhost", "root", "", "cadence");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the filter values
    $hostname = $_GET['hostname'];
    $os_name = $_GET['os_name'];

    // Build the query
    $query = "SELECT * FROM Machine WHERE 1=1";
    if(!empty($hostname)){
        $query .= " AND hostname LIKE '%$hostname%'";
    }
    if(!empty($os_name)){
        $query .= " AND os LIKE '%$os_name%'";
    }

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