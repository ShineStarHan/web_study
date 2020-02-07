//모든문서가 로딩이 되면 자동으로 실행해주는 함수

$(document).ready(function () {
    var $slideShow=$('.slideShow');
    var $slideSlides=$slideShow.find('.side_slides');
    var $slidesAnchor=$slideSlides.find('a');
    var $nav=$slideShow.find('.slide_nav');
    var $indicator=$slideShow.find('.slide_indicator');
    var $indicator_anchor=$indicator.find('a');
    var $pre=$nav.find('.pre');
    var $next=$nav.find('.next');
    var $currentIndex=0;//현재 슬라이드를 첫번째 화면 셋팅
    var $slidesCount=$slidesAnchor.length;
    var $intervalSec=1000;
    var $timer=null;
   
//슬라이드를 가로로 배치하는 이벤트
//슬라이드0~3 (왼쪽기준 슬라이드 각각 0%,100%,200%,300%)
$slidesAnchor.each(function(i){
    var newLeft=(i*100)+'%';
    $(this).css({'left':newLeft});
    window.console.log(newLeft);
});
//이벤트처리 네비게이션 처리진행
// goToSlide($currentIndex);
goToSlide($currentIndex);
function goToSlide(index){
    $currentIndex=index;
    $slideSlides.animate({'left':(-100*$currentIndex)+'%'},600,'easeInOutExpo');
    
    if($currentIndex===0){
        $pre.addClass("disabled");
    }else{
        $pre.removeClass("disabled");
    }

    if($currentIndex===($slidesCount-1)){
        $next.addClass("disabled");
    }else{
        $next.removeClass("disabled");
    }
    
    $indicator_anchor.removeClass('activated');
    $indicator_anchor.eq($currentIndex).addClass('activated');

}

$pre.click(function (e) { 
    e.preventDefault();//앵커 기본기능막기
    if($currentIndex!== 0){
        $currentIndex -=1;
    }
    goToSlide($currentIndex);
    
});

$next.click(function (e) { 
    e.preventDefault();//앵커 기본기능막기
    if($currentIndex!== ($slidesCount-1)){
        $currentIndex +=1;
    }
    goToSlide($currentIndex);
   
});

$indicator_anchor.click(function (e) { 
    e.preventDefault();
    var point=$(this).index();
    goToSlide(point);
});
//자동슬라이드
function autoSlideStart(){
    $timer=setInterval(function (){
        //0,1,2,3,0...
        var $autoCount=($currentIndex+1)%$slidesCount;
       
        goToSlide($autoCount)

    },$intervalSec);
}

function autoSlideStop(){
    clearInterval($timer);
}

$slideShow.mouseenter(function () { 
    autoSlideStop();
});
$slideShow.mouseleave(function () { 
    autoSlideStart()
});
autoSlideStart();
});
