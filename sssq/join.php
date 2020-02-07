<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="join.css">

    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
<!-- <link rel="stylesheet" type="text/css" href="./css/member.css"> -->
    <script src="./join.js"></script>
    <script src="./join_valid_check.js"></script>
    <script src="./js/member_form.js"></script>
    <title>회원가입</title>
</head>

<body onload="setBirthdaySelect()">
<header>
    	<?php include "header.php";?>
    </header>
    <div id="joinCenter">

    <div id="join_content">
<br><br><br><br>
        <h1 id="title">회원가입</h1>

        <hr>

        <h4>필수항목</h4><br>
        <div>
            <form action="./member_insert.php" name="join_form" method="POST">
                    <span class="innerText">아이디</span class="innerText">
                    <input onblur="idValidCheck(document.getElementById('inputId'));" name="id" type="text" id="inputId">
                    <input type="button" id="id_confirm" value="중복확인">
                    <p1 id="subMsg"></p1>
                    <table>
                        <tr>
                            <td>
                                <span class="innerText">비밀번호</span>
                                <input onblur="pwValidCheck(document.getElementById('inputPw'))" name="pw" type="password" id="inputPw">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="innerText">비밀번호 확인</span>
                                <input type="password" id="inputPwCheck" onblur="pwCheckValidCheck(document.getElementById('inputPwCheck'))">
                            </td>
                        </tr>
                    </table>

                    <span class="innerText">이름</span>
                    <input type="text" id="inputName" name="name" onblur="nameValidCheck(document.getElementById('inputName'))">
                <div id="mailBox">
                        <span class="innerText">이메일</span>
                        <input type="text" name="mail1" id="inputMail">
                    <span>@</span>
                        <select name="mail2" id="selectMail" onchange="setOhterMail()">
                            <option value="naver.com">naver.com</option>
                            <option value="daum.com">daum.net</option>
                            <option value="nate.com">nate.com</option>
                            <option value="gmail.com">gmail.com</option>
                            <option value="">--직접입력--</option>
                        </select>
                        <input type="text" id="otherMail" name="directMail" style="display: none;">
                </div>
                <hr>
                <div id="privacyAgreement">
                    <input type="checkbox" name="saveCheck[]" value="14세이상"  class="requiredList"><span class="bigFont">만 14세 이상입니다</span><br>
                    <input type="checkbox" name="saveCheck[]" value="이용약관"  class="requiredList"><span class="bigFont">이용약관 동의</span><br>
                    <input type="checkbox" name="saveCheck[]" value="개인정보"  class="requiredList"><span class="bigFont">개인정보 수집 및 동의</span>
                    <br>
                </div>
                <table id="requiredInfoTable">
                    <tr>
                    <th>구분</th>
                    <th>목적</th>
                    <th>항목</th>
                    <th>보유 및 이용기간</th>
                    </tr>
                    <tr>
                    <td>필수</td>
                    <td>이용자 식별,서비스 이행을 위한 연락</td>
                    <td>이름, 아이디, 비밀번호, 이메일</td>
                    <td>회원탈퇴 후 5일까지</td>
                    </tr>
                </table>

                <hr>

                <h4>선택항목</h4><br>
                <div>
                    <label for="birthDay">생년월일
                        <select name="year"   id="year"></select>
                        <select name="month"   id="month" onchange="setDaySelect()"></select>
                        <select name="day"   id="day"></select>
                </div>
                <br>
                <div id="genderBox">
                    <label for="gender">성별</label>
                    <input type="radio" name="gender" value="남자"  class="genderCheck" checked>남자
                    <input type="radio" name="gender"  value="여자" class="genderCheck">여자
                </div>
                <div>
                    <div id="allAgreement">
                        <input onclick="setAgreeAll();" id="agreeAll" type="checkbox">전체동의하기


                    </div>
                    
                    <div>
                        <input class="agreeOptions" type="checkbox" name="optionAgree[]" value="생일">생년월일과 성별 수집 및 이용 동의<br>
                        <input class="agreeOptions" type="checkbox" name="optionAgree[]" value="이메일">이메일 마케팅 수신 동의<br>
                        <input class="agreeOptions" type="checkbox" name="optionAgree[]" value="개인정보 유효기간 연장">개인정보 유효기간 3년 지정(미동의 시 1년)
                        
                    </div>

                    <hr>

                </div>
                <h4>개인정보 수집 및 이용</h4><br>
                <table id="selectInfoTable">
                    <tr>
                        <th>구분</th>
                        <th>목적</th>
                        <th>항목</th>
                        <th>보유 및 이용기간</th>
                    </tr>
                    <tr>
                        <td>선택</td>
                        <td>맞춤 정보 제공,마케팅</td>
                        <td>성별,생년월일</td>
                        <td>회원탈퇴 후 5일까지</td>
                    </tr>
                </table>

                <hr>

                <div>
                    <input id="joinSubmit" type="button" value="회원가입" onclick="finalCheck()">
                </div>
                <br><br><br>
            </form>
            </div>
        </div>  

    </div>
    <footer>
    	<?php include "footer.php";?>
    </footer>
</body>

</html>