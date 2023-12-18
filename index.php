<?php

require_once './includes/db.php';
require_once './Classes/Equipo.php';
require_once './Classes/Entrenador.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_SERVER['REQUEST_URI'] === '/insertarPokemones') {
        $pokeUrl = "https://pokeapi.co/api/v2/pokemon?limit=15";
        $pokeResponse = file_get_contents($pokeUrl);
        $pokeDatos = json_decode($pokeResponse, true);

        $stmt = $pdo->prepare("INSERT INTO pokemones (id, nombre, tipo) VALUES (:id, :nombre, :tipo)");

        foreach ($pokeDatos['results'] as $pokemon) {
            $pokemonDetails = file_get_contents($pokemon['url']);
            $pokemonDetails = json_decode($pokemonDetails, true);

            foreach ($pokemonDetails['types'] as $pokemonType) {
                $nombreTipo = $pokemonType['type']['name'];
            }

            $stmt->execute([
                ':id' => $pokemonDetails['id'],
                ':nombre' => $pokemonDetails['name'],
                ':tipo' => $nombreTipo
            ]);
        }
    }

    if ($_SERVER['REQUEST_URI'] === '/crearEntrenador') {
        $nombre = $_POST['nombre'];

        $entrenador = new Entrenador($pdo);
        $entrenadorId = $entrenador->crearEntrenador($nombre);

        echo json_encode(['id_entrenador' => $entrenadorId]);
        exit();
    }
    if ($_SERVER['REQUEST_URI'] === '/crearEquipo') {
        $entrenadorId = $_POST['id_entrenadores'];
        $nombreEquipo = $_POST['nombre'];

        $equipo = new Equipo($pdo);
        $equipoId = $equipo->crearEquipo($entrenadorId, $nombreEquipo);

        echo json_encode(['id_equipo' => $equipoId]);
        exit();
    }
    if ($_SERVER['REQUEST_URI'] === '/asociarAEquipo') {
        $id_equipo = $_POST['id_equipo'];
        $id_pokemones = $_POST['id_pokemones'];
        $orden = $_POST['orden'];

        $equipo = new Equipo($pdo);
        $resultado = $equipo->asociarAEquipo($id_equipo, $id_pokemones, $orden);

        echo json_encode($resultado);
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_SERVER['REQUEST_URI'] === '/listarEntrenadores') {
        $entrenador = new Entrenador($pdo);
        $entrenadores = $entrenador->listarEntrenadores();

        echo json_encode($entrenadores);
        exit();
    }
    if ($_SERVER['REQUEST_URI'] === '/detallarEntrenador?id=' . $_GET['id']) {
        $idEntrenador = $_GET['id'];

        $entrenador = new Entrenador($pdo);
        $entrenadorDetallado = $entrenador->detallarEntrenador($idEntrenador);

        echo json_encode($entrenadorDetallado);
        exit();
    }
    if ($_SERVER['REQUEST_URI'] === '/listarEquipo?id=' . $_GET['id']) {
        $idEquipo = $_GET['id'];

        $equipo = new Equipo($pdo);
        $equipos = $equipo->listarEquipo($idEquipo);

        echo json_encode($equipos);
        exit();
    }
}
