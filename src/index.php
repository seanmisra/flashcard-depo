<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>

<html>
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
</html>
<?php require('cardAction.php') ?>
