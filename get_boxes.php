<?php

if (isset($_POST['branch_id'])) {
    $branch_id = $_POST['branch_id'];
    
    
    // Database connection
    $conn = new mysqli("localhost", "root", "", "catmarketing");
    
    // Simple SQL query to get branches for the selected company
    $result = $conn->query("SELECT box_id, box_name FROM box WHERE branchID_FK = '$branch_id'");
    
    $boxes = array();
    while ($row = $result->fetch_assoc()) {
        $boxes[] = $row;
    }
    

    // Return branches as JSON
    echo json_encode($boxes);

    $conn->close();
}
?>