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
        $flashcardUser = $_SESSION["username"];
        $is_private = 'Y';

        #echo "INSERT INTO mydatabase.cards (front_desc, back_desc, tags, is_private) VALUES ('test-front', 'test-back', 'test-tag', 'Y')";
        #echo "<br>";
        $insertSQL = "INSERT INTO mydatabase.cards (front_desc, back_desc, tags, is_private, user) VALUES ('"
            . $flashcardFront . "', '" . $flashcardBack . "', '" . $flashcardTags . "', '" . $is_private . "', '" . $flashcardUser . "')";
        #echo $sql;

        try {
            $conn->query($insertSQL);
        } catch (PDOException $e) {
            echo "<br>";
            die($e->getMessage());
        }
        echo "New record successfully created";
    }

?>

<div>
    <?php
        $readQuery = "SELECT * FROM mydatabase.cards where user='" . $_SESSION["username"] . "'";
        $result = null;
        $allCards = [];
        try {
            $result = $conn->query($readQuery);
        } catch (PDOException $e) {
            echo "<br>";
            die($e->getMessage()); 
        }

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $allCards[] = $row;
        }
        // print_r($allCards);
    ?>

    <h2>All Cards</h2>
    <?php foreach($allCards as $card): ?>
        <h3> <?php echo $card['id']?> </h3>
        <p>Flashcard Front: <?php echo $card['front_desc']?> </p>
        <p>Flashcard Front: <?php echo $card['back_desc']?> </p>
        <p>Flashcard Front: <?php echo $card['tags']?> </p>
        <br><br>

    <?php endforeach; ?>
</div>