<?php

    $gender=$_POST["gender"];
    $id=$_GET["id"];
    echo "<script>window.document.console.log({$id})</script>";
    $pw=$_POST["pw"];
    $name=$_POST["name"];
    $email1=$_POST["mail1"];
    $email2=$_POST["mail2"];
    $optionAgree=$_POST["optionAgree"];
    $year=$_POST["year"];
    $month=$_POST["month"];
    $day=$_POST["day"];
    $email=$email1."@".$email2;
    $birth="{$year}-{$month}-{$day}";
    $con=mysqli_connect("localhost","root","123456","test");
    $optional="";
    for($i=0;$i<count($optionAgree);$i++){
        $optional .= $optionAgree[$i]." ";
    }
    
    $sql="update mem set pass='$pw', name='$name', email='$email', gender='$gender', optional='$optional', birth='$birth' where id='$id'";
    echo "<script>console.log({$sql})</script>";
    mysqli_query($con,$sql);
    mysqli_close($con);
    echo "<script>
         location.href = 'index.php';
    </script>
";
?>