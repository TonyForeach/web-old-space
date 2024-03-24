<div class="container-fluid bg-light mb-5 p-3 shadow-lg">
    <form method="get" action=<?php echo URL . "User/Index/1"; ?>>
        <div class="row d-lg-flex justify-content-lg-between gap-3 gap-lg-0">
            <div class="col-12 col-lg d-flex">
                <div class="col-9 col-sm-9 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                    <input type="text" id="filtrar" name="filtrar" placeholder="Buscar" class="form-control" />
                </div>
                <div class="col-3 col-sm-3 col-md-2 col-lg-2 col-xl-1 col-xxl-1">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search fa-sm"></i></buttton>
                </div>
            </div>
              <div class="col-12 col-lg-2 px-4 d-flex flex-column justify-content-end">
                <a href="<?php echo URL . 'User/ExportExcel' . (isset($_GET["date1"]) && isset($_GET["date2"]) ? '?date1='.$_GET["date1"] .'&date2='.$_GET["date2"] : '') ; ?>" 
                class="btn btn-sm btn-success shadow-sm d-none">
                  <i class="fas fa-download fa-sm text-white-50"></i> Exportar a Excel</a>
              </div>
        </div>
    </form>
</div>
<div class="container-fluid">
    <div class="row d-flex justify-content-between mb-3">
        <form action="<?php echo URL . 'User/Index' . (isset($_GET['registrosPorPagina']) ? '?registrosPorPagina='.$_GET["registrosPorPagina"] : ''); ?>" method="get" class="col-12 col-lg d-lg-flex mb-4 mb-lg-0">
            <div class="col-12 col-lg-9 align-content-lg-end align-items-lg-center input-group input-daterange" id="datepicker">
                <input type="text" class="input-sm form-control d-none" name="date1" autocomplete="off">
                <div class="input-group-addon d-none">a</div>
                <input type="text" class="input-sm form-control d-none" name="date2" autocomplete="off">
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-check-label"></label>
                <input type="submit" value="filtrar" class="btn btn-success btn-block d-none">
            </div>
        </form>
        <div class="col d-flex justify-content-end align-items-end">
            <div class="col d-lg-flex justify-content-lg-end">
                <label for="registrosPorPagina" class="d-none">Registros por página:</label>
            </div>

            <form class="col-4 col-lg-3" method="get" action=<?php echo URL . "User/Index" . (isset($_GET["date1"]) && isset($_GET["date2"]) ? '?date1='.$_GET["date1"] .'&date2='.$_GET["date2"] : '') . (isset($_GET['registrosPorPagina']) ? '?registrosPorPagina='.$_GET["registrosPorPagina"] : ''); ?>>
                <input type="hidden" name="date1" value="<?php echo (isset($_GET["date1"])) ? $_GET["date1"] : ''; ?>">
                <input type="hidden" name="date2" value="<?php echo (isset($_GET["date2"])) ? $_GET["date2"] : '' ?>">
                <select id="registrosPorPagina" name="registrosPorPagina" class="d-none form-select" onchange="this.form.submit()">
                    <option value="5" <?php echo (isset($_GET['registrosPorPagina']) && $_GET['registrosPorPagina'] == 5) ? 'selected' : ''; ?>>5</option>
                    <option value="10" <?php echo (isset($_GET['registrosPorPagina']) && $_GET['registrosPorPagina'] == 10) ? 'selected' : ''; ?>>10</option>
                    <option value="15" <?php echo (isset($_GET['registrosPorPagina']) && $_GET['registrosPorPagina'] == 15) ? 'selected' : ''; ?>>15</option>
                    <option value="20" <?php echo (isset($_GET['registrosPorPagina']) && $_GET['registrosPorPagina'] == 20) ? 'selected' : ''; ?>>20</option>
                    <option value="30" <?php echo (isset($_GET['registrosPorPagina']) && $_GET['registrosPorPagina'] == 30) ? 'selected' : ''; ?>>30</option>
                    <option value="50" <?php echo (isset($_GET['registrosPorPagina']) && $_GET['registrosPorPagina'] == 50) ? 'selected' : ''; ?>>50</option>
                    <!-- Agrega más opciones según tus necesidades -->
                </select>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col">
            <table class="table table-responsive-sm text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo de Documento</th>
                        <th>N° de Documento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    <?php
                    if (is_array($model1["results"])) {
                        foreach ($model1["results"] as $key => $value) {

                    ?>
                            <tr>
                                <th><?php echo $value["full_name"]; ?></th>
                                <th><?php echo $value["document_type"]; ?></th>
                                <th><?php echo $value["document_number"]; ?></th>
                                <th><a href="<?php echo URL . 'User/Details/' . $value["id"] ?>" class="btn btn-primary text-white">
                                        Detalles
                                    </a></th>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="text-center">
    <?php
    echo $model1["pagi_info"];
    echo "<br>";
    echo $model1["pagi_navegacion"];
    ?>
</div>