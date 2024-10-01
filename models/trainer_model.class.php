<?php
/**
 * Author: Sarah Wood
 * Date: 4/17/24
 * File: trainer_model.class.php
 * Description: where Sarah will probably cry
 */

class TrainerModel
{
    private Database $db;

    private mysqli $dbConnection;

    private string $tblTrainer;

    private string $tblPokemon;

    private string $tblArea;

    private string $tblAbility;

    private string $tblType;


    public function __construct() {
        $this->db = Database::getInstance();
        $this->dbConnection = $this->db->getConnection();
        $this->tblTrainer = $this->db->getTrainer();
        $this->tblPokemon = $this->db->getPokemon();
        $this->tblArea = $this->db->getArea();
        $this->tblAbility = $this->db->getAbility();
        $this->tblType = $this->db->getType();
    }

    public function add_user(): bool
    {
        try {
            //get password from the form :p
            $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
            $checkpassword = trim(filter_input(INPUT_POST, 'checkpassword', FILTER_SANITIZE_STRING));

            if ($checkpassword != $password) {
                throw new VerifyPasswordException("The passwords do not match.");
            }

            //TO DO: Check Password Length (Password Length Exception)
            if (strlen($password) < 8) {
                throw new PasswordLengthException("Password Too Short");
            }

            //it's not hash browns its hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            //everything from the form except the password
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

            //add query
            $addSQL = "INSERT INTO " . $this->tblTrainer . "(trainerID, username, password, firstName, lastName, favorites)" .
                " VALUES(NULL, " . "'$username', " . "'$hashedPassword', " . " '$firstName', " . "  '$lastName' " . ", NULL)";

            //var_dump($addSQL);
            //ship it
            $query = $this->dbConnection->query($addSQL);

            //var_dump($query);

            if (!$query) {
                return false;
                //query questioning
            } else
                return true;
        }
        //these exceptions catch errors and return false for the entire function
        catch (PasswordLengthException){
            //if password too short, returns false
            return false;
        }
        catch (VerifyPasswordException){
            //if verify password exception, returns false
            return false;
        }
    }

    public function verify_user(): bool|array {
        try {
            //gotta grab the username and password from le login form
            $inputUsername = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
            $inputPassword = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

            $trainerID = NULL;
            //if username or password is not retrieved, throw an exception
            if(empty($inputPassword) || empty($inputUsername)) {
                throw new MissingDataException();
            }

            $verifySQL = "SELECT trainerID, username, password, firstName, lastName, favorites  FROM " . $this->tblTrainer . " WHERE username='" . $inputUsername . "'";

            //ship it o7
            $query = $this->dbConnection->query($verifySQL);

            if ($query && $query->num_rows > 0) {
                $verifyResults = mysqli_fetch_all($query, MYSQLI_ASSOC);
                // I <3 associative array
                $row = $verifyResults[0];
                $verifyHash = $row['password'];

                //gotta verify the password matches
                if (!password_verify($inputPassword, $verifyHash)) {
                    return false;
                }

                # Initialize an array of trainer information
                $trainer = [
                    'username' => $row['username'],
                    'fName' => $row['firstName'],
                    'lName' => $row['lastName'],
                    'id' => $row['trainerID'],
                    # Remember to undo the json_decode
                    'favorites' => json_decode($row['favorites'])
                ];

                # Return the array of trainer information
                return $trainer;
            }

            // It shouldn't get to this point, but if it does, then return false
            return false;

        }
        catch (missingDataException $e){
            //if missing data, return false
            //controller gives login unsuccessful message to user
            return false;
        }
    }

    public function reset_password(): bool {
        try {
            $inputUsername = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
            $inputPassword = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

            //its a hashed password not hash browns
            $hashPassword = password_hash($inputPassword, PASSWORD_DEFAULT);

            //update sql time
            $updateSQL = "UPDATE " . $this->tblTrainer . " SET password='" . $hashPassword . "' WHERE username='" . $inputUsername . "'";

            //ship it
            $query = $this->dbConnection->query($updateSQL);

            //exception if there arent any usernames that are updated or if the query is false
            if (!$query || $this->dbConnection->affected_rows == 0) {
                throw new DatabaseException();
            }
            return true;
        }
        //return false if query does not work
        catch (DatabaseException $e){
            return false;
        }
    }
    //ill need a json parse for the favorites column json pain
    //and ill need to make sure the json changes in the db.

    public function setFavorites(int $trainerID, array|string|int $pokemonFavorites):bool
    {
        try {//I need to separate the pokemon into an associative array or just do that json thingy
            // then from there add it to the favorite JSON
            //return bool if success or not

            //fastest shipping in the whole project, this will turn the object
            // into my enemy for the favorites JSON bc I hate myself
            if (gettype($pokemonFavorites) === "string" || gettype($pokemonFavorites) === "int") {
                $pokemonFavorites = [$pokemonFavorites];
            }
            # Set the JSON of the array of favorite pokemon IDS
            $jsonShipping = json_encode($pokemonFavorites);

            $shippingSQL = "UPDATE trainer" . " SET favorites = '" . $jsonShipping .
                "' WHERE trainerID=$trainerID";
            // var_dump($shippingSQL);
            $query = $this->dbConnection->query($shippingSQL);

            if (!$query) {
                //if query fails, throw database exception
                throw new DatabaseException();
            } else
                return true;

        }
        //if database exception, return false
        catch (DatabaseException $e) {
            return false;
        }
    }

    /**
     * Convert the trainer favorites array which is an array of IDs
     * @param $trainerFavorites
     * @return array of favorite pokemon objects
     */
    public function getPokemonObjectsFromFavorites($trainerFavorites): array {

        # Get the Pokemon Model to handle the pokemon objects
        $pokemonModel = new PokemonModel();

        # Initialize the Array of Favorite Pokemon Objects
        $favArray = [];

        # Walk through the array of pokemon IDs
        foreach ($trainerFavorites as $favPokemonID) {
            $favPokemonObj = $pokemonModel->view_pokemon($favPokemonID);

            # Add the Pokemon object to the array
            $favArray[] = $favPokemonObj;
        }

        # Return the Array of Favorite Pokemon Objects
        return $favArray;
    }

}
