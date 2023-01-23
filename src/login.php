<?php
    session_start();
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
   
    $error = "";

   function validateUser($user, $password) {
        if ($user === "test" && $password === "test") {
            return true;
        } else {
            return false;
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['username'];
        $password = $_POST['password'];

        if (validateUser($name, $password)) {
            $_SESSION['username'] = $name;
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid credentials";
        }
   }
?>

<html> 
   <h1>Login</h1>

    <form method='POST'>
        <input name='username' value='test'>
        <input name='password' value='test'>
        <br>
        <button>Login</button>
    </form> 
    <div class = "errors">
        <?php echo $error?>
    </div>
</html>