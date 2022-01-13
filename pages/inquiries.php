<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Запросы приютов</title>
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
                <a href="./inquiries.php" class="active-link center-nav-link">Запросы</a>
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
                    if($user_id !=null){
                        // var_dump($user_id);
                        $get_image = mysqli_query($DBlink, "SELECT * FROM shelters WHERE user_id = {$user_id}");
                        // var_dump($get_image);
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
        <section class="shelters-wrapper">
            <?php
                function stripQuotes($text) {
                    return preg_replace('/^(\'(.*)\'|"(.*)")$/', '$2$3', $text);
                  }
                session_start();
                require_once('../src/db.php');
                global $DBlink;
                mysqli_query($DBlink,"SET NAMES UTF8");
                mysqli_query($DBlink,"SET CHARACTER SET UTF8");
                $result = mysqli_query($DBlink, "SELECT * FROM shelters");
                $shelter = mysqli_fetch_assoc($result);
                if($shelter!=0){
                    do{
                        $result2= mysqli_query($DBlink,"SELECT description FROM inquiries WHERE shelter_id = '".$shelter['id']."' ORDER BY id DESC LIMIT 1;");
                        $inquiry = mysqli_fetch_assoc($result2);
                        printf("<div class='shelter'><img class='shelter-img' src='".$shelter['imagepath'].$shelter['imagename']."'><div class='shelter-filling'><span class='shelter-name'>".stripQuotes($shelter['shelter_name'])."</span><p class='shelter-description'>".stripQuotes($shelter['description'])."</p><div class='link-wrapper'><span class='last-inq'>Последний запрос: ".stripQuotes($inquiry['description'])." </span><a href='../pages/shelter_page.php?shelter_id={$shelter['id']}' class='shelter-link'>Подробнее ❯❯</a></div></div></div>");
                    }
                    while($shelter = mysqli_fetch_assoc($result));

                }
            ?>
        </section>
    </main>
</body>

</html>