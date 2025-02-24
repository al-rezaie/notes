<?php require_once 'sections/header.php'; checkLogin();
$userData = getUserData(); ?>
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

                <div class="row mycards mx-auto">
                    <div class="col-lg-8 col-md-12">
                        <div class="box notes shadow-md">
                            <h2><i class="fas fa-calendar-day"></i>خلاصه امروز</h2>
                            <ul class="list">
                                <?php 
                                $notes = getUserNotes(3);
                                foreach($notes as $note){
                                    echo "<li>" . $note['note_text'] . "</li>";
                                 } 
                                 ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mt-lg-0  mt-2">
                        <div class="box quick-access shadow-md">
                            <h2><i class="fas fa-circle-plus"></i>افزودن یادداشت</h2>
                            <?php showMessage() ?>
                            <form action="inc/functions.php" method="POST">
                                <input type="text" name="user-note"class="note border border-danger" placeholder="بنویسید و enter بزنید ...">
                                <select name="category" class="form-control mt-2 text-center" id="exampleFormControlSelect1">
                                    <option hidden>دسته بندی یادداشت را انتخاب کنید</option>
                                    <?php 
                                        $categories = getCategories();
                                        foreach($categories as $category){
                                    ?>
                                    <option value="<?php echo $category['category_name'] ?>"><?php echo $category['category_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <button type="submit" class="btn btn-success w-100 mt-2">افزودن</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

<?php require_once 'sections/footer.php'; ?>