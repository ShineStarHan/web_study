<?php
session_start();
if(isset($_SESSION["id"])){
    $userid=$_SESSION["id"];
}
if($userid!="admin1"){
    echo "<script>alert('관리자만 이용할 수 있습니다');
    history.go(-1);
    </script>";
    exit;
}
$mode=$_GET["mode"];
$con=mysqli_connect("localhost","root","123456","test");
if($mode=="update"){
    $id=$_POST["id"];
    $level=$_POST["level"];
    $point=$_POST["point"];
    $sql = "update mem set level=$level, point=$point where id='$id'";
    mysqli_query($con, $sql);
}else{
    $id=$_GET["id"];
    $sql="delete from mem where id='$id'";
    mysqli_query($con, $sql);
}
mysqli_close($con);
header("Location:admin.php");
exit;




?>