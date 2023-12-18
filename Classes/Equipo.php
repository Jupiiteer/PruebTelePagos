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
    public function listarEquipos()
    {
        $query = "SELECT equipos.id AS id_equipo, equipos.nombre AS equipo, entrenadores.nombre AS entrenador, pokemones.id AS id_pokemon, pokemones.nombre AS pokemon, equipos_pokemones.orden FROM equipos JOIN entrenadores ON equipos.id_entrenadores = entrenadores.id JOIN equipos_pokemones ON equipos.id = equipos_pokemones.id_equipos JOIN pokemones ON equipos_pokemones.id_pokemones = pokemones.id ORDER BY equipos.id, equipos_pokemones.orden";
        $stmt = $this->pdo->query($query);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        # Formateo
        $equipos = [];
        foreach ($resultado as $fila) {
            $idEquipo = $fila['id_equipo'];

            if (!isset($equipos[$idEquipo])) {
                $equipos[$idEquipo] = [
                    'id_equipo' => $idEquipo,
                    'nombre_equipo' => $fila['nombre_equipo'],
                    'nombre_entrenador' => $fila['nombre_entrenador'],
                    'pokemones' => []
                ];
            }

            $equipos[$idEquipo]['pokemones'][] = [
                'id_pokemon' => $fila['id_pokemon'],
                'nombre_pokemon' => $fila['nombre_pokemon'],
                'orden' => $fila['orden']
            ];
        }

        return array_values($equipos);
    }
    public function asociarAEquipo($idEquipo, $idPokemon, $orden)
    {
        $stmt = $this->pdo->prepare("INSERT INTO equipos_pokemones (id_equipos, id_pokemones, orden) VALUES (:id_equipos, :id_pokemones, :orden)");
        $stmt->execute([':id_equipos' => $idEquipo, ':id_pokemones' => $idPokemon, ':orden' => $orden]);

        return ['mensaje' => 'Pokemón asociado al equipo correctamente'];
    }
}
