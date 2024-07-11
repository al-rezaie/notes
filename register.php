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
                    <div class="col-5 mx-auto">
                        <div class="box notes shadow-md">
                            <h2><i class="fas fa-user"></i>ساخت حساب جدید</h2>
                            <hr>
                            <?php showMessage() ?>
                            <form action="inc/functions.php" method="post" class="text-center">
                                <input type="text" name="display-name" class="form-control w-75 mx-auto" placeholder="نام شما">
                                <input type="text" name="username" class="form-control w-75 mx-auto mt-2" placeholder="نام کاربری">
                                
                                <div class="d-flex position-relative pass-container"><input type="password" name="password" class="form-control w-75 mx-auto mt-2 pass-input" placeholder="کلمه عبور"><span style="transform:translate(-50%,-50%);top:60%;left:17%;cursor:pointer;" class="d-inline-block position-absolute pass-icon"><i class="fas fa-eye"></i></span></div>

                                <div class="d-flex position-relative" id="pass-container"><input type="password" name="password-conf" class="form-control w-75 mx-auto mt-2" id="pass-input" placeholder="تکرار کلمه عبور"><span style="transform:translate(-50%,-50%);top:60%;left:17%;cursor:pointer;" class="d-inline-block position-absolute" id="pass-icon"><i class="fas fa-eye"></i></span></div>

                                <input type="submit" name="do-register" value="ساخت حساب جدید" class="btn btn-success w-75 mt-3">
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <?php require_once "section/footer.php"  ?>