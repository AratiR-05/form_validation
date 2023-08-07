<?php

include_once 'connection.php';
$id = $_GET['id'];

$sql = mysqli_query($conn, "SELECT * FROM mca_student WHERE Stu_ID = '$id'") or die(mysqli_error($conn));
$row = mysqli_fetch_array($sql);

$sname = $row['Name'];
$semail = $row['Email'];
$snumber = $row['Number'];

$valid_name = null;
$valid_email = null;
$valid_number = null;

$nameErr = "";
$emailErr = "";
$numberErr = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    // echo "<br>";
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    }
    // check if name only contains letters and whitespace
    else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr = "Only alphabets and white space are allowed";
    } else {
        $valid_name = $name;
    }

    //Email Validation
    $email = $_POST['email'];
    //echo "<br>";
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) {
        $emailErr = "Email Address must be in valid formate with @ symbol ";
    } else {
        $valid_email = $email;
    }

    //Number Validation
    $number = $_POST['number'];
    if (empty($_POST["number"])) {
        $numberErr = "Number is required";
    }
    // check if name only numbers
    else if (!preg_match("/^[0-9]{10}+$/", $number)) {
        $numberErr = "Mobile Number must be a number & 10 Digit Only";
    } else {
        $valid_number = $number;
    }



    if ($valid_name != "" && $valid_email != "" && $valid_number != "") {

        $sql = "UPDATE mca_student SET Name = '$valid_name', Email= '$valid_email', Number ='$valid_number' WHERE Stu_ID = '$id'";

        // if (mysqli_query($conn, $sql)) {
        //     echo "New record created successfully";
        // } else {
        //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // }
        if (mysqli_query($conn, $sql)) {
            header("Location: record.php", true, 301);
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
        // header("Location: record.php", true, 301);
    }

}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
</head>

<body>
    <!-- HTML Form -->
    <h2 style="color:blue">Login Form</h2>
    <form method="post" style="color:green">
        Name : <input type="text" name="name" id="name" placeholder="Enter Your Name"
            value="<?php echo $valid_name ?? $sname; ?>">
        <span class="error" id="nameErr" style="color:red">*
            <?php echo $nameErr; ?>
        </span><br><br>
        Email : <input type=" email" name="email" id="email" placeholder="abc45@gmail.com"
            value="<?php echo $valid_email ?? $semail; ?>">

        <span class="error" id="emailErr" style="color:red">*
            <?php echo $emailErr; ?>
        </span><br><br>
        Mobile No : <input type="number" name="number" id="number" value="<?php echo $valid_number ?? $snumber; ?>">
        <span class="error" id="numberErr" style="color:red">*
            <?php echo $numberErr; ?><br><br>
            <input type="submit" value="Submit" name="submit" id="submit" style="color:blue">
    </form>
</body>

</html>