<div class="col-12">
    <div class="card shadow mb-4">
        <form method="get">
            <input type="hidden" name="order" value="1"/>
            <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Filtro</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!--<form action="./?sec=formulario" method="post">                   -->
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="mb-3">
                            <label for="user">Username:</label>
                            <input type="text" class="form-control" name="user" id="user"
                                   value="<?php echo $_GET['user'] ?? ''; ?>"/>
                            <p class="text-danger small"><?php echo $errors['user'] ?? ''; ?></p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="mb-3">
                            <label for="retencionIRPF">Tipo De IRPF:</label>
                            <br>
                            <select name="retencionIRPF" id="retencionIRPF">
                                <option value="">-</option>
                                <?php
                                foreach ($tiposIrpf as $irpf) {
                                    ?>
                                    <option value="<?php echo $irpf['retencionIRPF']; ?>"<?php echo (isset($input['retencionIRPF']) && $irpf['retencionIRPF']) == $input['retencionIRPF'] ? 'selected' : ''; ?>> <?php echo ucfirst($irpf['retencionIRPF']) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <p class="text-danger small"><?php echo $errors['retencionIRPF'] ?? ''; ?></p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="mb-3">
                            <label for="id_rol">Tipo De Rol:</label>
                            <br>
                            <select name="id_rol" id="id_rol">
                                <option value="">-</option>
                                <?php
                                foreach ($tiposRol as $rol) {
                                    ?>
                                    <option value="<?php echo $rol['id_rol'] ?>"<?php echo (isset($input['id_rol']) && $rol['id_rol']) == $input['id_rol'] ? 'selected' : ''; ?>> <?php echo ucfirst($rol['nombre_rol']) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <p class="text-danger small"><?php echo $errors['id_rol'] ?? ''; ?></p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="mb-3">
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
                            <label for="nacionalidad">Nacionalidad:</label>
                            <input type="text" class="form-control" name="nacionalidad" id="nacionalidad"
                                   value="<?php echo $_GET['nacionalidad'] ?? ''; ?>"/>
                            <p class="text-danger small"><?php echo $errors['nacionalidad'] ?? ''; ?></p>
                        </div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary " value="Filtrar"/>
        </form>
    </div>
</div>
</div>
<table id="csvTable" class="table table-striped">
    <thead>
    <tr>
        <th>username</th>
        <th>Salario Bruto</th>
        <th>IRPF</th>
        <th>Rol</th>
        <th>Country</th>
        <th>Salario Neto</th>
    </tr>
    <thead>
    <tbody>
    <?php
    if (!empty($usuarios)) {
        foreach ($usuarios as $user) {
            ?>
            <tr class="<?php echo !$user['activo'] ? 'table-danger' : '' ?>">
                <td><?php echo $user['username']; ?></td>
                <td><?php echo number_format($user['salarioBruto'], 2, ',', '.'); ?></td>
                <td><?php echo number_format($user['retencionIRPF'], 0); ?>%</td>
                <td><?php echo $user['id_rol']; ?></td>
                <td><?php echo $user['id_country']; ?></td>
                <td><?php echo str_replace([',', '.', '_'], ['_', ',', '.'], $user['salarioNeto']); ?></td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>
