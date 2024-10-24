
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="post">
                <input type="hidden" name="order" value="1"/>
                <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Insertar</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="municipio">Municipio:</label>
                                <input type="text" class="form-control" name="municipio" id="municipio" value="" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="sexo">Sexo:</label>
                                <input type="text" class="form-control" name="sexo" id="sexo" value="" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="periodo">Periodo:</label>
                                <input type="text" class="form-control" name="periodo" id="periodo" value="" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="total">Total:</label>
                                <input type="number" class="form-control" name="total" id="total" value="" />
                            </div>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Insertar Municipio"/>
                    </form>
                 </div>
                </div>
            </div>
<table id="csvTable" class="table table-hover dataTable">
    <?php
    $first = true;
    foreach ($data as $file){
    if($first){
    ?>
    <thead>
    <tr>
        <?php
        foreach($file as $column){
            ?>
            <th><?php echo $column; ?></th>
            <?php

        }
        $first = false;
        ?>
    </tr>
    <thead>
    <tbody>
    <?php

    }
    else{
        ?>
        <tr>
            <?php
            foreach($file as $column){
                ?>
                <td><?php echo $column; ?></td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    }
    ?>
    </tbody>
</table>
