<?php
require "config.php";
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name","$db_user","$db_password");


function getPokemonFromAPI($name)
{
    $uri = 'https://pokebuildapi.fr/api/v1/pokemon/'. $name;

    $headers = get_headers($uri);

    if(substr($headers[0], 9, 3) != 200){
        header("location:../views/index.php");
    }else{
        $response = file_get_contents($uri);
        return json_decode($response, true);
    }
}


function insert($pokemon){
    global $pdo;
    
    // Requête mysql pour insérer des données
    $sql = "INSERT INTO pokemon(id, `name`, `image`) VALUES (:id, :name, :image)";
    $res = $pdo->prepare($sql);
    $res->execute(['id'=>$pokemon['id'], 'name'=>$pokemon['name'], 'image'=>$pokemon['image']]);
}


function getPokemonFromDB($name){
    global $pdo;
    
    $sql = "SELECT * 
    FROM pokemon 
    WHERE name = ?";

    $request = $pdo->prepare($sql);
    $request->execute([$name]);

    return $request->fetch(PDO::FETCH_ASSOC);
}

function getAllPokemons(){
    global $pdo;
    
    $sql = "SELECT * 
    FROM pokemon ";

    $request = $pdo->prepare($sql);
    $request->execute();

    return $request->fetchAll(PDO::FETCH_ASSOC);
}


if(isset($_POST['name'])){
    $pokemon = getPokemonFromDB($_POST['name']);

    if($pokemon === false){
        $pokemon = getPokemonFromApi($_POST['name']);

        insert($pokemon);
    }
    
    header("location:../views/index.php");
}


$pokemonList = getAllPokemons();