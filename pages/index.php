<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>ПомоГав</title>
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
                    <div class="reg-link-wraper">
                        <a href="./login.php" class="registration-link">Войти</a>
                        <!-- <a href="../src/logout.php" class="registration-link">Выйти</a> -->
                    </div>
                    <a href="./registr.php" class="registration-link">Регистрация</a>
                </div>
            </div>
        </section>
    </header>
    <main>
        <section class="container main-block-index-page">
            <div class="button-div">
                <p class="text">Здравствуй дорогой друг, этот сайт является работой группы студентов, которая просто хочет помочь животным. На&nbsp;данном сайте вы&nbsp;сможете найти информацию о&nbsp;потребностях конкретных приютов и&nbsp;связаться с&nbsp;ними. Также,
                    если ты&nbsp;волонтёр, то&nbsp;тут ты&nbsp;можешь поискать, кому нужна не только материальная помощь.</p>
                <a href="./inquiries.php" class="help-button">Кнопка помощи</a>
            </div>
            <img src="../img/dog.png" alt="dog" class="dog-img">
        </section>
    </main>
</body>

</html>