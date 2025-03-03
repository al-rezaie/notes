<?php require_once 'sections/header.php';checkLogin();
$userData = getUserData();
?>
    <div class="container-fluid min-vh-100 d-flex flex-column">
        <div class="row flex-grow-1">

            <div class="col-lg-2 col-md-3 sidebar">
                <h2 class="logo">یادداشت ها</h2>
                <div class="devider"></div>
                <div class="searchbox">
                <?php require_once 'sections/search.php' ?>
                </div>
                <?php require_once 'sections/menu.php' ?>

                
            </div>

            
            <div class="col-lg-10 col-md-9 content g-0">
                <div class="bg">
                    <div class="titles">
                        <h1 class="title"><?php echo $userData['title'] ?> <?php echo getUserDisplayname(); ?></h1>
                        <h2 class="title"><?php echo $userData['subtitle'] ?></h2>
                    </div>
                </div>

                <div class="row mycards mx-auto notes">
                    <div class="col-lg-12">
                        <div class="box">
                            <h2><i class="fas fa-wrench"></i>تنظیمات</h2>
                            <?php showMessage(); ?>
                            <form action="inc/functions.php" method="post">
                            <div class="row p-4">
                                <div class="col-lg-4 col-md-12"><input type="text" name="display-name" value="<?php echo $userData['display_name']; ?>" class="form-control border border-danger" placeholder="نام شما"></div>

                                <div class="col-lg-4 col-md-12 mt-lg-0 mt-1"><input type="text" name="title" value="<?php echo $userData['title']; ?>" class="form-control" placeholder="عنوان اصلی"></div>

                                <div class="col-lg-4 col-md-12 mt-lg-0 mt-1"><input type="text" name="subtitle" value="<?php echo $userData['subtitle']; ?>" class="form-control" placeholder="عنوان فرعی"></div>
                            </div>
                            <input type="submit" name="do-update" class="btn btn-success ms-4" value="بروزرسانی"> 
                        </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <?php require_once 'sections/footer.php'; ?>