<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITS 커뮤니티</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/admin_copy.css">

</head>

<body>
    <header>
        <?php
        include "header.php";
        ?>
    </header>

    <section>
        <div id="side_navi">
            <ul>
                <h3>[ 관리자모드 ]</h3>
                <li><a href="admin.php"><span>- 회원관리</span></a></li>
                <li><a href="admin_board.php"><span>- 게시판 관리</span></a></li>
                <li><a href="admin_qna.php"><span>- Q&A 게시판 관리</span></a></li>

            </ul>
        </div>

        <div id="admin_box">
            <h3 id="member_title">관리자 모드 > Q&A 게시판 관리</h3>
            <ul id="board_list">
                <li class="title">
                    <span class="col1">선택</span>
                    <span class="col2">번호</span>
                    <span class="col3">이름</span>
                    <span class="col4">제목</span>
                    <span class="col6">작성일</span>
                </li>
                <form method="post" action="admin_board_delete.php?mode=qna">
                    <?php
                     if(isset($_GET["page"])){
                        $page=$_GET["page"];
                    }else{
                        $page=1;
                    }
                    $con = mysqli_connect("localhost", "root", "123456", "test");
                    $sql = "select * from qna order by group_num desc, ord";
                    $result = mysqli_query($con, $sql);
                    $total_record = mysqli_num_rows($result);
                    $number = $total_record;
                    $scale=10;
                    if($total_record % $scale==0){1;
                        $total_page = floor($total_record/$scale);
                    }else{
                        $total_page = floor($total_record/$scale)+1;
                    }
    
                    $page_setting_num=($page-1)*$scale;
                    $number=$total_record - $page_setting_num;
                    for($i=$page_setting_num;$i<$page_setting_num+$scale&& $i<$total_record;$i++){
                        mysqli_data_seek($result,$i);
                        $row=mysqli_fetch_array($result);
                        $num = $row["num"];
                        $name = $row["name"];
                        $subject = $row["subject"];
                        $regist_day = $row["regist_day"];
                        $regist_day = substr($regist_day, 0, 10);
                    
                   



                    ?>


                        <li>
                            <span class="col1"><input type="checkbox" name="item[]" value="<?= $num ?>"></span>
                            <span class="col2"><?= $number ?></span>
                            <span class="col3"><?= $name ?></span>
                            <span class="col4"><?= $subject ?></span>
                            <span class="col6"><?= $regist_day ?></span>
                        </li>
                    <?php
                        $number--;
                    }
                    mysqli_close($con);
                    ?>
       
                    <button type="submit">선택된 글 삭제</button>
                </form>
            </ul>
            <ul id="page_num">
            <?php 
                if($total_page>=2 && $page>=2){
                    $new_page = $page-1;
                    echo "<li><a href='admin_qna.php?page=$new_page'>◀ 이전 </a></li>";
                }else{
                    echo "<li>&nbsp;</li>";
                }

                for($i=1;$i<=$total_page;$i++){
                    if($page==$i){
                        echo "<li> <b> $i </b> </li>";
                    }else{
                        echo "<li><a href='admin_qna.php?page=$i'> $i </a></li>";
                    }
                }



                if($total_page>=2 && $page!=$total_page){
                    $new_page = $page+1;
                    echo "<li><a href='admin_qna.php?page=$new_page'> 다음 ▶</a></li>";
                }else{
                    echo "<li>&nbsp;</li>";
                }
            ?>
            </ul>

        </div>

    </section>
</body>

</html>