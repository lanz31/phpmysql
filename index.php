<?php
include_once("config.php");

$result = $dbConn->query("SELECT * FROM tbl_products");
?>

<html>
<head>
	<title>Products</title>
</head>

<body>
    <a href="index.php">Home</a>
    <a href="add.html">Add Product</a>
	<br/><br/>

	<table width='80%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td>Id</td>
		<td>Product Name</td>
		<td>Description</td>
		<td>Price</td>
		<td>Stock Count</td>
		<td>Update/Delete Order</td>
	</tr>
	<?php 	
	while($row = $result->fetch(PDO::FETCH_ASSOC)) { 		
		echo "<tr>";
		echo "<td>".$row['id']."</td>";
		echo "<td>".$row['Pname']."</td>";
		echo "<td>".$row['Pdesc']."</td>";	
		echo "<td>".$row['Pprice']."</td>";
		echo "<td>".$row['Pstock']."</td>";
		echo "<td><a href=\"edit.php?id=$row[id]\">Edit</a> | <a href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
	}
	?>
	</table>
</body>
</html>

