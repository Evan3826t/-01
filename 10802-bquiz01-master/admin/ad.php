<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">動態文字廣告管理</p>
  <form method="post" action="./api/title_edit.php">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="80%">動態文字廣告</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
        </tr>
        <?php
          // 從資料庫撈資料，用迴圈建資料表
          $rows = all("ad");
          foreach($rows as $r){
          ?>
            <tr class="cent">
              <td >
                <input type="text" name="text[]" value="<?=$r['text']?>">
              </td>
              <td >
                <input type="radio" name="sh" value="<?=$r['id']?>" <?=($r['sh'] == 1)?"checked":""?>>
              </td>
              <td ><input type="checkbox" name="del[]" value="<?=$r['id']?>"></td>
              <td>
                <input type="button" value="更新圖片" 
                  onclick="op('#cover','#cvr','view/update_title.php?id=<?=$r['id']?>')">
                  <input type="hidden" name="id[]" value="<?=$r['id']?>">
              </td>
            </tr>

          <?php
          }
        ?>
      </tbody>
    </table>
    <table style="margin-top:40px; width:70%;">
      <tbody>
        <tr>
          <td width="200px"><input type="button"
              onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view/title.php?do=title&#39;)" value="新增動態文字廣告"></td> <!--&#39 是 ' 的打法 -->
          <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
        </tr>
      </tbody>
    </table>

  </form>
</div>