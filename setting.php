<?php
    require_once "section/header.php"; checkLogin();
    $userData = getUserData();
?>

    <div class="container-fluid min-vh-100 d-flex flex-column">
        <div class="row flex-grow-1">
            <div class="col-lg-2 col-md-3 sidebar">
                <h2 class="logo">یادداشت ها</h2>
                <div class="devider"></div>
                <div class="searchbox">
                <?php require_once 'section/searchForm.php' ?>
                </div>
                <?php require_once 'section/menu.php'  ?>

                <!-- <div class="upgrade">
                    <a href="#" class=""><i class="fas fa-trophy"></i>خرید نسخه کامل</a>
                </div> -->
            </div>
            <div class="col-lg-10 col-md-9 content g-0">
                <div class="bg">
                    <!-- <a class="profile"><i class="fas fa-user"></i>مشاهده پروفایل</a> -->
                    <div class="titles">
                        <h1 class="title"><?php echo $userData['title']; ?> <?php echo getDisplayName(); ?></h1>
                        <h2 class="title"><?php echo $userData['subtitle']; ?></h2>
                    </div>
                </div>

                <div class="row mycards mx-auto notes">
                    <div class="col-lg-12">
                        <div class="box">
                            <h2><i class="fas fa-wrench"></i>تنظیمات</h2>
                            <?php showMessage(); ?>
                            <form action="inc/functions.php" method="post">
                            <div class="row p-4">
                                <div class="col-12 mb-2"><h5>بروزرسانی پیام برنامه</h5></div>
                                <div class="col-md-4 col-sm-12 my-sm-2"><input type="text" name="display-name" value="<?php echo $userData['display_name']; ?>" class="form-control" placeholder="نام شما"></div>
                                <div class="col-md-4 col-sm-12 my-sm-2"><input name="title" type="text" value="<?php echo $userData['title']; ?>" class="form-control" placeholder="عنوان اصلی"></div>
                                <div class="col-md-4 col-sm-12 my-sm-2"><input name="subtitle" type="text" value="<?php echo $userData['subtitle']; ?>" class="form-control" placeholder="عنوان فرعی"></div>
                            </div>
                            <div class="row p-4">
                                <div class="col-12 mb-2"><h5>بروزرسانی نام‌كاربری و رمزعبور</h5></div>
                                <div class="col-md-6 col-sm-12 my-sm-2"><input name="newUserName" type="text" class="form-control" placeholder="نام‌كاربری" value="<?php echo $userData['user_name'] ?>"/></div>
                                <div class="col-md-6 col-sm-12 my-sm-2 position-relative pass-container"><input dir='ltr' name="newPassword" type="password" class="form-control pass-input" placeholder="رمزعبور" value="<?php echo $userData['password'] ?>"/><span class="d-inline-block position-absolute pass-icon" style="transform:translate(-50%,-50%);right:5%;top:50%;cursor:pointer;"><i class="fas fa-eye"></i></span></div>
                            </div>
                            <input type="submit" name="do-update" class="btn btn-success ms-4" value="بروزرسانی"> 
                        </form>
                        </div>
                    </div>

                    
                </div>


            </div>
        </div>
    </div>


    <?php require_once "section/footer.php"  ?>