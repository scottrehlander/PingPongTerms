<?php
	require_once("DataAdapter.php");
	
	$pingPongTableAdapter = new PingPongTermTableAdapater();
	$terms = $pingPongTableAdapter->GetPingPongTerms();
	
	$divsPerRow = 3;
	
	
	$organizedArray = array ( );
	
	$curCategory = "";
	
	// Preproces by category
	foreach($terms as $term)
	{
		if($term['categoryName'] != $curCategory)
		{
			$curCategory = $term['categoryName'];
			//$organizedArray[] = array ( $curCategory => array ( ) );
		}
		
		$organizedArray[$curCategory][] = $term;
	}
	
	echo(json_encode($organizedArray));
?>