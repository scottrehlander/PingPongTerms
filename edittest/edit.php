<? 
include('config.php'); 
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `pingPongTerms` SET  `termId` =  '{$_POST['termId']}' ,  `termName` =  '{$_POST['termName']}'   WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='list.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `pingPongTerms` WHERE `id` = '$id' ")); 
?>

<form action='' method='POST'> 
<p><b>TermId:</b><br /><input type='text' name='termId' value='<?= stripslashes($row['termId']) ?>' /> 
<p><b>TermName:</b><br /><input type='text' name='termName' value='<?= stripslashes($row['termName']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
