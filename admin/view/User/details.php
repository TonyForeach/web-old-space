<div class="container-fluid bg-light p-3 mb-5 shadow-lg"> &nbsp; <a href="<?php echo URL ?>User" class="btn btn-link"><i class="fa fa-arrow-left fa-lg" aria-hidden="true"></i></a></div>
<div class="container text-dark">
    <h1 class="text-center mb-4"><?php echo $model1[0]["full_name"] ?></h1>
    <div class="row-cols-3 d-flex justify-content-center">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <table class="tableCursos">
                        <tbody>
                            <tr>
                                <th class="text-center">
                                    Informacion del Usuario
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Nombre Completo
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <p><?php echo $model1[0]["full_name"] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Tipo de Documento
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <p><?php echo $model1[0]["document_type"] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Nº de Documento de Identidad
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <p><?php echo $model1[0]["document_number"]; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Fecha y Hora de Registro del Usuario
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <p><?php echo $model1[0]["created_at"] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    Session::setSession('model1', serialize(array(
                                        "id" => $model1[0]["id"],
                                        "full_name" => $model1[0]["full_name"],
                                        "document_type" => $model1[0]["document_type"],
                                        "document_number" => $model1[0]["document_number"],
                                        "created_at" => $model1[0]["created_at"]
                                    )));
                                    Session::setSession('model2', serialize(array()));
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>