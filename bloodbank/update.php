<?php
// Include the database connection file
include('connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $updateId = $_POST['updateId'];
    $updateName = $_POST['updateName'];
    $updateAddress = $_POST['updateAddress'];
    $updateWeight = $_POST['updateWeight'];
    $updateGender = $_POST['updateGender'];
    $updateDOB = $_POST['updateDOB'];
    $updatePhone = $_POST['updatePhone'];

    // Update the donor information in the database
    $stmt = $db->prepare("UPDATE donor SET name = ?, address = ?, weight = ?, gender = ?, dob = ?, phone_no = ? WHERE id = ?");
    $stmt->execute([$updateName, $updateAddress, $updateWeight, $updateGender, $updateDOB, $updatePhone, $updateId]);

    // Check if the update was successful
    if ($stmt->rowCount() > 0) {
        // Return the updated donor information as JSON response
        $updatedData = array(
            'id' => $updateId,
            'name' => $updateName,
            'address' => $updateAddress,
            'weight' => $updateWeight,
            'gender' => $updateGender,
            'dob' => $updateDOB,
            'phone_no' => $updatePhone
        );
        echo json_encode($updatedData);
    } else {
        // If the update failed, return an error response
        http_response_code(500);
        echo json_encode(array('message' => 'Error updating donor information.'));
    }
} else {
    // If the form is not submitted via POST request, return an error response
    http_response_code(400);
    echo json_encode(array('message' => 'Bad request.'));
}
?>