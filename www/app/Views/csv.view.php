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
