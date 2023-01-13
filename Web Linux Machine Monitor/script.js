function createTable(){
    $.ajax({
        type: "POST",
        url: "create_table.php",
        success: function(response) {
            alert(response);
        },
        error: function(error) {
            console.log(error);
            alert("An error occurred, please try again later.");
        }
    });
}

function resetTable(){
    $.ajax({
        type: "POST",
        url: "reset_table.php",
        success: function(response) {
            alert(response);
        },
        error: function(error) {
            console.log(error);
            alert("An error occurred, please try again later.");
        }
    });
}

function addMachine() {
    // Get the form data
    var hostname = $("#hostname").val();
    var ip_address = $("#ip_address").val();
    var os_name = $("#os_name").val();
    var ram = $("#ram").val();
    var cpu = $("#cpu").val();
    var hdd = $("#hdd").val();
    var graphics = $("#graphics").val();
    var display = $("#display").val();
    var hardware = $("#hardware").val();
    var uptime = $("#uptime").val();
    var status = $("#status").val();

    // Send the data to the server
    $.ajax({
        type: "POST",
        url: "add_machine.php",
        data: { hostname: hostname, ip_address: ip_address, os_name: os_name, ram: ram, cpu: cpu, hdd: hdd, graphics: graphics, display: display, hardware: hardware, uptime: uptime, status: status},
        success: function(response) {
            // Clear the form
            alert(response);
            $("#insert-form")[0].reset();

            // Get the updated list of machines
            getMachines();
        }
    });
}

$("#filter-form").submit(function(event) {
    event.preventDefault();

    // Get the filter values
    var hostname = $("#filter-hostname").val();
    var os_name = $("#filter-os_name").val();

    // Send the filter values to the server
    $.ajax({
        type: "GET",
        url: "filter_machines.php",
        data: { hostname: hostname, os_name: os_name },
        success: function(response) {
            // Clear the table
            $("#machines-table tbody").empty();
            // Parse the JSON response
            var machines = JSON.parse(response);

            // Iterate through the array of machines
            for (var i= 0; i < machines.length; i++) {
                var machine = machines[i];
                // Append the data to the table
                $("#machines-table tbody").append("<tr><td>" + machine.id + "</td><td>" + machine.hostname + "</td><td>" + machine.ip + "</td><td>" + machine.os + "</td><td>" + machine.ram + "</td><td>" + machine.cpu + "</td><td>" + machine.hdd + "</td><td>" + machine.graphics + "</td><td>" + machine.display + "</td><td>" + machine.hardware + "</td><td>" + machine.uptime + "</td><td>" + machine.status + "</td></tr>");
            }
        },
        error: function(error) {
            console.log(error);
            alert("An error occurred, please try again later.");
        }
    });
});

function getMachines() {
    $.ajax({
    type: "GET",
    url: "get_machines.php",
    success: function(response) {
    // Clear the table
        $("#machines-table tbody").empty();
        
        // Parse the JSON response
        var machines = JSON.parse(response);
        // Iterate through the array of machines
        for (var i = 0; i < machines.length; i++) {
            var machine = machines[i];

            // Append the data to the table
            $("#machines-table tbody").append("<tr><td>" + machine.id + "</td><td>" + machine.hostname + "</td><td>" + machine.ip + "</td><td>" + machine.os + "</td><td>" + machine.ram + "</td><td>" + machine.cpu + "</td><td>" + machine.hdd + "</td><td>" + machine.graphics + "</td><td>" + machine.display + "</td><td>" + machine.hardware + "</td><td>" + machine.uptime + "</td><td>" + machine.status + "</td></tr>");
        }
    }
    });
}

// Get the initial list of machines
getMachines();