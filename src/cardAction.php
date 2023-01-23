<?php 
    require("connection.php");
    require("./model/Card.php");

    $flashcardFront = "";
    $flashcardBack = "";
    $flashcardTags = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // handle action item on specific card
        $actionItem = $_POST["flashcard-front"];




        // handle insert of new card
        $flashcardFront = $_POST["flashcard-front"];
        $flashcardBack = $_POST["flashcard-back"];
        $flashcardTags = $_POST["flashcard-tags"];
        $flashcardUser = $_SESSION["username"];
        $is_private = 'Y';

        #echo "INSERT INTO mydatabase.cards (front_desc, back_desc, tags, is_private) VALUES ('test-front', 'test-back', 'test-tag', 'Y')";
        #echo "<br>";
        $insertSQL = "INSERT INTO mydatabase.cards (front_desc, back_desc, tags, is_private, user, favorite_ind) VALUES ('"
            . $flashcardFront .
            "', '" . $flashcardBack .
            "', '" . $flashcardTags .
            "', '" . $is_private .
            "', '" . $flashcardUser . 
            "', 'N')";
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
            $cardId = $row['id'];
            $cardFront = $row['front_desc'];
            $cardBack = $row['back_desc'];
            $tags = $row['tags'];
            $favoriteInd = $row['favorite_ind'];
            $thisCard = new Card($cardId, $cardFront, $cardBack, $tags, $favoriteInd);
            $allCards[] = $thisCard;
        }
        // print_r($allCards);

        function clickStar(int $id) {
            echo "I got to click star";
        }
    ?>

    <h2>All Cards</h2>
    <?php foreach($allCards as $card): ?>
        <div class="card"
            id="<?php echo $card->getCardId()?>">
                <form class="card-icons" id="<?php echo 'card-icons-' . $card->getCardId() ?>"> 
                    <input id="<?php echo 'favorite-input-' . $card->getCardId() ?>" hidden>
                    <i class="card-icon fa-regular fa-star" 
                        onclick="<?php echo 'submitFavorite(' . $card->getCardId() . ')'?>"> </i>

                    <input id="<?php echo 'edit-input-' . $card->getCardId() ?>"hidden>
                    <i class="card-icon fa-solid fa-pen-to-square"
                        onclick="<?php echo 'submitEdit(' . $card->getCardId() . ')'?>"> </i>

                    <input id="<?php echo 'delete-input-' . $card->getCardId() ?>"hidden>
                    <i class="card-icon fa-solid fa-trash"
                        onclick="<?php echo 'submitDelete(' . $card->getCardId() . ')'?>"> </i>

                </form>
                <div class="card-content"
                onclick="<?php echo 'clickCard(' . $card->getCardId() . ')'?>"
                >
                    <p class="card-front show-side"><?php echo $card->getCardFront()?> </p>
                    <p class="card-back hide-side"><?php echo $card->getCardBack()?> </p>
                    <div class="tags"><?php echo $card->getFormattedTags()?> </div>
                </div>
        </div>
    <?php endforeach; ?>
</div>
