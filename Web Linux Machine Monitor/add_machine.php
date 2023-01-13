<?php
// Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "cadence");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Get the form data
    $hostname = $_POST['hostname'];
    $ip_address = $_POST['ip_address'];
    $os_name = $_POST['os_name'];
    $ram = $_POST['ram'];
    $cpu = $_POST['cpu'];
    $hdd = $_POST['hdd'];
    $graphics = $_POST['graphics'];
    $display = $_POST['display'];
    $hardware = $_POST['hardware'];
    $uptime = $_POST['uptime'];   
    $status = $_POST['status'];   

    // Build the query
    $query = "
    INSERT INTO Machine 
    (hostname, ip, os, ram, cpu, hdd, graphics, display, hardware, uptime, status) 
    VALUES ('$hostname', '$ip_address', '$os_name', '$ram', '$cpu', '$hdd', '$graphics', '$display', '$hardware', '$uptime', '$status');";

    if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
?>