<?php 
   session_start();

   include("../php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: third.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Message Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet"  href="../css/styles.css" type="text/css">
    <title>Home</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">EMINƎM</a>
            </div>
        </nav>
   <div class="right-links">

 <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_Age = $result['Age'];
                $res_id = $result['Id'];
            }
            
            echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
            ?>

    <a href="../php/logout.php"> <button class="btn">Log Out</button> </a>
</div>
</div>
<main>
    <div class="main-box top">
        <div class="top">
            <div class="box">
                <p> Hello <b><?php echo $res_Uname ?></b>,Welcome</p>
                <div class="box">
                <p> Your email is <b><?php echo $res_Email ?></b>.</p>
                <div class="bottom">
                <div class="box">
                <p> And you are <b><?php echo $res_Age ?> years old</b>.</p>
                      </div>
          </div>
       </div>
    </main>
<br><br>
    <form action="message.php" method="POST">  

<div class="field input">
                    <textarea type="text" name="message-field" id="message-field" ows="4" cols="50" placeholder="Type your message..."  required></textarea>
                </div>
<div class="field">
                    <input type="submit"  class="submit"  name="submit" value="Ok" required>
                </div>
                </form>
    <script>
    const messageField = document.getElementById('message');
    const backgroundText = document.getElementById('background-text');

    messageField.addEventListener('focus', () => {
      backgroundText.style.opacity = '0';
    });

    messageField.addEventListener('blur', () => {
      if (messageField.value === '') {
        backgroundText.style.opacity = '1';
      }
    });
  </script>
    </body>
</html>