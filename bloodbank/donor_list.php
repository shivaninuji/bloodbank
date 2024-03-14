<?php  
include('connection.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/s1.css">
    <style type="text/css">
        td{
            width:200px;
            height:40px;
            font-size:17px; 
        }
        .highlight {
            background-color: #ffeeba; /* You can change the highlight color */
        }
    </style>
    <script>
        function updateDonor(donorId) {
            var row = document.getElementById('row_' + donorId);
            var name = row.cells[1].innerText;
            var address = row.cells[2].innerText;
            var weight = row.cells[3].innerText;
            var gender = row.cells[4].innerText;
            var dob = row.cells[5].innerText;
            var phone_no = row.cells[6].innerText;

            document.getElementById('updateId').value = donorId;
            document.getElementById('updateName').value = name;
            document.getElementById('updateAddress').value = address;
            document.getElementById('updateWeight').value = weight;
            document.getElementById('updateGender').value = gender;
            document.getElementById('updateDOB').value = dob;
            document.getElementById('updatePhone').value = phone_no;

            document.getElementById('updateForm').style.display = 'block';
        }
    </script>
</head>
<body>
    <div id="full">
        <div id="inner_full">
            <div id="header">
                <h2 style="margin-left: 20px;"><a href="admin-home.php" style="text-decoration: none;color: white;">BLOOD BANK MANAGEMENT SYSTEM</a></h2>
            </div>
            <div id="body">
                <br>
                <h1 style="margin-left: 20px;">DONOR LIST</h1><br><br><br>
                <div id="form">
                    <table>
                        <tr>
                            <td style="font-size:20px; font-weight:bold;"><center><b><font color="black">Id</font></b></center></td>
                            <td style="font-size:20px; font-weight:bold;"><center><b><font color="black">Name</font></b></center></td>
                            <td style="font-size:20px; font-weight:bold;"><center><font color="black"><b>Address</b></font></center></td>
                            <td style="font-size:20px; font-weight:bold;"><center><font color="black"><b>Weight</b></font></center></td>
                            <td style="font-size:20px; font-weight:bold;"><center><font color="black"><b>Gender</b></font></center></td>
                            <td style="font-size:20px; font-weight:bold;"><center><b><font color="black">Date of birth</font></b></center></td>
                            <td style="font-size:20px; font-weight:bold;"><center><b><font color="black">Phone Number</font></b></center></td>
                            <td style="font-size:20px; font-weight:bold;"></td> <!-- Added an empty column for the update button -->
                        </tr>

                        <?php
                        $q = $db->query("SELECT id, name, address, weight, gender, dob, phone_no FROM donor");
                        while ($r1 = $q->fetch(PDO::FETCH_OBJ)) {
                        ?>
                            <tr class="data-row" id="row_<?= $r1->id; ?>">
                                <td><center><?= $r1->id; ?></center></td>
                                <td><center><?= $r1->name; ?></center></td>
                                <td><center><?= $r1->address; ?></center></td>
                                <td><center><?= $r1->weight; ?></center></td>
                                <td><center><?= $r1->gender; ?></center></td>
                                <td><center><?= $r1->dob; ?></center></td>
                                <td><center><?= $r1->phone_no; ?></center></td>
                                <td><center><button onclick="updateDonor(<?= $r1->id; ?>)">Update</button></center></td>
                                <td><center><button onclick="deleteDonor(<?= $r1->id; ?>)">Delete</button></center></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div> <br><br> <br><br> <br><br>  <br><br> <br><br> <br><br>
                </div>
            <div id="footer"><h4 align="center">copyright 2024 @ mini-project</h4></div>
            <p align="center"><a href="logout.php"><font color="black">Logout</font></a></p>
        </div>
            </div>
    
    <!-- Update Form -->
    <div id="updateForm" style="display: none;">
        <form id="updateDonorForm" method="post" action="update.php">
            <input type="hidden" name="updateId" id="updateId">
            Name: <input type="text" name="updateName" id="updateName"><br>
            Address: <input type="text" name="updateAddress" id="updateAddress"><br>
            Weight: <input type="text" name="updateWeight" id="updateWeight"><br>
            Gender: <input type="text" name="updateGender" id="updateGender"><br>
            Date of Birth: <input type="text" name="updateDOB" id="updateDOB"><br>
            Phone Number: <input type="text" name="updatePhone" id="updatePhone"><br>
            <input type="submit" value="Submit">
        </form>
    </div>

    <script>
        // Function to handle form submission using AJAX
        document.getElementById("updateDonorForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this); // Create a FormData object from the form
            var xhr = new XMLHttpRequest(); // Create a new XMLHttpRequest object

            // Configure the AJAX request
            xhr.open("POST", "update.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // On successful update, display a message and update the table
                        alert("Successfully updated");
                        updateTable(JSON.parse(xhr.responseText));
                    } else {
                        // If there's an error, display an error message
                        alert("Error updating donor details");
                    }
                }
            };

            // Send the form data to the server
            xhr.send(formData);
        });

        // Function to update the table with new data
        function updateTable(updatedData) {
            var row = document.getElementById('row_' + updatedData.id);
            row.cells[1].innerText = updatedData.name;
            row.cells[2].innerText = updatedData.address;
            row.cells[3].innerText = updatedData.weight;
            row.cells[4].innerText = updatedData.gender;
            row.cells[5].innerText = updatedData.dob;
            row.cells[6].innerText = updatedData.phone_no;

            // Hide the update form
            document.getElementById('updateForm').style.display = 'none';
        }
    </script>

    <!-- Delete Form -->
    <script>
        function deleteDonor(donorId) {
            // Confirm deletion with the user
            if (confirm('Are you sure you want to delete this donor?')) {
                // Use AJAX to send a request to the server to delete the donor
                fetch(`delete.php?Id=${donorId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Donor deleted successfully");
                            // You can update the UI or take other actions as needed
                            document.getElementById(`row_${donorId}`).remove(); // Remove the row from the table
                        } else {
                            alert("Failed to delete donor: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("An error occurred while deleting the donor");
                    });
            }
        }
    </script>
</body>
</html>
