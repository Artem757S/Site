<?php
include("../php/config.php");
session_start();

if (!isset($_SESSION['valid'])) {
    header("Location: third.php");
    exit();
}

if (isset($_GET['message_id'])) {
    $message_id = $_GET['message_id'];

    // Отримайте дані коментаря з бази даних
    $query = mysqli_query($con, "SELECT * FROM messages WHERE id=" . mysqli_real_escape_string($con, $message_id));
    $messageData = mysqli_fetch_assoc($query);

    if ($messageData) {
        $messageText = $messageData['message'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            // Оновіть коментар у базі даних
            $newMessageText = mysqli_real_escape_string($con, $_POST['new-message-field']);
            mysqli_query($con, "UPDATE messages SET message='$newMessageText' WHERE id=" . mysqli_real_escape_string($con, $message_id));

            // Поверніть користувача на головну сторінку після редагування
            header("Location: home.php");
            exit();
        }
    } else {
        echo "Comment not found.";
        exit();
    }
} else {
    echo "Message ID not provided.";
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Оновіть коментар у базі даних
    $newMessageText = mysqli_real_escape_string($con, $_POST['new-message-field']);
    $updateQuery = "UPDATE messages SET message='$newMessageText' WHERE id=" . mysqli_real_escape_string($con, $message_id);

    if (mysqli_query($con, $updateQuery)) {
        // Поверніть користувача на головну сторінку після редагування
        header("Location: home.php");
        exit();
    } else {
        echo "Error updating comment: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet"  href="../css/styles.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Edit Comment</title>
</head>
<body>
    <h2>Edit Comment</h2>
    <form action="verification.php?message_id=<?php echo $message_id; ?>" method="POST">
        <textarea name="new-message-field" rows="4" cols="50" required><?php echo $messageText; ?></textarea>
        <br>
        <input type="submit" name="submit" class="submit" value="Save Changes">
    </form>
    <br>
    <form action="comment_input.php" method="post"><button class="submit">Go back</button></form>
</body>
</html>















