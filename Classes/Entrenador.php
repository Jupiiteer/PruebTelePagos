<?php

class Entrenador
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function crearEntrenador($nombre)
    {
        $stmt = $this->pdo->prepare("INSERT INTO entrenadores (nombre) VALUES (:nombre)");
        $stmt->execute([':nombre' => $nombre]);

        return $this->pdo->lastInsertId();
    }
    public function listarEntrenadores()
    {
        $stmt = $this->pdo->query("SELECT * FROM entrenadores");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function detallarEntrenador($idEntrenador)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM entrenadores WHERE id = :id");
        $stmt->execute([':id' => $idEntrenador]);
        $entrenador = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$entrenador) {
            echo "Error no hay entrenador";
            return null;
        }

        $stmtEquipos = $this->pdo->prepare("SELECT * FROM equipos WHERE id_entrenadores = :id");
        $stmtEquipos->execute([':id' => $idEntrenador]);
        $equipos = $stmtEquipos->fetchAll(PDO::FETCH_ASSOC);

        $entrenador['equipos'] = $equipos;

        return $entrenador;
    }
}
