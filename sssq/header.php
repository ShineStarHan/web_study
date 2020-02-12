<?php
    session_start();
    if (isset($_SESSION["id"])) $userid = $_SESSION["id"];
    else $userid = "";
    if (isset($_SESSION["name"])) $username = $_SESSION["name"];
    else $username = "";
   
?>		
        <div id="top">
            <h3>
                <a href="index.php">잇츠커뮤니티</a>
            </h3>
            <ul id="top_menu">  
<?php
    if(!$userid) {
?>                
                <li><a href="join.php">회원 가입</a> </li>
                <li> | </li>
                <li><a href="login_form.php">로그인</a></li>
<?php
    } else {
                $logged = $username."(".$userid.")님";
?>
                <li><?=$logged?> </li>
                <li> | </li>
                <li><a href="logout.php">로그아웃</a> </li>
                <li> | </li>
                <li><a href="member_info_modify.php">정보 수정</a></li>
<?php
    }
?>
<?php
    if($username=='관리자') {
?>
                <li> | </li>
                <li><a href="admin.php">관리자 모드</a></li>
<?php
    }
?>
            </ul>
        </div>
        <div id="menu_bar">
            <ul>  
                <li><a href="index.php">HOME</a></li>
                <li><a href="message_form.php">쪽지 보내기</a></li>                                
                <li><a href="board_list.php">게시판 입장</a></li>
                <li><a href="qna_list.php">Q&A</a></li>
            </ul>
        </div>