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
                            <h2><i class="fas fa-clock"></i>پومودورو</h2>
                            <?php showMessage(); ?>
                            
                            <div class="col-12 text-center">
                                <h1><span class="minutes">25</span>:<span class="seconds">00</span></h1>
                            </div>
                            <div class="container text-center">
                                <div class="row text-center">
                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-lg-5 mt-md-3 mt-sm-3 mt-3"><button type="button" class="btn btn-success start w-75">کار</button></div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-lg-5 mt-md-3 mt-sm-3 mt-3"><button type="button" class="btn btn-primary rest w-75">استراحت</button></div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-lg-5 mt-md-3 mt-sm-3 mt-3"><button type="button" class="btn btn-warning restart w-75">شروع مجدد</button></div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-lg-5 mt-md-3 mt-sm-3 mt-3"><button type="button" class="btn btn-danger stop w-75">توقف</button></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <script src="./scripts/pomo.js"></script>

    <?php require_once 'sections/footer.php'; ?>