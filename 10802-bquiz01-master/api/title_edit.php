<?php
include_once ("../base.php");

// 瀏覽器上所存的form值
// text['a','b','c']
//   id['1','5','8']
//  del['5']
// sh=8


foreach( $_POST['id'] as $key => $id){
    // echo $id . "<br>";
    if( !empty( $_POST['del']) && in_array( $id, $_POST['del'])){
        // 刪除資料
        del( "title", $id);
        //  unlink() 刪除圖片
    }else{
        // 更新資料
        $data = find( "title", $id);
        $data['text'] = $_POST['text'][$key];

        // 判斷 sh 是否為隱藏
        $data['sh'] = ( $_POST['sh'] == $id)?1:0;
        save( "title", $data);
    }
}




to("../admin.php?do=title");
?>