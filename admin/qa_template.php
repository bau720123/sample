<table border="0" cellpadding="0" cellspacing="2" id="tableA">
    <tr>
     <?php if($_GET['qa_typeid'] == '1' || $_GET['qa_typeid'] == '8') { ?><th>圖片</th><? } ?>
     <?php if($_GET['qa_typeid'] == '1' || $_GET['qa_typeid'] == '3' || $_GET['qa_typeid'] == '7') { ?><th>自定排序</th>
     <? } ?>
     <th><?php if($_GET['qa_typeid'] == 3) { ?>問題<? } ?><?php if($_GET['qa_typeid'] != 3 && $_GET['qa_typeid'] != 8) { ?>標題<? } ?><?php if($_GET['qa_typeid'] == '8') { ?>規格<? } ?></th>
     <?php if(($_GET['qa_typeid'] == '4' || $_GET['qa_typeid'] == '7') && isset($_GET['qa_id'])){ ?><th>分類</th><? } ?>
     <th>發佈人</th>
     <?php if($_GET['qa_typeid'] != 1 && $_GET['qa_typeid'] != 7) { ?><th><?php if($_GET['qa_typeid'] == 3) { ?>答案<? } ?><?php if($_GET['qa_typeid'] != 3) { ?>內容<? } ?></th><? } ?>
     <th>上架時間</th>
     <th>下架時間</th>
     <th>發佈</th>
     <th>選中項</th>
    </tr>
    <?php while(!$Recordset1->atEnd()) { ?>
	<?php
    $startRow_startRow = $startRow_startRow+1;
    $i = isset($startRow_startRow) ? $startRow_startRow : 0;
	?>
    <tr>
     <?php if($_GET['qa_typeid'] == '1' || $_GET['qa_typeid'] == '8') { ?><td align="center"><input name="photo_del<?php echo $i; ?>" type="hidden" id="photo_del<?php echo $i; ?>" value="<?php echo($Recordset1->getColumnVal("photo")); ?>" /><input name="photo_thum_del<?php echo $i; ?>" type="hidden" id="photo_thum_del<?php echo $i; ?>" value="<?php echo($Recordset1->getColumnVal("photo_thum")); ?>" /><?php if($Recordset1->getColumnVal("photo_thum") != '') { ?><img src="<?php echo $Recordset1->getColumnVal("photo_thum"); ?>" width="46" /><? } ?><br>
              <input name="photo<?php echo $i; ?>" type="file" id="photo<?php echo $i; ?>" /></td><? } ?>
     <!--<?php if($_GET['qa_typeid'] == '4') { ?><td align="center"><?php if($Recordset1->getColumnVal("member_id") == '0') { ?>系統管理者<? } else { ?><?php echo $Recordset1->getColumnVal("member_name"); ?><? } ?></td><? } ?>-->
     <?php if($_GET['qa_typeid'] == '1' || $_GET['qa_typeid'] == '3' || $_GET['qa_typeid'] == '7') { ?><td align="center"><input name="sort<?php echo $i; ?>" type="text" id="sort<?php echo $i; ?>" value="<?php echo $Recordset1->getColumnVal("sort"); ?>" size="4" /></td>
     <? } ?>
     <td align="center"><input name="qa_question<?php echo $i; ?>" type="text" id="qa_question<?php echo $i; ?>" value="<?php echo $Recordset1->getColumnVal("qa_question"); ?><?php echo $Recordset1->getColumnVal("qa_re_question"); ?>" size="14" /></td>
     <?php if(($_GET['qa_typeid'] == '4' || $_GET['qa_typeid'] == '7') && isset($_GET['qa_id'])) { ?><td align="center"><select name="qa_id<?php echo $i; ?>" id="qa_id<?php echo $i; ?>">
        <?php while(!$Recordset2->atEnd()) { ?>
        <option value="<?php echo $Recordset2->getColumnVal("qa_id"); ?>"<?php if (!(strcmp($Recordset2->getColumnVal("qa_id"), $_GET['qa_id']))) {echo "selected=\"selected\"";} ?>><?php echo $Recordset2->getColumnVal("qa_question"); ?></option>
<?php $Recordset2->moveNext(); } $Recordset2->moveFirst(); ?>
      </select></td><? } ?>
     <td align="center"><?php if($Recordset1->getColumnVal("member_id") == '0') { echo '系統管理者'; } else { echo $Recordset1->getColumnVal("member_name"); }?></td>
     <?php if($_GET['qa_typeid'] != 1 && $_GET['qa_typeid'] != 7) { ?><td align="center"><textarea name="qa_content<?php echo $i; ?>" id="qa_content<?php echo $i; ?>" onClick="ckclick('<?php echo $i; ?>')"><?php echo $Recordset1->getColumnVal("qa_content"); ?><?php echo $Recordset1->getColumnVal("qa_re_content"); ?></textarea><input name="qa_email<?php echo $i; ?>" type="hidden" id="qa_email<?php echo $i; ?>" value="<?php echo $Recordset1->getColumnVal("qa_email"); ?>" />
     </td><? } ?>
     <td align="center"><input name="ontime<?php echo $i; ?>" type="text" id="ontime<?php echo $i; ?>" value="<?php echo $Recordset1->getColumnVal("ontime"); ?>" size="16" maxlength="19" /></td>
     <td align="center"><input name="offtime<?php echo $i; ?>" type="text" id="offtime<?php echo $i; ?>" value="<?php echo $Recordset1->getColumnVal("offtime"); ?>" size="16" maxlength="19" /></td>
     <td align="center"><input <?php if (!(strcmp($Recordset1->getColumnVal("ready"),1))) {echo "checked=\"checked\"";} ?> name="ready<?php echo $i; ?>" type="checkbox" id="ready<?php echo $i; ?>" value="1" /></td>
     <td align="center"><input name="data_id<?php echo $i; ?>" type="hidden" id="data_id<?php echo $i; ?>" value="<?php if(empty($_GET['qa_id'])) { echo($Recordset1->getColumnVal("qa_id")); } ?><?php if(isset($_GET['qa_id'])) { echo($Recordset1->getColumnVal("qa_re_id")); } ?>" /><input name="mixdel<?php echo $i; ?>" type="checkbox" id="selecttype" value="<?php if(empty($_GET['qa_id'])) { echo($Recordset1->getColumnVal("qa_id")); } ?><?php if(isset($_GET['qa_id'])) { echo($Recordset1->getColumnVal("qa_re_id")); } ?>" onClick="mycheckbox();" /></td>
    </tr>
    <?php $Recordset1->moveNext(); } $Recordset1->moveFirst(); ?>
   </table>