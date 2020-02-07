<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>로그인</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="./main.css">
<link rel="stylesheet" type="text/css" href="./css/main.css">
<link rel="stylesheet" type="text/css" href="./css/common.css">
</head>

<body>

<header>
    	<?php include "header.php";?>
    </header>

    <section>
    <div id="loginCenter">
        <p id="loginP"><span id="loginImg"></span>로그인</p><br><br>
        <hr><br>
        <div id="loginMain">
            <form action="./login_check.php"  name="login_form" method="POST">

                <div id="chooseUserTypeBox">
                    <input type="radio" name="userType" value="회원"  checked><span class="miniFont">회원</span>
                    <input type="radio" name="userType" value="비회원" ><span class="miniFont">비회원</span>
                </div>
                <div id="userInputBox">
                    <label for="userID">아이디</label> <input class="inputTag" name="userID" type="text" id="userID"><br>
                    <label for="userPW">비밀번호</label> <input class="inputTag" name="userPW" type="password" id="userPW"><br>
                    <input type="submit" name="btn_login" value="LOGIN" id="btnLogin">
                    <div id="checkBox">
                        <input type="checkbox" name="saveCheck[]" value="아이디저장"  checked><span class="miniFont">아이디 저장</span>
                        <input type="checkbox" name="saveCheck[]" value="키보드보안" ><span class="miniFont">키보드 보안접속</span><span
                            id="helpImg"></span>
                    </div>
                </div>
            </form>
            <div id="buttonBox">
              <button><a href="./join.php">회원가입</a></button>
              <button><a href="">아이디 찾기</a></button>
              <button><a href="">비밀번호 찾기</a></button>
            </div>

            
        </div>
        <br><br><hr>
    </div>
    </section>

    <footer>
    	<?php include "footer.php";?>
    </footer>


    </div>
</body>

</html>