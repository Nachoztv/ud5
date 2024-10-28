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
                                <label for="user">Username:</label>
                                <input type="text" class="form-control" name="user" id="user" value="" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" value="" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="subs">Tipo De Suscripción:</label>
                                    <select name="typeSubs" id="subs">
                                        <option value="free">free</option>
                                        <option value="silver">silver</option>
                                        <option value="gold">gold</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="tarjeta">Numero de la tarjeta de crédito:</label>
                                <input type="number" class="form-control" name="tarjeta" id="tarjeta" value="" />
                                <p class = "text-danger small" ><?php echo $data['errors'] ?? '' ;?></p>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="check">Acepto los términos:</label>
                                <input type="checkbox" class="form-control" name="check" id="check" required value="" />
                                <p class = "text-danger small" ><?php echo $data['errors'] ?? '' ;?></p>
                            </div>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Insertar User"/>
            </form>
        </div>
    </div>
</div>