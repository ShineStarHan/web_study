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