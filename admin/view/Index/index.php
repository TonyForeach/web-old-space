<style>
    body {
        background-color: black;
    }

    .form-floating>label {
        transition: .3s !important;
    }

    .form-control {
        transition: .3s !important;
    }
</style>
<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-10 col-sm-7 col-md-6 col-lg-4 col-xl-4">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header">
                    <h3 class="text-center my-4">Login</h3>
                </div>
                <div class="card-body">
                    <form action="Index/Login" method="POST">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputUser" type="text" name="user" placeholder="User01" value="<?php echo $model1->user ?? "" ?>" onkeypress="new User().ClearMessages(this);" />
                            <label for="inputUser">Ingresa Usuario</label>
                            <span id="user" class="text-danger"><?php echo $model2->user ?? "" ?></span>
                        </div>
                        <div class="form-floating mb-4">
                            <input class="form-control" id="inputPassword" type="password" name="password" placeholder="password" value="<?php echo $model1->password ?? "" ?>" onkeypress="new User().ClearMessages(this);" />
                            <label for="inputPassword">Ingresa Password</label>
                            <span id="password" class="text-danger"><?php echo $model2->password ?? "" ?></span>
                        </div>
                        <div class="">
                            <button class="btn py-2 w-100 text-light fw-bold fs-5" style="background-color:#8a0002;">INICIAR SESIÓN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>