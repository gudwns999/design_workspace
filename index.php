<!DOCTYPE html>
<head>
<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://capstone.hae.so/v2/css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="http://capstone.hae.so/v2/js/client.php?no=<?=$_GET[no]?>"></script>
	<script src="http://capstone.hae.so/v2/js/capstone.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?include_once("nav.php");?>

<div style="height:90%; white-space:nowrap;">
	<div class="container" id="infinite" style="overflow-x: scroll; height:100%; width:100%">
		<h2 style="color:white">Card Position Test</h2>
		<button class="button button2" id="makeCardBtn" onclick="createCard(this)"> 추가 </button>
	</div>
	<?include_once("sidebar.php");?>
</div>
</body>
</html>
                      