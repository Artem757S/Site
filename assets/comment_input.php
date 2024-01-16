<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorial";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_users = "SELECT * FROM users ORDER BY timestamp_column DESC";
$result_users = $conn->query($sql_users);

$sql_messages = "SELECT * FROM messages ORDER BY timestamp_column DESC";
$result_messages = $conn->query($sql_messages);

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
<main>
    <div class="comment_input">
        <div class="comment">
            <table border="1">
                <?php
                $firstComment = true;
                while ($row_users = $result_users->fetch_assoc()) {
                    $row_messages = $result_messages->fetch_assoc();
                    ?>

                    <tr>
                        <td>
                            <div class="left-column">
                                <ul>
                                    <li><?php echo $row_users["timestamp_column"]; ?></li>
                                    <li><?php echo $row_users["Username"]; ?></li>
                                    <li><?php echo $row_users["Age"]; ?> years old</li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="right-column">
                                <p><?php echo $row_messages["message"]; ?></p>
                                <?php
                                if ($firstComment) {
                                    echo "<a href='verification.php?message_id=" . $row_messages["id"] . "' >Edit Comment</a>";
                                    $firstComment = false;
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="distance" colspan="2"><hr></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</main>

<?php
$conn->close();
?>
<form action="home.php" method="post"><button class="submit">Go back</button></form>
</body>
</html>

