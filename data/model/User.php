<?php 
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

class User {
    # this only works because the access modifiers are private, the variables are then implied 
    private $cardStack = [];

    public function __construct() {}

    public function addCard(Card $card) {
        array_push($this->cardStack, $card);
    }

    public function getCards(): array {
        return $this->cardStack;
    }
}