<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
    <title>ITS 커뮤니티</title>
</head>
<body>
    <header>
    <?php
        include "header.php";
    ?>
    </header>
    <section>
        <div id="board_box">
            <h3>
                게시판 > 목록보기
            </h3>
            <ul id="board_list">
                <li>
                    <span class="col1">번호</span>
                    <span class="col2">제목</span>
                    <span class="col3">작성자</span>
                    <span class="col4">첨부</span>
                    <span class="col5">동록날짜</span>
                    <span class="col6">조회</span>
                
                </li>
            <?php
                if(isset($_GET["page"])){
                    $page=$_GET["page"];
                }else{
                    $page=1;
                }
                $con=mysqli_connect("localhost","root","123456","test");
                $sql="select * from board order by num desc";
                $result=mysqli_query($con,$sql);
                $total_record=mysqli_num_rows($result);

                $scale=10;

                if($total_record % $scale==0){
                    $total_page = floor($total_record/$scale);
                }else{
                    $total_page = floor($total_record/$scale)+1;
                }

                $page_setting_num=($page-1)*$scale;
                $number=$total_record - $page_setting_num;

                for($i=$page_setting_num;$i<$page_setting_num+$scale && $i<$total_record;$i++){
                    mysqli_data_seek($result,$i);
                    $row=mysqli_fetch_array($result);
                    $num=$row["num"];
                    $id=$row["id"];
                    $name=$row["name"];
                    $subject=$row["subject"];
                    $regist_day=$row["regist_day"];
                    $hit=$row["hit"];
                    
                    if($row["file_name"]){
                        $file_image="<img src='./img/file.gif'>";
                    }else{
                        $file_image= " ";
                    }
                    
            ?>
                <li>
                    <span class="col1"><?=$number ?></span>
                    <span class="col2"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
                    <span class="col3"><?=$name?></span>
                    <span class="col4"><?=$file_image?></span>
                    <span class="col5"><?=$regist_day?></span>
                    <span class="col6"><?=$hit?></span>
                </li>
                <?php
                    $number--;
                }
                ?>
            </ul>
            <ul id="page_num">
            <?php 
                if($total_page>=2 && $page>=2){
                    $new_page = $page-1;
                    echo "<li><a href='board_list.php?page=$new_page'>◀ 이전 </a></li>";
                }else{
                    echo "<li>&nbsp;</li>";
                }

                for($i=1;$i<=$total_page;$i++){
                    if($page==$i){
                        echo "<li> <b> $i </b> </li>";
                    }else{
                        echo "<li><a href='board_list.php?page=$i'> $i </a></li>";
                    }
                }



                if($total_page>=2 && $page!=$total_page){
                    $new_page = $page+1;
                    echo "<li><a href='board_list.php?page=$new_page'> 다음 ▶</a></li>";
                }else{
                    echo "<li>&nbsp;</li>";
                }
            ?>
            </ul>
                <ul class="buttons">
                    <li>
                    <button onclick="location.href='board_list.php'">목록</button>
                    </li>
                    <li>
                    <button onclick="location.href='board_form.php'">글쓰기</button>
                    </li>
                </ul>
        </div>
    </section>
    <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>
</html>