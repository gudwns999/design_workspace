<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<script src="/socket.io/socket.io.js"></script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<style>
    body {
        font-family: "Lato", sans-serif;
    }

    .sidenav {
        margin-right: -250px;
        right: 250px;
        width: 0;
        background: lightgray;
        position: fixed;
        height: 100%;
        overflow-y: auto;
        z-index: 1000;
        transition: all 0.4s ease 0s;

    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: black;
        display: block;
        transition: 0.3s
    }

    .sidenav a:hover, .offcanvas a:focus{
        color: #f1f1f1;
    }

    .closebtn {
        position: absolute;
        top: 0;
        right: 15px;
        font-size: 36px !important;
        margin-left: 50px;
    }




    .page-content-wrapper {
        width: 100%;
    }

    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }
</style>
<body>
<div style="float: right;">
    <div id="mySidenav" class="sidenav"">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">x</a><br>

    <p align="center"><b>Menu</b></p>

    <hr algin="center" style="width:90%;">
    &nbsp&nbsp<button type="button" class="btn btn-default">멤버추가하기</button>
    <hr algin="center" style="width:90%;">
    <a href="#">Services</a>
    <a href="#">Clients</a>
    <a href="#">Contact</a>



    <!--채팅 부분은 바닥에 깔아버린다.-->
    <div style="position:absolute;bottom:0px;padding-bottom: 100px">
        <!--채팅 글 보여지는 곳-->
        <span id="msgs"></span>
        <!--채팅 글쓰기-->
        Message  <input type="text" id="msgbox"/>
    </div>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">Click...</span>
<script>


    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        <!--채팅 부분-->
        var socket = io.connect('http://capstone.hae.so:9000');
        $("#msgbox").keyup(function(event) {
            if (event.which == 13) {
                socket.emit('fromclient',{msg:$('#msgbox').val()});
                $('#msgbox').val('');
            }
        });
        socket.on('toclient',function(data){
            console.log(data.msg);
            $('#msgs').append(data.msg+'<BR>');
        });
        /*실시간 DB 긁어오는 부분
         socket.on('toDB',function(rows[0].name, rows[0].description){
         console.log(rows[0].name.msg+rows[0].description.msg);
         $('#dbs').append(rows[0].name.msg+rows[0].description.msg+'<BR>');
         });*/
    }


    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>


</body>
</html>