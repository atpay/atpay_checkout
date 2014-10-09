<?php

$file = 'sample.txt';

$data  = print_r($_POST['details'], true);

$obj = json_decode($data);

$current.= "Name: ";
$current.= $obj->name;
$current .= "\n";
$current.= "Email: ";
$current.= $obj->email;
$current .= "\n";

// Write the contents back to the file
file_put_contents($file, $current);
?>
