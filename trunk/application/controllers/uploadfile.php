<?php
//$uploaddir = '/var/www/uploads/';
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/homerweb/images/';

$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
{
  echo "success";
} 
else 
{
  echo "error";
}
?>