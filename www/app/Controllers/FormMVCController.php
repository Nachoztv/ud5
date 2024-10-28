<?php

declare (strict_types=1);
namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class FormMVCController extends BaseController
{


public function showFormMVC(): void
{
    $_vars = array('titulo' => 'Formularios MVC',
        'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
        'div_titulo' => 'Formularios MVC',
        'js' => array('plugins/datatables/js/jquery.dataTables.min.js', 'plugins/datatables/js/dataTables.bootstrap4.min.js')
    );
    /*$data = [];
    if (isset($_POST['submit'])) {
        $errors = checkform($_POST);
        if (count($errors) > 0) {
            $data['errors'] = $errors;
        } else {
            $json_array = json_decode($_POST["json"], true);
            $data['resultado'] = calculeArray($json_array);
        }
    }
    */
        $this->view->showViews(array('templates/header.view.php', 'FormMVC.view.php', 'templates/footer.view.php'), $_vars);
    }


    public function checkErrors(array $data) : array
    {
        $errors = "";
        $data['input_user'] = filter_var($_POST['user'], FILTER_SANITIZE_SPECIAL_CHARS);
        $data['input_email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $data['input_tarjeta'] = filter_var($_POST['tarjeta'], FILTER_SANITIZE_NUMBER_INT);
        if (!preg_match('/^\d{16}$/', $data['input_tarjeta'])) {
            $data['errors'] = "El formato de la tarjeta no es el correcto";
        }
return $errors;
    }
    public function insertFormMVC(): void
    {

    }
    }