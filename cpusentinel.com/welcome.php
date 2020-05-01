<?php
session_start();
?>
<!DOCTYPE html>
<body>


<?php


    $username = $_POST['username'];
    $password = $_POST['password'];


        
        $conn = mysqli_connect("localhost", "u123926142_ZiadHamwi", "sentinel123", "u123926142_CPU_Sentinel");
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }
    $sql = "SELECT Password, FirstName
FROM `$username`
WHERE FirstName = '0';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {


    $Password = $row["Password"];

    
break;


}



}


$_SESSION['username'] = $username;
if ($password == $Password && $username != '' && $password != '') {
    
    echo "<script type='text/javascript'>location.href = 'CPUSentinelHome.php';</script>";
    
}

else {
    
    echo "<script type='text/javascript'>location.href = 'indexFailed.html';</script>";
    
    
}

$conn->close();
?>




</body>
</html>
