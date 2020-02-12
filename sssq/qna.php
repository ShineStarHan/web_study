<?php
session_start();
if(!isset($_SESSION["id"])){
    echo "<script>alert('권한없음!');history.go(-1);</script>";
    exit;
}
    include "tool.php";
    $userid=$_SESSION["id"];
    $username=$_SESSION["name"];


    if(isset($_GET)&&$_GET["mode"]=="insert"){
        $content=trim($_POST["content"]);
        $subject=trim($_POST["subject"]);
        $subject=test_input($_POST["subject"]);
        $content=test_input($_POST["content"]);
        $userid=test_input($userid);
        $hit=0;
        $q_subject=mysqli_real_escape_string($con,$subject);
        $q_content=mysqli_real_escape_string($con,$content);
        $q_userid=mysqli_real_escape_string($con,$userid);
        $regist_day=date("Y-m-d (H:i)");
        $group_num=0;
        $depth=0;
        $ord=0;

        $sql="INSERT INTO qna VALUES (null,$group_num,$depth,$ord,'$q_userid','$username','$q_subject','$q_content','$regist_day',$hit)";
        $result=mysqli_query($con,$sql);
        if(!$result){
            die('에러 : '.mysqli_error($con));
        }

        $sql="SELECT max(num) from qna";
        $result=mysqli_query($con,$sql);
        if(!$result){
            die("에러 : ".mysqli_error($con));
        }
        $row=mysqli_fetch_array($result);
        $max_num=$row["max(num)"];
        $sql="UPDATE qna SET group_num = $max_num WHERE num=$max_num;";
        $result=mysqli_query($con,$sql);
        if(!$result){
            die('에러 : '.mysqli_error($con));
        }
        mysqli_close($con);
        echo "<script>location.href='qna_list.php';</script>";
    }else if(isset($_GET["mode"])&&$_GET["mode"]=="delete"){
        if($userid!=$_GET['id']){
            echo "<script>alert('작성자만이 삭제할 수 있습니다');history.go(-1)</script>";
            exit;
        }
        $num=test_input($_GET["num"]);
        $q_num=mysqli_real_escape_string($con,$num);
        $sql="DELETE FROM qna WHERE num=$q_num";
        $result=mysqli_query($con,$sql);
        if(!$result){
            die("에러 : ".mysqli_error($con));
        }


        mysqli_close($con);
        echo "<script>location.href='qna_list.php?page=1';</script>";
    }else if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
        $content = trim($_POST["content"]);
        $subject = trim($_POST["subject"]);
        $subject = test_input($_POST["subject"]);
        $content = test_input($_POST["content"]);
        $userid = test_input($userid);
        $num = test_input($_GET["num"]);
        $hit = test_input($_POST["hit"]);
        $q_subject = mysqli_real_escape_string($con, $subject);
        $q_content = mysqli_real_escape_string($con, $content);
        $q_userid = mysqli_real_escape_string($con, $userid);
        $q_num = mysqli_real_escape_string($con, $num);
        $regist_day=date("Y-m-d (H:i)");
      
        $sql="UPDATE qna SET subject='$q_subject',content='$q_content',regist_day='$regist_day' WHERE num=$q_num;";
        $result = mysqli_query($con,$sql);
        if (!$result) {
          die('에러: ' . mysqli_error($con));
        }
        echo "<script>location.href='./qna_view.php?num=$num&hit=$hit';</script>";
    }else if(isset($_GET["mode"])&&$_GET["mode"]=="response"){
        $content = trim($_POST["content"]);
        $subject = trim($_POST["subject"]);
        $subject = test_input($_POST["subject"]);
        $content = test_input($_POST["content"]);
        $userid = test_input($userid);
        $num = $_GET["num"];
        $hit =0;
        $q_subject = mysqli_real_escape_string($con, $subject);
        $q_content = mysqli_real_escape_string($con, $content);
        $q_userid = mysqli_real_escape_string($con, $userid);
        $q_num = mysqli_real_escape_string($con, $num);
        $regist_day=date("Y-m-d (H:i)");
      
        $sql="SELECT * from qna where num =$q_num;";
        $result = mysqli_query($con,$sql);
        if (!$result) {
          die('에러: ' . mysqli_error($con));
        }
        $row=mysqli_fetch_array($result);

        $group_num=(int)$row['group_num'];
        $depth=(int)$row['depth']+1;
        $ord=(int)$row["ord"]+1;

        $sql="UPDATE qna SET ord=ord+1 WHERE group_num = $group_num and ord>=$ord;";
        $result =mysqli_query($con,$sql);
        if(!$result){
            die("에러 : ".mysqli_error($con));
        }
        $sql="INSERT INTO qna VALUES (null,$group_num,$depth,$ord,
        '$q_userid','$username','$q_subject','$q_content','$regist_day',$hit);";
        $result = mysqli_query($con,$sql);
        if (!$result) {
            die('에러: ' . mysqli_error($con));
        }
        $sql="SELECT max(num) from qna;";
        $result=mysqli_query($con,$sql);
        if (!$result) {
            die('에러: ' . mysqli_error($con));
        }
        $row=mysqli_fetch_array($result);
        $max_num=$row["max(num)"];

        echo "<script>location.href='qna_view.php?num=$max_num&hit=$hit';</script>";
    }
?>