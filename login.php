<?php
// Connect to the MySQL database
$db = new mysqli("localhost", "root", "", "mentor_mentee");

// Check if the user is logged in
if (isset($_SESSION["username"])) {
    // The user is logged in, redirect them to the home page
    header("Location: index.php");
    exit;
}


session_start();

// Check if the login form has been submitted
if (isset($_POST["username"], $_POST["password"])) {
    // Get the username and password from the form
    $loginid = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username and password are valid
    $sql = "SELECT * FROM users WHERE username='$loginid' AND password='$password'";
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // The username and password are valid, store them in the session
        $_SESSION["username"] = $loginid;
        $_SESSION["password"] = $password;

        // Redirect the user to the next page
        header("Location: next_page.php");
        exit;
    } else {
        // The username and password are not valid, display an error message
        echo "Invalid username or password.";
    }
}
?>