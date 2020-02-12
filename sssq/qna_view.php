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
    <?php include "header.php"; ?>
</header>
    <section>
        <div id="board_box">
            <h3 class="title">Q&A > 내용보기</h3>
            <?php 
                if(!isset($_GET["page"])){
                    $page=1;
                }else{
                    $page=$_GET["page"];
                }
                $num=$_GET["num"];
            
                $con=mysqli_connect("localhost","root","123456","test");
                $sql="select * from qna where num=$num";
                $result=mysqli_query($con,$sql);

                $row=mysqli_fetch_array($result);
                $id      = $row["id"];
                $name      = $row["name"];
                $regist_day = $row["regist_day"];
                $subject    = $row["subject"];
                $content    = $row["content"];
                $hit          = $row["hit"];
                $content=str_replace(" ", "&nbsp", $content);
                $content=str_replace("\n", "<br>", $content);
                $new_hit=$hit+1;
                mysqli_query($con,"update qna set hit=$new_hit where num=$num");
                



            ?>
            <ul id="view_content">
                <li>
                    <span class="col1"><b>제목 : </b><?= $subject ?></span>
                    <span class="col2"><?= $name ?> | <?=$regist_day?></span>
                    
                </li>
                <li>
                    <?php
                        mysqli_close($con);
                    ?>
                    <?=$content?>
                
                
                </li>
            
            
            </ul>
                    <ul class="buttons">
                        <li><button onclick="location.href='qna_list.php?page=<?=$page?>'">목록</button></li>
                        <li><button onclick="location.href='qna_form.php?num=<?=$num?>&page=<?=$page?>&mode=update&id=<?=$id?>'">수정</button></li>                        
                        <li><button onclick="location.href='qna.php?num=<?=$num?>&page=<?=$page?>&mode=delete&id=<?=$id?>'">삭제</button></li>
                        <li><button onclick="location.href='qna_form.php?num=<?=$num?>&page=<?=$page?>&mode=response'">답변하기</button></li>
                            
                    </ul>
        </div>
    
    
    
    </section>
    <footer>
    <?php include "footer.php"; ?>
    </footer>
</body>
</html>