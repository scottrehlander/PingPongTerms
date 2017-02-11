<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
	
	require_once("../DataAdapter.php");

	if($_POST['categoryName'] != "")
	{
		$pptta = new PingPongTermTableAdapater();
		
		$pptta->InsertCategory($_POST['categoryName'], $_POST['categoryDesc']);
	}

?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Add Category</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>

</head>
<body id="main_body" >
	
	<img id="top" src="top.png" alt="">
	<div id="form_container">
	
		<h1><a>Add Category</a></h1>
		<form id="form_291279" class="appnitro"  method="post" action="AddCategory.php">
					<div class="form_description">
			<h2>Add category</h2>
			<p>Describe the category you wish to add</p>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="categoryName">Category Name </label>
		<div>
			<input id="categoryName" name="categoryName" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="categoryDesc">Category Description </label>
		<div>
			<textarea id="categoryDesc" name="categoryDesc" class="element textarea medium"></textarea> 
		</div> 
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="291279" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
	</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>