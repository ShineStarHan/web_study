<?php
    $mode=$_GET["mode"];
    $num=$_GET["num"];
    $page=$_GET["page"];
    switch($mode){
        case "insert":
            session_start();
            date_default_timezone_set('Asia/Seoul');
            if(isset($_SESSION["id"])){
                $userid=$_SESSION["id"];
            }else{
                $userid="";
            }
        
            
            if(isset($_SESSION["name"])){
                $username=$_SESSION["name"];
            }else{
                $username="";
            }
        
            $subject=$_POST["subject"];
            $content=$_POST["content"];
        
            $subject = htmlspecialchars($subject,ENT_QUOTES);
            $content = htmlspecialchars($content,ENT_QUOTES);
        
            $regist_day=date("Y-m-d (H:i)");
        
            $upload_dir="./data/";
        
            $upfile_name = $_FILES["upfile"]["name"];
            $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
            $upfile_type = $_FILES["upfile"]["type"];
            $upfile_size = $_FILES["upfile"]["size"];
            $upfile_error = $_FILES["upfile"]["error"];
        
            if($upfile_name && !$upfile_error){
                $file=explode(".",$upfile_name);
                $file_name=$file[0];
                $file_ext=$file[1];
        
                $new_file_name= date("Y_m_d_H_i_s");
                $copied_file_name=$new_file_name.".".$file_ext;
                $uploaded_file=$upload_dir.$copied_file_name;
        
                if($upfile_size > 1000000){
                    echo("
                    <script>
                    alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                    history.go(-1)
                    </script>
                    ");
                    exit;
                }
                
                if(!move_uploaded_file($upfile_tmp_name,$uploaded_file)){
                    echo("
                            <script>
                            alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                            history.go(-1)
                            </script>
                        ");
                        exit;
                }
        
            }else{
                $upfile_name="";
                $upfile_type="";
                $copied_file_name="";
            }
            $con=mysqli_connect("localhost", "root", "123456", "test");
            $sql = "insert into board (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
            $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
            $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
            mysqli_query($con, $sql);
            
            mysqli_close($con);
        
            echo "
               <script>
                location.href = 'board_list.php';
               </script>
            ";
        break;
        case "update":
            $subject=$_POST["subject"];
            $content=$_POST["content"];
        
            $subject = htmlspecialchars($subject,ENT_QUOTES);
            $content = htmlspecialchars($content,ENT_QUOTES);
        
        
            $upload_dir="./data/";
        
            $upfile_name = $_FILES["upfile"]["name"];
            $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
            $upfile_type = $_FILES["upfile"]["type"];
            $upfile_size = $_FILES["upfile"]["size"];
            $upfile_error = $_FILES["upfile"]["error"];
        
            if($upfile_name && !$upfile_error){
                $file=explode(".",$upfile_name);
                $file_name=$file[0];
                $file_ext=$file[1];
        
                $new_file_name= date("Y_m_d_H_i_s");
                $copied_file_name=$new_file_name.".".$file_ext;
                $uploaded_file=$upload_dir.$copied_file_name;
        
                if($upfile_size > 1000000){
                    echo("
                    <script>
                    alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                    history.go(-1)
                    </script>
                    ");
                    exit;
                }
                
                if(!move_uploaded_file($upfile_tmp_name,$uploaded_file)){
                    echo("
                            <script>
                            alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                            history.go(-1)
                            </script>
                        ");
                        exit;
                }
        
            }else{
                $upfile_name="";
                $upfile_type="";
                $copied_file_name="";
            }
            $con=mysqli_connect("localhost","root","123456","test");
            if( $upfile_name==""){
                $sql="update board set subject='$subject', content='$content' where num=$num";
            }else{
                $sql="select * from board where num=$num";
                $result=mysqli_query($con,$sql);
                $row=mysqli_fetch_array($result);
                if(!$row["file_copied"]==""){
                    $file_dir="./data/".$row["file_copied"];
                    unlink($file_dir);
                }
                $sql="update board set subject='$subject', content='$content', file_name='$upfile_name', file_type='$upfile_type', file_copied='$copied_file_name' where num=$num";
            }
            mysqli_query($con,$sql);
            echo "<script>location.href='board_list.php?page=$page'</script>";
        break;
    }


 

?>