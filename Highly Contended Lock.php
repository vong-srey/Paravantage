<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Heavily Contended Locks</title>
<link rel="stylesheet" href="data/mystyle.css" type="text/css"
	media="screen">
<style type="text/css" id="css">
#dialogoverlay {
	display: none;
	opacity: .8;
	position: fixed;
	top: 0px;
	left: 0px;
	background: #FFF;
	width: 100%;
	z-index: 10;
}

#dialogbox {
	display: none;
	position: fixed;
	background: #000;
	border-radius: 7px;
	width: 550px;
	z-index: 10;
}

#dialogbox>div {
	background: #FFF;
	margin: 8px
}

#dialogbox>div>#dialogboxhead {
	background: #666;
	font-size: 19px;
	padding: 10px;
	color: #CCC;
}

#dialogbox>div>#dialogboxbody {
	background: #333;
	padding: 20px;
	color: #FFF;
}

#dialogbox>div>#dialogboxfoot {
	background: #666;
	padding: 10px;
	text-align: right;
}
</style>
<script src="data/racecondition.js" type="text/javascript"></script>

<script>
	function CustomAlert() {
		this.render = function(dialog) {
			var winW = window.innerWidth;
			var winH = window.innerHeight;
			var dialogoverlay = document.getElementById('dialogoverlay');
			var dialogbox = document.getElementById('dialogbox');
			dialogoverlay.style.display = "block";
			dialogoverlay.style.height = winH+"px";
			dialogbox.style.left = (winW/2) - (550 * .5)+"px";
			dialogbox.style.top = "100px";
			dialogbox.style.display = "block";
			document.getElementById('dialogboxhead').innerHTML = "Acknowledge This Message";
			document.getElementById('dialogboxbody').innerHTML = dialog;
			document.getElementById('dialogboxfoot').innerHTML = '<button onclick="Alert.ok()">OK</button>';
		}
		this.ok = function() {
			document.getElementById('dialogbox').style.display = "none";
			document.getElementById('dialogoverlay').style.display = "none";			
		}
	}
	var Alert = new CustomAlert();
	window.onload = function(){
		var theDelay = 1;
  		var timer = setTimeout("showText()",theDelay*1000)
		var timer2 = setTimeout("showVPText()",(theDelay+1.5)*1000)
		var timer3 = setTimeout("loadText()",(theDelay+5)*1000)
	}
	function showText(){
  		document.getElementById("bobText").style.visibility = "visible";
	}
	function showVPText(){
  		document.getElementById("compText").style.visibility = "visible";
	}
	function loadText(){
  		Alert.render("Click on Load Game Button")
	}

	var arr = new Array();
	function loadGame(){

		var xmlhttp;
		
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.open("GET","deadlock-question.php",true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				var a =xmlhttp.responseText;
				arr = a.split("|");
				document.userForm.question.value = arr[0];
				document.vpForm.question.style.backgroundImage = "url('data/wait1.png')";
				document.vpForm.question.style.backgroundRepeat="no-repeat"
				document.vpForm.question.style.backgroundSize="50px 50px"
				document.vpForm.question.style.backgroundPosition="top center"
				document.getElementById("lockingText").style.visibility = "visible";
				document.userForm.submit.disabled=false;
			}
		}

	}

	var i=1;
	function nextQuest(){
		if( i==1) {
			document.vpForm.question.style.backgroundImage = "none";
			document.vpForm.question.value = arr[i-1];
			document.userForm.question.value = arr[i];
			document.getElementById("lockingText"+i).style.visibility = "visible";
			document.userForm.answer.value = "";
			document.vpForm.submit.disabled=false;
			document.userForm.submit.disabled=true;
			i=i+1;
		}
		else if(i==2) {
			document.vpForm.question.value = "";
			document.vpForm.answer.value = "";
			document.vpForm.question.style.backgroundImage = "url('data/wait1.png')";
			document.vpForm.question.style.backgroundRepeat="no-repeat"
			document.vpForm.question.style.backgroundSize="50px 50px"
			document.vpForm.question.style.backgroundPosition="top center"
			document.getElementById("lockingText"+i).style.visibility = "visible";
			document.vpForm.submit.disabled=true;
			var theDelay = 7;
  			var timer = setTimeout("showDialog()",theDelay*1000)
		}
		else {
			if(i==5) {
				Alert.render("Emma Wins!!!");
				var theDelay = 5;
	  			var timer = setTimeout("Starvation()",theDelay*1000)
			}
			else {
				document.vpForm.question.value = arr[i-1];
				document.vpForm.answer.value = "";
				document.userForm.question.style.backgroundImage = "none";
				document.userForm.question.value = arr[i-2];
				i=i+1;
			}
		}
	}

	function setPriority(){
		document.userForm.question.value = "";
		document.userForm.answer.value = "";
		document.userForm.question.style.backgroundImage = "url('data/wait1.png')";
		document.userForm.question.style.backgroundRepeat="no-repeat"
		document.userForm.question.style.backgroundSize="50px 50px"
		document.userForm.question.style.backgroundPosition="top center"
		document.vpForm.question.style.backgroundImage = "none";
		document.vpForm.question.value = arr[i-1];
		document.vpForm.submit.disabled=false;
		i=i+1;
		document.getElementById("lockingText"+i).style.visibility = "visible";
	}

	function showDialog(){
		Alert.render("Threads that all use the same lock become queued to use the lock and end up serializing the processing.\n " + 
				"Lower priority threads can slow down the higher priority threads as they queue up for the lock.");
		document.getElementById("priority").style.visibility ="visible";
		document.getElementById("priorityText").style.visibility ="visible";
	}

	function Starvation(){
		Alert.render("If there is always a higher priority process ready, a lower priority process will never be run leading to STARVATION.\n" + 
				"In this case VP and Bob never got the chance to lock the question first and thus lost the game");
	}
	</script>

</head>
<body style="background-color: white">
	<div id="dialogoverlay"></div>
	<div id="dialogbox">
		<div>
			<div id="dialogboxhead"></div>
			<div id="dialogboxbody"></div>
			<div id="dialogboxfoot"></div>
		</div>
	</div>

	<!-- Header: Cinema's Logo and Search box +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	<div id="header"
		style="background-color: rgb(68, 40, 45); font-family: verdana; color: white;">
		<h1>
			<center>Parallel Programming Pitfalls</center>
		</h1>
		<h2>
			<center>Heavily Contended Locks</center>
		</h2>
		<div align="right">
			<a href="index.php" style="color: #CC0000"><right> HOME </right></a>
		</div>
	</div>
	<!-- @ Header ends here +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

	<div id="content">
		<div id="left">
			<h3>P1: Bob</h3>
			<br /> <br />
			<h3>QUESTION:</h3>
			<br />
			<form name="userForm">
				<div id="p1-question">
					<input type="text" name="question"
						style="width: 300px; height: 50px;" readonly="readonly"></input>
				</div>
				<br /> <br /> <input type="text" name="answer"
					style="width: 200px; height: 30px;"></input> <br /> <br /> <input
					type="button" onclick="nextQuest()" value="Submit" name="submit" disabled="disabled"> </input>
			</form>
			<br /> <br /> <br /> <br />
			<div id="load-game">
				<form name="load">
					<input type="button" onclick="loadGame()" value="Load Game"
						name="loadButton"> </input>
				</form>
			</div>

			<img src="data/Lock.jpg" width="20" height="20" title="Lock"
				alt="Lock" align="right" /> <br /> <br />

		</div>

		<div id="middle">
			<h3>Stack Traces</h3>
			<div id="bobText" style="visibility: hidden; color: Green">
				<p>Bob and Emma Enters</p>
			</div>
			<div id="compText" style="visibility: hidden; color: Yellow">
				<p>Virtual Player Enters</p>
			</div>
			<div id="lockingText" style="visibility: hidden; color: Green">
				<p style="color: Green">Bob locks Question1</p>
				<p style="color: Yellow">Emma and VP queues to lock Question1</p>
			</div>
			<div id="lockingText1" style="visibility: hidden; color: Yellow">
				<p style="color: Yellow">Emma locks Question1, Bob locks Question2</p>
				<p style="color: Green">VP still in queue to acquire lock on Question1</p>
			</div>
			<div id="lockingText2" style="visibility: hidden; color: Yellow">
				<p style="color: Yellow">Bob is still on Question2, VP gets Question1</p>
				<p style="color: Green">Emma again in queue to acquire lock on Question2</p>
			</div>
			<div id="lockingText3" style="visibility: hidden; color: Yellow">
				<h3 style="color: Yellow">Emma increases priority and gets Question2</h3>
				<h3 style="color: Green">Bob gets in queue to lock the question</h3>
			</div>
			<br/><br/><br/><br/>
		</div>

		<div id="right">
			<h3>P2: Emma</h3>
			<br /> <br />
			<h3>QUESTION:</h3>
			<br />
			<form name="vpForm">
				<input type="text" name="question"
					style="width: 300px; height: 50px;" readonly="readonly"></input> <br />
				<br /> <br /> <input type="text" name="answer" style="width: 200px; height: 30px;"></input> <br />
				<br /> <input type="button" onclick="nextQuest()" value="Submit" name="submit" disabled="disabled"> </input>
			</form>
			<br /> 
			<div id="priority" style="visibility: hidden;">
				<input type="radio" name="Priority" onClick="setPriority()" value="Increase My Priority">Increase My Priority?
			</div>
			 <br />
			<div id="load-game">
				<form>
					<input type="button" onclick="loadGame()" value="Load Game"> </input>
				</form>
			</div>
			<img src="data/Lock.jpg" width="20" height="20" title="Lock"
				alt="Lock" align="left" /> <br /> <br /> <br /> <br />
		</div>
	</div>

	<div id="footer">

		<a href="test.php"> Auckland University </a>
		<p align="right">Team: Nancy, Victor, Aravind</p>

	</div>

</body>
</html>