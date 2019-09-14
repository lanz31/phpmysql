<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$ProductName = $_POST['Pname'];
	$ProductDesc = $_POST['Pdesc'];
	$Price = $_POST['Pprice'];
	$Stocks = $_POST['Pstock'];

	// checking empty fields
	if(empty($ProductName) || empty($ProductDesc) || empty($Price) || empty($Stocks)) {
				
		if(empty($ProductName)) {
			echo "<h4 class=\"text-danger\">Product Name field is empty.</h4><br/>";
		}

		if(empty($ProductDesc)) {
			echo "<h4 class=\"text-danger\">Product Description field is empty.</h4><br/>";
		}
		
		if(empty($Price)) {
			echo "<h4 class=\"text-danger\">Price field is empty.</h4><br/>";
		}
		
		if(empty($Stocks)) {
			echo "<h4 class=\"text-danger\">Stocks field is empty.</h4><br/>";
		}
		
		//link to the previous page
		echo "<br/><a class=\"btn btn-primary\" href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty)
			
		//insert data to database		
		$sql = "INSERT INTO tbl_products (Pname, Pdesc, Pprice, Pstock) VALUES(:Pname, :Pdesc, :Pprice, :Pstock)";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':Pname', $ProductName);
		$query->bindparam(':Pdesc', $ProductDesc);
		$query->bindparam(':Pprice', $Price);
		$query->bindparam(':Pstock', $Stocks);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
		
		//display success message
		echo "<h2 class=\"text-success\">Data added successfully.</h2>";
		echo "<br/><h2 class=\"text-success\"><a href='index.php'>View Result</a></h2>";
	}
}
?>
</body>
</html>
