<?php require_once 'sections/header.php'; checkLogin();$userData = getUserData(); ?>
<div class="container-fluid min-vh-100 d-flex flex-column">
        <div class="row flex-grow-1">
            <div class="col-lg-2 col-md-3 sidebar">
                <h2 class="logo">پنل ادمین</h2>
                <div class="devider"></div>
                <div class="searchbox">
                </div>
                <ul id="menu">
                    <li class="menu-item"><a href="admin-panel.php"><i class="fas fa-home"></i>داشبورد</a></li>
                    <li class="menu-item"><a href="admin-notes.php"><i class="fas fa-book"></i>یادداشت ها</a></li>
                    <li class="menu-item"><a href="admin-category.php"><i class="fas fa-tags"></i>دسته بندی ها</a></li>
                    <li class="menu-item"><a href="admin-chat.php"><i class="fas fa-comment"></i>هوش مصنوعی</a></li>
                    <li class="menu-item"><a href="?logout"><i class="fas fa-power-off"></i>خروج</a></li>
                </ul>

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
                            <div id="accordion">
                                <?php
                                    $allUsers = getUsers();
                                    $i = 0;
                                    foreach ($allUsers as $allUser) {
                                ?>
                                <div class="card border-0">
                                    <a class="btn mt-2" data-bs-toggle="collapse" href="#collapse<?php echo $i ?>">
                                        <div class="card-header rounded-pill bg-success text-light">
                                            <?php echo $allUser['username'] ?>
                                        </div>
                                    </a>
                                    <div id="collapse<?php echo $i ?>" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <ul class="list">
                                                <?php 
                                                    $notes = getAllNotes($allUser['id']);
                                                    if(count($notes) == 0){
                                                        echo 'یادداشتی یافت نشد';
                                                    }
                                                    foreach($notes as $note){
                                                ?>
                                                    <li><a href="?deleteNote=<?php echo $note['id']; ?>"><i class="fas fa-trash"></i></a><?php echo $note['note_text'] ?></li>    
                                                <?php } ?>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; } ?>
                            </div>
                        </div>
                    </div>

                    
                </div>


            </div>
        </div>
    </div>
<?php require_once 'sections/footer.php'; ?>