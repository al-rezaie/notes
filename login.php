<?php require_once "section/header.php";  ?>

    <div class="container-fluid min-vh-100 d-flex flex-column">
        <div class="row flex-grow-1">
            <div class="col-lg-2 col-md-3 sidebar">
                <h2 class="logo">یادداشت ها</h2>
                <div class="devider"></div>

                <?php require_once 'section/menu.php' ?>

            </div>
            <div class="col-lg-10 col-md-9 content g-0">
                <div class="bg">
                </div>

                <div class="row mycards mx-auto">
                    <div class="col-lg-5 col-md-7 col-sm-10 mx-auto">
                        <div class="box notes shadow-md">
                            <h2><i class="fas fa-user"></i>ورود به حساب کاربری</h2>
                            <hr>
                            <?php showMessage() ?>
                            <form action="inc/functions.php" method="post" class="text-center">
                                <input type="text" name="username" class="form-control w-75 mx-auto" placeholder="نام کاربری">

                                <div class="d-flex position-relative pass-container"><input type="password" name="passwrod" class="form-control w-75 mx-auto mt-2 pass-input" placeholder="کلمه عبور"><span class="pass-icon"><i style="transform:translate(-50%,-50%);top:50%;left:16%;cursor:pointer;" class="position-absolute d-inline-block fas fa-eye"></i></span></div>

                                <input type="submit" name="do-login" value="ورود به حساب کاربری" class="btn btn-success w-75 mt-3">
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <?php require_once "section/footer.php"  ?>