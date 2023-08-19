<?php

$file_path = '/etc/svxlink/svxreflector.conf';
$content = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$global_section = [];
$users_section = [];
$passwords_section = [];

$current_section = null;

foreach ($content as $line) {
    $line = trim($line);

    if (empty($line) || strpos($line, '#') === 0) {
        continue;
    }

    if (preg_match('/^\[(.*?)\]$/', $line, $matches)) {
        $current_section = $matches[1];
        continue;
    }

    [$key, $value] = explode('=', $line, 2);
    $key = trim($key);
    $value = trim($value);

    switch ($current_section) {
        case 'GLOBAL':
            $global_section[$key] = $value;
            break;
        case 'USERS':
            $users_section[$key] = $value;
            break;
        case 'PASSWORDS':
            $passwords_section[$key] = $value;
            break;
    }
}

echo "Global Section:\n";
print_r($global_section);

echo "\nUsers Section:\n";
print_r($users_section);

echo "\nPasswords Section:\n";
print_r($passwords_section);

?>
