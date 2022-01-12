

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Добавить приют</title>
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
        <section class="form-sec">
            <form class="auth-form" method = "post" action="./add_shelter.php" enctype="multipart/form-data">
                <span class="form-span">Добавить приют</span>
                <input class="form-input" type="text" name="shelter_name" placeholder="Название приюта">
                <input class="form-input" type="text" name="description" placeholder="Описание приюта">
                <input class="form-input" type="text" name="address" placeholder="Адрес приюта">
                <input class="form-input" type="tel" name="phone_number" placeholder="Контактный номер телефона">
                <input class="form-input"  type="file" name="image" placeholder="добавить фото">
                <input class="form_sub" type="submit" name='add_shelter' value="Добавить приют">
            </form>
        </section>
    </main>
<?php
session_start();
require_once '../src/db.php';

if (isset($_POST['shelter_name'],$_POST['description'],$_POST['address'],$_POST['phone_number'])){
    if($_SESSION['role']=='приют'){
        global $DBlink;
        mysqli_query($DBlink,"SET NAMES UTF8");
        mysqli_query($DBlink,"SET CHARACTER SET UTF8");
        error_reporting(0);

if(isset($_POST['add_shelter'])) {

    $image_name = $_FILES['image']['name'];

    $temp_name = $_FILES["image"]["tmp_name"];

     $file_extension = strtolower(end(explode('.',$_FILES['image']['name'])));

     $file_size =$_FILES['image']['size'];

      $expensions = array("jpeg","jpg","png","gif");

      if(in_array($file_extension,$expensions)=== false){

         $message = "File Type Not allowed, Please choose a JPEG or PNG file.";
      }

      if($file_size > 500000){

         $message = '<h1> File size Too Large !! </h1>';
      }

      if(empty($message)==true){

         move_uploaded_file($temp_name,$_SERVER['DOCUMENT_ROOT']."/pomogav/images/".$image_name);

         $message = '<div class = "success">Добавлен файл</div>';
      }
      else{

         $message = '<div class = "warning">Вы не можете добавлять приюты</div>';
      }
}

if(isset($message))
{
echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$message.'</div>';
// var_dump($_SERVER['DOCUMENT_ROOT'],$image_name,$temp_name);
}
$query = "INSERT INTO shelters VALUES (id,'".$_SESSION['user_id']."','".$_POST['shelter_name']."','".$_POST['description']."','".$_POST['phone_number']."','".$_POST['address']."','../images/','$image_name')";
$result_query = mysqli_query($DBlink, $query);
if($result_query != false){
    echo '<div class = "success">Добавлен приют</div>';
} else {
    echo '<div class = "warning">Ошибка</div>';
}
} else {
    echo '<div class = "warning">Вы не можете добавлять приюты</div>';
    // var_dump($_SESSION['role']);
}
// $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    // $imagename=$_FILES["myimage"]["name"];
    // var_dump($_SESSION['user_id']);
    // var_dump($query);
    // var_dump($_POST['shelter_name']);
    // header('location: ./success_log.php');
    // die();
}
?>