<html>
<head>
<link href="form2.css" rel="stylesheet">
</head>
<body>
<?php
include 'dbconnect.php';
$conn = OpenCon();
if(!$conn)
{
	die('Could not connect: ' . mysql_error());
}
$user = $_POST["username"];
$pass = $_POST["password"];
if (empty ($user))
{
    echo "Enter a unique username";

}
if (empty ($pass)) 
{
    echo "Enter a unique password";
}
$query = "SELECT * FROM admin WHERE username = '". mysqli_real_escape_string($conn,$user) ."' AND password = '". mysqli_real_escape_string($conn,$pass) ."'" ;
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result) == 1) 
{
	echo "Welcome";
	echo $_POST["username"];
	echo "<br>";
	echo "<br>";
	echo "Orders you have are ";
	$sql = "SELECT * FROM orders where date>CURDATE() AND storename= '".mysqli_real_escape_string($conn,$user) ."'" ;
	if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>storename</th>";
                echo "<th>user</th>";
                echo "<th>date</th>";
				echo "<th>item</th>";
                echo "<th>quantity</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['storename'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
				echo "<td>" . $row['item'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
		echo "<br>";
		echo "Item to add";
		echo "<br>";
        mysqli_free_result($result);
        }
	}else{
        echo "No records matching your query were found.";
    }
}else 
{
	echo "incorrect username or password";
}
 ?><br>
 items you want to add
 <form action="newfile.php" method="post">
username:<input type="text" name="username"><br>
<br>
date: <input type="date" name="date"><br>
<br>
item: <input type="text" name="item"><br>
<br>
quantity available:<input type="number" name="quantity"><br>
<input type="submit">
</form>

</body>
</html>