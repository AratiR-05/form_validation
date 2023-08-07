<?php
include_once 'connection.php';
$result = mysqli_query($conn, "SELECT * FROM mca_student;");
?>
<?php
if (mysqli_num_rows($result) > 0) {
    ?>
<table border="1">
    <tr>
        <th colspan="5">
            <h2>Student Record</h2>
        </th>
    </tr>

    <tr>
        <td>S.No</td>
        <td>Name</td>
        <td>Email id</td>
        <td>Mobile</td>
        <td>Action</td>
    </tr>
    <?php
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            ?>
    <tr>
        <td>
            <?php echo $i; ?>
        </td>

        <td>
            <?php echo $row["Name"]; ?>
        </td>

        <td>
            <?php echo $row["Email"]; ?>
        </td>

        <td>
            <?php echo $row["Number"]; ?>
        </td>
        <td>
            <a href="http://localhost/form_validation/edit.php?id=<?php echo $row["Stu_ID"]; ?>">Edit</a>
            <a href="delete.php?id=<?php echo $row["Stu_ID"]; ?>" onclick="return confirm('are you sure?')">Delete</a>
        </td>
    </tr>
    <?php
            $i++;
        }
        ?>
</table>
<?php
} else {
    echo "No result found";
}
?>