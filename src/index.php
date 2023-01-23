<?php
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

  if (!isset($_SESSION['username'])) {
    Header("location: login.php");
  }
?>

<html>
    <head>
      <link rel='stylesheet' href='style/style.css'>
      <script src='script/cardScript.js'></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <p><?php echo "WELCOME: " . $_SESSION['username']; ?></p>
    <a href="logout.php">Logout</a>

    <h1>Flashcard Depo</h1>

    <h2>Create Card</h2>

    <form method="post">
        <label for="flashcard-front">Front: </label>
        <textarea name="flashcard-front" id="flashcard-front" type='text'></textarea>
        <br><br>

        <label for="flashcard-back">Back: </label>
        <textarea name="flashcard-back" id="flashcard-back" type='text'></textarea>
        <br><br>

        <label for="flashcard-tags">Tags (comma-seperated): </label>
        <input name="flashcard-tags" id="flashcard-tags" type='text'></input>
        <br><br>

        <button>Submit</button>
    </form> 
  <?php require('cardAction.php') ?>
</html>