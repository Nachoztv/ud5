<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Decimal\Decimal;

class UsuarioController extends BaseController
{
    public function testConnect(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $model->getUsuariosConnection();
    }

    public function showUsers(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = array('titulo' => 'Usuarios',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
        );
        $usuarios = $model->getUsers();
        $data['usuarios'] = $this->calcularNeto($usuarios);
        $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);
    }

    private function calcularNeto(array $usuarios): array
    {
        foreach ($usuarios as &$usuario) {
            $salarioBruto = new Decimal($usuario['salarioBruto']);
            $retencionIRPF = new Decimal($usuario['retencionIRPF'], 2);
            $neto = $salarioBruto - ($salarioBruto * $retencionIRPF / new Decimal('100', 2));
            $usuario['salarioNeto'] = $neto->toFixed(2, true, Decimal::ROUND_HALF_UP);
        }
        return $usuarios;
    }

    public function showUsersBruto(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = array('titulo' => 'Usuarios',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
        );
        $data['usuarios'] = $model->getUsersBruto();
        $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);
    }

    public function showUsersStandard(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = array('titulo' => 'Usuarios',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
        );
        $data['usuarios'] = $model->getUsersStandard();
        $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);
    }

    public function showUsersCarlos(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = array('titulo' => 'Usuarios',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
        );
        $data['usuarios'] = $model->getUsersCarlos();
        $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);
    }

    public function showUsersByName(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = array('titulo' => 'Usuarios',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
        );
        if (!empty($_GET['user'])) {
            $user = filter_var($_GET['user'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data['usuarios'] = $model->getUsersByName($user);
            if (empty($data['usuarios'])) {
                $data['errors']['user'] = 'No se ha encontrado ningún usuario con ese nombre';
            }
            $data['usuarios'] = $this->calcularNeto($data['usuarios']);
        } else {
            $data['errors']['user'] = 'Por favor introduzca un usuario';
        }
        $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);
    }

    public function showUsersByRol(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $model1 = new \Com\Daw2\Models\RolModel();
        $data = array('titulo' => 'Usuarios',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false))
        );
       $data['tiposRol'] = $model1->getUsersByRol();
        if (!empty($_GET['id_rol'])) {
            $rol = (int)$_GET['id_rol'];
            $data['usuarios'] = $model->getUsersByRol($rol);
            if (empty($data['usuarios'])) {
                $data['errors']['id_rol'] = 'No se ha encontrado ningún rol con ese numero';
            }
            $data['usuarios'] = $this->calcularNeto($data['usuarios']);
        } else {
            $data['errors']['id_rol'] = 'Por favor introduzca un rol';
        }
        $data['input']['id_rol'] = $_GET['id_rol'] ?? '';
        $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);
    }

    public function showUsersByIRPF(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = array('titulo' => 'Usuarios',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
        );
        if (!empty($_GET['irpf'])) {
            $irpf = (int)filter_var($_GET['irpf'], FILTER_SANITIZE_NUMBER_INT);
            $data['usuarios'] = $model->getUsersByIRPF($irpf);
            if (empty($data['usuarios'])) {
                $data['errors']['irpf'] = 'No se ha encontrado ningún usuario con ese irpf';
            }
            $data['usuarios'] = $this->calcularNeto($data['usuarios']);
        } else {
            $data['errors']['irpf'] = 'Por favor introduzca un irpf';
        }
        $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);
    }
    public function showUsersBySalary(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = array('titulo' => 'Usuarios',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
        );
        if (!empty($_GET['salMin']) && !empty($_GET['salMax'])) {
            $salMin = filter_var($_GET['salMin'], FILTER_SANITIZE_NUMBER_FLOAT);
            $salMax = filter_var($_GET['salMax'], FILTER_SANITIZE_NUMBER_FLOAT);
            if ($salMin > $salMax) {
                $data['errors']['salary'] = 'El salario minimo, no puede ser mayor que el salario maximo';
            }
            $data['usuarios'] = $model->getUsersBySal($salMin, $salMax);
            if (empty($data['usuarios'])) {
                $data['errors']['salary'] = 'No se ha encontrado ningún usuario con ese rango de salario';
            }
            $data['usuarios'] = $this->calcularNeto($data['usuarios']);
        } else {
            $data['errors']['salary'] = 'Por favor introduzca un rango de salario';
        }
        $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);
    }
    public function showUsersByCountry(): void
    {
        $model = new \Com\Daw2\Models\CountryModel();
        $data = array('titulo' => 'Usuarios',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
        );
        if (!empty($_GET['nacionalidad'])) {
            $nacionalidad = filter_var($_GET['nacionalidad'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data['usuarios'] = $model->getUsersByCountry($nacionalidad);
            if (empty($data['usuarios'])) {
                $data['errors']['nacionalidad'] = 'No se ha encontrado ningún usuario con esta nacionalidad: ' . $nacionalidad;
            }
            $data['usuarios'] = $this->calcularNeto($data['usuarios']);
        } else {
            $data['errors']['nacionalidad'] = 'Por favor introduzca una nacionalidad';
        }
        $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);
    }
}
