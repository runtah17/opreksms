<?php
include_once("Kalkun_API.php");

$config['base_url'] = "http://localhost/opreksms/index.php/";
$config['session_file'] = "/tmp/cookies.txt";
$config['username'] = "kalkun";
$config['password'] = "kalkun";
$config['phone_number'] = "085691046947";
$config['message'] = "Test message from API";

// unicode message
// $config['coding'] = 'unicode';

$sms = new Kalkun_API($config);
$sms->run();
?>