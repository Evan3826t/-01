<?php

include_once ("../base.php");

$data = [];
// $_FILES['file']['tmp_name'] 上傳檔案成功後會在 xampp 的 temp 中新增暫存檔 -> $_FILES['file']['tmp_name']
if(!empty($_FILES['file']['tmp_name'])){
    $name = $_FILES['file']['name'];
    
    // 把檔案從暫存位置移到新位置
    move_uploaded_file($_FILES['file']['tmp_name'],"../img/".$name);
    $data['file'] = $name;
}
$data['text'] = $_POST['text'];
print_r ($data);

save("title", $data);

to("../admin.php?do=title");
?>