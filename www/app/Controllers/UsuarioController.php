<?php
declare (strict_types=1);
namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class UsuarioController extends BaseController
{
    public function testConnect(): void{
        $model = new \Com\Daw2\Models\UsuarioModel();
        $model->getUsuariosConnection();
    }
    public function showUsers(): void
    {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = array('titulo' => 'Usuarios',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
        );
        $data['usuarios'] = $model->getUsers();
        $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);
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



} 