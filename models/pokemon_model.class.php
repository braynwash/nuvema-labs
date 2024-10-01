<?php
/**
 * Author: Sarah Wood
 * Date: 4/3/24
 * File: pokemon_model.class.php
 * Description: Sarah's second try at the pokemon model now that I have fixed the database
 * I got this :)
 */

class PokemonModel
{
    //le database
    private Database $db;
    //database connection object
    private mysqli $dbConnection;
    //tbl pokemon :)
    private string $tblPokemon;

    private string $tblType;

    private string $tblAbility;

    private string $tblArea;

    private string $lordSQL;

    private string $orderBy;


/*select pokemon.pokemonID, pokemon.pokemonName, pokemon.img, `ability`.abilityName,
`ability`.abilityDescr, `area`.areaName, `primaryType`.typeName, `secondaryType`.typeName, pokemon.evolvesTo
from pokemon
LEFT join `ability` on `ability`.abilityID = pokemon.abilityID
LEFT join `area` on `area`.areaID = pokemon.areaID
INNER join `type` as `primaryType` on primaryType.typeID = pokemon.primaryTypeID
LEFT join `type` as `secondaryType` on secondaryType.typeID = pokemon.secondaryTypeID;
 *
 *
 */

   //THE CONSTRUCT!!!!!!

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->dbConnection = $this->db->getConnection();
        $this->tblPokemon = $this->db->getPokemon();
        $this->tblType = $this->db->getType();
        $this->tblArea = $this->db->getArea();
        $this->tblAbility = $this->db->getAbility();

        $this->lordSQL = "SELECT " . $this->tblPokemon . ".pokemonID" . ", " .
        $this->tblPokemon . ".pokemonName" . ", " .
        $this->tblPokemon . ".img" . ", " .
        $this->tblAbility . ".abilityName" . ", " .
        $this->tblAbility . ".abilityDescr" . ", " .
        $this->tblArea . ".areaName" . ", " .
        "`primary" . $this->tblType . "`" . ".typeName" . " AS `primaryTypeName`" .  ", " .
        "`secondary" . $this->tblType . "`" .".typeName" . " AS `secondaryTypeName`" . ", " .
        $this->tblPokemon . ".evolvesTo" .
        " FROM " . $this->tblPokemon .
        " LEFT JOIN " . $this->tblAbility . " ON " . $this->tblAbility . ".abilityID= "  . $this->tblPokemon . ".abilityID" .
        " LEFT JOIN " . $this->tblArea . " ON " . $this->tblArea . ".areaID= "  . $this->tblPokemon . ".areaID" .
        " INNER JOIN " . $this->tblType . " AS " . "`primary" . $this->tblType . "`" . " ON " . "`primary" . $this->tblType . "`" . ".typeID= " . $this->tblPokemon . ".primaryTypeID" .
        " LEFT JOIN " . $this->tblType . " AS " . "`secondary" . $this->tblType . "`" . " ON " . "`secondary" . $this->tblType . "`" . ".typeID= " . $this->tblPokemon . ".secondaryTypeID" ;

        $this->orderBy =  " ORDER BY pokemonID ASC";
    }

    //This method is gonna get the pokemon and pTypes and sTypes from the db and array or say false if it didn't work
    public function getPokemon(): false|array
    {
        try {
            //SQL statement!!!!!

            // This will get
            // everything in the pokemon table.
            $sql = $this->lordSQL . $this->orderBy;

            //var_dump($sql); exit;

            //ship the query!!!
            $query = $this->dbConnection->query($sql);

            if ($query && $query->num_rows > 0) {

                //Results is just a large PHP associative array that is a Table
                //Should look like what you'd get when you use the SQL directly in the database
                $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

                //if results are not retrieved, throw an exception
                if(!$results){
                    throw new Exception("Unable to retrieve the Pokemon List");
                }

                //Initialize an empty array to contain all the pokemon
                $allPokemon = [];

                //Iterate through the results
                foreach ($results as $row) {

                    $pokemon = new Pokemon(
                        $row['pokemonID'],
                        $row['pokemonName'],
                        $row['img'],
                        $row['abilityName'],
                        $row['abilityDescr'],
                        $row['primaryTypeName'],
                        $row['secondaryTypeName'],
                        $row['areaName'],
                        $row['evolvesTo']

                    );

                    //Bind the individual pokemon back into the array
                    $allPokemon[] = $pokemon;

                }
                //if successful, return complete Pokemon list
                return $allPokemon;
            }
            return false;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
    //lists the pokemon
    public function list_pokemon(): bool|array|int
    {
        $sql = $this->lordSQL . $this->orderBy;

        $query = $this->dbConnection->query($sql);

        //big sad query failed
        if (!$query)
            return false;

        //no pokemon :(
        if ($query->num_rows == 0) {
            return 0;
        }

        //result time
        //another array for the results
        $pokemons = array();

        //loops through rows in results //TODO switch to above.
        while($obj = $query->fetch_object()) {
            $pokemon = new Pokemon(
            stripslashes($obj->pokemonID),
            stripslashes($obj->pokemonName), //name
            stripslashes($obj->img), //img
            stripslashes($obj->abilityName),//abilityname
            stripslashes($obj->abilityDescr), //abilitydescr
            stripslashes($obj->primaryTypeName), //primarytype
            stripslashes($obj->secondaryTypeName), //secondarytype
            stripslashes($obj->areaName), //area
            stripslashes($obj->evolvesTo) //evolvesto
            );

            //set id of the pokemon
            $pokemon->setId($obj->pokemonID);

            //add the pokemon into the pokemons
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }

    public function view_pokemon($pokemonID): bool|Pokemon
    {

        $sql = $this->lordSQL . " WHERE " . $this->tblPokemon . ".pokemonID" . " = " . $pokemonID . $this->orderBy;

        //ship the query!!!
        $query = $this->dbConnection->query($sql);

        //takes le query then associative arrays it for the specified pokemonID
        $results = mysqli_fetch_all($query, MYSQLI_ASSOC);

        //Iterate through each attribute of the pokemon object
        $row  = $results[0];

        $pokemon = new Pokemon(
            $row['pokemonID'],
            $row['pokemonName'],
            $row['img'],
            $row['abilityName'],
            $row['abilityDescr'],
            $row['primaryTypeName'],
            $row['secondaryTypeName'],
            $row['areaName'],
            $row['evolvesTo']

        );
        //fruits of our labor
        return $pokemon;
    }


    public function search_pokemon($words): array|bool|string
    {
        //I got this totally
        $words = explode(" ", $words);

        $searchSql = $this->lordSQL ;
        //SELECT * FROM pokemon (WHERE pokemonName LIKE  );
        foreach($words as $word) {
            $searchSql .= " WHERE pokemonName LIKE '%" . $word . "%'";
        }

        $searchSql .=  $this->orderBy;



        //ship it!
       $query = $this->dbConnection->query($searchSql);


        //big L if does not ship
        if (!$query)
            return false;

        //if success but just not anything
        if ($query->num_rows == 0)
            return 0;

        if ($query && $query->num_rows > 0) {
            //results
            $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
            //le array
            $searchedPokemon = [];

            foreach ($results as $row ) {

                $pokemon = new Pokemon (
                    $row['pokemonID'],
                    $row['pokemonName'],
                    $row['img'],
                    $row['abilityName'],
                    $row['abilityDescr'],
                    $row['primaryTypeName'],
                    $row['secondaryTypeName'],
                    $row['areaName'],
                    $row['evolvesTo']
                );
                $searchedPokemon[] = $pokemon;
            }
            // the pokemon searched
            return $searchedPokemon;
        }
        return false;
    }


//TO DO: Add an exception for if there is missing data fields
public function create_pokemon($pokemonName, $primaryType, $img, $abilityName, $area = null, $evolvesTo = null, $secondaryType = null): bool|Pokemon
{
    //time to check pokemonName
    $localPokemonName = '';

    //nameSQL statement to check against db
    $nameSQL = "SELECT * FROM " . $this->tblPokemon . " WHERE pokemonName='" . $pokemonName . "'"; //safety check to make sure there's no repeats, it will not go forth

    //ship it
    $query = $this->dbConnection->query($nameSQL);
    if (!$query) { //if something made an oopsy and the query returns false
        return false;
    }

    if ($query->num_rows == 0) {
        $localPokemonName = $pokemonName;
    } elseif ($query->num_rows > 0) {
        //return message that pokemon already exists! //TODO: needs an error message with porygon z
        die;
    }

    $bigSQL = "INSERT INTO " . $this->tblPokemon . " (pokemonID, pokemonName, img, abilityID, primaryTypeID, secondaryTypeID, areaID, evolvesTo)" .
        " VALUES (NULL, '" . $localPokemonName . "', '" . $img . "', " . $abilityName . ", " . $primaryType . ", " . $secondaryType . ", " . $area . ", " . $evolvesTo . ")";

    $query = $this->dbConnection->query($bigSQL);
    //var_dump($query);
    if (!$query) {
        return false;
    }

    $resSQL = $this->lordSQL . " WHERE " . $this->tblPokemon . ".pokemonName='" . $localPokemonName . "'";

    $query = $this->dbConnection->query($resSQL);
        $addedResults = mysqli_fetch_all($query, MYSQLI_ASSOC);
        //var_dump($addedResults);
        //Iterate through each attribute of the pokemon object
        $row = $addedResults[0];
        //var_dump($row);
        $addedPokemon = new Pokemon(
            $row['pokemonID'],
            $row['pokemonName'],
            $row['img'],
            $row['abilityName'],
            $row['abilityDescr'],
            $row['primaryTypeName'],
            $row['secondaryTypeName'],
            $row['areaName'],
            $row['evolvesTo']
        );
        //var_dump($addedPokemon);

    return $addedPokemon;
}

    //checks to see if a pokemon is already in the database - Nathan
    //returns true if the pokemon is a duplicate //who touched my stuff
    public function duplicatePokemonName($pokemonName){

        //creates a sql query to search the database for the pokemon name
        $searchSql = $this->lordSQL;
        $searchSql .= " WHERE pokemonName = '" . $pokemonName . "'";

        //run the query
        $query = $this->dbConnection->query($searchSql);

        //return false if query fails
        if (!$query)
            return false;

        // If query is successful, but does not find any matches
        if ($query->num_rows == 0)
            return false;

        //if query is successful and returns at least one row
        //then returns true
        if ($query && $query->num_rows > 0) {
            return true;
        }
    }

//end of model class
}

