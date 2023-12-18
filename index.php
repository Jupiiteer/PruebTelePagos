<?php

require_once './includes/db.php';
require_once './Classes/Equipo.php';
require_once './Classes/Entrenador.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['accion'] === 'crearEntrenador') {
        $nombre = $_POST['nombre'];

        $entrenador = new Entrenador($pdo);
        $entrenadorId = $entrenador->crearEntrenador($nombre);

        echo json_encode(['id_entrenador' => $entrenadorId]);
        exit();
    }
    if ($_POST['accion'] === 'crearEquipo') {
        $entrenadorId = $_POST['id_entrenadores'];
        $equipo = $_POST['nombre'];

        $equipo = new Equipo($pdo);
        $equipoId = $equipo->crearEquipo($entrenadorId, $equipo);

        echo json_encode(['id_equipo' => $equipoId]);
        exit();
    }
    if ($_POST['accion'] === 'asociarAEquipo') {
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
    if ($_GET['accion'] === 'listarEntrenadores') {
        $entrenador = new Entrenador($pdo);
        $entrenadores = $entrenador->listarEntrenadores();

        echo json_encode($entrenadores);
        exit();
    }
    if ($_GET['accion'] === 'detallarEntrenador') {
        $idEntrenador = $_GET['id'];

        $entrenador = new Entrenador($pdo);
        $entrenadorDetallado = $entrenador->detallarEntrenador($idEntrenador);

        echo json_encode($entrenadorDetallado);
        exit();
    }
    if ($_GET['accion'] === 'listarEquipos') {
        $equipo = new Equipo($pdo);
        $equipos = $equipo->listarEquipos();

        echo json_encode($equipos);
        exit();
    }
}
