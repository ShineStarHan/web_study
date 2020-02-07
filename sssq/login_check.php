<?php
    session_start();
    
    $id=$_POST["userID"];
    $pw=$_POST["userPW"];
    $con=mysqli_connect("localhost","root","123456","test");
    $sql="select * from mem where id='$id'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)){
        $value=mysqli_fetch_array($result);
        if(!($pw===$value['pass'])){
            echo "<script>window.alert('비밀번호가 일치하지 않습니다')</script>";
            echo "<script>location.href='login_form.php';</script>";
        }else{
            echo "<script>alert('{$value['name']}님 환영합니다')</script>;";
            $_SESSION['id']=$value['id'];
            $_SESSION['name']=$value['name'];
            echo "<script>location.href='index.php';</script>";
        }
    }else{
        echo "<script>alert('등록된 아이디가 없습니다')</script>;";
        echo "<script>location.href='login_form.php';</script>";
    }
     mysqli_close($con);


?>