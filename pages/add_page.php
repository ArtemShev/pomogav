<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Приютам</title>
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
                <a href="./add_page.php" class="active-link center-nav-link">Приютам</a>
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
                    <a href="./registr.php" class="registration-link">Регистрация</a>
                </div>
            </div>
        </section>
    </header>
    <main>
        <section class="container add-page-wrapper">
            <div class=" main-block-add-page">
                <div class="add_button">
                    <a href="./add_shelter.php" class="help-button">Добавить приют</a>
                    <span class="button-description">Эта кнопка позволит вам добавить свой приют и&nbsp;информацию о&nbsp;нем на&nbsp;сайт</span>
                </div>
                <div class="add_button">
                    <a href="./add_inquiry.php" class="help-button">Добавить запрос</a>
                    <span class="button-description">Размещайте запросы о&nbsp;помощи вашему приюту для волонтеров</span>
                </div>
            </div>
            <img src="../img/cat_8.png" alt="cat" class="pets-img">
        </section>

    </main>
    <!-- <footer>

    </footer> -->
</body>

</html>