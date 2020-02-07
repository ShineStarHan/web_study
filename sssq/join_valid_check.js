var flag = false;

function idValidCheck(id) {
    if (flag) {
        flag = !flag;
        return;
    } else {
        flag = !flag;
    }
    var idExp = /^\w{5,8}$/;
    if (!(id.value.match(idExp))) {
        alert("5~8자리의 영문과 숫자로 아이디를 입력하시오");
        id.focus();
    } else {
        flag = false;
    }
}

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
    var requiredCheckList = document.getElementsByClassName("requiredList");
    for (var i = 0; i < requiredCheckList.length; i++) {
        if (requiredCheckList[i].checked === false) {
            alert("필수동의 항목에 체크를 해주십시오");
            return;
        }
    }
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
        alert("회원가입이 되었습니다");
        document.join_form.submit();


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

// function checkID(){
//     window.open("id_check.php?id=" + document.join_form.id.value,
//     "IDcheck",
//      "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
// }