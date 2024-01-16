<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorial";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment_id"])) {
    $comment_id = mysqli_real_escape_string($conn, $_POST["comment_id"]);
    $edited_message = mysqli_real_escape_string($conn, $_POST["edited_message"]);

    $sql_update = "UPDATE messages SET message='$edited_message' WHERE id=$comment_id";
    $result_update = $conn->query($sql_update);

    if ($result_update) {
        echo "Comment edited successfully";
    } else {
        echo "Error editing comment: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>



