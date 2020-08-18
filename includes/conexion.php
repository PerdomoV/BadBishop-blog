<?php
require_once './vendor/autoload.php';

require_once 'helpers.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$server=$_ENV['SERVER'];
$username =$_ENV['USERNAME'];
$password=$_ENV['PASS'];
$database=$_ENV['BD'];
$db=mysqli_connect($server,$username, $password, $database);

mysqli_query($db,"SET NAMES 'utf-8'");

session_start();
