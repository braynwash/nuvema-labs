<?php
/**
 * Author: Jeremy Black
 * Date: {4/18/2024}
 * File: {user_controller.class.php}
 * Description:
 */

class UserController {
    //Trainer Model attribute
    private $trainer_model;

    //constructor creates a new instance of the Trainer model
    public function __construct(){
        $this->trainer_model = new TrainerModel();
    }

    //bring up the login page for users to login
    public function login() {
        if (isset($_SESSION['trainer'])) {
            $view = new UserError();
            $view->display("You are already logged in!");
        } else {
            $view = new Login();
            $view->display();
        }
    }

    public function register(){
        //displays the registration form
        $view = new Register();
        $view->display();
    }

    //runs when the registration form is submitted
    //adds user and displays success method if successful
    //displays login failure message if unsuccessful
    public function addUser()
    {
        try {
            //runs the add user method in the trainer model
            //returns true or false
            $result = $this->trainer_model->add_user();

            //if registration successful
            if ($result) {
                //runs the trainer success view displaying a success message
                $view = new TrainerSuccess;
                $view->display("Account created! Please log in.");
            } //if registration unsuccessful (false value returned)
            else {
                throw new DatabaseException("Account could not be created. Please try again.");
            }
        } catch (DatabaseException $e) {
            //runs the UserError view displaying a failure message to the user
            $view = new UserError();
            $view->display($e->getMessage());
        }
    }

    //displays the reset view
    public function reset() {
        $view = new ResetView();
        $view->display();
    }

    //verifies whether the user is correct
    public function verify() {
        //determines the result of the verification
        $result = $this->trainer_model->verify_user();

        # Expecting Two Result Types

        # If there is an array of Trainer details,
        if(getType($result) === 'array') {

            # Simply for readability
            $trainerInfo = $result;

            # If the trainer session is not set, start it
            if (!isset($_SESSION)) {
                // start the session
                session_start();
            }

            # Set the trainer property of the Session variable to the received trainer information
            $_SESSION['trainer'] = $trainerInfo;


            //runs the trainer success view displaying a success message
            $view = new TrainerSuccess();
            $view->display("Congrats, you are now logged in!");
        }
        //if login unsuccessful
        else {
            $view = new UserError();
            $view->display("Login failed. Please try again.");
        }
    }

    # Function to add the favorites view
    public function addFav($pokemonID) {
        // if a fav session is not set, start it
        if (!isset($_SESSION['trainer'])) {
            $view = new UserError();
            $view->display("You must be logged in to access this feature!");
        }

        # Get the existing trainer favorites from the session
        $trainerID = $_SESSION['trainer']['id'];

        # Favorites is a php array of the trainer's favorite pokemon ids
        # Adding the new Pokemon ID back into the favorites

        $_SESSION['trainer']['favorites'][] = $pokemonID;


        # Execute a model method to save the favorites
        $this->trainer_model->setFavorites($trainerID,$_SESSION['trainer']['favorites']);

        # Return a success message that the pokemon was added
        $view = new FavoritesSuccess();
        $view->display("Pokemon added to Favorites.");
    }

    # Function to add the favorites view
    public function removeFav($pokemonID) {
        // if a fav session is not set, start it
        if (!isset($_SESSION['trainer'])) {
            $view = new UserError();
            $view->display("You must be logged in to access this feature!");
        }

        # Get the existing trainer favorites from the session
        $trainerID = $_SESSION['trainer']['id'];
        $trainerFavorites = $_SESSION['trainer']['favorites'];

        # Look for the pokemonID to remove in the array
        $indexOfPokemonID = array_search($pokemonID, $trainerFavorites);

        # Assuming it returns an index other than false, AKA it finds a result
        if($indexOfPokemonID !== false) {
            # Remove that pokemon ID from the Session
            unset($_SESSION['trainer']['favorites'][$indexOfPokemonID]);
        }

        # Execute a model method to save the favorites
        $this->trainer_model->setFavorites($trainerID, $_SESSION['trainer']['favorites']);

        # Return a success message that the pokemon was removed
        $view = new FavoritesSuccess();
        $view->display("Pokemon removed from favorites list.");
    }

    # Calls the favorites view
    public function favorites() {
        # Get favorite pokemon objects

        // if a fav session is not set, start it
        if (!isset($_SESSION['trainer'])) {
            $view = new UserError();
            $view->display("You must be logged in to access this feature!");
            return false;
        }

        # Get the existing trainer favorites from the session
        $trainerID = $_SESSION['trainer']['id'];
        $trainerFavorites = $_SESSION['trainer']['favorites'];

        # Execute a model method to get the favorite Pokemon as objects
        $pokemon = $this->trainer_model->getPokemonObjectsFromFavorites($trainerFavorites);

        # Feed them into the list view
        #$view = new FavoritesView();
        $view = new FavoritesView();
        $view->display($pokemon);
    }

    public function logout(): void {
        // Unset all of the session variables
        $_SESSION = [];

        // Destroy the session
        session_destroy();

        $view = new TrainerSuccess();
        $view->display("You have successfully logged out.");
    }

}