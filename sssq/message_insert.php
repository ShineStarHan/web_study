<?php
   date_default_timezone_set('Asia/Seoul');
   $send_id=$_GET["send_id"];
   $rv_id=$_POST["rv_id"];
   $subject=$_POST["subject"];
   $content=$_POST["content"];
   $subject = htmlspecialchars($subject,ENT_QUOTES);
   $content = htmlspecialchars($content,ENT_QUOTES);
   $regist_day=date("Y-m-d (H:i)");

   if(!$send_id){
        echo("<script>
        alert('로그인 후 이용해 주세요');
        history.go(-1)
        </script>");
   }
   $con=mysqli_connect("localhost","root","123456","test");
   $sql="select * from mem where id='$rv_id'";
   $result=mysqli_query($con,$sql);
   $num_record=mysqli_num_rows($result);

   if($num_record){
    $sql = "insert into message values (null,'$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
    mysqli_query($con, $sql);
   }else{
       echo("
       <script>
       alert('수신 아이디가 잘못 되었습니다');
       history.go(-1)
       </script>
       ");
   }
   mysqli_close($con);
   echo "<script>location.href = 'message_box.php?mode=send';</script>";
?>