<?php

class Equipo
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function crearEquipo($idEntrenador, $nombre)
    {
        $stmt = $this->pdo->prepare("INSERT INTO equipos (id_entrenadores, nombre) VALUES (:id_entrenadores, :nombre)");
        $stmt->execute(['id_entrenadores' => $idEntrenador, ':nombre' => $nombre]);

        return $this->pdo->lastInsertId();
    }
    public function listarEquipo($idEquipo)
    {
        $query = "SELECT equipos.id AS id_equipo, equipos.nombre AS equipo, entrenadores.nombre AS entrenador, pokemones.id AS id_pokemon, pokemones.nombre AS pokemon, equipos_pokemones.orden FROM equipos JOIN entrenadores ON equipos.id_entrenadores = entrenadores.id JOIN equipos_pokemones ON equipos.id = equipos_pokemones.id_equipos JOIN pokemones ON equipos_pokemones.id_pokemones = pokemones.id WHERE equipos.id = :idEquipo ORDER BY equipos.id, equipos_pokemones.orden";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":idEquipo", $idEquipo, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function asociarAEquipo($idEquipo, $idPokemon, $orden)
    {
        $stmt = $this->pdo->prepare("INSERT INTO equipos_pokemones (id_equipos, id_pokemones, orden) VALUES (:id_equipos, :id_pokemones, :orden)");
        $stmt->execute([':id_equipos' => $idEquipo, ':id_pokemones' => $idPokemon, ':orden' => $orden]);

        return ['mensaje' => 'Pokemon asociado al equipo correctamente'];
    }
}
