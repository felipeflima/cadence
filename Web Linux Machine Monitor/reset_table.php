<?php
    $conn = mysqli_connect("localhost", "root", "", "cadence");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "DELETE FROM Machine;";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Table Machine created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    mysqli_close($conn);
?>
