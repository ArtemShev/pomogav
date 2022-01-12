                    <?php
                    session_start();
                    if (isset($_POST['email'],$_POST['password'])){

                        $_SESSION['email'] = $_POST['email'];
                        require_once '../src/db.php';
                        global $DBlink;
                        mysqli_query($DBlink,"SET NAMES UTF8");
                        mysqli_query($DBlink,"SET CHARACTER SET UTF8");
                        $result = mysqli_query($DBlink, "Select * from users where email ='".$_POST['email']."'");
                        $result = mysqli_fetch_assoc($result);
                        // var_dump($result);
                        if(password_verify($_POST['password'],$result['user_password'])){
                            $_SESSION['user_id']=[];
                            $_SESSION['user_id']= $result['id'];
                            $_SESSION['islogged'] = 1;
                            $_SESSION['role']=$result['role'];
                            if($result['role']=='приют'){
                                var_dump($_SESSION['user_id']);
                                var_dump($_SESSION['role']);
                                header('location: ./add_page.php');
                            } else {
                                header('location: ./inquiries.php');
                            }
                            // die();
                        } else {
                            $warning = '<div class="warning"> Неправильные данные</div>';
                        }
                    }
                    ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Войти</title>
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
                    <a href="./login.php" class="active-link registration-link">Войти</a>
                    <a href="./registr.php" class="registration-link">Регистрация</a>
                </div>
            </div>
        </section>
    </header>
    <main>
    <section class="form-sec">

        <form class="auth-form" method = "post" action="./login.php">
            <span class="form-span">Вход</span>
            <input class="form-input" type="email" name = "email" placeholder="Email">
            <input class="form-input" type="password" name="password" placeholder="Пароль">
            <input class="form_sub" type="submit" name='login' value="Войти">
        </form>
    </section>`
    <?php printf($warning);?>
    </main>
    <!-- <footer>

    </footer> -->
</body>

</html>