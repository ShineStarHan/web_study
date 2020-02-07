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
        <?php 
            include "header.php";
        ?>
    </header>
    <section>
        <div id="message_box">
            <h3 id="write_title">
                답변 쪽지 보내기
            </h3>
        <?php 
            $num=$_GET["num"];
            $con=mysqli_connect("localhost","root","123456","test");
            $sql="select * from message where num=$num";
            $result=mysqli_query($con,$sql);
            $row=mysqli_fetch_array($result);
            $send_id=$row["send_id"];
            $rv_id=$row["rv_id"];
            $subject=$row["subject"];
            $content=$row["content"];

            $subject="RE: ".$subject;
            
            $content="> ".$content;
            $content = str_replace("\n", "\n>", $content);
            $content="\n\n\n============================\n".$content;

            $result2=mysqli_query($con,"select name from mem where id='$send_id'");
            $record = mysqli_fetch_array($result2);
            $send_name=$record["name"];
        ?>
            <form action="message_insert.php?send_id=<?=$userid?>" name="message_form" method="POST">
                <input type="hidden" name="rv_id" value=<?=$send_id?>>
                <div id="write_msg">
                    <ul>
                        <li>
                            <span class="col1">보내는 사람 : </span>
                            <span class="col2"><?=$userid?> </span>
                        </li>
                        <li>
                            <span class="col1">수신 아이디 : </span>
                            <span class="col2"><?=$send_name?>(<?=$send_id?>) </span>
                        </li>
                        <li>
                            <span class="col1">제목 : </span>
                            <span class="col2"><input type="text" name="subject"value="<?=$subject?>"></span>
                        </li>
                        <li id="text_area">
                            <span class="col1">글내용 : </span>
                            <span class="col2"><textarea name="content"><?=$content?></textarea> </span>
                        </li>
                    </ul>
                        <button onclick="check_input()">보내기</button>
                </div>
            </form>
        </div>
    </section>

    <footer>
    <?php 
        include "footer.php";
    ?>
    </footer>
</body>
</html>