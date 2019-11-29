<h3 class="cent" >更新標題區圖片</h3>
<hr>

<form action="./api/update_title.php" method="post" enctype="multipart/form-data">
    <table style="width:600px; margin:auto">
        <tr>
            <td>標題區圖片：</td>
            <td><input type="file" name="file"></td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="id" value="<?=$_GET['id']?>">
                <input type="submit" value="更新">
                <input type="reset" value="重置">
            </td>
            <td></td>
        </tr>
    </table>
</form>