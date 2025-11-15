<?php

session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
      margin-left:10%;
    }
     input[type="button"] {
      background-color: #ac7318ff;
      color: white;
      border: none;
      margin-top: 10px;
      cursor: pointer;
      width: 30%;
      margin-left:10%;
    }
    input[type="submit"]:hover {
      background-color: #ac7318ff;
    }
    </style>
</head>
<body>
    <form action="" method="post">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" name="Login" value="Login">
        <a href="signup.php"><input type="button" name="SignUp" value="SignUp"></a>
    </form>
</body>
</html>
<?php

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM christb1 where username ='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $row['id'];
                header("Location: home.php");
                exit;
    }
    else{
        echo "Invalid login!!!!";
    }
}

?>