<?php
    session_start();
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    require("connection.php");
   
    $error = "";

   function validateUser($user, $password) {
        #TODO: INSECURE, revise with encryption
        $userReadQuery = "SELECT password FROM mydatabase.users WHERE username='" . $user . "'";
        $existingUser = 1;
        try {
            $result = $GLOBALS['conn']->query($userReadQuery);
            $resultArray = $result->fetch(PDO::FETCH_ASSOC);
            $dbPassword = reset($resultArray);
            
            return $password === $dbPassword;
        } catch (PDOException $e) {
            echo "<br>";
            die($e->getMessage());
        }


        if ($user === "test" && $password === "test") {
            return true;
        } else {
            return false;
        }
    }

    function createUser($user, $password) {
        #TODO: ideally should be one query/proc 

        $userExistsQuery = "SELECT EXISTS(SELECT * FROM mydatabase.users WHERE username='" . $user . "')";
        $existingUser = 1;
        try {
            $result = $GLOBALS['conn']->query($userExistsQuery);
            $resultArray = $result->fetch(PDO::FETCH_ASSOC);
            $existingUser = reset($resultArray); // 1 or 0
        } catch (PDOException $e) {
            echo "<br>";
            die($e->getMessage());
        }

        if ($existingUser === 0) {
            $userInsertQuery = "INSERT INTO mydatabase.users (username, password) VALUES ('" . $user . "', '" . $password . "')";
            
            try {
                $result = $GLOBALS['conn']->query($userInsertQuery);
            } catch (PDOException $e) {
                echo "<br>";
                die($e->getMessage());
            }
            echo "User successfully created, can now login";
        } else {
            $GLOBALS['error'] = "Username already exists";
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['username'];
        $password = $_POST['password'];
        $signUp = isset($_POST['sign-up']);

        if ($signUp) {
            createUser($name, $password);
        } else {
            if (validateUser($name, $password)) {
                $_SESSION['username'] = $name;
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid credentials";
            }
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
    <div class = "errors" style="color:red">
        <?php echo $error?>
    </div>

    <h3>OR...</h3>

    <h1>Sign Up</h1>

    <form method='POST'>
        <input name='username' value=''>
        <input name='password' value=''>
        <input hidden name='sign-up' value='true'>
        <br>
        <button>Login</button>
    </form> 

</html>