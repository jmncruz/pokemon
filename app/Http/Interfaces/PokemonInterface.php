<?php

namespace App\Http\Interfaces;

interface PokemonInterface {
    public function pokemon($name);
    public function pokemons();
    public function sprites($name);
    public function types($name);
}