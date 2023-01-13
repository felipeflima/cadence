<?php
    $conn = mysqli_connect("localhost", "root", "", "cadence");


    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $drop = "DROP TABLE IF EXISTS Machine;";
    
    $sql = "
    CREATE TABLE IF NOT EXISTS Machine (
        id INT AUTO_INCREMENT PRIMARY KEY,
        hostname VARCHAR(255) NOT NULL,
        ip VARCHAR(15) NOT NULL,
        os VARCHAR(255) NOT NULL,
        ram FLOAT NOT NULL,
        cpu VARCHAR(255) NOT NULL,
        hdd FLOAT NOT NULL,
        graphics VARCHAR(255) NOT NULL,
        display VARCHAR(255) NOT NULL,
        hardware VARCHAR(255) NOT NULL,
        uptime INT NOT NULL,
        status ENUM('online', 'offline') NOT NULL
    );";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Table Machine created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    mysqli_close($conn);
?>
