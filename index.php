<?php
require_once "classes/User.php";
require_once "classes/UserRepository.php";
require_once "classes/UserController.php";

$repo = new UserRepository("data/users.json");
$controller = new UserController($repo);
$controller->handleRequest();
?>
