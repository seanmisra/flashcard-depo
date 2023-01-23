<?php 
    require("connection.php");
    require("./model/Card.php");

    $flashcardFront = "";
    $flashcardBack = "";
    $flashcardTags = "";

    $readQuery = "SELECT * FROM mydatabase.cards where user='" . $_SESSION["username"] . "'";
    $result = null;
    $allCards = [];

    function getAllCards() {
        $GLOBALS['allCards'] = [];
        try {
            $result = $GLOBALS['conn']->query($GLOBALS['readQuery']);
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
            $GLOBALS['allCards'][] = $thisCard;
        }
    }

    getAllCards();

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
                }
            }
            else if (str_contains($key, 'edit-input')) {
                if (isset($key[$value])) {
                    $favoriteUpdate = true;
                    handleEdit($value);
                }
            }
            else if (str_contains($key, 'delete-input')) {
                if (isset($key[$value])) {
                    $favoriteUpdate = true;
                    handleDelete($value);
                }
            }
        }


        if ($favoriteUpdate === false && $editUpdate === false && $deleteUpdate === false) {
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
        getAllCards();
    }
    require('cardContainer.php');
?>