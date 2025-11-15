<?php
session_start();
include "connect.php";

if(!isset($_SESSION['username'])){
  header("Location: login.php");
  exit;
}

echo "Welcome, " . $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
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

    table {
      width: 60%;
      border-collapse: collapse;
      background-color: #fff;
      margin-top: 20px;
      margin: auto;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #ac7318ff;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    a {
      text-decoration: none;
      color: #ac7318ff;
      margin-right: 10px;

    }

    a:hover {
      text-decoration: underline;
    }
    .log{
        margin-left: 90%;
        margin-top:; 
    }
    </style>
</head>
<body>
    <p><a href="logout.phP" class = "log">LOGOUT</a></p>
    <h2>Student Management</h2>
    <form action="" method="post">
        <input type="hidden" name ="Id" required><br>
        <label for="Fullname">Full Name:</label><br>
        <input type="text" name="Name" id="" required><br>
        <label for="Email">Email:</label><br>
        <input type="text" name="Email" id="" required><br>
        <label for="Gender">Gender:</label><br>
        <select name="Gender" id="" required>
            <option value="">--Select--</option>
            <option value="Male" >Male</option>
            <option value="Male" >Female</option>
        </select><br>
        <label for="Course">Course:</label><br>
        <input type="text" name="Course" id="" required><br>
        <input type="submit" name="Save" value = "Save">
    </form>
    
</body>
</html>

<?php
//insert the record 
if (isset($_POST['Save'])){
    $id = $_POST['Id'];
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $gender = $_POST['Gender'];
    $course = $_POST['Course'];

    $insert = "insert into christb (Id, Name, Email, Gender, Course) values ('$id', '$name', '$email', '$gender', '$course')";
    $result = mysqli_query($conn, $insert);

    // if($result){
    //     echo "Record inserted";
    // }else{
    //     echo "Error to inserting record".mysqli_error($conn);
    // }
}
// The table where our record displayed
$fetch = "SELECT * FROM christb";
$data = mysqli_query($conn, $fetch);

if(mysqli_num_rows($data) > 0){
    echo "<table>
        <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Course</th>
        <th>Actions</th>
    </tr>";

    while($row = mysqli_fetch_assoc($data)) {
        echo "
        <tr>
        <td> ".$row['Id']. "</td>
            <td> ".$row['Name']. "</td>
            <td> ".$row['Email']. "</td>
            <td> ".$row['Gender']. "</td>
            <td> ".$row['Course']. "</td>
            <td>
                <a href='update.php?Id={$row['Id'] }'>Edit</a>
                <a href='?delete={$row['Id']}' onclick='return confirm(\"Are you sure you want to delete?\");'>Delete</a>
            </td>
        </tr>";
        
    }
    echo "</table>";

    // else{
    //     // echo "<p> No records found! </p>";
    // }
    
}



// -----------Delete record stored in database----------

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = "DELETE FROM christb WHERE Id = $id";
    mysqli_query($conn, $delete);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

?>
