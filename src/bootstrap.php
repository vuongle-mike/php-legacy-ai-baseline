<?php
require __DIR__ . '/../vendor/autoload.php';
ini_set('display_errors', '1');
error_reporting(E_ALL & ~E_DEPRECATED);
session_start();
$db = new PDO('sqlite:' . __DIR__ . '/../var/app.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$twig = new Twig_Environment(new Twig_Loader_Filesystem(__DIR__ . '/../templates'), array('autoescape' => false));
