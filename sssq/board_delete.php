<?php
    $page = $_GET["page"];
    $num = $_GET["num"];
    $mode = $_GET["mode"];
    
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
                $sql="update board set  where num=$num";
                mysqli_query($con,$sql);
                mysqli_close($con);
            break;
            case "select" :
            break;
            default:
            break;

        }
    }
    query_module($mode,$num,$page);

    


?>