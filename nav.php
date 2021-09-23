


<nav class="navbar-default" id="topNav">
  <div class="container-fluid">
    <div style="position:absolute; left:45%;">
      <a class="navbar-brand" href="index.php"><span style="color:white">디지털공방</span></a>
    </div>
  


 	<?
		session_start();
		if($_SESSION["id"])
		{
	?>

  	    <ul class="nav navbar-nav navbar-right">
        <li><a><span style="color:white"> <?= $_SESSION["nick"] ?>님 환영합니다. <span class="glyphicon glyphicon-log-out" style="cursor:pointer;color:white" onclick="location.href='logout.php'" >로그아웃</span></span></a></li>
      </ul>

	<?} else {?>

		 <ul class="nav navbar-nav navbar-right">
      <li><a data-toggle="modal" data-target="#myModal"><span style="color:white" class="glyphicon glyphicon-log-in" ></span> <span style="color:white;cursor:pointer;" onclick="location.href='http://capstone.hae.so/v2/login.php?go=<?="http://capstone.hae.so:9000/index.php?no=".$_GET[no];?>';"> 로그인</span></a></li>
	  <li><a href="register.php"><span class="glyphicon glyphicon-user" style="color:white"></span><span style="color:white"> 회원가입</span></a></li>
    </ul>
	<?}?>

	
  </div>
</nav>


