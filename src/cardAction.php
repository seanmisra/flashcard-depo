<?php 
    require("connection.php");
    require("./model/Card.php");

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    $flashcardFront = "";
    $flashcardBack = "";
    $flashcardTags = "";
    $existingSearchTerm = "";

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

        // sort by reverse creation date (i.e. id)
        usort($GLOBALS['allCards'], function($a, $b) { 
            return $b->getCardId() <=> $a->getCardId();
        });
    }

    getAllCards();

    function filterCards() {
        if (isset($_GET['card-search']) && !empty($_GET['card-search'])) {  
            $searchTerm = $GLOBALS['existingSearchTerm'] = $_GET['card-search'];
            if ($searchTerm) {
                $filteredCards = [];
    
                foreach($GLOBALS['allCards'] as $card) {
                    foreach($card->getTagList() as $tag) {
                        if (str_contains(strtolower($tag), strtolower($searchTerm))) {
                            array_push($filteredCards, $card);
                            break 1; 
                        }
                    }
                }
                $GLOBALS['allCards'] = $filteredCards;
            } else {
                getAllCards();
            }
        }
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
            $starredWord = $newInd === 'Y' ? 'starred' : 'unstarred';

            $favoriteUpdateSQL = "UPDATE mydatabase.cards SET favorite_ind='" . $newInd . 
                "' WHERE id=" . $id;
            $GLOBALS['conn']->query($favoriteUpdateSQL);


            echo '<script type="text/javascript">toastr.success("Card is ' . $starredWord . '")</script>';
        }

        filterCards();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // handle action item on specific card
        $favoriteUpdate = false;
        $editUpdate = false;
        $deleteUpdate = false;

        foreach($_POST as $key=>$value) {
            if (str_contains($key, 'favorite-input')) {
                if (isset($value) && !empty($value)) {
                    $favoriteUpdate = true;
                    handleFavorite($value);
                }
            }
            else if (str_contains($key, 'edit-input')) {
                if (isset($value) && !empty($value)) {
                    $favoriteUpdate = true;
                    handleEdit($value);
                }
            }
            else if (str_contains($key, 'delete-input')) {
                if (isset($value) && !empty($value)) {
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


            echo '<script type="text/javascript">toastr.success("New record successfully created")</script>';
        }
        getAllCards();
    }
    require('cardContainer.php');
?>