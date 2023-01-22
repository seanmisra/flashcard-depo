<?php 
    $flashcardFront = "";
    $flashcardBack = "";
    $flashcardTags = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $flashcardFront = $_POST["flashcard-front"];
        $flashcardBack = $_POST["flashcard-back"];
        $flashcardTags = $_POST["flashcard-tags"];
    }
?>

<div>
    <h2>Submitted Values</h2>
    <p>Flashcard Front: <?php echo $flashcardFront?> </p>
    <p>Flashcard Back: <?php echo $flashcardBack?> </p>
    <p>Flashcard Tags: <?php echo $flashcardTags?> </p>
</div>