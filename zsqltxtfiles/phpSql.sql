"SELECT pokemon.pokemonID" . ", pokemon ".pokemonName" . ", pokemon ".img" . ", " .
        $this->tblAbility . ".abilityName" . ", " .
        $this->tblAbility . ".abilityDescr" . ", " .
        $this->tblArea . ".areaName" . ", " .
        "`primary" . $this->tblType . "`" . ".typeName" . " AS `primaryTypeName" .  ", " .
        "`secondary" . $this->tblType . "`" .".typeName" . " AS `secondaryTypeName`" . ", pokemon ".evolvesTo" .
        " FROM " . $this->tblPokemon .
        " LEFT JOIN " . $this->tblAbility . " ON " . $this->tblAbility . ".abilityID= "  . $this->tblPokemon . ".abilityID" .
        " LEFT JOIN " . $this->tblArea . " ON " . $this->tblArea . ".areaID= "  . $this->tblPokemon . ".areaID" .
        " INNER JOIN " . $this->tblType . " AS " . "`primary" . $this->tblType . "`" . " ON " . "`primary" . $this->tblType . "`" . ".typeID= pokemon.primaryTypeID" .
        " LEFT JOIN " . $this->tblType . " AS " . "`secondary" . $this->tblType . "`" . " ON " . "`secondary" . $this->tblType . "`" . ".typeID= pokemon.secondaryTypeID";