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
                            <table class="table table-striped table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">کدکاربری</th>
                                        <th scope="col">نام کاربری</th>
                                        <th scope="col">تعداد یادداشت ها</th>
                                        <th scope="col">عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    
                                        $allUsers = getUsers();
                                        foreach($allUsers as $allUser){
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $allUser['id'] ?></th>
                                        <td><?php echo $allUser['username'] ?></td>
                                        <td><?php echo notesCount($allUser['id']) ?></td>
                                        <td><a href="?deleteUser=<?php echo $allUser['id']; ?>"><button type="button" class="btn btn-sm btn-danger">حذف کاربر</button></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                </div>


            </div>
        </div>
    </div>
<?php require_once 'sections/footer.php'; ?>