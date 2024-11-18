<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;
use PDO;

class formUsuarioModel extends BaseDbModel
{
    public function getUsuariosConnection()
    {
        $this->pdo;
    }
    public function getTypesOfIrpf(): array
    {
        $stmt = $this->pdo->query("SELECT DISTINCT us.retencionIRPF FROM usuario us ORDER BY us.retencionIRPF");
        return $stmt->fetchAll();
    }
}