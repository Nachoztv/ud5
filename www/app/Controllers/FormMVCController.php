<?php

declare (strict_types=1);
namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class FormMVCController extends BaseController
{

    private const TIPOS_SUSCRIPCION = ['free','silver','gold'];
    public function showFormMVC(): void
    {

        $data = array('titulo' => 'Formularios MVC(Alta Usuario)',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
            'tiposSuscripcion' => self::TIPOS_SUSCRIPCION
        );
        $this->view->showViews(array('templates/header.view.php', 'FormMVC.view.php', 'templates/footer.view.php'), $data);
    }


    public function checkform(array $data): array
    {
        $errors = [];
        if (!preg_match('/^[\p{L}\p{N}_]/iu', $data['user'])) {
            $errors['username'] = 'El nombre debe tener letras, numeros o _.';
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Introduce un email válido';
        }
        if (!in_array($data['typeSubs'], self::TIPOS_SUSCRIPCION)) {
            $errors['typeSubs'] = 'El tipo de usuario de suscripcion es requerido';
        }
        if (!empty($data['input_tarjeta'])) {
            if (!preg_match('/^\d{16}$/', $data['tarjeta'])) {
                $errors['tarjeta'] = "El formato de la tarjeta no es el correcto";
            }
        }else{
            if (in_array($data['typeSubs'],['gold','silver'])){
                $errors['tarjeta'] = 'Tienes que insertar un numero de tarjeta ya que es requerido por la sub';
            }
        }
        if (!isset($data['check'])){
            $errors['check'] = 'Acepta los terminos para continuar';
        }
        return $errors;
    }

    public function insertFormMVC(): void
    {

        $data = array('titulo' => 'Formularios MVC(Alta Usuario)',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
            'tiposSuscripcion' => self::TIPOS_SUSCRIPCION
        );

            $data['errors'] = $this->checkform($_POST);
            $data['exito'] = empty($data['errors']);
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['input']['typeSubs'] = $_POST['typeSubs'];
            $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $this->view->showViews(array('templates/header.view.php', 'FormMVC.view.php', 'templates/footer.view.php'), $data);
    }
}