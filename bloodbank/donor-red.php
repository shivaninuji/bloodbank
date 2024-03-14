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
                <h2 style="margin-left: 20px;"><a href="admin-home.php" style="text-decoration: none;color: white;">BLOOD BANK MANAGEMENT SYSTEM</a></h2>
            </div>
            <div id="body">
                <br>
                <h1 style="margin-left: 20px;">DONOR REGISTRATION</h1><br><br><br>
                <center><div id="form">
                    <form action="" method="post">
                        <table>
                            <tr>
                                <td style="font-size:21px; font-weight:bold;">Enter Name</td>
                                <td width="200px" height="50px"><input type="text" name="name" placeholder="Enter Name"></td>
                                <td style="font-size:21px; font-weight:bold;">Enter address</td>
                                <td width="200px" height="50px"><textarea name="address"></textarea></td>
                            </tr>
                            <tr>
                                <td style="font-size:21px; font-weight:bold;">Date of birth</td>
                                <td width="200px" height="50px"><input type="date" name="dob" placeholder="Enter DOB" max="<?php echo date('Y-m-d'); ?>"></td>
                                <td style="font-size:21px; font-weight:bold;" >Enter weight</td>
                                <td width="200px" height="50px"><input type="text" name="weight" placeholder="Enter weight"></td>
                            </tr>
                            <tr>
                                <td style="font-size:21px; font-weight:bold;">Phone number</td>
                                <td width="200px" height="50px"><input type="text" name="phone_no" placeholder="Enter Phoneno"></td>
                                <td style="font-size:21px; font-weight:bold;">Gender</td>
                                <td width="200px" height="50px"><input type="text" name="gender" placeholder="Enter Gender"></td>
                            </tr>
                            <tr>
                                <td width="200px" height="50px" style="font-size:21px; font-weight:bold;">Doctor Name</td>
                                <td width="200px" height="50px"><input type="text" name="doc_name" placeholder="Doctor Name"></td>
                            </tr>
                            <tr>
                                <td width="200px" height="50px" style="font-size:21px; font-weight:bold;">Doctor Phone No.</td>
                                <td width="200px" height="50px"><input type="text" name="doc_phoneno" placeholder="Doctor Phone No."></td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="sub" value="Save"></td>
                            </tr>
                        </table>
                    </form>
                </div></center>

                <?php
                if(isset($_POST['sub'])) {
                    $name = $_POST['name'];
                    $address = $_POST['address'];
                    $dob = $_POST['dob'];
                    $weight = $_POST['weight'];
                    $phone_no = $_POST['phone_no'];
                    $gender = $_POST['gender'];
                    $doc_name = $_POST['doc_name'];
                    $doc_phoneno = $_POST['doc_phoneno'];

          // Calculate age from date of birth
          $current_year = date('Y');
          $dob_timestamp = strtotime($dob);
          $birth_year = date('Y', $dob_timestamp);
          $age = $current_year - $birth_year;

          // Check if age is less than 18
          if ($age < 18) {
              echo "<script>alert('You must be at least 18 years old to register as a donor.')</script>";
          } else {
              // Proceed with donor registration
              $q = $db->prepare("INSERT INTO donor (name, address, dob, weight, phone_no, gender, doc_name, doc_phoneno) VALUES
                  (:name, :address, :dob, :weight, :phone_no, :gender,:doc_name, :doc_phoneno)");

              $q->bindValue(':name', $name);
              $q->bindValue(':address', $address);
              $q->bindValue(':dob', $dob);
              $q->bindValue(':weight', $weight);
              $q->bindValue(':phone_no', $phone_no);
              $q->bindValue(':gender', $gender);
              $q->bindValue(':doc_name', $doc_name);
              $q->bindValue(':doc_phoneno', $doc_phoneno);

              if ($q->execute()) {
                  echo "<script>alert('Donor registered successfully.')</script>";

                  // Insert data into the doctor table
                  $q = $db->prepare("INSERT INTO doctor (doc_name, doc_phoneno) VALUES (:doc_name, :doc_phoneno)");
                  $q->bindValue(':doc_name', $doc_name);
                  $q->bindValue(':doc_phoneno', $doc_phoneno);
                  $q->execute();
              } else {
                  echo "<script>alert('Donor registration failed.')</script>";
              }
          }
      }
      ?>
<br><br> <br><br> <br><br>  <br><br> <br><br> <br><br>
            </div>
            <div id="footer"><h4 align="center">Copyright 2024 @ mini-project</h4></div>
            <p align="center"><a href="logout.php"><font color="black">Logout</font></a></p>
        </div>
    </div>
</body>
</html>
