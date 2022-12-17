<?php
    session_start();
    include_once("db_connect.php");
    if (isset($_POST['submit'])) {
        // Get the value of the checkbox
        $checkbox = isset($_POST['returned']) ? 1 : 0;
    
        // Update the boolean column in the MySQL table
        $sqlUpdate = "UPDATE borrowing_acts SET returned = $checkbox";
        mysqli_query($connect, $sqlUpdate);
    }
    
    // Get the current value of the boolean column from the MySQL table
    $sqlSelect = "SELECT returned FROM borrowing_acts";
    $result = mysqli_query($connect, $sqlSelect);
    $row = mysqli_fetch_assoc($result);
    $returned = $row['returned'];
    
    ?>
   


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currently Borrowed</title>
    <link rel="stylesheet" href="dashStyle.css">
</head>
<body>
<div class="sidebar">
        <h3>Quick Links</h3>
        <br><hr><br>
        <a href="dashboard.php">Dashboard</a><br><br>
        <a href="profile.php">My Profile</a><br><br>
        <a href="studList.php">Student List</a><br><br>
        <a href="">Violators List</a>
        
    </div>
    <div id="header">
            <h2>Book Borrowing System!</h2>
    </div>
    <div class="whole">
    <h1>Currently Borrowed Books</h1>
    <?php
         $tbData = "SELECT * FROM borrowing_acts  WHERE returned = 0;";
         $result = $connect->query($tbData);
     
         echo "<div id='dataTbl'><table cellspacing='20'>";
         echo "<tr>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Book Title</th>
               <th>Date Borrowed</th>
               <th>Return Date</th>
               <th>Returned</th>
               </tr>";
     
         while ($row = $result->fetch_assoc()) {
             echo "<tr id=" . $row["id"].">";
             echo "<td>" . $row["b_first_name"] . "</td>";
             echo "<td>" . $row["b_last_name"] . "</td>";
             echo "<td>" . $row["book_title"] . "</td>";
             echo "<td>" . $row["date_borrowed"] . "</td>";
             echo "<td>" . $row["return_date"] . "</td>";
             echo "<td><form method='post'>
             <input type='checkbox' name='returned' value='1' <?php if ($returned == 1) { echo 'checked'; } ?>>
             <input type='submit' name='submit' value='Submit'>
             </form></td>";
             echo "</tr>";
         }
         
         echo "</table></div>";
         $connect->close();

    ?>
    </div>
</body>
</html>