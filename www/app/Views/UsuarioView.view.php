<div class="col-12">
    <div class="card shadow mb-4">
        <form method="post">
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
                            <input type="text" class="form-control" name="user" id="user" value="" />
                            <p class = "text-danger small" ><?php echo $errors['username'] ?? '' ;?></p>
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
        foreach($usuarios as $user){
            ?>
                <tr class="<?php echo !$user['activo']  ? 'table-danger' : '' ?>">
            <td><?php echo $user['username']; ?></td>
                    <td><?php echo number_format($user['salarioBruto'],2,',','.'); ?></td>
                    <td><?php echo number_format($user['retencionIRPF'],0); ?>%</td>
                    <td><?php echo $user['id_rol']; ?></td>
                    <td><?php echo $user['id_country']; ?></td>
                    <td><?php echo str_replace([',','.','_'],['_',',','.'],$user['salarioNeto']);?></td>
            </tr>
            <?php
        }

        ?>
    </tbody>
</table>
