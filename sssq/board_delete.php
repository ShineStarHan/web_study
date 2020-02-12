<?php
    session_start();
    $page = $_GET["page"];
    $num = $_GET["num"];
    $mode = $_GET["mode"];
    if(!isset($_SESSION["id"])){
        echo ("<script>alert('로그인 후에 이용해 주세요');
        history.go(-1)
        </script>");
        exit;
    }else{
        $id=$_SESSION["id"];
        $con=mysqli_connect("localhost","root","123456","test");
        $sql="select * from board where num=$num";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        $userid=$row["id"];
        if($id!=$userid){
            echo ("<script>
            alert('작성자만 이용할 수 있습니다');
            history.go(-1)
            </script>");
            mysqli_close($con);
            exit;
        }
    }
    
    function query_module($mode,$num,$page){
        switch($mode){
            case "delete" :
                $con=mysqli_connect("localhost","root","123456","test");
                $sql="select * from board where num=$num";
                $result=mysqli_query($con,$sql);
                $row=mysqli_fetch_array($result);
                if($row["file_copied"]){
                    $file_dir="./data/".$row["file_copied"];
                    unlink($file_dir);
                }
                $sql="delete from board where num=$num";
                mysqli_query($con,$sql);
                mysqli_close($con);
                echo "<script>location.href='board_list.php?page=$page';</script>";
            break;
            case "update" :
                $con=mysqli_connect("localhost","root","123456","test");
                $sql="update board set where num=$num";
                mysqli_query($con,$sql);
                mysqli_close($con);
            break;
            default:
            break;

        }
    }
    query_module($mode,$num,$page);

    


?>