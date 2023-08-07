<?php
include_once 'connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM mca_student WHERE Stu_ID = '$id'";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
header("Location: record.php", true, 301);
?>