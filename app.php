<?php

require_once './includes/db.php';

$pokeUrl = "https://pokeapi.co/api/v2/pokemon?limit=15";
$pokeResponse = file_get_contents($pokeUrl);
$pokeDatos = json_decode($pokeResponse, true);

$stmt = $pdo->prepare("INSERT INTO pokemones (id, nombre, tipo) VALUES (:id, :nombre, :tipo)");

foreach ($pokeDatos['results'] as $pokemon) {
    $pokemonDetails = file_get_contents($pokemon['url']);
    $pokemonDetails = json_decode($pokemonDetails, true);

    $stmt->execute([
        ':id' => $pokemonDetails['id'],
        ':nombre' => $pokemonDetails['name'],
        ':tipo' => implode(', ', array_column($pokemonDetails['types'], 'type.name'))
    ]);
}

echo "Pokemones insertados correctamente";
