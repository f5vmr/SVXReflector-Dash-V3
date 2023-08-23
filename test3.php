<?php
$host = '0.0.0.0'; // Listen on all available network interfaces
$port = 5300;

// Create a UDP socket
$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
socket_bind($socket, $host, $port);

$log = '';

// Continuously read data from the UDP socket
while (true) {
    $from = '';
    $port = 0;
    socket_recvfrom($socket, $data, 1024, 0, $from, $port);
    
    // Add received data to the log
    $log .= $data . "\n";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>UDP Log Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .log-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f5f5f5;
            white-space: pre-line;
        }
    </style>
</head>
<body>
    <h1>UDP Log Viewer</h1>
    <div class="log-container">
        <?php echo nl2br(htmlspecialchars($log)); ?>
    </div>
</body>
</html>
