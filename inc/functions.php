<?php 
require_once 'db.php';
session_start();


//passwrod validation
function validatePassword($pass) {
    $uppercase = preg_match('/[A-Z]/', $pass);
    $lowercase = preg_match('/[a-z]/', $pass);
    $number = preg_match('/[0-9]/', $pass);
    $special = preg_match('/[^a-zA-Z0-9]/', $pass);

    $length = strlen($pass);

    if ($length < 5) {
        setMessage('طول رمزعبور باید بیشتر از 5 باشد.');
        return false;
    } elseif (!$number) {
        setMessage('رمزعبور باید حاوی عدد باشد.');
        return false;
    } elseif (!$uppercase) {
        setMessage('رمزعبور باید حاوی حروف بزرگ باشد.');
        return false;
    } elseif (!$lowercase) {
        setMessage('رمزعبور باید حاوی حروف كوچک باشد.');
        return false;
    } elseif (!$special) {
        setMessage('رمزعبور باید حاوی علائم خاص (@#$%) باشد.');
        return false;
    }

    return true;
}


//add new user
if(isset($_POST['do-register'])){
    $displayName = $_POST['display-name'];
    $userName = $_POST['username'];
    $password = $_POST['password'];
    $passConf = $_POST['password-conf'];

    $check_username = mysqli_query($db, "SELECT * FROM users WHERE user_name='$userName'");

    if(mysqli_num_rows($check_username) != 0){
        setMessage('كاربري با اين نام‌كابري در سيستم ثبت‌نام كرده است.');
        header('Location: ../register.php');

    }else {
        if($password != $passConf){
            setMessage('رمزعبور و تكرار آن با هم برابر نيستند.');
            header('Location: ../register.php');

        }elseif(!validatePassword($password)) {
            header('Location: ../register.php');

        }else {
            $insert = mysqli_query($db, "INSERT INTO users (display_name, user_name, password) VALUES ('$displayName', '$userName', '$password')");

            if($insert){
                setMessage('ثبت‌نام موفقیت‌آميز بود ، وارد شويد.');
                header('Location: ../login.php');

            }else {
                $_SESSION['message'] = 'مشكلی پيش آمده است ، لطفا دوباره تلاش كنيد.';
                header('Location: ../register.php');
            }
        }
    }
}


// login
if (isset($_POST['do-login'])) {
    $username = $_POST['username'];
    $password = $_POST['passwrod'];

    $checkLogin = mysqli_query($db,"SELECT * FROM users WHERE user_name ='$username' AND password='$password'");

    if (mysqli_num_rows($checkLogin) > 0) {
        $_SESSION['loggedin'] = $username;
        header('Location: ../index.php');
    }else {
        setMessage('نام كاربری يا رمزعبور اشتباه است.');
        header('Location: ../login.php');
    }
}

//logout
if(isset($_GET['logout'])) {
    unset($_SESSION['loggedin']);
    header('Location: login.php');
}


// add note
if (isset($_POST['user-note'])) {
    $userNote = $_POST['user-note'];
    $noteCategory = $_POST['category'];
    $userId = getUserId();

    $addNote = mysqli_query($db, "INSERT INTO notes (note_text, user_id, category) VALUES ('$userNote', '$userId', '$noteCategory')");

    if ($addNote) {
        header('Location: ../index.php');
    }
}


// set message
function setMessage($message) {
    $_SESSION['message'] = $message;
}

// show message
function showMessage() {
    if(isset($_SESSION['message'])){
        echo '<div class="alert alert-warning m-3">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
}

// check login
function checkLogin () {
    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
    }
}

// get user notes
function getUserNotes($limit=false, $category='general') {
    global $db; 

    $userId = getUserId();

    if ($limit) {
        $getNotes = mysqli_query($db, "SELECT * FROM notes WHERE user_id='$userId' AND is_done='0' ORDER BY id DESC LIMIT $limit");
    }else {
        $getNotes = mysqli_query($db, "SELECT * FROM notes WHERE user_id='$userId' AND is_done='0'AND category='$category' ORDER BY id DESC");
    }

    $userNotes = [];

    while ($note = mysqli_fetch_array($getNotes)) {
        $userNotes[] = $note;
    }

    return $userNotes;
}

// get user id
function getUserId() {
    global $db;

    $userName = $_SESSION['loggedin'];

    $getUser = mysqli_query($db, "SELECT * FROM users WHERE user_name='$userName'");

    $userArray = mysqli_fetch_array($getUser);

    return $userArray['id'];
}

// show display name
function getDisplayName() {
    global $db;
    
    $userName = $_SESSION['loggedin'];
    
    $getUser = mysqli_query($db, "SELECT * FROM users WHERE user_name='$userName'");
    
    $userArray = mysqli_fetch_array($getUser);
    
    return $userArray['display_name'];
    
}

// done a note
if (isset($_GET['done'])) {
    $noteId = $_GET['done'];
    $updateNote = mysqli_query($db, "UPDATE notes SET is_done='1' WHERE id='$noteId'");

    if ($updateNote) {
        header('Location: notes.php');
    }
}

// get done notes
function getDoneNotes () {
    global $db;
    $userId = getUserId();

    $getNotes = mysqli_query($db, "SELECT * FROM notes WHERE user_id='$userId' AND is_done='1' ORDER BY id DESC");

    $userNotes = [];
    while ($notes = mysqli_fetch_array($getNotes)) {
        $userNotes[] = $notes;
    }

    return $userNotes;
}

// delete notes
if (isset($_GET['delete'])) {
    $noteId = $_GET['delete'];

    $deleteNote = mysqli_query($db, "DELETE FROM notes WHERE id='$noteId'");

    if ($deleteNote) {
        header('Location: notes.php');
    }
}

// search
if (isset($_GET['search'])) {
    function getSearchResults() {
        global $db;

        $userId = getUserId();
        $searchText = $_GET['search'];

        $search = mysqli_query($db, "SELECT * FROM notes WHERE note_text LIKE '%$searchText%' AND user_id='$userId' AND is_done='0'");

        $searchResults = [];
        while ($result = mysqli_fetch_array($search)) {
            $searchResults[] = $result;
        }

        return $searchResults;

    }
}

// get user data 
function getUserData() {
    global $db;
    $userId = getUserId();

    $getUserData = mysqli_query($db, "SELECT * FROM users WHERE id='$userId'");

    $userData = mysqli_fetch_array($getUserData);

    return $userData;

}

// update user data
if (isset($_POST['do-update'])) {
    //update the message
    $newDisplayName = $_POST['display-name'];
    $newTitle = $_POST['title'];
    $newSubTitle = $_POST['subtitle'];
    $userId = getUserId();

    $updateDisplayName = mysqli_query($db, "UPDATE users SET display_name='$newDisplayName', title='$newTitle', subtitle='$newSubTitle' WHERE id='$userId'");

    if ($updateDisplayName) {
        setMessage('پیام‌برنامه بروزرسانی شد');
        // header('Location: ../setting.php');
    } else {
        echo 'مشکلی پیش‌ آمده. لطفا دوباره امتحان كنید.';
    }

    //update username and password
    $newUserName = $_POST['newUserName'];
    $newPassword = $_POST['newPassword'];

    $query = mysqli_query($db, "SELECT * FROM users WHERE id='$userId'");
    $info = mysqli_fetch_assoc($query);

    $currentUserName = $info['user_name'];
    $currentPassword = $info['password'];

    if ($currentUserName != $newUserName || $newPassword != $currentPassword) {
        if(validatePassword($newPassword)) {
            $changeInfo = mysqli_query($db, "UPDATE users SET user_name='$newUserName', password='$newPassword' WHERE id='$userId'");

            if($changeInfo) {
                setMessage('لطفا با اطلاعات جدید خود وارد شوید.');
                header('Location: ../login.php');
                return 1;
            } else {
                setMessage('مشکلی پیش‌آمد. لطفا دوباره تلاش كنید.');
            } 
        }
    }

    header('Location: ../setting.php');

}