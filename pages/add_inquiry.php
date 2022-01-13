
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Добавить запрос</title>
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
    <section class="form-sec">

        <form class="auth-form" method = "post" action="./add_inquiry.php">
            <span class="form-span">Добавить запрос</span>
            <input class="form-input" type="text" name = "shelter_name" placeholder="название нуждающегосы приюта">
            <input class="form-input" type="text" name="description" placeholder="описание запроса">
            <input class="form_sub" type="submit" name='add_inquiry' value="Добавить запрос">
        </form>
    </section>`
    </main>
</body>

</html>
<?php
session_start();
require_once '../src/db.php';
if ($_SESSION['islogged']==1 && isset($_POST['shelter_name'],$_POST['description'])){
    global $DBlink;
    mysqli_query($DBlink,"SET NAMES UTF8");
    mysqli_query($DBlink,"SET CHARACTER SET UTF8");
    $get_shelter =  mysqli_query($DBlink, "SELECT * FROM shelters WHERE shelter_name ='".$_POST['shelter_name']."'");
    $get_shelter = mysqli_fetch_assoc($get_shelter);
    $get_user =  mysqli_query($DBlink, "SELECT * FROM users WHERE id ='".$get_shelter['user_id']."'");
    $get_user = mysqli_fetch_assoc($get_user);
    // var_dump($get_shelter['id']);
    // var_dump($get_shelter['user_id']);
    // var_dump($get_user['id']);
    if($get_shelter['user_id']==$_SESSION['user_id'] && $_SESSION['role']==$get_user['role']){
        $query = "INSERT INTO inquiries VALUES (id,'".$get_shelter['id']."', '".$_POST['description']."')";
        mysqli_query($DBlink, $query);
        echo '<div class = "success">Запрос добавлен</div>';
    } else {
        echo '<div class = "warning">Вы не можете добавлять запросы в этот приют</div>';
    }
    // var_dump($query);
}
?>