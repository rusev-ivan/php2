<?php
require __DIR__ . '/../App/autoload.php';

$uri = $_SERVER ['REQUEST_URI'];
$parts = explode('/',$uri);
$ctrl = $parts[1] ? ucfirst($parts[1]) : 'Index';
$class = 'App\Controllers\\' . $ctrl;

$ctrl = new $class;
$ctrl();