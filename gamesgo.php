<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "game";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id,zahl1,zahl2,zahl3 FROM games WHERE id_user2 IS NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$won = true;
	$row =$result->fetch_assoc();
	if($row["zahl1"]<$_POST["name"]){
		$won= false;
	}
	
	$sql = "UPDATE games SET id_user2=".$_POST["id"]." ,zahl4=".$_POST["name"].",zahl5=".$_POST["email"].",zahl6=".$_POST["three"].",result=".$won." WHERE id=".$row["id"].";";
	echo "<br>". $sql;
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
  
} else {
    echo "0 results";
	$sql = "INSERT INTO games (zahl1, zahl2, zahl3,id_user)
VALUES (" .$_POST["name"].",".$_POST["email"].",".$_POST["three"].",".$_POST["id"].")";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}






$sql = "SELECT max(id) FROM games WHERE id_user=".$_POST["id"] ;
$result = $conn->query($sql);

    
        echo "id: " . $result->fetch_assoc()["max(id)"]."<br>";
    



$conn->close();

?>
<br>Welcome <?php echo $_POST["name"]; ?><br>
Your email address is: <?php echo $_POST["email"]; ?><br>
Your email address is: <?php echo $_POST["three"]; ?>

</body>
</html>