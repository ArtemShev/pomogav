

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Регистрация</title>
</head>

<body>
<header class="adapt-header">
        <section class="container page-navbar">
            <div class="left-navbar">
                <a href="./index.php" class="logo">
                    <img src="../img/logo.png" alt="DobroGav" class="logo-img" windth='130' height="120">
                </a>
                <a href="./index.php" class="title">ПомоГав</a>
            </div>
            <div class="center-navbar">
                <a href="./add_page.php" class="center-nav-link">Приютам</a>
                <a href="./inquiries.php" class="center-nav-link">Запросы</a>
                <a href="./about_us.php" class="center-nav-link">О нас</a>
            </div>
            <div class="right-navbar">
                <a href="#" class="icon-account">
                    <?php
                    session_start();
                    require_once('../src/db.php');
                    global $DBlink;
                    mysqli_query($DBlink,"SET NAMES UTF8");
                    mysqli_query($DBlink,"SET CHARACTER SET UTF8");
                    $user_id = $_SESSION['user_id'];
                    $get_image = mysqli_query($DBlink, "SELECT * FROM shelters WHERE user_id = {$user_id}");
                    // var_dump($result);
                    $shelter_image = mysqli_fetch_assoc($get_image);
                    if($_SESSION['role'] == 'приют'){
                        if($shelter_image['imagename']==null){
                            printf("<img class='acc-img' src='../img/user.png'>");
                        }else{
                            printf("<img class='acc-img' src='".$shelter_image['imagepath'].$shelter_image['imagename']."'>");

                        }
                    }else{
                        printf("<img class='acc-img' src='../img/user.png'>");
                    }

                    ?>

                </a>
                <div class="navbar-registration">
                    <a href="./login.php" class="registration-link">Войти</a>
                    <a href="./registr.php" class="active-link registration-link">Регистрация</a>
                </div>
            </div>
        </section>
    </header>
    <main>
        <section class="form-sec">

            <form class="auth-form" method = "post" action="./registr.php">
                <span class="form-span">Регистрация</span>
                <input class="form-input" type="email" name = "email" placeholder="Email">
                <input class="form-input" type="password" name="password" placeholder="Пароль">
                <input class="form-input" type="text" name="username" placeholder="Ваше имя">
                <input class="form-input" type="text" name="city" placeholder="Ваш город">
                <!-- <input class="form-input" type="text" name="role" placeholder="Вы приют или волонтер"> -->
                <select class="form-input" name="role">
                    <option value="приют">Приют</option>
                    <option value="волонтер">Волонтер</option>
                </select>
                <input class="form_sub" type="submit" name='register' value="Зарегистрироваться">
            </form>
        </section>
    </main>
<?php
session_start();
require_once '../src/db.php';
if (isset($_POST['email'],$_POST['password'],$_POST['username'],$_POST['city'])){
    global $DBlink;
    mysqli_query($DBlink,"SET NAMES UTF8");
    mysqli_query($DBlink,"SET CHARACTER SET UTF8");
    // var_dump($_POST['username']);
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $query = "INSERT INTO users VALUES (id,'".$_POST['email']."','".$password."', '".$_POST['username']."','".$_POST['city']."','".$_POST['role']."',0)";
    $result_query= mysqli_query($DBlink, $query);
    if($result_query != false){
        // echo '<h1 class = "success">Вы зарегистрировались!</h1>';
        header('location: ./login.php');
        die();
    }
    else {
        echo '<div class = "warning">Ошибка при регистрации</div>';
    }
}
echo($_SESSION['user_id']);

?>