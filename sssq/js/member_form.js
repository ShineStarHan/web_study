$(document).ready(function () {
    var $inputId=$("#inputId");
    var $subMsg=$("#subMsg");
    var $duplic=$("#id_confirm");;
    $duplic.click(function (){
        var inputId=$inputId.val();
        var exp=/^[\w]{6,12}$/;
        if(inputId===""){
            $subMsg.html("<span style='color:red'>아이디입력요망</span>");
        }else if(!inputId.match(exp)){
            $subMsg.html("<span style='color:red'>형식에 맞지 않음</span>");
        }else{
            $.ajax({
                type: "post",
                url: "./member_checkId.php",
                data: {"inputId":inputId},
                success: function (response) {
                    if(response==="1"){
                        $subMsg.html("<span style='color:red'>중복된 아이디!</span>");
                    }else if(response==="0"){
                        $subMsg.html("<span style='color:red'>사용가능한 아이디!</span>");
                    }else{
                        $subMsg.html("<span style='color:red'>??뭐함??</span>");
                    }
                }
            });
        }

    });    
});