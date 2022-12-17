<?php
    session_start();
    include_once("db_connect.php");
    include_once("php_functions.php");  
    
    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
    $b_fname = $_POST['fname'];
    $b_lname = $_POST['lname'];
    $bookName = $_POST['Bname'];
    $Rdate = $_POST['Rdate'];
    $Bdate = date("Y-m-d H:i:s");

    $b_fname = mysqli_real_escape_string($connect, $b_fname);
    $b_lname = mysqli_real_escape_string($connect, $b_lname);
    $bookName = mysqli_real_escape_string($connect, $bookName);
    $Rdate = mysqli_real_escape_string($connect, $Rdate);

    $insertQuery = "INSERT INTO borrowing_acts (b_first_name, b_last_name, book_title, date_borrowed, return_date) VALUES ('$b_fname', '$b_lname', '$bookName', '$Bdate', '$Rdate');";

    $result = mysqli_query($connect, $insertQuery);

    if ($result) {
        echo "<div class='Msg'><h3>Successfully Added!</h3></div>";
        header('refresh:2');
      } else {
        echo "<div class='Msg'><h3>Something went wrong</h3></div>" . mysqli_error($mysqli);
        header('refresh:2');
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashStyle.css">
</head>
<body>
    <div class="sidebar">
        <h3>Quick Links</h3>
        <br><hr><br>
        <a href="profile.php">My Profile</a><br><br>
        <a href="studList.php">Student List</a><br><br>
        <a href="">Violators List</a><br><br>
        <a href="current.php">Currently Borrowed</a>
    </div>
    <div id="header">
            <h2>Book Borrowing System!</h2>
    </div>
    <div class="mainScrn">
        
        <br><br>
        <h1 id="date"></h1><br>
        <h2>Today's Borrowers</h2>
        <div class="bBox">
            <?php
                $Bdata = "SELECT * FROM `borrowing_acts` WHERE DATE(date_borrowed) = CURDATE();";
                $tbResult = $connect->query($Bdata);

                echo "<div id='bDataTbl'><table cellspacing='20'>";
                echo "<tr>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Book Title</th>
               <th>Date/Time Borrowed</th>
               <th>Return Date</th>
               </tr>";

               while ($row = $tbResult->fetch_assoc()) {
                echo "<tr id=" . $row["id"].">";
                echo "<td>" . $row["b_first_name"] . "</td>";
                echo "<td>" . $row["b_last_name"] . "</td>";
                echo "<td>" . $row["book_title"] . "</td>";
                echo "<td>" . $row["date_borrowed"] . "</td>";
                echo "<td>" . $row["return_date"] . "</td>";
                echo "</tr>";
            }
            
            echo "</table></div>";
            $connect->close();
            ?>
        </div>
        <button id="addBtn">Add Entry</button>
        <div id="myPopUp" class="modal">
            <form class="modal-content" method="post">
                <span class="close" id="closeBtn">&times;</span>
                <h3>Enter Borrowing Information:</h3>
                
                <div class="labels"> 
                    <label for="borrowerFname">Borrower First Name:</label>
                    <label for="borrowerLname">Borrower Last Name:</label>
                    <label for="bookName">Book Title:</label>
                    <label for="returnDate">Return Date:</label>
                </div>
                <div class="inputs">
                    <input type="text" id="borrowerFname"  name="fname" required="">
                    <input type="text" id="borrowerLname"  name="lname" required="">
                    <input type="text" id="bookName"  name="Bname" required="">
                    <input type="text" id="returnDate"  name="Rdate" required="">
                </div>
                <button type="submit" id="submit">OK</button>
            </form>
        </div>
    </div>
    
    <script src="dash.js"></script>
</body>
</html>