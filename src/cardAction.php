<?php 
    require("connection.php");
    require("./model/Card.php");

    $flashcardFront = "";
    $flashcardBack = "";
    $flashcardTags = "";

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

    function handleDelete($id) {
        echo "Handle delete not implemented yet!!";
    }

    function handleEdit($id) {
        echo "Handle edit not implemented yet!!";
    }

    function handleFavorite($id) {
        $allCards = $GLOBALS['allCards'];
        $card = null;
        foreach($allCards as $element) {
            if ($id == $element->getCardId()) {
                $card = $element;
                break;
            }
        }

        if (isset($card)) {
            $newInd = $card->getFavoriteInd() === 'Y' ? 'N' : 'Y';
            $favoriteUpdateSQL = "UPDATE mydatabase.cards SET favorite_ind='" . $newInd . 
                "' WHERE id=" . $id;
            $GLOBALS['conn']->query($favoriteUpdateSQL);
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // handle action item on specific card
        $favoriteUpdate = false;
        $editUpdate = false;
        $deleteUpdate = false;


        foreach($_POST as $key=>$value) {
            if (str_contains($key, 'favorite-input')) {
                if (isset($key[$value])) {
                    $favoriteUpdate = true;
                    handleFavorite($value);
                    return;
                }
            }
            else if (str_contains($key, 'edit-input')) {
                if (isset($key[$value])) {
                    $favoriteUpdate = true;
                    handleEdit($value);
                    return;
                }
            }
            else if (str_contains($key, 'delete-input')) {
                if (isset($key[$value])) {
                    $favoriteUpdate = true;
                    handleDelete($value);
                    return;
                }
            }
        }


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
    <h2>All Cards</h2>
    <?php foreach($allCards as $card): ?>
        <div class="card"
            id="<?php echo $card->getCardId()?>">
                <form method=post class="card-icons" id="<?php echo 'card-icons-' . $card->getCardId() ?>"> 
                    <? if ($card->getFavoriteInd() === 'Y'): ?>
                        <input name="<?php echo 'favorite-input-' . $card->getCardId() ?>"
                            id="<?php echo 'favorite-input-' . $card->getCardId() ?>" hidden>
                        <i class="fa-solid favorite-card-icon fa-star"
                            onclick="<?php echo 'submitFavorite(' . $card->getCardId() . ')'?>"> </i>
                    <? else: ?>
                        <input name="<?php echo 'favorite-input-' . $card->getCardId() ?>"
                            id="<?php echo 'favorite-input-' . $card->getCardId() ?>" hidden>
                        <i class="card-icon fa-regular fa-star" 
                            onclick="<?php echo 'submitFavorite(' . $card->getCardId() . ')'?>"> </i>
                    <? endif; ?>

                    <input name="<?php echo 'edit-input-' . $card->getCardId() ?>"
                        id="<?php echo 'edit-input-' . $card->getCardId() ?>" hidden>
                    <i class="card-icon fa-solid fa-pen-to-square"
                        onclick="<?php echo 'submitEdit(' . $card->getCardId() . ')'?>"> </i>

                    <input name="<?php echo 'delete-input-' . $card->getCardId() ?>"
                        id="<?php echo 'delete-input-' . $card->getCardId() ?>"hidden>
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
