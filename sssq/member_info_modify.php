<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/member.css">
<link rel="stylesheet" href="./join.css">
<script type="text/javascript" src="./js/member_modify.js"></script>
</head>
<body onload="setBirthdaySelect()"> 
	<header>
    	<?php include "header.php";?>
    </header>
<?php    
   	$con = mysqli_connect("localhost", "root", "123456", "test");
    $sql    = "select * from mem where id='$userid'";
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_array($result);

    $pass = $row["pass"];
    $name = $row["name"];

    $email = explode("@", $row["email"]);
    $birth = explode("-",$row["birth"]);
    $gender=$row["gender"];
    $email1 = $email[0];
    $email2 = $email[1];
    $email3=array("","","","","");
      switch($email2){
          case "naver.com":
            $email3[0]="selected";
          break;
          case "daum.net":
            $email3[1]="selected";
          break;
          case "nate.com":
            $email3[2]="selected";
          break;
          case "gmail.com":
            $email3[3]="selected";
          break;
          default:
            $email3[4]="selected";
          break;
      }
      $gender_checked=array("","");
      switch($gender){
          case "남자":
            $gender_checked[0]="checked";
          break;
          case "여자":
            $gender_checked[1]="checked";
          break;
      }

    
    mysqli_close($con);
?>
	<section>
    <div id="joinCenter">
      <div id="join_content">
      <br><br><br><br>
        <h1 id="title">회원수정</h1>

        <hr>
        <h4>필수항목</h4><br>
        <div>
            <form action="member_modify.php?id=<?=$userid?>" name="modify_form" method="POST">
                <fieldset class="longFieldset">
                    <span class="innerText">아이디</span class="innerText">
                    <input name="id" type="test" disabled  id="inputId" value=<?=$userid?>>
                </fieldset>
                <fieldset class="longFieldset">
                    <table>
                        <tr>
                            <td>
                                <span class="innerText">비밀번호</span>
                                <input onblur="pwValidCheck(document.getElementById('inputPw'))" value=<?=$pass?> name="pw" type="password" id="inputPw">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="innerText">비밀번호 확인</span>
                                <input type="password" id="inputPwCheck" value=<?=$pass?> onblur="pwCheckValidCheck(document.getElementById('inputPwCheck'))">
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset class="longFieldset">
                    <span class="innerText">이름</span>
                    <input type="text" id="inputName" name="name" value=<?=$name?> onblur="nameValidCheck(document.getElementById('inputName'))">
                </fieldset>
                <div id="mailBox">
                    <fieldset id="emailField">
                        <span class="innerText">이메일</span>
                        <input type="text" name="mail1" id="inputMail" value=<?=$email1?>>
                    </fieldset>
                    <span>@</span>
                    <fieldset id="emailFieldBack">
                        <select name="mail2" id="selectMail" onchange="setOhterMail()">
                            <option value="naver.com" <?=$email3[0]?>>naver.com</option>
                            <option value="daum.com" <?=$email3[1]?>>daum.net</option>
                            <option value="nate.com" <?=$email3[2]?>>nate.com</option>
                            <option value="gmail.com" <?=$email3[3]?>>gmail.com</option>
                            <option value="" <?=$email3[4]?>>--직접입력--</option>
                        </select>
                        <input type="text" id="otherMail" name="directMail" style="display: none" value=<?=$email2?>>
                    </fieldset>
                </div>
                <br>
                <h2>선택항목</h2>
                <hr>
                <div>
                    <label for="birthDay">생년월일
                    <fieldset id="birthField">
                        <select name="year"   id="year"></select>
                        <select name="month"   id="month" onchange="setDaySelect()"></select>
                        <select name="day"   id="day"></select>
                    </fieldset>
                </div>
                <div id="genderBox">
                    <label for="gender">성별</label>
                    <input type="radio" name="gender" value="남자"  class="genderCheck" <?=$gender_checked[0]?>>남자
                    <input type="radio" name="gender"  value="여자" class="genderCheck"  <?=$gender_checked[1]?>>여자
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

                </div>
                <br>
                <h1>개인정보 수집 및 이용</h1>
                <br>
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
                <div>
                    <input id="modifySubmit" type="button" value="정보수정하기" onclick="finalCheck()">
                </div>
            </form>
        </div>  
        </div>
    </div>
	</section> 
	<footer>
        <?php include "footer.php";?>
    </footer>
</body>
</html>

