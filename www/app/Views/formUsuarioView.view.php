<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="post">
                <input type="hidden" name="order" value="1"/>
                <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Insercion</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label for="user">Username:</label>
                                <input type="text" class="form-control" name="user" id="user"
                                       value="<?php echo $_GET['user'] ?? ''; ?>"/>
                                <p class="text-danger small"><?php echo $errors['user'] ?? ''; ?></p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group">
                                <label for="retencionIRPF">Tipo De IRPF:</label>
                                <br>
                                <select name="retencionIRPF" id="retencionIRPF">
                                    <option value="">-</option>
                                    <?php
                                    foreach ($tiposIrpf as $irpf) {
                                        ?>
                                        <option value="<?php echo $irpf['retencionIRPF']; ?>" <?php echo (isset($input['retencionIRPF']) && $irpf['retencionIRPF'] == $input['retencionIRPF']) ? 'selected' : ''; ?>> <?php echo ucfirst($irpf['retencionIRPF']) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="text-danger small"><?php echo $errors['retencionIRPF'] ?? ''; ?></p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label for="id_rol">Tipo De Rol:</label>
                                <br>
                                <select name="id_rol" id="id_rol">
                                    <option value="">-</option>
                                    <?php
                                    foreach ($tiposRol as $rol) {
                                        ?>
                                        <option value="<?php echo $rol['id_rol'] ?>" <?php echo (isset($input['id_rol']) && $rol['id_rol'] == $input['id_rol']) ? 'selected' : ''; ?>> <?php echo ucfirst($rol['nombre_rol']) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="text-danger small"><?php echo $errors['id_rol'] ?? ''; ?></p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label for="salMin">Salario Minimo:</label>
                                <input type="number" class="form-control" name="salMin" id="salMin"
                                       value="<?php echo $_GET['salMin'] ?? ''; ?>"/>
                                <label for="salMax">Salario Maximo:</label>
                                <input type="number" class="form-control" name="salMax" id="salMax"
                                       value="<?php echo $_GET['salMax'] ?? ''; ?>"/>
                            </div>
                            <p class="text-danger small"><?php echo $errors['salary'] ?? ''; ?></p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_country">Nacionalidad:</label>
                                <br>
                                <select name="id_country" id="id_country">
                                    <option value="">-</option>
                                    <?php
                                    foreach ($countries as $country) {
                                        ?>
                                        <option value="<?php echo $country['country_name'] ?>" <?php echo (isset($input['id_country']) && $country['id_country'] == $input['id_country']) ? 'selected' : ''; ?>> <?php echo ucfirst($country['country_name']) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <p class="text-danger small"><?php echo $errors['id_country'] ?? ''; ?></p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-12 text-right">
                            <input type="submit" name="submit" class="btn btn-primary " value="Insertar"/>
                            </div>
                        </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>