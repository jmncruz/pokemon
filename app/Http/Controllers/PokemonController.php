<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Interfaces\PokemonInterface;


class PokemonController extends Controller implements PokemonInterface
{
    /**
     * @author Judson Michael neves da Cruz <judson.michael@declatecnologia.com.br>
     * @copyright 2022 DeclaTenologia
     * @license MIT
     */

    private $baseUrl = "https://pokeapi.co/api/v2/pokemon";
    private $param = "?offset=0&limit=3";
    public $id;
    public $name;
    public $sprites;
    public $types;

    /**
     * Metodo para retorno de todos pokemons
     * 
     * @return object [name, url]
     */
    public function __construct(){
        try{
            $this->pokemons = Http::get("$this->baseUrl$this->param");
        }
        catch(\Exception $e){
            return [
                "message" => $e->getMessage(),
                "code" =>  $e->getCode(),
                "file" =>  $e->getFile(),
                "line" =>  $e->getLine(),
            ];
        }
    }
    public function index(){
        try{
            return json_decode($this->pokemons)->results;
        }
        catch(\Exception $e){
            return $this->errors($e);
        }
    }
    /**
     * Metodo para retorno de apenas um pokemon
     * 
     * Aceita um parametro com o nome do pokemon e retorna o pokemon desejado
     * 
     * @param string $name nome do pokemon
     * @return object [ name, url ]
     */
    public function pokemon($name){
        try{
            return json_decode(Http::get("$this->baseUrl/$name"));
        }
        catch(\Exception $e){
            return $this->errors($e);
        }
    }
    /**
     * Metodo para retornar a imagem do pokemon
     *
     * @param string $name nome do pokemon
     * @return string
     */
    public function sprites($name){
        try{
            
            $sprites = (array)$this->pokemon($name)->sprites->other;
            return $sprites["official-artwork"]->front_default;
        }catch(\Exception $e){
            return $this->errors($e);
        }
    }
    /**
     * Metodo para retornar os tipos do pokemon
     *
     * @param string $name nome do pokemon
     * @return array [types]
     */    
    public function types($name){
        try{
            $types = $this->pokemon($name)->types;
            return $types;
        }catch(\Exception $e){
            return $this->errors($e);
        }
    }
    /**
     * Metodo para retornar todos os pokemon
     * 
     * @return array [id, name, sprites, types]
     */
    public function pokemons(){
        try{
            if(!isset($this->index()["code"])):
                foreach($this->index() as $key=>$items){
                    $pokemons[] = (object)[
                        "id" => $key+1,
                        "name" => $items->name,
                        "sprites" => $this->sprites($items->name),
                        "types" => $this->types($items->name)
                    ];
                }
                return view("home", compact('pokemons'));
            else:
                return view("errors.500");
            endif;
        }catch(\Exception $e){
            return $this->errors($e);
        }
    }
    /**
     * Metodos para retornar exeções
     *
     * @param object $e de Exception
     * @return array [message, code, file, line]
     */
    public function errors($e){
        return [
            "message" => $e->getMessage(),
            "code" =>  $e->getCode(),
            "file" =>  $e->getFile(),
            "line" =>  $e->getLine(),
        ];
    }

}
