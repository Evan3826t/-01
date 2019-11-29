<?php

include_once ("../base.php");

$data = find( "title", $_POST['id']);
if(!empty( $_FILES['file']['tmp_name'])){
    $name = $_FILES['file']['name'];
    move_uploaded_file( $_FILES['file']['tmp_name'], "../img/".$name);
    $data['file'] = $name;
    save( "title", $data);
}


to( "../admin.php?do=title");

?>