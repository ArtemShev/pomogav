

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>О нас</title>
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
                <a href="./about_us.php" class="active-link center-nav-link">О нас</a>
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
                    if($user_id !=null){
                        $get_image = mysqli_query($DBlink, "SELECT * FROM shelters WHERE user_id = {$user_id}");
                        $shelter_image = mysqli_fetch_array($get_image);
                        if($_SESSION['role'] == 'приют'){
                            if($shelter_image['imagename']==null){
                                printf("<img class='acc-img' src='../img/user.png'>");
                            }else{
                                printf("<img class='acc-img' src='".$shelter_image['imagepath'].$shelter_image['imagename']."'>");

                            }
                        }else{
                            printf("<img class='acc-img' src='../img/user.png'>");
                        }
                    } else{
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
        <section class="about-us-wrapper">
            <div class="p-and-video">
                <p class="about-us-descr">Здравствуй дорогой друг, этот сайт является работой группы студентов, которая просто хочет помочь животным. На&nbsp;данном сайте вы&nbsp;сможете найти информацию о&nbsp;потребностях конкретных приютов и&nbsp;связаться с&nbsp;ними. Также,
                    если ты&nbsp;волонтёр, то&nbsp;тут ты&nbsp;можешь поискать, кому нужна не&nbsp;только материальная помощь. Просим отправлять нам ваше мнение по&nbsp;поводу сайта, о&nbsp;его плюсах и&nbsp;минусах. Это очень поможет нам улучшать сайт.
                    Спасибо, что ты&nbsp;с&nbsp;нами!</p>
                <video class="about-us-video" controls="controls" poster="../img/pomogav_video.png" preload="auto" autoplay="autoplay" loop="loop" muted>
                    <source src="../video/PomoGaw.mp4" type='video/mp4; codecs ="avc1.42E01E, mp4a.40.2"'>
            </div>

            <span class="site-features-h1">Наш сайт предлагает следующие возможности:</span>
            <div class="features-and-contacts">
                <ul class="features-list">
                    <li class="feature">Регистрация приюта</li>
                    <li class="feature">Добавление запросов для вашего приюта</li>
                    <li class="feature">Поиск вакансий для волонтеров</li>
                </ul>
                <div class="our-contacts">
                    <span class="h1-our-contacts">Наши контакты</span>
                    <span class="our-email">Электронная почта: pomogav@gmail.com</span>
                    <span class="our-tel">Контактный телефон: +7(964) 717-01-91</span>
                    <span class="our-address">Адрес: Гороховский пер., 4, Москва</span></div>
            </div>
        </section>
    </main>
</body>

</html>