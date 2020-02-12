<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ITS 커뮤니티</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/message.css">
</head>

<body>
    <header>
        <?php include "header.php" ?>
    </header>
    <section>
        <div id="message_box">
            <h3>
                <?php
            if(isset($_GET["page"])){
                $page = $_GET["page"];
            }else{
                $page=1;
            }
            $mode=$_GET["mode"];

            if($mode=="send"){
                echo "송신 쪽지함 > 목록보기";
            }else{
                echo "수신 쪽지함 > 목록보기";
            }
        ?>
            </h3>
            <ul id="message">
                <li>
                    <span class="col1">번호</span>
                    <span class="col2">제목</span>
                    <span class="col3">
                        <?php 
                    if($mode==="send"){
                        echo "받은이";
                    }else{
                        echo "보낸이";
                    }
                ?>
                    </span>
                    <span class="col4">등록일</span>
                </li>
                <?php 
                $con=mysqli_connect("localhost","root","123456","test");

                if($mode=="send"){
                    $sql = "select * from message where send_id='$userid' order by num desc";
                }else{
                    $sql = "select * from message where rv_id='$userid' order by num desc";
                }
                $result=mysqli_query($con,$sql);
                $total_record=mysqli_num_rows($result);
                $scale=10;

                if($total_record % $scale === 0){
                    $total_page=floor($total_record/$scale);
                }else{
                    $total_page=floor($total_record/$scale)+1;
                }

                $start = ($page-1)*$scale;
                $number=$total_record-$start;
                
                for($i=$start;$i<$start+$scale && $i<$total_record;$i++){
                    mysqli_data_seek($result,$i);
                    $row=mysqli_fetch_array($result);

                    $num=$row["num"];
                    $subject=$row["subject"];
                    $regist_day=$row["regist_day"];

                    if($mode=="send"){
                        $msg_id=$row["rv_id"];
                    }else{
                        $msg_id=$row["send_id"];
                    }

                    $result2=mysqli_query($con,"select name from mem where id='$msg_id'");
                    $record=mysqli_fetch_array($result2);
                    $msg_name = $record["name"];

            ?>

                <li>
                    <span class="col1"><?=$number?></span>
                    <span class="col2"><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>"><?=$subject?></a></span>
                    <span class="col3"><?=$msg_name?></span>
                    <span class="col4"><?=$regist_day?></span>

                </li>
                <?php
    $number--;
                }
                mysqli_close($con);
?>
            </ul>
            <ul id="page_num">
                <?php
    if($total_page>=2 && $page>=2){
        $new_page=$page-1;
        echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전</a></li>";
    }else{
        echo "<li>&nbsp;</li>";
    }

    for($i=1;$i<=$total_page;$i++){
        if($page==$i){
            echo "<li><b>$i</b></li>";
        }else{
            echo "<li> <a href='message_box.php?mode=$mode&page=$i'> $i </a> <li>";
        }
    }

    if($total_page>=2 && $page!=$total_page){
        $new_page=$page+1;
        echo "<li> <a href='message_box.php?mode=$mode&page=$new_page'>다음 ▶</a> </li>";
    }else{
        echo "<li>&nbsp;</li>";
    }


?>
            </ul>
        </div>
    </section>
    <footer>
        <?php 
        include "footer.php";
        ?>

    </footer>
</body>

</html>