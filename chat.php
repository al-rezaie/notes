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
                            <h2><i class="fas fa-comment"></i>چت با هوش مصنوعی</h2>
                            <?php showMessage(); ?>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


<?php require_once 'sections/footer.php'; ?>