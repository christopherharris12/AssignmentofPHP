<?php include 'connect.php'; 
if(!isset($_SESSION['username'])){
  header("Location: login.php");
  exit;
}
?>

<?php
// Fetch record to edit
if (!isset($_GET['Id'])) {
    header("Location: home.php");
    exit;
}

$id = $_GET['Id'];
$result = mysqli_query($conn, "SELECT * FROM christb WHERE Id=$id");
$student = mysqli_fetch_assoc($result);

if (!$student) {
    echo "<p style='color:red;'>Record not found!</p>";
    exit;
}

// Handle update
if (isset($_POST['update'])) {
    $name   = $_POST['Name'];
    $email  = $_POST['Email'];
    $gender = $_POST['Gender'];
    $course = $_POST['Course'];

    $update = "UPDATE christb SET 
                Name='$name', 
                Email='$email', 
                Gender='$gender', 
                Course='$course'
               WHERE Id=$id";

    mysqli_query($conn, $update);
    header("location: " .$_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Student</title>
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
</style>
</head>
<body>

<h2>Edit Student Info</h2>

<form method="POST">
    <label>Full Name:</label><br>
    <input type="text" name="Name" value="<?= $student['Name'] ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="Email" value="<?= $student['Email'] ?>" required><br><br>

    <label>Gender:</label><br>
    <select name="Gender" required>
        <option value="Male" <?= ($student['Gender']=='Male') ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= ($student['Gender']=='Female') ? 'selected' : '' ?>>Female</option>
    </select><br><br>

    <label>Course:</label><br>
    <input type="text" name="Course" value="<?= $student['Course'] ?>" required><br><br>

    <input type="submit" name="update" value="Update">
</form>

<br>
<a href="home.php">⬅ Back to list</a>
</body>
</html>