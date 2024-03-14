<?php
// Include the database connection file
include('connection.php');

// Check if the donor ID is provided
if (isset($_GET['Id'])) {
    $donorId = $_GET['Id'];

    // Perform the deletion logic (delete the donor from the database, etc.)
    // Example:
    $stmt = $db->prepare("DELETE FROM donor WHERE Id = ?");
    $stmt->execute([$donorId]);

    // Check if any rows were affected
    if ($stmt->rowCount() > 0) {
        // Return a success response
        echo json_encode(['success' => true]);
        exit;
    } else {
        // If no rows were affected, return an error response
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to delete donor. No records were affected.']);
        exit;
    }
}

// If the donor ID is not provided, return an error response
http_response_code(400);
echo json_encode(['success' => false, 'message' => 'Invalid request. Donor ID not provided.']);
?>
