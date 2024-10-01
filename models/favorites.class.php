<?php
/**
 * Author: Jeremy Black
 * Date: {4/22/2024}
 * File: {favorites.class.php}
 * Description: Defines the Favorites class that retreieves Pokemon objects to store them into
 * an array
 */

class Favorites {
    private $items = []; //sets an empty array for the favorited Pokemon to go into



    public function addItem(Pokemon $pokemon) { //adds a pokemon into the items array
        $pokemonID = $pokemon->getPokemonID();

        if (!isset($this->items[$pokemonID])) {
            $this->items[$pokemonID] = $pokemon;
        }
    }

    public function removeItem($pokemonID) { //removes a pokemon into the items array
        if (isset($this->items[$pokemonID])) {
            unset($this->items[$pokemonID]);
        }
    }

    public function getItems() {
        return $this->items;
    }

}