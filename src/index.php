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
    
      <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    </head>

    <i class="fa-solid fa-user"></i>
    <p id="username-line"><?php echo "username: " . $_SESSION['username']; ?></p>

    <br>
    <i class="fa-solid fa-right-from-bracket"></i>
    <a id="logout" href="logout.php">logout</a>

    <h1>Flashcard Depo</h1>

    <h2 id="create-card-label">Create Card</h2>
    <span class="invisible" onclick="<?php echo 'toggleCreateCard()'?>"
      id="hide-create-card">
      Hide
    </span>

    <span class="visible-inline" onclick="<?php echo 'toggleCreateCard()'?>"
      id="show-create-card">
      Show
    </span>


    <form class="invisible" id="create-card-form" method="post">
        <label class="card-create-label" for="flashcard-front">Front: </label>
        <textarea class="card-create-input card-create-textarea" name="flashcard-front" id="flashcard-front" type='text'></textarea>
        <br><br>

        <label class="card-create-label" for="flashcard-back">Back: </label>
        <textarea class="card-create-input card-create-textarea" name="flashcard-back" id="flashcard-back" type='text'></textarea>
        <br><br>

        <label class="card-create-label" for="flashcard-tags">Tags (cs): </label>
        <input autocomplete="off" class="card-create-input" name="flashcard-tags" id="flashcard-tags" type='text'></input>
        <span id="tag-example">
          (ex: php, php-8, laravel)
        </span>
        <br><br>

        <button id="create-card-button">Submit</button>
    </form> 
  <?php require('cardAction.php') ?>
</html>