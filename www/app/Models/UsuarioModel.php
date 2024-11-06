<?php
namespace Com\Daw2\Models;
use Com\Daw2\Core\BaseDbModel;
use \PDO;
class UsuarioModel extends BaseDbModel
{
    public function getUsuariosConnection(){
        $this ->pdo;
    }
    public function getUsers(): array{
       $stmt = $this ->pdo -> query('SELECT us.*,ar.nombre_rol ,ac.country_name
                                            FROM usuario us
                                            JOIN aux_rol ar ON us.id_rol = ar.id_rol
                                            LEFT JOIN aux_countries ac ON us.id_country = ac.id');
       $_users = $stmt -> fetchAll();
        return $_users;
    }
    public function getUsersBruto(): array{
        $stmt = $this ->pdo -> query('SELECT us.*,ar.nombre_rol ,ac.country_name
                                           FROM usuario us
                                           JOIN aux_rol ar ON us.id_rol = ar.id_rol
                                           LEFT JOIN aux_countries ac ON us.id_country = ac.id
                                           ORDER BY us.salarioBruto DESC');
        $_users = $stmt -> fetchAll();
        return $_users;
    }
    public function getUsersStandard(): array{

        $stmt = $this ->pdo -> query('SELECT us.*,ar.nombre_rol ,ac.country_name
                                           FROM usuario us
                                           JOIN aux_rol ar ON us.id_rol = ar.id_rol
                                           LEFT JOIN aux_countries ac ON us.id_country = ac.id
                                           WHERE us.id_rol = 5');
        $_users = $stmt -> fetchAll();
        return $_users;
    }
    public function getUsersCarlos(): array{
        $stmt = $this ->pdo -> query('SELECT us.*,ar.nombre_rol ,ac.country_name
                                           FROM usuario us
                                           JOIN aux_rol ar ON us.id_rol = ar.id_rol
                                           LEFT JOIN aux_countries ac ON us.id_country = ac.id
                                           WHERE us.username REGEXP "^Carlos"');
        $_users = $stmt -> fetchAll();
        return $_users;
    }
    public function getUsersByName($name): array{
       $stmt =$this->pdo ->prepare("SELECT * FROM usuario us WHERE us.username LIKE ?");
       $stmt->execute(['%'.$name.'%']);
       $_users = $stmt -> fetchAll();
        return $_users;
    }
    public function getUsersByRol($rol): array{
        $stmt =$this->pdo ->prepare("SELECT * FROM usuario us  JOIN aux_rol ar ON us.id_rol = ar.id_rol WHERE ar.id_rol = ?");
        $stmt->execute([$rol]);
        $_users = $stmt -> fetchAll();
        return $_users;
    }
    public function getUsersByIRPF($irpf): array{
        $stmt =$this->pdo ->prepare("SELECT * FROM usuario us WHERE us.retencionIRPF = ?");
        $stmt->execute([$irpf]);
        $_users = $stmt -> fetchAll();
        return $_users;
    }
}