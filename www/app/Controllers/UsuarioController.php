<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\RolModel;
use Com\Daw2\Models\UsuarioModel;
use Decimal\Decimal;

class UsuarioController extends BaseController
{
    const ORDER_DEFECTO = 1;

    public function testConnect(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $model->getUsuariosConnection();
    }
const TIPOS_IRPF = [18,20,30];
    const TIPOS_ROL = [1,2,3,4,5,6];
    public function showUsers(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $modelRol = new \Com\Daw2\Models\RolModel();
        $modelCountry = new \Com\Daw2\Models\CountryModel();
        $data = array('titulo' => 'Usuarios',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
        );
        $data['tiposRol'] = $modelRol->getUsersByRol();
        $data['tiposIrpf'] = $model->getTypesOfIrpf();
        $data['tiposCountry'] = $modelCountry->getCountries();
        $data['input']['id_rol'] = $_GET['id_rol'] ?? '';
        $data['input']['retencionIRPF'] = $_GET['retencionIRPF'] ?? '';
        $data['input']['id'] = $_GET['id'] ?? '';
        $_vars = [];
        if (!empty($_GET['user'])) {
            $_vars['user'] = '%' . $_GET['user'] . '%';
        }
        if (!empty($_GET['id_rol'])) {
            $_vars['id_rol'] = ((int)$_GET['id_rol']);
        }
        if (!empty($_GET['salMin']) && filter_var($_GET['salMin'], FILTER_VALIDATE_FLOAT)) {
            $_vars['salMin'] = new Decimal($_GET['salMin']);
        }
        if (!empty($_GET['salMax']) && filter_var($_GET['salMax'], FILTER_VALIDATE_FLOAT)) {
            $_vars['salMax'] = new Decimal($_GET['salMax']);
        }
        if (!empty($_GET['retencionIRPF'])) {
            $_vars['retencionIRPF'] = $_GET['retencionIRPF'];
        }

        if (!empty($_GET['id'])) {
            $_vars['id'] = $_GET['id'];
        }
        if (empty($_vars)) {
            $usuarios = $model->getUsers();
        }
        $limit = 25;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;


        $order = $this->getOrderColumn();
        $data['order'] = $order;

        $numberOfPages = $model ->getUsersByAnyPages($_vars,$order);

        $data['numberOfPages'] = (int)$numberOfPages;

        $page = $this->getPage((int)$numberOfPages);

        $data['page'] = $page;


        $offset = ($page - 1) * $limit;

        $usuarios = $model->getUsersByAny($_vars, $order,(int)$offset,(int)$limit);


        $_copiaGET = $_GET;
        unset($_copiaGET['page']);
        $data['queryStringNoPage'] = http_build_query($_copiaGET);

        if (!empty($data['queryString'])) {
            $data['queryStringNoPage'] .= '&';
        }

        unset($_copiaGET['order']);

        $data['queryString'] = http_build_query($_copiaGET);
        if (!empty($data['queryString'])) {
            $data['queryString'] .= '&';
        }


        $data['usuarios'] = $this->calcularNeto($usuarios);
        $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);
    }
    public function checkform(array $data): array
    {
        $errors = [];
        if (!preg_match('/^[\p{L}\p{N}_]/iu', $data['user'])) {
            $errors['user'] = 'El nombre debe tener letras, numeros o _.';
        }
        if (!filter_var($data['salBruto'], FILTER_VALIDATE_FLOAT)) {
            $errors['salary'] = 'Introduce un salario válido';
        }
        if (!isset($data['check'])) {
            $errors['check'] = 'Inidica si esta activo o no';
        }
        if (!in_array($data['retencionIRPF'], self::TIPOS_IRPF)) {
            $errors['retencionIRPF'] = 'Selecciona un irpf';
        }
        if (!in_array($data['id_rol'], self::TIPOS_ROL)) {
                $errors['id_rol'] = "Selecciona un rol";
        }
        if (!isset($data['check'])) {
            $errors['check'] = 'Acepta los terminos para continuar';
        }
        return $errors;
    }
    private function getOrderColumn(): int
    {
        if (isset($_GET['order']) && filter_var($_GET['order'], FILTER_VALIDATE_INT)) {
            if ($_GET['order'] > -(count(UsuarioModel::ORDER_COLUMNS)) && $_GET['order'] <= count(UsuarioModel::ORDER_COLUMNS)) {
                return (int)$_GET['order'];
            }
        }
        return self::ORDER_DEFECTO;
    }


    private function getPage(int $max): int
    {
        if (isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT)) {
            if ($_GET['page'] > 1 && $_GET['page'] <= $max) {
                return (int)$_GET['page'];
            }
        }
        return 1;
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
            } else {
                $data['usuarios'] = $model->getUsersBySal($salMin, $salMax);
                if (empty($data['usuarios'])) {
                    $data['errors']['salary'] = 'No se ha encontrado ningún usuario con ese rango de salario';
                }
                $data['usuarios'] = $this->calcularNeto($data['usuarios']);
            }
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
