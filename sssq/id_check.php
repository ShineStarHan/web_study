<!DOCTYPE html>
<head>
<meta charset="utf-8">
<style>
h3 {
   padding-left: 5px;
   border-left: solid 5px #edbf07;
}
#close {
   margin:20px 0 0 80px;
   cursor:pointer;
}

</style>
</head>
<body>
<h3>아이디 중복체크</h3>
<p>
<?php
    $id=$_GET["id"];
    if(!$id){
        echo ("<li>아이디 입력 바람!</li>");
    }else{
        $con = mysqli_connect("localhost","root","123456","test");
        $sql="select * from mem where id='$id'";
        $result=mysqli_query($con,$sql);
        $num_record=mysqli_num_rows($result);
        if($num_record){
            echo "<li>{$id} 아이디는 중복 되었습니다!</li>";
            echo "<li>다른 아이디를 입력하시오!</li>";
        }else{
            echo "<li>{$id} 아이디는 사용가능합니다!</li>";
        }
        mysqli_close($con);
    }
?>
</p>
<div id="close">
   <img src="./img/close.png" onclick="javascript:self.close()">
</div>
</body>
</html>

