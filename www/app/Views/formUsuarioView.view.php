<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" action="">
                <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="username"
                                        id="username"
                                        value="<?php echo $input['username'] ?? ''; ?>"
                                />
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group">
                                <label for="id_rol">Tipo:</label>
                                <select name="id_rol" id="id_rol" class="form-control">
                                    <option value="">-</option>
                                    <?php foreach ($tiposRol as $role) {
                                        ?>
                                        <option value="<?php echo $role['id_rol'] ?>" <?php echo (isset($input['id_rol']) && $role['id_rol'] == $input['id_rol']) ? 'selected' : ''; ?>><?php echo ucfirst($role['nombre_rol']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label for="salario_min">Salario:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="min_salar" id="min_salar" value="<?php echo $input['min_salar'] ?? ''; ?>" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="max_salar" id="max_salar" value="<?php echo $input['max_salar'] ?? ''; ?>" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
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
                        <div class="col-12 col-lg-3">
                            <div class="form-group">
                                <label for="id_country">Tipo:</label>
                                <select name="id_country[]" id="id_country" class="form-control select2" data-placeholder="Países" multiple>
                                    <?php
                                    foreach ($countries as $country) {
                                        ?>
                                        <option value="<?php echo $country['id_country']; ?>" <?php echo (isset($input['id_country']) && in_array($country['id_country'], $input['id_country'])) ? 'selected' : ''; ?>>
                                            <?php echo $country['country_name']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="<?php echo $_ENV['host.folder']; ?>insert-users" value="" name="reiniciar" class="btn btn-danger">Reiniciar</a>
                        <input type="submit" value="Insertar User" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>