<?php

session_start();
include "connect.php";  

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$username = $_POST['username'];
$password = $_POST['password'];
$comfirm = $_POST['comfirm_pass'];

    if($password !== $comfirm){
        echo "Passwords do not match! <a href='signup.php'>Try again</a>";
        exit();
    }
$check = mysqli_query($conn, "SELECT * FROM christb1 WHERE username = '$username'");

if(!$check){
     die("Query failed: " . mysqli_error($conn));   
}
if(mysqli_num_rows($check) > 0){
    echo "User already taken!!";
    exit;
}
$sql = "insert into christb1 (username, password) values ('$username','$password')";
if(mysqli_query($conn, $sql)){
    echo "SignUp successful! <a href='login.php'>Login now</a>";
}
else {
    echo "Error: " . mysqli_error($conn);
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
        <style>

    h2 {
      color: #333;
      margin: auto;
      margin-left: 40%;
      margin-bottom: 10px;
    }

    form {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 6px;
      padding: 15px;
      width: 400px;
      margin-bottom: px;
      margin: auto;
      margin-top: 15%;
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    input, select {
      width: 90%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      background-color: #ac7318ff;
      color: white;
      border: none;
      margin-top: 10px;
      cursor: pointer;
      width: 30%;
      margin-left:30%;
    }

    input[type="submit"]:hover {
      background-color: #ac7318ff;
    }
    a {
      text-decoration: none;
      color: #ac7318ff;
      margin-right: 10px;
      font-size: 20px;
    }
    </style>
</head>
<body>
    <form action="" method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Comfirm: <input type="password" name="comfirm_pass"><br>
        <input type="submit" name="SignUp" value="SignUp">
    </form>
</body>
</html>