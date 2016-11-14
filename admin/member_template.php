<table border="0" cellpadding="0" cellspacing="2" id="tableA">
    <tr>
     <th>帳號</th>
     <th>身分證字號</th>
     <th>姓名</th>
     <th>手機號碼</th>
     <th>EMAIL</th>
     <th>認證狀態</th>
     <th>選中項</th>
    </tr>
    <?php while(!$Recordset1->atEnd()) { ?>
	<?php
    $startRow_startRow = $startRow_startRow+1;
    $i = isset($startRow_startRow) ? $startRow_startRow : 0;
	?>
    <tr>
     <td align="center"><?php echo $Recordset1->getColumnVal("member_username"); ?></td>
     <td align="center"><?php echo $Recordset1->getColumnVal("member_uid"); ?></td>
     <td align="center"><?php echo $Recordset1->getColumnVal("member_name"); ?></td>
     <td align="center"><input name="member_phone<?php echo $i; ?>" type="text" id="member_phone<?php echo $i; ?>" value="<?php echo $Recordset1->getColumnVal("member_phone"); ?>" size="9" maxlength="10"></td>
     <td align="center"><input name="member_email<?php echo $i; ?>" type="text" id="member_email<?php echo $i; ?>" value="<?php echo $Recordset1->getColumnVal("member_email"); ?>" size="17"></td>
     <td align="center"><select name="member_ok<?php echo $i; ?>" id="member_ok<?php echo $i; ?>">
                  <option value="0" <?php if (!(strcmp(0, $Recordset1->getColumnVal("member_ok")))) { echo "selected=\"selected\"";} ?>>未認證</option>
                  <option value="1" <?php if (!(strcmp(1, $Recordset1->getColumnVal("member_ok")))) { echo "selected=\"selected\"";} ?>>已認證</option>
                  <option value="2" <?php if (!(strcmp(2, $Recordset1->getColumnVal("member_ok")))) { echo "selected=\"selected\"";} ?>>黑名單</option>
                </select></td>
     <td align="center"><input name="data_id<?php echo $i; ?>" type="hidden" id="data_id<?php echo $i; ?>" value="<?php echo $row_Recordset1['member_id']; ?>" /><input name="mixdel<?php echo $i; ?>" type="checkbox" id="selecttype" value="<?php echo $row_Recordset1['member_id']; ?>" /></td>
    </tr>
    <?php $Recordset1->moveNext(); } $Recordset1->moveFirst(); ?>
   </table>