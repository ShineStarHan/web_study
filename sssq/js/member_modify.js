var flag = false;

function nameValidCheck(id) {
    if (flag) {
        flag = !flag;
        return;
    } else {
        flag = !flag;
    }
    var nameExp = /^[A-Za-z가-힣]{2,8}$/;
    if (!(id.value.match(nameExp))) {
        alert("2~8자리의 영문과 한글로 이름을 입력하시오");
        id.focus();
    } else {
        flag = false;
    }
}

function pwValidCheck(id) {
    if (flag) {
        flag = !flag;
        return;
    } else {
        flag = !flag;
    }
    var pwExp = /^(?=.*[\w])(?=.*[~!@#$%^&*()]).{8,12}$/;
    if (!(id.value.match(pwExp))) {
        alert("특수문자를 포함한 영문과 숫자 8~12자리 비밀번호를 입력하세요");
        id.focus();
    } else {
        flag = false;
    }
}

function pwCheckValidCheck(id) {

    var pwExp = document.getElementById("inputPw").value;
    if (!(id.value === pwExp)) {
        alert("입력하신 비밀번호와 같지 않습니다");
    } else {
        flag = false;
    }
}

function finalCheck() {
    var mail = document.getElementById("selectMail");
    var id = document.getElementById("inputId").value;
    var password = document.getElementById("inputPw").value;
    var passwordCheck = document.getElementById("inputPwCheck").value;
    var name = document.getElementById("inputName").value;
    var email = document.getElementById("inputMail").value;
    var requiredList = [id, password, passwordCheck, name, email];
  
    if (mail.selectedIndex === 4) {
        if (document.getElementById("otherMail").value === "") {
            alert("메일의 주소를 직접 입력하거나 다른 메일을 선택해주십시오");
            return;
        }
    }
    for (var i = 0; i < requiredList.length; i++) {
        if (requiredList[i] === "") {
            alert("입력이 안 된 필수입력 항목이 있습니다");
            return;
        }
    }
        alert("회원수정이 되었습니다");
        document.modify_form.submit();


}

function setOhterMail() {
    var id = document.getElementById("selectMail");
    if (id.selectedIndex === 4) {
        document.getElementById("otherMail").style.display = "inline-block";
        document.getElementById("emailFieldBack").style.width="467px";
    } else {
        document.getElementById("otherMail").style.display = "none";
        document.getElementById("emailFieldBack").style.width="300px";
    }
}
function setBirthdaySelect() {
    var yearOption = document.getElementById("year");
    var monthOption = document.getElementById("month");
    var dayOption = document.getElementById("day");
    var creatOption = null;
    for (var i = 2020; i >= 1906; i--) {
        creatOption = document.createElement("option");
        creatOption.value = i.toString();
        creatOption.innerHTML = i.toString() + "년";
        yearOption.appendChild(creatOption);
    }
    for (var i = 1; i <= 12; i++) {
        creatOption = document.createElement("option");
        creatOption.value = i.toString();
        creatOption.innerHTML = i.toString() + "월";
        monthOption.appendChild(creatOption);
    }
    for (var i = 1; i <= 31; i++) {
        creatOption = document.createElement("option");
        creatOption.value = i.toString();
        creatOption.innerHTML = i.toString() + "일";
        dayOption.appendChild(creatOption);
    }
    setOhterMail();

}

function setDaySelect() {
    var monthOption = document.getElementById("month");
    var creatOption = null;
    var dayOption = document.getElementById("day");
    
    while (dayOption.hasChildNodes()) {
        dayOption.removeChild(dayOption.childNodes[0]);
    }

    switch (monthOption.selectedIndex.valueOf() + 1) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            for (var i = 1; i <= 31; i++) {
                creatOption = document.createElement("option");
                creatOption.value = i.toString();
                creatOption.innerHTML = i.toString() + "일";
                dayOption.appendChild(creatOption);
            }
            break;
        case 2:
            for (var i = 1; i <= 29; i++) {
                creatOption = document.createElement("option");
                creatOption.value = i.toString();
                creatOption.innerHTML = i.toString() + "일";
                dayOption.appendChild(creatOption);
            }
            break;
        default:
            for (var i = 1; i <= 30; i++) {
                creatOption = document.createElement("option");
                creatOption.value = i.toString();
                creatOption.innerHTML = i.toString() + "일";
                dayOption.appendChild(creatOption);
            }
            break;
    }

}
function setAgreeAll() {
    var checkAll=document.getElementById("agreeAll");
    var checkList=document.getElementsByClassName("agreeOptions");

    if(checkAll.checked){
        for(var i=0;i<checkList.length;i++){
            checkList[i].checked=true;
        }
    }else{
        for(var i=0;i<checkList.length;i++){
            checkList[i].checked=false;
        }
    }
}