<?php
    $save_check=$_POST["saveCheck"];
    $gender=$_POST["gender"];
    $id=$_POST["id"];
    $pw=$_POST["pw"];
    $name=$_POST["name"];
    $email1=$_POST["mail1"];
    $email2=$_POST["mail2"];
    $optionAgree=$_POST["optionAgree"];
    $year=$_POST["year"];
    $month=$_POST["month"];
    $day=$_POST["day"];
    $resist=date("y-m-d");
    $email=$email1."@".$email2;
    $birth="{$year}-{$month}-{$day}";
    $con=mysqli_connect("localhost","root","123456","test");
    for($i=0;$i<count($save_check);$i++){
        $essential .= $save_check[$i]. " ";
    }
    for($i=0;$i<count($optionAgree);$i++){
        $optional .= $optionAgree[$i]." ";
    }
    
    $sql="insert into mem values ('$id','$pw','$name','$email','$resist','$essential','$gender','$optional','$birth',default,default)";
    mysqli_query($con,$sql);
    mysqli_close($con);
    echo "<script>
        location.href = 'index.php';
    </script>
";
?>