<?php
/**
 * Author: Nathan Ensley, Jeremy B (cart functionality)
 * Date: 4/4/2024
 * File: {pokemon_controller.class.php}
 * Description: creates a Pokemon controller that handles communication with the pokemon database and views
 */

//TO DO: set cookies for Verify Password

//creates a Pokemon controller that handles communication with the pokemon database and views
class PokemonController
{
    //private attribute for the pokemon model
    private PokemonModel $pokemon_model; //check this

    //constructor for the Pokemon Controller
    public function __construct()
    {
        //create an object of the Pokemon Controller class
        $this->pokemon_model = new PokemonModel();
    }

    //
    public function index()
    {
        $this->retrieveAllPokemon();
    }

    //method that retrieves all pokemon
    public function retrieveAllPokemon()
    {
        try {
            //gets all Pokemon from the database from the model
            //returns Pokemon as objects
            $allPokemon = $this->pokemon_model->getPokemon();
            $view = new PokemonView();
            //pass all Pokemon objects through to the display page
            $view->display($allPokemon);
        } catch (exception $e) {
            $view = new PokemonError;
            $view->display("Pokemon Not Found, Please Try Again.");
        }
    }

    //view function to view the Pokemon Page using the View
    public function pokemon()
    {
        $view = new PokemonView();
        $view->display();
    }

    // Show the details of a Pokemon - Jeremy B
    public function details($id): void
    {
        // Retrieve the specific pokemon from the model
        $details = $this->pokemon_model->view_pokemon($id);
        //display movie details
        $view = new PokemonDetail();
        $view->display($details);
    }

    // displays all pokemon of which the search terms are applicable
    // runs when the search button is pressed in the pokemon view
    public function search()
    {
        //runs the search unless an exception is found
        try {
            //grab the user input from the search box
            //check if the search term is passed in the URL
            if (isset($_GET["query_terms"])) {
                //retrieves the user input from the query
                $userInput = $_GET["query_terms"];
                //change the user input into html special characters
                $terms = htmlspecialchars($userInput);

                //passes the cleaned terms into the search pokemon method in the model
                $results = $this->pokemon_model->search_pokemon($terms);

                //if results are found from the database, display those results on the Pokemon Details Page
                if ($results) {
                    //create a new Pokemon Details View
                    $view = new PokemonView();
                    //display the details of any Pokemon applicable to the user search
                    $view->display($results);
                }
                //if no results are found in the database, then throw an exception
                //passes the error message which contains the search query
                else {
                    throw new NoResultsFoundException("No Results Found for " . "'" . $terms . "'");
                }
            //if no query terms, throw a missing data exception
            } else {
                throw new missingDataException("Input Not Found");
            }
        } catch (NoResultsFoundException $e) {
            //retrieves the error message from above
            $message = $e->getMessage();
            //displays the error on to the error page
            $view = new PokemonError();
            $view->display($message);
        } catch (missingDataException $e) {
            //retrieves the error message from above
            $message = $e->getMessage();
            //displays the error message on the error page
            $view = new PokemonError();
            $view->display($message);
        }
    }

    //adds a new pokemon to the database with all appropriate details
    public function addNewPokemon()
    {
        try {
            //check for if the required fields are retrieved from the form
            if ($_POST["pokemonName"] && $_POST["primaryType"] && $_POST["img"] && $_POST["abilityName"]) {
                //retrieves the input from the pokemon create form
                //sanitize the user input using html special characters
                $pokemonName = htmlspecialchars($_POST["pokemonName"]);
                $primaryType = htmlspecialchars($_POST["primaryType"]);
                $img = htmlspecialchars($_POST["img"]);
                $abilityName = htmlspecialchars($_POST["abilityName"]);
                $area = htmlspecialchars($_POST["area"]);
                $evolvesTo = htmlspecialchars($_POST["evolvesTo"]);
                $secondaryType = htmlspecialchars($_POST["secondaryType"]);
            } else {
                //if any of the fields are missing, throw missing data exception
                throw new MissingDataException("Missing Data Fields");
            }

            //runs the model function to check whether the pokemon is already present
            $pokemonCheckResult = $this->pokemon_model->duplicatePokemonName($pokemonName);

            //if the pokemon is already in the database, return an error message
            if($pokemonCheckResult){
                throw new DuplicatePokemonException("Unable to add Pokemon. Pokemon already found.");
            }

            if($primaryType == $secondaryType){
                throw new TypeException("Unable to add Pokemon. Primary and Secondary Types can not be the same.");
            }

            //pass the user inputs into the create_pokemon method in the Pokemon model
            $newPokemon = $this->pokemon_model->create_pokemon($pokemonName, $primaryType, $img, $abilityName, $area, $evolvesTo, $secondaryType);

            //displays the success method
            $view = new Success();
            $view->display();

        }
        //if an exception is thrown, return appropriate error message associated with it
        catch (MissingDataException | DuplicatePokemonException | TypeException $e) {
        //retrieves the error message from above
        $message = $e->getMessage();
        //displays the error on to the error page
        $view = new PokemonError();
        $view->display($message);
        }
    }

    //brings up the page to add a new pokemon
    public function add()
    {
        // if a fav session is not set, start it
        if (!isset($_SESSION['trainer'])) {
            $view = new UserError();
            $view->display("You must be logged in to access this feature!");
        } else {
            //creates a new instance of the pokemonAdd view
            $view = new PokemonAdd();
            $view->display();
        }

    }
}