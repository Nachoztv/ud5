<?php

declare (strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use \Com\Daw2\Models\PobPontevModel;

class PobPontevControllerForm extends BaseController
{
    public function showPoblacionPontevedra()
    {
        $_vars = array('titulo' => 'Histórico población Pontevedra',
            'breadcumb' => array('Inicio' => array('url' => '#', 'active' => false)),
            'csv_div_titulo' => 'Datos del CSV',
            'js' => array('plugins/datatables/js/jquery.dataTables.min.js', 'plugins/datatables/js/dataTables.bootstrap4.min.js')
        );
        $csvModel = new PobPontevModel('../app/Data/poblacion_pontevedra.csv');
        $_vars["data"] = $csvModel->pobPontevedra();
        $this->view->showViews(array('templates/header.view.php', 'csvForm.view.php', 'templates/footer.view.php'), $_vars);
    }
    public function insertPoblacionPontevedraForm()
    {
                $municipio =$_POST ['municipio'];
                $sexo = $_POST ['sexo'];
                $periodo =$_POST ['periodo'];
                $total =$_POST ['total'];
                $registro = array($municipio,$sexo,$periodo,$total);
                $resource = fopen('../app/Data/poblacion_pontevedra.csv', 'a');
                fputcsv($resource, $registro,";");
                fclose($resource);
            $this->showPoblacionPontevedra();
            }
}