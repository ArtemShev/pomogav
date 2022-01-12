<?php
header("content-type:image/png");
require_once('./db.php');
global $DBlink;
// mysqli_query($DBlink,"SET NAMES UTF8");
// mysqli_query($DBlink,"SET CHARACTER SET UTF8");
// $name=$_GET['name'];
// var_dump($name);

// $var=mysqli_query($DBlink,"SELECT * FROM shelters WHERE img_name = '".$name."' ");
// var_dump($var);
// if($row=mysqli_fetch_assoc($var))
// {
//  $image_name=$row["img_name"];
//  $image_content=$row["img_tmp"];
// }
// echo $image;
$name=$_GET['name'];

$select_image="select * from shelters where img_name='$name'";

$var=mysqli_query($DBlink,$select_image);

if($row=mysqli_fetch_array($var))
{
 $image_name=$row["img_name"];
 $image_content=$row["img_tmp"];
}
echo $image;
?>
