<?php
                session_start();
                function stripQuotes($text) {
                    return preg_replace('/^(\'(.*)\'|"(.*)")$/', '$2$3', $text);
                  }
                require_once('../src/db.php');
                global $DBlink;
                mysqli_query($DBlink,"SET NAMES UTF8");
                mysqli_query($DBlink,"SET CHARACTER SET UTF8");
                $shel_id = $_GET['shelter_id'];
                $result = mysqli_query($DBlink, "SELECT * FROM shelters WHERE id = {$shel_id}");
                $shelter = mysqli_fetch_assoc($result);
                $result2= mysqli_query($DBlink,"SELECT description FROM inquiries WHERE shelter_id = {$shel_id} ORDER BY id DESC;");
                $inquiry = mysqli_fetch_assoc($result2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <title><?php echo $shelter['shelter_name']?></title>
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
        <section class="shelter-page-wrapper">
            <div class="shelter-img-and-address">
            <?php printf("<img class='shelter-page-img' src='".$shelter['imagepath'].$shelter['imagename']."'>");?>
                <div class="shelter-contacts">
                    <div class="shelter-contact">
                        <span class= 'contact-h1'>Контактный номер:</span>
                        <span class="contact-info">
                            <?php printf("".stripQuotes($shelter['phone_number'])."")?>
                        </span>
                    </div>
                    <div class="shelter-contact">
                        <span class= 'contact-h1'>Адрес:</span>
                        <span class="contact-info">
                            <?php printf("".stripQuotes($shelter['address'])."")?>
                        </span>

                    </div>
                </div>
            </div>
            <section class="shelter-discr-and-inq">
                <div class="shelter-descr">
                <?php printf("".stripQuotes($shelter['description'])."")?>
                </div>
                <div class="shelter-inq">
                    <span class="h1-inq">Запросы:</span>
                    <div class="inq">
                        <?php
                            $result2= mysqli_query($DBlink,"SELECT description FROM inquiries WHERE shelter_id = {$shel_id} ORDER BY id DESC");
                            while($inquiry = mysqli_fetch_array($result2)){
                                printf("<span class='one-inq'>".stripQuotes($inquiry['description'])."</span>");
                            };
                        ?>
                    </div>
                </div>
            </section>
        </section>
    </main>
</body>

</html>
