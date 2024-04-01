<!-- Outer Row -->
        <div class="row justify-content-center" style="background-color:black;">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="d-flex justify-content-center p-4"><center><img class="m-1" src="../img/primorivero.png" width="80px" /><img src="../img/logo_rivero.png" width="250px" /></center></div>
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12 d-lg-block bg-login-image">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-white mb-4" style="text-shadow: black 2px 2px;">¡Bienvenido! Accede al sistema de Mantenimiento</h1>
                                    </div>
                                    <form class="user d-flex justify-content-center" method="POST" action="validar.php">
                                        <div>
                                            <div class="form-group" style="min-width:250px;">
                                                <input type="text" class="form-control form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Escribe tu usuario..." required name="user">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="Contraseña" name="pass" required>
                                            </div>
                                            <p><center class="text-danger"><?=$_SESSION["msj"]?></center></p>
                                            <center><input type="submit" value="Entrar" class="btn btn-primary btn-lg "/></center>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small text-white" href="forgot-password.html">¿Olvidaste tu contraseña?</a>
                                    </div>
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>