<?php
    session_start();
    include_once("db_connect.php");

   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="dashStyle.css">
</head>
<body>
    <div class="sidebar">
            <h3>Quick Links</h3>
            <br><hr><br>
            <a href="dashboard.php">Dashboard</a><br><br>
            <a href="profile.php">My Profile</a><br><br>
            <a href="">Violators List</a><br><br>
            <a href="current.php">Currently Borrowed</a>
        </div>
    <div id="header">
            <h2>Book Borrowing System!</h2>
    </div>
    <div class="whole">
    <h1>Registered Students</h1>
    <?php
         $tbData = "SELECT * FROM student_users";
         $result = $connect->query($tbData);
     
         echo "<div id='dataTbl'><table cellspacing='20'>";
         echo "<tr>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Course</th>
               <th>Year</th>
               <th>Section</th>
               <th>Department</th>
               </tr>";
     
         while ($row = $result->fetch_assoc()) {
             echo "<tr>";
             echo "<td>" . $row["first_name"] . "</td>";
             echo "<td>" . $row["last_name"] . "</td>";
             echo "<td>" . $row["course"] . "</td>";
             echo "<td>" . $row["year"] . "</td>";
             echo "<td>" . $row["section"] . "</td>";
             echo "<td>" . $row["department"] . "</td>";
             echo "</tr>";
         }
         
         echo "</table></div>";
         $connect->close();

    ?>
    </div>
</body>
</html>