<?php
include('db.php');

// Prepare data for update
$id = $_POST['id'];
$cname = $_POST['cname'];
$clogo = $_POST['clogo'];
$curl = $_POST['curl'];
$ccategory = $_POST['ccategory'];

// Update data in database
$sql = "UPDATE `tv channels` SET CNAME='$cname', CLOGO='$clogo', CURL='$curl', CCATEGORY='$ccategory' WHERE ID='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Channel updated successfully";
} else {
    echo "Error updating channel: " . $conn->error;
}

$conn->close();
?>
