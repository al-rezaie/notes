<?php
require_once 'db.php';
session_start();

//inputs secuirity
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// add new user
if (isset($_POST['do-register'])) {

    $displayName = test_input($_POST['display-name']);
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $passConf = test_input($_POST['pass-conf']);

    if (empty($displayName) || empty($username) || empty($password) || empty($passConf)){
        setMessage('فرم های اجباری را پر کنید');
        header('Location: ../register.php');
    } else {
        $check_username = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");

        if (mysqli_num_rows($check_username) > 0) {
            setMessage('کاربری با این نام کاربری قبلا ثبت نام کرده است...');
            header("Location: ../register.php");
        } else {
    
            if ($password != $passConf) {
                setMessage('رمز عبور و تکرار آن باهم برابر نیستند');
                header("Location: ../register.php");
            } else {
                $insert = mysqli_query($db, "INSERT INTO users (display_name, username, password) VALUES ('$displayName', '$username', '$password')");
    
                if ($insert) {
                    setMessage('ثبت نام با موفقیت انجام شد. هم اکنون وارد شوید');
                    header("Location: ../login.php");
                } else {
                    echo 'error';
                }
            }
        }
    }
}

// check login
if (isset($_POST['do-login'])) {
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);

    if (empty($username) || empty($password)){
        setMessage('فرم های اجباری را پر کنید');
        header('Location: ../login.php');
    } else{
        $checkUser = mysqli_query($db, "SELECT * FROM users WHERE username='$username' AND password='$password'");

        if (mysqli_num_rows($checkUser) > 0) {
            session_start();
            $_SESSION['loggedin'] = $username;
            if ($password == 'root' && $username == 'admin'){
                header("Location: ../admin-panel.php");
            }
            if ($username != 'admin'){
                header("Location: ../index.php");
            }
        } else {
            setMessage('نام کاربری یا کلمه عبور اشتباه است.');
            header("Location: ../login.php");
        }
    }
}

// do logout
if (isset($_GET['logout'])) {
    // session_start();
    unset($_SESSION['loggedin']);
    header("Loaction: login.php");
}

// add note
if (isset($_POST['user-note'])) {
    $userNote = test_input($_POST['user-note']);
    $category = test_input($_POST['category']);
    $userId = getUserId();

    if (empty($userNote)){
        setMessage('فرم های اجباری را پر کنید');
        header('Location: ../index.php');
    } else{
        if($category == 'دسته بندی یادداشت را انتخاب کنید') {
            $category = 'عمومی';
        }
        // vars are Case sensitive
        $addNote = mysqli_query($db, "INSERT INTO notes (note_text, user_id, category) VALUES ('$userNote', '$userId', '$category')");
        if ($addNote) {
            header("Location: ../index.php");
        }
    }
}


// set message
function setMessage($message)
{
    // session_start();
    $_SESSION['message'] = $message;
}

// show message
function showMessage()
{
    // session_start();
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-warning m-3'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
}


// check login
function checkLogin()
{
    // session_start();
    if (!isset($_SESSION['loggedin'])) {
        header("Location: login.php");
    }
}

//get categories
function getCategories() {
    global $db;

    $getCategory = mysqli_query($db, "SELECT * FROM categories ORDER BY id ASC");
    $categories = [];
    while ($category = mysqli_fetch_array($getCategory)) {
        $categories[] = $category;
    }

    return $categories;
}

// get user notes
function getUserNotes($limit = false, $category=' ')
{
    global $db;

    $userId = getUserId();
    if ($limit) { // if limit was not false
        $getNotes = mysqli_query($db, "SELECT * FROM notes WHERE user_id='$userId' AND is_done='0' ORDER BY id DESC LIMIT $limit");
    } else {
        $getNotes = mysqli_query($db, "SELECT * FROM notes WHERE user_id='$userId' AND is_done='0' AND category='$category' ORDER BY id DESC");
    }

    $userNotes = [];
    while ($notes = mysqli_fetch_array($getNotes)) {
        $userNotes[] = $notes;
    }

    // return as an array
    return $userNotes;
}

// get done notes
function getDoneNotes()
{
    global $db;
    $userId = getUserId();

    $getNotes = mysqli_query($db, "SELECT * FROM notes WHERE user_id='$userId' AND is_done='1' ORDER BY id DESC");

    $userNotes = [];
    while ($notes = mysqli_fetch_array($getNotes)) {
        $userNotes[] = $notes;
    }

    return $userNotes;
}


// get user id from username
function getUserId()
{
    global $db;

    // session_start();
    $username = $_SESSION['loggedin'];

    $getUser = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");
    $userArray = mysqli_fetch_array($getUser);
    return $userArray['id'];
}

// get user display name
function getUserDisplayname()
{
    global $db;

    $username = $_SESSION['loggedin'];

    $getUser = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");
    $userArray = mysqli_fetch_array($getUser);
    return $userArray['display_name'];
}


// make note done
if (isset($_GET['done'])) {
    // echo $_GET['done'];
    $noteId = $_GET['done']; // note id
    $updateNote = mysqli_query($db, "UPDATE notes SET is_done='1' WHERE id='$noteId'");
    if ($updateNote) {
        header("Location: notes.php");
    }
}

// delete note
if (isset($_GET['delete'])) {
    $noteId = $_GET['delete'];
    $deleteNote = mysqli_query($db, "DELETE FROM notes WHERE id='$noteId'");
    if ($deleteNote) {
        header("Location: notes.php");
    }
}

// serach
if (isset($_GET['search'])) {
    function getSearchResult()
    {
        global $db;
        $searchInput = test_input($_GET['search']);
        $userId = getUserId();

        $search = mysqli_query($db, "SELECT * FROM notes WHERE note_text LIKE '%$searchInput%' AND user_id=$userId AND is_done=0");

        $searchResults = [];
        while ($result = mysqli_fetch_array($search)) {
            $searchResults[] = $result;
        }

        return $searchResults;
    }
}


// Get user data for setting page
function getUserData(){
    global $db;
    $userId = getUserId();

    $getUsername = mysqli_query($db, "SELECT * FROM users WHERE id='$userId'");

    $userData = mysqli_fetch_array($getUsername);

    return $userData;
}

// update user data
if(isset($_POST['do-update'])){
    $newDisplayName = test_input($_POST['display-name']);
    $newTitle = test_input($_POST['title']);
    $newSubTitle = test_input($_POST['subtitle']);

    if (empty($newDisplayName)){
        setMessage('فرم ها اجباری را پر کنید');
        header('Location: ../setting.php');
    } else{
        $userId = getUserId();
        $updateSetting = mysqli_query($db, "UPDATE users SET display_name='$newDisplayName', title='$newTitle', subtitle='$newSubTitle' WHERE id='$userId'");
    
        if($updateSetting){
            setMessage('اطلاعات با موفقیت بروزرسانی شد');
            header("Location: ../setting.php");
        }
    }
}

//admin functions

//get users
function getUsers(){
    global $db;

    $users = mysqli_query($db, "SELECT * FROM users WHERE username!='admin'");

    $userNames = [];
    while ($user = mysqli_fetch_array($users)) {
        $userNames[] = $user;
    }

    return $userNames;
}

//get the number of notes
function notesCount($id) {
    global $db;
    $noteCounts = mysqli_query($db, "SELECT * FROM notes WHERE user_id=$id");
    return mysqli_num_rows($noteCounts);
}

// delete user
if (isset($_GET['deleteUser'])) {
    $userId = $_GET['deleteUser'];
    $deleteUser = mysqli_query($db, "DELETE FROM users WHERE id='$userId'");
    if ($deleteUser) {
        header("Location: admin-panel.php");
    }
}

// delete category
if (isset($_GET['deleteCategory'])) {
    $categoryId = $_GET['deleteCategory'];
    $deleteCategory = mysqli_query($db, "DELETE FROM categories WHERE id='$categoryId'");
    if ($deleteCategory) {
        header("Location: admin-category.php");
    }
}

//get user notes
function getAllNotes($id) {
    global $db;
    $userId = $id;

    $getNotes = mysqli_query($db, "SELECT * FROM notes WHERE user_id='$userId' ORDER BY id DESC");

    $userNotes = [];
    while ($notes = mysqli_fetch_array($getNotes)) {
        $userNotes[] = $notes;
    }

    return $userNotes;
}

// delete note
if (isset($_GET['deleteNote'])) {
    $noteId = $_GET['deleteNote'];
    $deleteNote = mysqli_query($db, "DELETE FROM notes WHERE id='$noteId'");
    if ($deleteNote) {
        header("Location: admin-notes.php");
    }
}

//add category
if (isset($_POST['category-name'])){
    $categoryName = test_input($_POST['category-name']);
    if (empty($categoryName)){
        setMessage('فرم های اجباری را پر کنید');
    } else{
        $addCategory = mysqli_query($db, "INSERT INTO categories (category_name) VALUES ('$categoryName')");
    }
    header("Location: ../admin-category.php");
}