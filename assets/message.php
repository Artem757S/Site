 <?php 
$message = $_POST['message-field']; 

var_dump($message);

$host = "localhost";
$dbname = "tutorial";
$username= "root";
$password="";

$conn = mysqli_connect  ($host, $username, $password, $dbname); 

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}
echo "Соединение успешно." . "<br>";

$sql = "INSERT INTO messages (MESSAGE)
        VALUES (?)";

        $stmt = mysqli_stmt_init($conn);

        if (! mysqli_stmt_prepare($stmt , $sql)) {
          die(mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, "s", $message);
mysqli_stmt_execute($stmt);


function validateInput($userInput, $pattern, $error) {
    if (preg_match($pattern, $userInput)) {
        echo $error . "<br>";
    } else {
        echo "NICE." . "<br>";
    }
}
$userInputMessage = $_POST['message-field'];
$numbersPattern = '/\d/';
$prohibitedPattern = '/[#$%^&*()\[\]{}|~<>\\\\]/';
validateInput($userInputMessage, $numbersPattern, "Ошибка: числа не допускаются во входных данных.");
validateInput($userInputMessage, $prohibitedPattern, "Ошибка: во входных данных нельзя использовать запрещенные символы.");

$allowedCharactersPattern = '/[@?!"+=:$\-\. ]/';
validateInput($userInputMessage, $allowedCharactersPattern, "Error.");


header("Location: comment_input.php");
exit();
?>


