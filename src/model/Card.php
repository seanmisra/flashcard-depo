<?php 
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

class Card {
    # this only works because the access modifiers are private, the variables are then implied 
    private $tagList = [];

    public function __construct(private string $cardFront, private string $cardBack, private string $tags) {
        $this->tagList = explode(",", $tags);
    }

    public function getCardFront(): string {
        return $this->cardFront;
    }

    public function getCardBack(): string {
        return $this->cardBack;
    }

    public function getTags(): string {
        return $this->tags;
    }

}