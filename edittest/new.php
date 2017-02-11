<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `pingPongTerms` ( `termId` ,  `termName`  ) VALUES(  '{$_POST['termId']}' ,  '{$_POST['termName']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='list.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>TermId:</b><br /><input type='text' name='termId'/> 
<p><b>TermName:</b><br /><input type='text' name='termName'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
