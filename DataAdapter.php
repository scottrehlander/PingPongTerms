<?php

class BaseDataAdapter
{
	protected $pdo;
	private $dbServer;
	private $dbName;
	private $dbUser;
	private $dbPass;

	function __construct()
	{
		$this->dbServer = 'db391398570.db.1and1.com';
		$this->dbName = 'db391398570';
		$this->dbUser = 'dbo391398570';
		$this->dbPass = 'highres123';
	}

	function ExecuteQuery($sql)
	{   
		if(empty($this->pdo))
		{
			$connectDb = "mysql:host=" . $this->dbServer . ";dbname=" . $this->dbName;
			$this->pdo = new pdo($connectDb, $this->dbUser, $this->dbPass);
		}

		return $this->pdo->query($sql);
	}

	// We want to pass in the query and an associative array of variables
	//  Bind the variables and then execute the query.
	function ExecutePreparedQuery($sql, $vars)
	{
		if(empty($this->pdo))
		{
			$connectDb = "mysql:host=" . $this->dbServer . ";dbname=" . $this->dbName;
			//$connectDb = "mysql:unix_socket=/tmp/mysql5.sock;dbname=" . $this->dbName;
			$this->pdo = new pdo($connectDb, $this->dbUser, $this->dbPass);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		try
		{
			$query = $this->pdo->prepare($sql);
		}
		catch(Exception $e)
		{
			echo("<b><font color=\"red\">Error executing sql query:</font><br><br>");
			print_r($e->getMessage());
			die();
		}
		if($query)
			$query->execute($vars);
		else
		{
			print_r($this->pdo->errorInfo);
			die();
		}

		try
		{
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(Exception $e)
		{ // An insert will throw, this is crappy and should probably be handled better
			return "";
		}
	}

	function ExecuteUpdateQuery($sql)
	{
		$connectDb = "mysql:host=" . $this->dbServer . ";dbname=" . $this->dbName;

		if(empty($pdo))
			$pdo = new pdo($connectDb, $this->dbUser, $this->dbPass);

		try
		{
			$pdo->beginTransaction();
			$pdo->query($sql);
			$pdo->commit();
		}
		catch(Exception $ex) { $pdo->rollbackTransaction(); }
	}

	function ExecutePreparedUpdateQuery($sql, $vars)
	{
		$connectDb = "mysql:host=" . $this->dbServer . ";dbname=" . $this->dbName;
		//$connectDb = "mysql:unix_socket=/tmp/mysql5.sock;dbname=" . $this->dbName;

		if(empty($pdo))
			$pdo = new pdo($connectDb, $this->dbUser, $this->dbPass);

		try
		{
			$pdo->beginTransaction();
			$query = $pdo->prepare($sql);

			$query->Execute($vars);
			$pdo->commit();
		}
		catch(Exception $ex) { print_r($ex); die(); $pdo->rollbackTransaction(); }
	}

	function GetLastInsertId()
	{
		$sql = "SELECT LAST_INSERT_ID()";
		$result = $this->ExecuteQuery($sql);

		$result = $result->fetchAll(PDO::FETCH_ASSOC);
		$result = $result[0];
		return $result['LAST_INSERT_ID()'];
	}

}

class PingPongTermTableAdapater extends BaseDataAdapter
{

	function GetPingPongTerms()
	{
		$sql = "SELECT * from pingPongTerms INNER JOIN termCategories ON pingPongTerms.termCategoryId = termCategories.categoryId ORDER BY termCategories.categoryName, pingPongTerms.termName";
		$varsArray = array ( );

		$result = $this->ExecutePreparedQuery($sql, $varsArray);
		
		return $result;
	}
	
	function GetCategories()
	{
		$sql = "SELECT * from termCategories";
		$varsArray = array ( );

		$result = $this->ExecutePreparedQuery($sql, $varsArray);
		
		return $result;	
	}

	function InsertCategory($catName, $catDesc)
	{
		$sql = "INSERT INTO termCategories (categoryName, categoryDescription) VALUES (:catName, :catDesc)";

		$varsArray = array (
			':catName'=>$catName,
			':catDesc'=>$catDesc
		);

		$this->ExecutePreparedUpdateQuery($sql, $varsArray);
	}	
	
	function InsertTerm($termName, $termDefinition, $categoryId)
	{
		$sql = "INSERT INTO pingPongTerms (termName, termDefinition, termCategoryId) VALUES (:termName, :termDefinition, :termCategoryId)";

		$varsArray = array (
			':termName'=>$termName,
			':termDefinition'=>$termDefinition,
			':termCategoryId'=>$categoryId
		);

		$this->ExecutePreparedUpdateQuery($sql, $varsArray);
	}
	
	// function UpdateFeaturedCity($city, $featuredCityText, $userName)
	// {
		// $sql = "UPDATE superadmindata SET extraData = :featuredCityText, adminDataValue = :cityId,
		// lastUserToEdit = :lastUser WHERE adminDataName = 'featuredCity'";

		// $varsArray = array (
		// ':featuredCityText'=>$featuredCityText,
		// ':cityId'=>$city->GetCityId(),
		// ':lastUser'=>$userName
		// );

		// $this->ExecutePreparedUpdateQuery($sql, $varsArray);
	// }
}

 ?>