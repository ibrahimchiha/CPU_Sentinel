<?php
session_start();
?>
<!DOCTYPE html>
<body>


<?php
    function table_exists(&$db, $table) {
        $result = $db->query("SHOW TABLES LIKE '{$table}'");
        if( $result->num_rows == 1 ) {
                return TRUE;
        }
        else {
                return FALSE;
        }
        $result->free();
    }

    $username = $_POST['username'];
    $password = $_POST['password1'];
    $password = $_POST['password2'];

        
        $conn = mysqli_connect("localhost", "u123926142_ZiadHamwi", "sentinel20", "u123926142_CPU_Sentinel");
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }
    
    
    
        $sql = "SELECT *
FROM $username;";

$result = $conn->query($sql);


if ($result->num_rows > 0)
    echo "<script type='text/javascript'>location.href = 'https://google.com';</script>";
    
else
    
    echo "<script type='text/javascript'>location.href = 'https://google.com';</script>";
    
    
    
    
    
    
    
//     if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$username."'"))==1) 
//     echo "<script type='text/javascript'>location.href = 'https://google.com';</script>";
// else 
// echo "<script type='text/javascript'>location.href = 'https://google.com';</script>";
    
    
    
    



//     $Password = $row["Password"];

    
// break;


// }



// }




$_SESSION['username'] = $username;
if ($password == $Password && $username != '' && $password != '') {
    
    echo "<script type='text/javascript'>location.href = 'CPUSentinelHome.php';</script>";
    
}

else {
    
    echo "<script type='text/javascript'>location.href = 'index.php';</script>";
    
    
}

$conn->close();
?>




</body>
</html>
