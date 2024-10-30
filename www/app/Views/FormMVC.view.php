<div class="row">
    <?php
    if (isset($exito) && $exito) {
    ?>
    <div class="col-12">
        <div class="alert alert-success">
            Usuario registrado con éxito.
        </div>
    </div>
    <?php
    }
    ?>
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
                                <label for="user">Username:</label>
                                <input type="text" class="form-control" name="user" id="user" value="" />
                                <p class = "text-danger small" ><?php echo $errors['username'] ?? '' ;?></p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" value="" />
                                <p class = "text-danger small" ><?php echo $errors['email'] ?? '' ;?></p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="typeSubs">Tipo De Suscripción:</label>
                                    <select name="typeSubs" id="typeSubs">
                                        <option value="">-</option>
                                        <?php
                                        foreach ($tiposSuscripcion as $ts){

                                            ?>
                                        <option value="<?php echo $ts?>"<?php echo (isset($input['typeSubs']) && $ts == $input['typeSubs']) ? 'selected' : ''; ?>> <?php echo ucfirst($ts)?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                <p class = "text-danger small" ><?php echo $errors['typeSubs'] ?? '' ;?></p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="tarjeta">Numero de la tarjeta de crédito:</label>
                                <input type="number" class="form-control" name="tarjeta" id="tarjeta" value="" />
                                <p class = "text-danger small" ><?php echo $errors['tarjeta'] ?? '' ;?></p>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="check">Acepto los términos:</label>
                                <input type="checkbox" class="form-control" name="check" id="check" value="" />
                                <p class = "text-danger small" ><?php echo $errors['check'] ?? '' ;?></p>
                            </div>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Insertar User"/>
            </form>
        </div>
    </div>
</div>