<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class RolModel extends BaseDbModel
{
    public function getUsersByRol(): array{
        $stmt =$this->pdo ->query("SELECT * FROM aux_rol ar ORDER BY ar.nombre_rol");
        return $stmt -> fetchAll();
    }
}