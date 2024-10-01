<?php
/**
 * Author: Nathan Ensley
 * Date: {4/4/2024}
 * File: {pokemon_controller.class.php}
 * Description:
 */

class PokemonController extends IndexController{
    Private PokemonModel $pokemon_model;

    public function __construct() {
        //create an object of the PokemonModel class
        $this->pokemon_model = new PokemonModel();
    }

    //method that retrieves all pokemon
    public function retrieveAllPokemon() {
        //gets all Pokemon from the database from the model
        //returns Pokemon as objects
        $allPokemon = $this->pokemon_model->getPokemon();

        $view = new PokemonView();
        //pass all Pokemon objects through to the display page
        $view->display($allPokemon);
    }

    public function retrievePokemon() {
        //

    }

    public function pokemon(): void {
        $view = new PokemonView();
        $view->display();
    }

    //function for when a user adds a pokemon to the list
    //public function addtolist() {
        //create an object from the addtolist class
        //new addtolist();
        //addtolist->display();
    //}
}