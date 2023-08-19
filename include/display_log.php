<?php

$file_path = '/etc/svxlink/svxreflector.conf';
$config_content = file_get_contents($file_path);

$users_section = [];
if (preg_match_all('/^\s*([\w\d]+)\s*=\s*([^\n]+)/m', $config_content, $matches)) {
    $users_section = array_combine($matches[1], $matches[2]);
}

$log_file_path = '/var/log/svxreflector.log';
$log_content = file_get_contents($log_file_path);

$user_information = [];

foreach ($users_section as $username => $display_name) {
    if (preg_match("/\\b$username\\b.*?(\\d{4}-\\d{2}-\\d{2} \\d{2}:\\d{2}:\\d{2}).*?(\\d+\\.\\d+\\.\\d+\\.\\d+)/s", $log_content, $matches)) {
        $user_information[$username] = [
            'display_name' => $display_name,
            'timestamp' => $matches[1],
            'ip_address' => $matches[2]
        ];
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>SvxReflector User Dashboard</title>
</head>
<body>
    <h1>SvxReflector User Dashboard</h1>

    <table>
        <tr>
            <th>Username</th>
            <th>Display Name</th>
            <th>Timestamp</th>
            <th>IP Address</th>
        </tr>
        <?php foreach ($user_information as $username => $info) { ?>
            <tr>
                <td><?php echo $username; ?></td>
                <td><?php echo $info['display_name']; ?></td>
                <td><?php echo $info['timestamp']; ?></td>
                <td><?php echo $info['ip_address']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
