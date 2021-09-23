<?
session_start();
echo "var sid = '".session_id()."';";
$connect = mysqli_connect("localhost","capstone","zoqtmxhs","capstone");
mysqli_query($connect, "set names utf8");

if(!$_SESSION[id]) {$email = "guest";$guest=1;}
else {$email = $_SESSION[id];$guest=0;}
if(!$_SESSION[nick]) $nickname = "손님";
else $nickname = $_SESSION[nick];
$token=md5(mb_convert_encoding("caps".$email."tone".$nickname,'UTF-8', 'UTF-8'));
$room = $_GET[no];
?>


///////////////////////////////////// 글로벌 변수, config 설정////////////////////////.
var socket = io();
var id = "<?=$email?>";
var nick = "<?=$nickname?>";
var token = "<?=$token?>";
var room = <?=$room?>;
var cardCount = 0;
var inText = 1;

//////////////////////////////////socket.on 함수만///////////////////////////////////

socket.on('auth',function()
{
	//계정 정보와 닉네임, 토큰, 현재 접속한 공방의 정보를 전송한다.
	socket.emit("send information",id,nick,token, room);
});

socket.on('greeting',function()
{	
	socket.emit("member list");
});

socket.on("subject",function(name,description)
{
	$('#workshopTitle').html(name);
	$('#workshopDescription').html(description);
});

socket.on("contents",function(e)
{
	for(var i=0;i<e.length;i++) createCard();

	var i = 0;

	$('.w3-card-12').each(function()
	{
		$(this).find('#cardTitle').append(e[i].title);
		i++;
	});
});

socket.on("subject error",function()
{
	alert("존재하지 않는 공방입니다.");
});


socket.on('invalid token',function()
{
	alert("올바르지 않은 정보입니다.");
	//history.back();
});

socket.on('receive member list',function(a)
{
	alert("받은 데이터 : "+a);
});

 $("#msgbox").keyup(function(event) {
            if (event.which == 13) {
                socket.emit('fromclient',{msg:$('#msgbox').val()});
                $('#msgbox').val('');
            }
        });

///////////////////////////////사용자 정의 함수////////////////////////////////////
function openNav()
{
	$('#mySidenav').css({
		"width":"250px",
	});
}
function closeNav()
{
	$('#mySidenav').css("width","0px");
}


         
         function createCard (elmt)
         {
            cardCount++;

            // 카드 생성
            var newCard = $('<div class="w3-card-12" id="card'+cardCount+'" background="#ACACAC" style="display:inline-block; vertical-align:top; margin:0 6px 0 6px; "><div id="cardTitle"></div><input type="text" id="subjectText'+cardCount+'"><br>');
			
            var addBtn = $('<button class="button button2" id="inButton'+cardCount+'" onclick="createInCard(this)"> 추가 </button></div>');
			var delBtn = $('<a href="#"><span class="glyphicon glyphicon-remove" onclick="delCard(this)" style="float:right; top:-40px;"></span></a>');
            
			$('#infinite').append(newCard);
            $("#makeCardBtn").insertAfter('#card'+cardCount);
			$('#card'+cardCount).hide().fadeIn(200);
			$("#card"+cardCount).append(addBtn);
			
           
			$('#subjectText'+cardCount).focus();
			$("#card"+cardCount).append(delBtn);
			$('#infinite').scrollLeft(1000000000000000000);
         }
         
         function createInCard (elmt) 
         {   
            var textArea = $('<div id="inText'+inText+'"><textarea style="max-width: 330px; border-radius:5px;" row="relative"></textarea><br>');
			var delBtn = $('<a href="#"><span class="glyphicon glyphicon-remove" onclick="delCard(this)"></span></a>');
            var id = $(elmt).attr('id'); // 버튼의 id를 받는다.
            
            //var $newInCard = $('<div class="w3-card-12 w3-card-12-2" id="inCard" background="white"><textarea style="width: relative;" row="relative">');
            
            // 카드의 버튼을 고유의 id를 붙여서 만든다.
            var addInBtn = $('<button class="button button2" id="'+id+'" onclick="createInCard(this)"> 추가 </button>');
			var saveBtn = $('<button class="button button2" id="save'+id+'" onclick=""> 저장 </button>');

            // 해당 버튼이 속한 div class의 id를 받는다.
            var divId = $(elmt).closest("div").attr("id");
            
            // 각 카드별로 버튼과 텍스트 area를 추가한다.
            $("#"+divId).append(textArea);
            $("#"+divId).append(addInBtn);
			console.log (divId);
			$("#inText"+inText).append(saveBtn);
			$("#inText"+inText).append(delBtn);
            $("#"+id).remove();
			console.log (inText);
			++inText;
			
         }

		 function delCard (elmt)
		 {
			 // 해당 버튼이 속한 div class의 id를 받는다.
			 var thisClass = $(elmt).closest("div").attr("id");

			 // 해당 id를 갖는 div의 모든 요소 삭제.
			 console.log (thisClass);
			 $('#'+thisClass).remove();
		 }
<?
header("Content-type: application/javascript");
?>