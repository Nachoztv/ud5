<?php
declare (strict_types=1);
namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class UsuarioController extends BaseController
{
    public function testConnect(): void{
        $model = new \Com\Daw2\Models\UsuarioModel();
    }
} 