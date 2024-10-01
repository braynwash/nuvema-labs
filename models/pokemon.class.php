<?php
/**
 * Author: Sarah Wood
 * Date: 4/4/24
 * File: pokemon.class.php
 * Description:
 */

class Pokemon {
    //all of the features of the table
//    private ?int $pokemonID, $evolvesTo, $primaryTypeID, $secondaryTypeID;
//    private string|null  $secondaryTypeID, $area; //these are null values so they are separate.
//    private string $pokemonName, $img, $abilityName, $primaryTypeName;
    private ?int $pokemonID, $evolvesTo;
    private string $primaryTypeName, $pokemonName, $img, $abilityName, $abilityDescr;
    private string|null $secondaryTypeName, $areaName;

    //i can do this
    public function __construct(
        $pokemonID, $pokemonName, $img, $abilityName, $abilityDescr,
        $primaryTypeName, $secondaryTypeName, $areaName, $evolvesTo) {
        $this->pokemonID = $pokemonID;
        $this->pokemonName = $pokemonName;
        $this->img = $img;
        $this->abilityName = $abilityName;
        $this->abilityDescr = $abilityDescr;
        $this->primaryTypeName = $primaryTypeName;
        $this->secondaryTypeName = $secondaryTypeName;
        $this->areaName = $areaName;
        $this->evolvesTo = $evolvesTo; //meanie pants?
    }
//gets pokemon id
    public function getPokemonID(): int {
        return $this->pokemonID;
    }

    /**
     * @return string
     */
    //gets pokemon name
    public function getPokemonName(): string
    {
        return $this->pokemonName;
    }
//gets pokemon sprite they all move so its so cute!!!!!
    public function getImg(): string {
        return $this->img;
    }

    /**
     * @return string
     */
    //gets pokemon ability
    public function getAbilityName(): string
    {
        return $this->abilityName;
    }

    /**
     * @return string
     */
    //gets pokemon description
    public function getAbilityDescr(): string
    {
        return $this->abilityDescr;
    }

    /**
     * @return string
     */
    //gets pokemon type
    public function getPrimaryTypeName(): string
    {
        return $this->primaryTypeName;
    }
    //primary type name

    /**
     * @return string
     */
    //gets pokemon secondary type, but can be null because not all pokemon have a secondary type.
    public function getSecondaryTypeName(): string|null
    {
        return $this->secondaryTypeName;
    }

    /**
     * @param string $area
     */
    //not all pokemon can be found in the wild
    public function getArea(): string|null
    {
      return  $this->areaName;
    }

    /**
     * @return ?int
     */
    //gets pokemon can be null, bc some are final stage evolution ex. Emboar. Also some just dont evolve
    public function getEvolvesTo(): ?int
    { //meanie pants
        return $this->evolvesTo;
    }

}
