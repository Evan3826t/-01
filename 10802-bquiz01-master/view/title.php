<h3>新增標題區圖片</h3>
<hr>
<form action="./api/title_add.php" method="post" enctype="multipart/form-data">
    <table style="width:600px; margin:auto">
        <tr>
            <td>標題區圖片：</td>
            <td><input type="file" name="file"></td>
        </tr>
        <tr>
            <td>標題區替代文字</td>
            <td><input type="text" name="text"></td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="新增">
                <input type="reset" value="重置">
            </td>
            <td></td>
        </tr>
    </table>
</form>