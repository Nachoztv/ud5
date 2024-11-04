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
                    <td><?php echo number_format(($user['salarioBruto'])-($user['salarioBruto']*$user['retencionIRPF']/100),2,',','.'); ?></td>
            </tr>
            <?php
        }

        ?>
    </tbody>
</table>
