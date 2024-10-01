<?php
/**
 * Author: Sarah Wood
 * Date: 4/2/24
 * File: database.class.php
 * Description: Sarah loves databases with a passion.
 * I concur! - Jeremy
 * The database for Nuvema Labs consisting of all pokemon we have knowledge of in unova and suspected routes.
 */

class Database {
    //database parameters :)
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser', //all hail phpuser, the walker of databases
        'password' => 'phpuser',
        'database' => 'unova_db',
        'tblAbility' => 'ability',
        'tblArea' => 'area',
        'tblPokemon' => 'pokemon',
        'tblTrainer' => 'trainer',
        'tblType' => 'type'
    );

    //db connection
    private ?object $objDBConnection;

    static private ?Database $_instance = null;

    //oh yeah its all coming together in this construct constructor
    public function __construct()
    {

        $this->objDBConnection = @new mysqli(
            $this->param['host'],
            $this->param['login'],
            $this->param['password'],
            $this->param['database'],
        );
        if (mysqli_connect_errno() != 0) {
            exit("Connecting to database failed:" . mysqli_connect_error());
        }
    }

    //THerE caN ONlY be ONe
    public static function getInstance(): Database|null {
        if (self::$_instance == NULL) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    //returns the database connection object
    public function getConnection(): mysqli {
        return $this->objDBConnection;
    }


    //I <3 Databases!!!!!
    //the dex we will mainly be working with
    public function getAbility(): string {
        return $this->param['tblAbility'];
    }

    public function getArea(): string {
        return $this->param['tblArea'];
    }

    public function getPokemon(): string {
        return $this->param['tblPokemon'];
    }

    public function getTrainer(): string {
        return $this->param['tblTrainer'];
    }

    public function getType(): string {
        return $this->param['tblType'];
    }



}