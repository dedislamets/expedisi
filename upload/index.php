<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');

$target_path = "C:/xampp/htdocs/hris/upload/". $_GET['folder']. "/";
 
$target_path = $target_path . basename( $_FILES['file']['name']);
 
if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    echo "Upload and move success";
} else {
echo $target_path;
    echo "There was an error uploading the file, please try again!";
}
?>

