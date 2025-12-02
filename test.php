<?php 
session_start();
error_reporting(0);

set_time_limit(0); // กำหนดเวลาการประมวลผล script (0 หมายถึงไม่กำหนดเวลาการทำงาน)
ini_set('max_input_time', 36000); // กำหนดเวลาการทำงานสูงสุดกับการส่งค่าด้วย $_GET $_POST และ $_FILES (วินาที)
ini_set('max_execution_time', 36000); // กำหนดเวลาการประมวลผล script (วินาที)

$set_url = 'https://www.happympm.com';
$url_uplond = '../upload_image/';

$HostName = "localhost";
$HostUsername = 'happympmho_main';
$HostPassword = 'DYHr1L4oaJFAikkG0';
$DatabaseName = 'happympmho_main';

$language1 = 'TH';
$language2 = 'ENG';
$language3 = 'language3';
$language4 = 'language4';
$language5 = 'language5';

// Create connection
$conn = new mysqli($HostName, $HostUsername, $HostPassword, $DatabaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$conn->set_charset("utf8");

// Your further code here

?>
