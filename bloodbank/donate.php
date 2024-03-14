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
            <h2 style="margin-left: 20px;"><a href="admin-home.php" style="text-decoration: none;color: white;">BLOOD BANK MANAGEMENT SYSTEM</a></h2></div>
            <div id="body">
            <br>
            <h1 style="margin-left: 20px;">DONATION</h1><br><br><br>
            <center><div id="form">
                <form action="" method="post">
                <table>
                    <tr>
                        <td style="font-size:21px; font-weight:bold;">Blood Type</td>
                        <td width="200px" height="50px"><input type="text" name="bloodtype" placeholder="Blood Type"></td>
                        
                    </tr>
                    <tr>
                        <td style="font-size:21px; font-weight:bold;">Blood Bank Name</td>
                        <td width="200px" height="50px">
                        <select name="bloodbank_name" id="bloodbank_name">
                                            <option>KMC</option>
                                            <option>Father Mullers</option>
                                            <option>AJ</option>
                                            
                                        </select></td>
                    </tr>
          
     

        <tr>
        <td style="font-size:21px; font-weight:bold;">Blood Bank Address</td>
                        <td width="200px" height="50px">
                        <select name="bloodbank_address" >
                                            <option>Attavar</option>
                                            <option>Kankanady</option>
                                            <option>Kuntikana</option>
                                            
                                        </select>
                        </td>
        </tr>

        <tr>
                    <td><input type="submit" name="sub" value="save"><td>
                    </tr>
    </table>
    </form>
    <?php
if(isset($_POST['sub'])) {
    $bloodtype = $_POST['bloodtype'];
    $bloodbank_name = $_POST['bloodbank_name'];
    $bloodbank_address = $_POST['bloodbank_address'];

    $q = $db->prepare("INSERT INTO donate (bloodtype, bloodbank_name, bloodbank_address) VALUES
                      (:bloodtype, :bloodbank_name, :bloodbank_address)");

    $q->bindValue(':bloodtype', $bloodtype);
    $q->bindValue(':bloodbank_name', $bloodbank_name);
    $q->bindValue(':bloodbank_address', $bloodbank_address);
   

    try {
        if ($q->execute()) {
            echo "<script>alert('Donation successful')</script>";
        } else {
            echo "<script>alert('Donation failed')</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>

</div>

                 </div>
             </table>

             <br><br> <br><br> <br><br>  <br><br> <br><br> <br><br>
            <div id="footer"><h4 align="center">copyright 2024 @ mini-project</div>
                <p align="center"><a href="logout.php"><font color="black">Logout</font></a></p>
</div>
</div>

</body>
</html>