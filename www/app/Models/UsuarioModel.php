<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;
use PDO;

class UsuarioModel extends BaseDbModel
{
    public function getUsuariosConnection()
    {
        $this->pdo;
    }

    public const ORDER_COLUMNS = ['username', 'salarioBruto', 'retencionIRPF', 'nombre_rol', 'country_name'];
    private const SELECT_FROM = "SELECT us.*, ar.nombre_rol, ac.country_name
                                    FROM usuario us
                                    JOIN aux_rol ar ON us.id_rol = ar.id_rol
                                    LEFT JOIN aux_countries ac ON us.id_country = ac.id";
    private const COUNT_FROM = "SELECT count(*)
                                    FROM usuario us
                                    JOIN aux_rol ar ON us.id_rol = ar.id_rol
                                    LEFT JOIN aux_countries ac ON us.id_country = ac.id";

    public function getUsersByAny($_vars, $order, $offset, $limit): array
    {

        if (empty($_vars)) {
            $statement = $this->pdo->query(self::SELECT_FROM . ' ORDER BY ' . self::ORDER_COLUMNS[abs($order) - 1] . ' LIMIT '.  intval($offset) .','. intval($limit));
            if ($order < 0) {
                $statement = $this->pdo->query(self::SELECT_FROM . ' ORDER BY ' . self::ORDER_COLUMNS[abs($order) - 1] . ' DESC' . ' LIMIT '.  intval($offset) .','. intval($limit));
            }
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $condiciones = [];
            if (isset($_vars["user"])) {
                $condiciones[] = 'us.username LIKE :user';
            }
            if (isset($_vars["id_rol"])) {
                $condiciones[] = 'us.id_rol = :id_rol';
            }
            if (isset($_vars["salMin"])) {
                $condiciones[] = 'us.salarioBruto >= :salMin';
            }
            if (isset($_vars["salMax"])) {
                $condiciones[] = 'us.salarioBruto <= :salMax';
            }
            if (isset($_vars["retencionIRPF"])) {
                $condiciones[] = 'us.retencionIRPF = :retencionIRPF';
            }
            if (isset($_vars["id"])) {
                $condiciones[]='ac.id LIKE :id';
            }
            $sql = self::SELECT_FROM . ' WHERE ' . implode(' AND ', $condiciones) . ' ORDER BY ' . self::ORDER_COLUMNS[abs($order) - 1] . ' LIMIT '.  intval($offset) .','. intval($limit);
            if ($order < 0) {
                $sql = self::SELECT_FROM . ' WHERE ' . implode(' AND ', $condiciones) . ' ORDER BY ' . self::ORDER_COLUMNS[abs($order) - 1] . ' DESC' . ' LIMIT '.  intval($offset) .','. intval($limit);
            }
            $statement = $this->pdo->prepare($sql);

            $statement->execute($_vars);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getUsersByAnyPages($_vars, $order): int
    {

        if (empty($_vars)) {
            $statement = $this->pdo->query(self::COUNT_FROM);
            $numberOfPages = $statement->fetchColumn(0);
            return ceil($numberOfPages / 25);
        }
            $condiciones = [];
            if (isset($_vars["user"])) {
                $condiciones[] = 'us.username LIKE :user';
            }
            if (isset($_vars["id_rol"])) {
                $condiciones[] = 'us.id_rol = :id_rol';
            }
            if (isset($_vars["salMin"])) {
                $condiciones[] = 'us.salarioBruto >= :salMin';
            }
            if (isset($_vars["salMax"])) {
                $condiciones[] = 'us.salarioBruto <= :salMax';
            }
            if (isset($_vars["retencionIRPF"])) {
                $condiciones[] = 'us.retencionIRPF = :retencionIRPF';
            }
            if (isset($_vars["id"])) {
                $condiciones[]='ac.id LIKE :id';
            }
            $sql = self::COUNT_FROM . ' WHERE ' . implode(' AND ', $condiciones);
            $statement = $this->pdo->prepare($sql);
            $statement->execute($_vars);
            $numberOfPages = $statement->fetchColumn(0);
            return ceil($numberOfPages / 25);
        }

    public function getUsers(): array
    {
        $stmt = $this->pdo->query('SELECT us.*,ar.nombre_rol ,ac.country_name
                                            FROM usuario us
                                            JOIN aux_rol ar ON us.id_rol = ar.id_rol
                                            LEFT JOIN aux_countries ac ON us.id_country = ac.id');
        $_users = $stmt->fetchAll();
        return $_users;
    }

    public function getUsersBruto(): array
    {
        $stmt = $this->pdo->query('SELECT us.*,ar.nombre_rol ,ac.country_name
                                           FROM usuario us
                                           JOIN aux_rol ar ON us.id_rol = ar.id_rol
                                           LEFT JOIN aux_countries ac ON us.id_country = ac.id
                                           ORDER BY us.salarioBruto DESC');
        $_users = $stmt->fetchAll();
        return $_users;
    }

    public function getUsersStandard(): array
    {

        $stmt = $this->pdo->query('SELECT us.*,ar.nombre_rol ,ac.country_name
                                           FROM usuario us
                                           JOIN aux_rol ar ON us.id_rol = ar.id_rol
                                           LEFT JOIN aux_countries ac ON us.id_country = ac.id
                                           WHERE us.id_rol = 5');
        $_users = $stmt->fetchAll();
        return $_users;
    }

    public function getUsersCarlos(): array
    {
        $stmt = $this->pdo->query('SELECT us.*,ar.nombre_rol ,ac.country_name
                                           FROM usuario us
                                           JOIN aux_rol ar ON us.id_rol = ar.id_rol
                                           LEFT JOIN aux_countries ac ON us.id_country = ac.id
                                           WHERE us.username REGEXP "^Carlos"');
        $_users = $stmt->fetchAll();
        return $_users;
    }

    public function getUsersByName($name): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario us WHERE us.username LIKE ?");
        $stmt->execute(['%' . $name . '%']);
        $_users = $stmt->fetchAll();
        return $_users;
    }

    public function getUsersByRol($rol): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario us  JOIN aux_rol ar ON us.id_rol = ar.id_rol WHERE ar.id_rol = ?");
        $stmt->execute([$rol]);
        $_users = $stmt->fetchAll();
        return $_users;
    }

    public function getTypesOfIrpf(): array
    {
        $stmt = $this->pdo->query("SELECT DISTINCT us.retencionIRPF FROM usuario us ORDER BY us.retencionIRPF");
        return $stmt->fetchAll();
    }

    public function getUsersByIRPF($irpf): array
    {
        $stmt = $this->pdo->prepare("SELECT *  FROM usuario us WHERE us.retencionIRPF = ?");
        $stmt->execute([$irpf]);
        $_users = $stmt->fetchAll();
        return $_users;
    }

    public function getUsersBySal($salMin, $salMax): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario us WHERE us.salarioBruto BETWEEN ? AND ? ORDER BY us.salarioBruto DESC");
        $stmt->execute([$salMin, $salMax]);
        $_users = $stmt->fetchAll();
        return $_users;
    }
    public function addUser(array $data){
        $stmt = $this->db->prepare( "INSERT INTO usuario (username, salarioBruto, retencionIRPF,activo,id_rol,id_country) VALUES (:username, :salarioBruto, :retencionIRPF,:activo,:id_rol,:id_country)");


        $stmt->bindParam(':username', $data['user']);
        $stmt->bindParam(':salarioBruto', $data['salBruto']);
        $stmt->bindParam(':retencionIRPF', $data['retencionIRPF']);
        $stmt->bindParam(':activo', $data['active']);
        $stmt->bindParam(':id_rol', $data['id_rol']);
        $stmt->bindParam(':id_country', $data['id']);

        return $stmt->execute();
    }
}
