<?php require_once 'sections/header.php'; ?>
<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="row flex-grow-1">
        <div class="col-lg-2 col-md-3 sidebar">
            <h2 class="logo">یادداشت ها</h2>
            <div class="devider"></div>
            <?php require_once 'sections/menu.php' ?>
        </div>
        <div class="col-lg-10 col-md-9 content g-0">
            <div class="bg">
            </div>

            <div class="row mycards mx-auto">
                <div class="col-lg-5 col-md-8 col-sm-10 col-12 mx-auto">
                    <div class="box notes shadow-md">
                        <h2><i class="fas fa-user"></i>ساخت حساب جدید</h2>
                        <hr>
                        <?php showMessage(); ?>
                        <form action="inc/functions.php" method="post" class="text-center">
                            <input type="text" name="display-name" class="form-control w-75 mx-auto d-inline-block border border-danger" placeholder="نام شما">
                            <input type="text" name="username" class="form-control w-75 mx-auto mt-2 d-inline-block border border-danger" placeholder="نام کاربری">
                            <input type="password" name="password" class="form-control w-75 mx-auto mt-2 d-inline-block border border-danger" placeholder="کلمه عبور">
                            <input type="password" name="pass-conf" class="form-control w-75 mx-auto mt-2 d-inline-block border border-danger" placeholder="تکرار کلمه عبور">
                            <input type="submit" name="do-register" value="ساخت حساب جدید" class="btn btn-success w-75 mt-3">
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<?php require_once 'sections/footer.php'; ?>