<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/board.css">
    <title>ITS 커뮤니티</title>
    <script>
        function check_input(){
            if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.board_form.subject.focus();
          return;
      }
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
        
        }
    
    </script>
</head>
<body>
<header>
    <?php include "header.php"; ?>
</header>
<?php 
    if(!$userid){
        echo("<script>alert('로그인 후 이용해주세요!'); history.go(-1);</script>");
    }
?>
<section>
    <div id="board_box">
        <h3 id="board_box">
            <?php
            if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
                if($userid!=$_GET['id']){
                    echo "<script>alert('작성자만이 수정할 수 있습니다');history.go(-1)</script>";
                    exit;
                }
                $mode=$_GET["mode"];
                echo "Q&A > 글 수정";
                $num=$_GET["num"];
                $page=$_GET["page"];
                $con=mysqli_connect("localhost","root","123456","test");
                $sql="select * from qna where num=$num";
                $result=mysqli_query($con,$sql);
                $row=mysqli_fetch_array($result);
                $subject=$row['subject'];
                $content=$row['content'];
                $subject=htmlspecialchars($subject);
                $content=htmlspecialchars($content);
                $content=str_replace(" ", "&nbsp", $content);
                $content=str_replace("\n", "<br>", $content);
            }elseif(isset($_GET["mode"])&&$_GET["mode"]=="response"){
                $mode=$_GET["mode"];
                echo "Q&A > 답변 쓰기";
                $num=$_GET["num"];
                $page=$_GET["page"];
                $con=mysqli_connect("localhost","root","123456","test");
                $sql="select * from qna where num=$num";
                $result=mysqli_query($con,$sql);
                $row=mysqli_fetch_array($result);
                $depth=(int)$row['depth'];
                $content=$row['content'];
                $subject=$row['subject'];
                $subject=htmlspecialchars($subject);
                $content=htmlspecialchars($content);
                $content=str_replace(" ", "&nbsp", $content);
                $content=str_replace("\n", "<br>", $content);
                $subject=str_replace(" ", "&nbsp", $subject);
                $subject=str_replace("\n", "<br>", $subject);
                $subject="[re]".$subject;
                $content="[re]".$content;
            }else{
                echo "Q&A > 글 쓰기";
                $mode="insert";
                $num=-1;
                $page=1;
            } 
            ?>
            
        </h3>
        <form action="qna.php?mode=<?=$mode?>&num=<?=$num?>&page=<?=$page?>" name="board_form" method="post">
            <ul id="board_form">
                <li>
                    <span class="col1">이름 : </span>
                    <span class="col2"><?=$username?></span>
                </li>
                <li>
                    <span class="col1">제목 : </span>
                    <span class="col2"><input name="subject" type="text" 
                    value=<?php 
                      if(isset($_GET["mode"])){
                        echo "$subject";
                    }else{
                        echo "";
                    }
                    ?>
                    
                    ></span>
                </li>
                <li id="text_area">
                    <span class="col1">내용 : </span>
                    <span class="col2"><textarea name="content"><?php 
                      if(isset($_GET["mode"])){
                        echo "$content";
                    }else{
                        echo "";
                    }
                    ?></textarea></span>
                </li>
            </ul>
            <ul class="buttons">
                <li> <button type="button" onclick="check_input();">완료</button></li>
                <li> <button type="button" onclick="location.href='qna_list.php'">목록</button></li>
            </ul>

        </form>
    </div>
</section>
<footer>
    <?php include "footer.php"; ?>
</footer>
</body>
</html>