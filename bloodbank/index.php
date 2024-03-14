<?php  
include('connection.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/s1.css">
    
</head>
<body>
    <div id="full">
        <div id="inner_full">
            <div id="header">
            <h2 style="margin-left: 20px;">BLOOD BANK MANAGEMENT SYSTEM</h2></div>
            <div id="body">
            <br><br><br><br><br>

            <form action="" method="post">
            <table align="center">
                <tr>
                    <td width="200px" height="70px" style="font-size:20px;"><b>Enter Username</b></td>
                    <td width="100px" height="70px"><input type="text" name="un" placeholder="Enter Username" style="width: 180px;height: 40px; border-radius: 10px;"></td>
                </tr>

                <tr>
                    <td width="200px" height="70px" style="font-size:20px;"><b>Enter Password</b></td>
                    <td width="200px" height="70px"><input type="text" name="ps" placeholder="Enter password" style="width: 180px;height: 40px; border-radius: 10px;"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="sub" value="login" style="width:70px; height:40px;border-radius: 10px;" ></td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['sub']))
            {
               $un=$_POST['un'];
               $ps=$_POST['ps'];
               $q=$db->prepare("SELECT * FROM admin WHERE uname='$un'&& pass='$ps'" );
               $q->execute();
               $res=$q->fetchAll(PDO::FETCH_OBJ);
               if($res)
               {
                header("Location:admin-home.php");
               }
               else
               {
                echo "<script>alert('Wrong User')</script>";
               }

            }
        ?><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          </div>
            <div id="footer"><h4 align="center">copyright 2024 @ mini-project</div>
                <h3 align="center"><a href="logout.php"><font color="black">Logout</font></a></p>
</div>
</div>

</body>
</html>