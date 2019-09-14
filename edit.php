<?php
include_once("config.php");

if(isset($_POST['update']))
{	
	$pid = $_POST['id'];
	$ProductName = $_POST['Pname'];
	$ProductDesc = $_POST['Pdesc'];
	$Price = $_POST['Pprice'];
	$Stocks = $_POST['Pstock'];
	
	// checking empty fields
	if(empty($ProductName) || empty($ProductDesc) || empty($Price) || empty($Stocks)) {	
			
		if(empty($ProductName)) {
			echo "<font color='red'>Product Name field is empty.</font><br/>";
		}
		
		if(empty($ProductDesc)) {
			echo "<font color='red'>Description field is empty.</font><br/>";
		}
		
		if(empty($Price)) {
			echo "<font color='red'>Price field is empty.</font><br/>";
        }
        
        if(empty($Stocks)) {
			echo "<font color='red'>Stocks field is empty.</font><br/>";
		}
	} else {	
		//updating the table
		$sql = "UPDATE tbl_products SET Pname=:pname, Pdesc=:pdesc, Pprice=:pprice, Pstock=:pstock WHERE id=:id";
		$query = $dbConn->prepare($sql);
        
        $query->bindparam(':id', $pid);
		$query->bindparam(':pname', $ProductName);
		$query->bindparam(':pdesc', $ProductDesc);
		$query->bindparam(':pprice', $Price);
		$query->bindparam(':pstock', $Stocks);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
				
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>

<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM tbl_products WHERE id=:pid";
$query = $dbConn->prepare($sql);
$query->execute(array(':pid' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $ProductName = $row['Pname'];
	$ProductDesc = $row['Pdesc'];
	$Price = $row['Pprice'];
	$Stocks = $row['Pstock'];
}
?>

<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
        <table width="25%" border="1">
			<tr> 
				<td>Product Name</td>
				<td><input type="text" name="Pname" value="<?php echo $ProductName ?>"></td>
			</tr>
			<tr>
				<td>Product Description</td>
				<td><input type="text" name="Pdesc" value="<?php echo $ProductDesc ?>"></td>
			</tr>
			<tr> 
				<td>Price</td>
				<td><input type="text" name="Pprice" value="<?php echo $Price ?>"></td>
			</tr>
			<tr> 
				<td>Stocks</td>
				<td><input type="text" name="Pstock" value="<?php echo $Stocks ?>"></td>
			</tr>
			<tr> 
                <td><input type="text" name="id" value="<?php echo $_GET['id'] ?>"></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>