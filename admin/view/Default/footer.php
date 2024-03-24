    <?php
        $user = Session::getSession("nombre");
        if (null != $user) {
    ?>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; sitio 2023</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terminos &amp; Condiciones</a>
                </div>
            </div>
        </div>
    </footer>
    </div>
    </div>
    <?php } ?>
    
    <script src="<?php echo URL.RQ?>js/jquery-3.6.0.min.js"></script>
    <script defer src="<?php echo URL.RQ?>js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo URL.RQ?>js/bootstrap-datepicker.js"></script>
    <script src="<?php echo URL.RQ?>js/system/menu.js"></script>
    <script src="<?php echo URL.RQ ?>js/function.js"></script>
    <script src="<?php echo URL.RQ?>js/User.js"></script>   
    <script src="<?php echo URL.RQ ?>js/app.js"></script>  
    </body>
</html>