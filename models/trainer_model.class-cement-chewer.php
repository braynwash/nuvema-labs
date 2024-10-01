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
        //get password from the form :p
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

        //it's not hash browns its hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //everything from the form except the password
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

        //add query
        $addSQL = "INSERT INTO " . $this->tblTrainer . "(trainerID, username, password, firstName, lastName, favorites)" .
            " VALUES(NULL, " .  "'$username', ". "'$hashedPassword', " . " '$firstName', ". "  '$lastName' " . ", NULL)";

        var_dump($addSQL);
        //ship it
        $query = $this->dbConnection->query($addSQL);

        var_dump($query);

        if (!$query) {
            return false;
        //query questioning
         }
        else
            return true;
    }

    public function verify_user(): bool|array {
        try {
            //gotta grab the username and password from le login form
            $inputUsername = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
            $inputPassword = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

            $trainerID = NULL;
            //if username or password is not retrieved, throw an exception
            if(empty($inputPassword) || empty($inputUsername)) {
                throw new MissingDataException("Data Missing");
            }

            $verifySQL = "SELECT password AND trainerID FROM " . $this->tblTrainer . " WHERE username='" . $inputUsername . "'";


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
                return $e->getMessage();
        }
    }

    public function reset_password(): bool {
        $inputUsername = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $inputPassword = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

        //its a hashed password not hash browns
        $hashPassword = password_hash($inputPassword, PASSWORD_DEFAULT);

        //update sql time
        $updateSQL = "UPDATE " . $this->tblTrainer . " SET password='" . $hashPassword . "' WHERE username='" . $inputUsername ."'";

        //ship it
        $query = $this->dbConnection->query($updateSQL);

        //false if there arent any usernames that are updated or if the query is false
        if(!$query || $this->dbConnection->affected_rows == 0) {
            return false;
        }
        return true;
    }
    //ill need a json parse for the favorites column json pain
    //and ill need to make sure the json changes in the db.

    public function setFavorites(int $trainerID, array $pokemonFavorites):bool {
        //I need to separate the pokemon into an associative array or just do that json thingy
        // then from there add it to the favorite JSON
        //return bool if success or not

        //fastest shipping in the whole project, this will turn the object
        // into my enemy for the favorites JSON bc I hate myself

        # Set the JSON of the array of favorite pokemon IDS
        $jsonShipping = json_encode($pokemonFavorites);

        $shippingSQL = "UPDATE trainer" . " SET favorites = " . $jsonShipping .
            "WHERE trainerID=$trainerID";

        $query = $this->dbConnection->query($shippingSQL);

        if(!$query) {
            return false;
        }
        else
            return true;


        //$jsonShipping = json_encode($trainerID);

    }

    public function listFavorites($username) {
        $favArray = []; //will be needed later for the eventual display of results

        // Get the Pokmeon Model to handle the pokemon objects
        $pokemonModel = new PokemonModel();

        //ship it o7
        $query = $this->dbConnection->query($favSQL);

        //results timmmmmeeeeee

        //json encode is def the right one
         $favResults = json_decode($query, true);
       // $favResults = mysqli_fetch_all($query, MYSQLI_ASSOC);

        foreach ($favResults as $favRow) {
            $favPokemon = new Pokemon(
                $favRow['pokemonID'],
                $favRow['pokemonName'],
                $favRow['img'],
                $favRow['abilityName'],
                $favRow['abilityDescr'],
                $favRow['primaryTypeName'],
                $favRow['secondaryTypeName'],
                $favRow['areaName'],
                $favRow['evolvesTo']
            );
            $favArray[] = $favPokemon;
        }
        return $favArray;
    }

}
