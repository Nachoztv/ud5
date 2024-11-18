<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class formUsuarioController extends BaseController
{
    public function testConnect(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $model->getUsuariosConnection();
    }

    const TIPOS_IRPF = [18, 20, 30];

    public function checkform(array $data): array
    {
        $errors = [];
        if (!preg_match('/^[\p{L}\p{N}_]/iu', $data['user'])) {
            $errors['user'] = 'El nombre debe tener letras, numeros o _.';
        }
        if (!filter_var($data['salMin'], FILTER_VALIDATE_EMAIL)) {
            $errors['user'] = 'Introduce un email válido';
        }
        if (!in_array($data['retencionIRPF'], self::TIPOS_IRPF)) {
            $errors['retencionIRPF'] = 'El tipo de retencion irpf es requerido';
        }
        if (!empty($data['input_tarjeta'])) {
            if (!preg_match('/^\d{16}$/', $data['tarjeta'])) {
                $errors['tarjeta'] = "El formato de la tarjeta no es el correcto";
            }
        } else {
            if (in_array($data['typeSubs'], ['gold', 'silver'])) {
                $errors['tarjeta'] = 'Tienes que insertar un numero de tarjeta ya que es requerido por la sub';
            }
        }
        if (!isset($data['check'])) {
            $errors['check'] = 'Acepta los terminos para continuar';
        }
        return $errors;
    }

    public function showForm(): void
    {
        $modelRol = new \Com\Daw2\Models\RolModel();
        $model = new \Com\Daw2\Models\formUsuarioModel();
        $modelCountries = new \Com\Daw2\Models\CountryModel();
        $data['tiposIrpf'] = $model->getTypesOfIrpf();
        $data['tiposRol'] = $modelRol->getUsersByRol();
        $data['countries'] = $modelCountries->getCountries();
        $this->view->showViews(array('templates/header.view.php', 'formUsuarioView.view.php', 'templates/footer.view.php'),$data);
    }
}