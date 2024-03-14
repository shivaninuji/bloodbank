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
            <h1 style="margin-left: 20px;">PATIENT</h1><br><br><br>
            <center><div id="form">
                <form action="" method="post">
                <table>
                    <tr>
                        <td style="font-size:21px; font-weight:bold;">Patient name</td>
                        <td width="200px" height="50px"><input type="text" name="patient_name" placeholder="Patient name"></td>

                    </tr>
                    <tr>
                        <td style="font-size:21px; font-weight:bold;">Patient Address </td>
                        <td width="200px" height="50px"><input type="text" name="patient_address" placeholder="Patient Address"></td>
                </tr>
          
     

        <tr>
        <td style="font-size:21px; font-weight:bold;">Patient Mobile</td>
                        <td width="200px" height="50px"><input type="text" name="patient_mobile" placeholder="Patient Mobile"></td>
        </tr>

        <tr>
        <td style="font-size:21px; font-weight:bold;">Hospital Address</td>
                        <td width="200px" height="50px"><input type="text" name="hospital_address" placeholder="Hospital Address"></td>
        </tr>

        <tr>
                    <td><input type="submit" name="sub" value="save"><td>
                    </tr>
    </table>
    </form>
    <?php
if(isset($_POST['sub'])) {
    $patient_name = $_POST['patient_name'];
    $patient_address = $_POST['patient_address'];
    $patient_mobile = $_POST['patient_mobile'];
    $hospital_address = $_POST['hospital_address'];
    

    $q = $db->prepare("INSERT INTO patient (patient_name, patient_address, patient_mobile,hospital_address) VALUES
                      (:patient_name, :patient_address, :patient_mobile,:hospital_address)");

    $q->bindValue(':patient_name',$patient_name );
    $q->bindValue(':patient_address', $patient_address);
    $q->bindValue(':patient_mobile',$patient_mobile );
    $q->bindValue(':hospital_address',$hospital_address);
   

    try {
        if ($q->execute()) {
            echo "<script>alert('Patient Registration Successful')</script>";
        } else {
            echo "<script>alert('Patient Registration Failed')</script>";
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