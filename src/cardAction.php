<?php 
    $flashcardFront = "";
    $flashcardBack = "";
    $flashcardTags = "";

    $user = 'root';
    $pass = 'root';
    $dbhost = 'mysql';
    $database = 'mydatabase';

    $conn = new PDO("mysql:host=$dbhost;database=$database", $user, $pass);     

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $flashcardFront = $_POST["flashcard-front"];
        $flashcardBack = $_POST["flashcard-back"];
        $flashcardTags = $_POST["flashcard-tags"];
        $is_private = 'Y';



        #echo "INSERT INTO mydatabase.cards (front_desc, back_desc, tags, is_private) VALUES ('test-front', 'test-back', 'test-tag', 'Y')";
        #echo "<br>";
        $sql = "INSERT INTO mydatabase.cards (front_desc, back_desc, tags, is_private) VALUES ('"
            . $flashcardFront . "', '" . $flashcardBack . "', '" . $flashcardTags . "', '" . $is_private . "')";
        #echo $sql;

        try {
            $conn->query($sql);
        } catch (PDOException $e) {
            echo "<br>";
            die($e->getMessage());
        }
        echo "New record successfully created";
    }

?>

<div>
    <h2>Submitted Values</h2>
    <p>Flashcard Front: <?php echo $flashcardFront?> </p>
    <p>Flashcard Back: <?php echo $flashcardBack?> </p>
    <p>Flashcard Tags: <?php echo $flashcardTags?> </p>
</div>