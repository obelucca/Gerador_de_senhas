<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('Password.php');

$passwordClass = new Password(4);
$passwordClass->setConfig('use_numbers', true);
$passwordClass->setConfig('use_lowercase', true);
$passwordClass->setConfig('use_uppercase', true);
$passwordClass->setConfig('use_symbols', true);
$passwordClass->generatePassword();
echo $passwordClass->getPassword();