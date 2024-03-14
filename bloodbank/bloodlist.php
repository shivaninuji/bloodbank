<?php  
// Include the file containing the database connection
include('connection.php');

// Retrieve blood bank information from the "donation" table in the database
$q = $db->query("SELECT bloodtype, bloodbank_name, bloodbank_address FROM donate");
$blood_banks = $q->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Blood</title>
    <link rel="stylesheet" type="text/css" href="css/s1.css">
    <style type="text/css">
        td {
            width:200px;
            height:40px;
        }
    </style>
</head>
<body>
    <div id="full">
        <div id="inner_full">
            <div id="header">
                <h2 style="margin-left: 20px;"><a href="admin-home.php" style="text-decoration: none;color: white;">BLOOD BANK MANAGEMENT SYSTEM</a></h2>
            </div>
            <div id="body">
                <br>
                <h1 style="margin-left: 20px;">BLOOD BANKS</h1>
                <br><br><br>
                <div id="form">
                    <table>
                        <tr>
                            <td><center><b><font color="black" style="font-size:21px; font-weight:bold;">Blood Bank Name</font></b></center></td>
                            <td><center><b><font color="black" style="font-size:21px; font-weight:bold;">Blood Bank Address</font></b></center></td>
                            <td><center><b><font color="black" style="font-size:21px; font-weight:bold;">BloodType</font></b></center></td>
                            <td><center><b><font color="black" style="font-size:21px; font-weight:bold;">Action</font></b></center></td>
                        </tr>

                        <?php foreach ($blood_banks as $bank): ?>
                            <tr>
                                <td style="font-size:21px; "><center><?= $bank['bloodbank_name']; ?></center></td>
                                <td style="font-size:21px; "><center><?= $bank['bloodbank_address']; ?></center></td>
                                <td style="font-size:21px; "><center><?= $bank['bloodtype']; ?></center></td>
                                <td style="font-size:21px; "><center><a href="#" onclick="orderBlood('<?= $bank['bloodbank_name']; ?>', '<?= $bank['bloodbank_address']; ?>', '<?= $bank['bloodtype']; ?>')">Request</a></center></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <br><br> <br><br> <br><br><br><br> <br><br> <br><br> 
            </div>
            <div id="footer"><h4 align="center">copyright 2024 @ mini-project</h4></div>
            <p align="center"><a href="logout.php"><font color="black">Logout</font></a></p>
        </div>
    </div>

    <script>
        function orderBlood(bloodbankName, bloodbankAddress, bloodType) {
            // Display a notification instead of redirecting
            alert("Your request for blood from " + bloodbankName + " has been successfully submitted!");
        }
    </script>
</body>
</html>
