
<form action="" method="">
    <label id="nombrePob"></label>
<input type="text" name="nombrePob" id="nombrePob">
</form>
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
    <tfoot>
    <tr>
        <td></td>
        <td></td>
        <td>Max</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Min</td>
        <td></td>
    </tr>
    </tfoot>
</table>
