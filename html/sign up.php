<?php
include 'db.php';


$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];


if ($password !== $confirm) {
    echo "Passwords do not match";
    exit();
}

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$check = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "Email already exists";
    exit();
}else{

$sql = "INSERT INTO users (full_name, email, phone, password_hash, created_at)
        VALUES ('$full_name', '$email', '$phone', '$password_hash', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
}
?>