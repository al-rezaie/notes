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
                    <h1 class="title">
                        <?php echo $userData['title']; ?>
                        <?php echo getDisplayName(); ?>
                    </h1>
                    <h2 class="title">
                        <?php echo $userData['subtitle']; ?>
                    </h2>
                </div>
            </div>

            <div class="row mycards mx-auto notes">
                <div class="col-lg-12">
                    <div class="box">
                        <h2><i class="fas fa-clock"></i>پومودورو<sup><a target="_blank" href="https://cafetadris.com/blog/%D8%AA%DA%A9%D9%86%DB%8C%DA%A9-%D9%BE%D9%88%D9%85%D9%88%D8%AF%D9%88%D8%B1%D9%88-%DA%86%DB%8C%D8%B3%D8%AA/" title="پومودورو چیست؟"><i style="font-size:18px;" class="fa-solid fa-circle-question"></i></a></sup></h2>

                        <div dir="ltr" class="conatiner-fluid text-center m-5" id="timer-container">
                            <div class="h1" id="timer-value"></div>
                            
                            <!-- <div class="btn-container d-flex flex-row-reverse justify-content-around mt-5" > -->
                            <div class="container mt-4">
                                <div class="row d-flex flex-row-reverse justify-content-around">
                                    <button class="btn btn-success col-lg-2 col-md-12 mt-2" id="start-button">شروع</button>
                                    <button class="btn btn-info col-lg-2 col-md-12 mt-2" id="rest-button">استراحت</button>
                                    <button class="btn btn-warning col-lg-2 col-md-12 mt-2" id="reset-button">تنظیم مجدد</button>
                                    <button class="btn btn-danger col-lg-2 col-md-12 mt-2" id="stop-button">توقف</button>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>


            </div>
        </div>
    </div>

    <script src="scripts/pomodoro.js"></script>

    <?php require_once "section/footer.php"  ?>