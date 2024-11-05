<?php
declare (strict_types=1);
namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Decimal\Decimal;

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
        $usuarios = $model->getUsers();
        $data['usuarios'] = $this->calcularNeto($usuarios);
        $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);
    }
    private function calcularNeto(array $usuarios): array{
        foreach ($usuarios as &$usuario){
            $salarioBruto = new Decimal($usuario['salarioBruto']);
            $retencionIRPF = new Decimal($usuario['retencionIRPF'],2);
            $neto = $salarioBruto - ($salarioBruto * $retencionIRPF/new Decimal('100',2));
            $usuario['salarioNeto'] = $neto->toFixed(2,true,Decimal::ROUND_HALF_UP);
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
public function showUsersByName(): void{
        $model = new \Com\Daw2\Models\UsuarioModel();
    $data = array('titulo' => 'Usuarios',
        'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
    );
    if(!empty($_GET['user'])) {
        $user = $_GET['user'];
        $data['usuarios'] = $model->getUsersByName($user);
        if(empty($data['usuarios'])) {
            $data['errors']['user'] = 'No se ha encontrado ningún usuario con ese nombre';
        }
        $data['usuarios'] = $this->calcularNeto($data['usuarios']);
    }else{
        $data['errors']['user'] = 'Por favor introduzca un usuario';
    }
    $this->view->showViews(array('templates/header.view.php', 'UsuarioView.view.php', 'templates/footer.view.php'), $data);

}


} 