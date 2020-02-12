<?php
      session_start();
      if (isset($_SESSION["id"])) $userid = $_SESSION["id"];
      else $userid = "";
  
      if ( $userid != "admin1" )
      {
          echo("
                      <script>
                      alert('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!');
                      history.go(-1)
                      </script>
          ");
                  exit;
      }
  
      if (isset($_POST["item"]))
          $num_item = count($_POST["item"]); 
      else
          echo("
                      <script>
                      alert('삭제할 게시글을 선택해주세요!');
                      history.go(-1)
                      </script>
          ");
  
      $con = mysqli_connect("localhost", "root", "123456", "test");
      if(isset($_GET["mode"])&&$_GET["mode"]=="qna"){
        for($i=0; $i<count($_POST["item"]); $i++){
            $num = $_POST["item"][$i];
    
            $sql = "select * from qna where num = $num";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
    
            $sql = "delete from qna where num = $num";
            mysqli_query($con, $sql);
        }       
        mysqli_close($con);
      
        echo "
             <script>
                 location.href = 'admin_qna.php';
             </script>
           ";
      }else{

          for($i=0; $i<count($_POST["item"]); $i++){
              $num = $_POST["item"][$i];
      
              $sql = "select * from board where num = $num";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_array($result);
      
              $copied_name = $row["file_copied"];
      
              if ($copied_name)
              {
                  $file_path = "./data/".$copied_name;
                  unlink($file_path);
              }
      
              $sql = "delete from board where num = $num";
              mysqli_query($con, $sql);
          }       
          
          mysqli_close($con);
      
          echo "
               <script>
                   location.href = 'admin_board.php';
               </script>
             ";
      }


?>