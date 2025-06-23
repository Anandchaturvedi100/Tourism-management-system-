<?php

$con = mysqli_connect('localhost:3306', 'root', '', 'travel');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$firstname = $_POST['fname'];
$password = $_POST['password'];
$email = $_POST['email'];
$city = $_POST['city'];
$phone = $_POST['phone'];

// First check if the username already exists
$checkQuery = "SELECT * FROM `customer` WHERE fname = '$firstname'";
$checkResult = mysqli_query($con, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    echo "<script>
            alert('Username already taken. Please choose another name.');
            window.location.href = 'registration.html';
          </script>";
    exit;
}

// If username is not taken, insert data
$sql = "INSERT INTO `customer`(`fname`, `password`, `email`, `city`, `phone`) 
        VALUES ('$firstname', '$password', '$email', '$city', '$phone')";

$result = mysqli_query($con, $sql);

if ($result) {
    if ($firstname == "admin" && $password == "ad123") {
        header("Location: admin.php");
    } else {
        header("Location: mainPage.html");
    }
    exit;
} else {
    echo "Error: " . mysqli_error($con);
}
?>
