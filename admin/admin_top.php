<?php require_once('../webassist/mysqli/authentication.php'); ?>
<?php require_once('security.php'); ?>
<table border="0" cellpadding="0" cellspacing="0" id="top">
  <tr>
    <td align="left"><span class="style1">歡迎登入使用後台管理系統</span></td>
    <td align="right"><input name="logoutbutton" type="button" id="logoutbutton" onclick="this.disabled=true;this.value='登出中，請稍後！';location.href='logout.php'" value="點我登出" /></td>
  </tr>
</table>
