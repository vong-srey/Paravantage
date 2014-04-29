<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Deadlock</title>
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
			document.getElementById("analogy").style.visibility = "visible";		
		}
	}
	var Alert = new CustomAlert();
	window.onload = function(){
		var theDelay = 1;
  		var timer = setTimeout("showText()",theDelay*1000)
		var timer2 = setTimeout("showVPText()",(theDelay+1.5)*1000)
		//var timer3 = setTimeout("loadText()",(theDelay+7)*1000)
	}
	function showText(){
  		document.getElementById("bobText").style.visibility = "visible";
	}
	function showVPText(){
  		document.getElementById("compText").style.visibility = "visible";
	}
	var load=false;
	function loadText(){
		if(load==false){
  			Alert.render("Click on Load Game Button")
  			load=true;
		}	
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
				document.vpForm.question.value = arr[2];
				document.getElementById("lockingText").style.visibility = "visible";
				document.userForm.submit.disabled=false;
				document.getElementById("Q1").style.visibility = "hidden";
				document.getElementById("Q4").style.visibility = "hidden";
				document.getElementById("lockImage2").style.visibility = "visible";
				document.getElementById("lockImage1").style.visibility = "visible";
				document.load.loadButton.disabled=true;
				document.getElementById("text1").style.backgroundColor="#00FF00"
				document.getElementById("text2").style.backgroundColor="#00FF00"
			}
		}

	}

	var i=1;
	function nextQuest(){
		if( i==1 ) {
			document.userForm.question.value = arr[i];
			document.getElementById("lockingText"+i).style.visibility = "visible";
			document.vpForm.answer.value = "";
			document.vpForm.question.value = "";
			document.vpForm.question.style.backgroundImage = "url('data/wait1.png')";
			document.vpForm.question.style.backgroundRepeat="no-repeat"
			document.vpForm.question.style.backgroundSize="50px 50px"
			document.vpForm.question.style.backgroundPosition="top center"
			document.userForm.answer.value="";
			document.getElementById("Q2").style.visibility = "hidden";
			document.getElementById("text3").style.backgroundColor="#00FF00"
			document.getElementById("text4").style.backgroundColor="#00FF00"
			document.getElementById("text1").style.backgroundColor="initial"
			document.getElementById("text2").style.backgroundColor="initial"
			i=i+1;
		}
		else {
			document.getElementById("lockingText4").style.visibility = "visible";
			document.userForm.answer.value = "";
			document.userForm.question.value = "";
			document.userForm.question.style.backgroundImage = "url('data/wait1.png')";
			document.userForm.question.style.backgroundRepeat="no-repeat"
			document.userForm.question.style.backgroundSize="50px 50px"
			document.userForm.question.style.backgroundPosition="top center"
 			document.userForm.submit.disabled="disabled";
			document.load.loadButton.disabled="disabled";
			document.getElementById("text3").style.backgroundColor="initial"
			document.getElementById("text5").style.backgroundColor="#00FF00"
			var theDelay = 8;
  			var timer = setTimeout("Freeze()",theDelay*1000)
		}
	}

	function Freeze(){
		var dialogoverlay = document.getElementById('dialogoverlay');
		dialogoverlay.style.display = "block";
		dialogoverlay.style.height = winH+"px";
		dialogoverlay.innerHTML = '<img src="data/deadlock.png" width="20" height="20" title="Lock" alt="Lock" align="right" />';
	}

	</script>

</head>
<body style="background-color: white" onclick="loadText()">
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
			<center>Deadlock</center>
		</h2>
		<div align="right">
			<a href="index.php" style="color: #CC0000"><right> HOME </right></a>
		</div>
	</div>
	<!-- @ Header ends here +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

	<div id="content">
		<div id="left">
			<div id="resources" ><center>
				Resources:
				<button id="Q1" style="background-color:#E96D63; color:#7FCA9F">Q1</button>
				<button id="Q2" style="background-color:#E96D63; color:#7FCA9F">Q2</button>
				<button id="Q3" style="background-color:#E96D63; color:#7FCA9F">Q3</button>
				</center>
			</div>
			<br />
			<h3>Bob (Process 1)</h3>
			<br /> 
			<h3>QUESTION:</h3>
			<br />
			<form name="userForm">
				<div id="p1-question">
					<input type="text" name="question"
						style="width: 300px; height: 50px;font-family: Comic Sans MS;font-size: 15pt;" readonly="readonly"></input>
				</div>
				<br /> <br /> <input type="text" name="answer"
					style="width: 200px; height: 30px;"></input> <br /> <br /> <input
					type="button" onclick="nextQuest()" value="Submit" name="submit" disabled="disabled" style="font-size:30pt;"> </input>
			</form>
			<br /> <br /> <br /> <br />
			<div id="load-game">
				<form name="load">
					<input type="button" onclick="loadGame()" value="Load Game"
						name="loadButton" style="font-size:30pt;"> </input>
				</form>
			</div>
			<br/>
			<img id="lockImage1" src="data/Lock.jpg" width="80" height="80" title="Lock"
				alt="Lock" align="right" style="visibility: hidden;"/><br /> <br />

		</div>

		<div id="middle">
			<h3>Stack Traces</h3>
			<div id="bobText" style="visibility: hidden; color: #FFCC00">
				<h3>--------->  Bob Enters</h3>
			</div>
			<div id="compText" style="visibility: hidden; color: Yellow">
				<h3>&nbsp;&nbsp;---------> Virtual Player Enters</h3>
			</div>
			<div id="lockingText" style="visibility: hidden; color: Green">
				<h3 style="color: Green">--------->  Bob locks Question1</h3>
				<h3 style="color: Yellow">&nbsp;&nbsp;---------> VP locks Question3</h3>
			</div>
			<div id="lockingText1" style="visibility: hidden; color: Yellow">
				<h3 style="color: Yellow">--------->  Bob locks Question2</h3>
				<p style="color: Green">&nbsp;&nbsp;---------> VP waits to acquire lock on Question1</p>
			</div>
			<div id="lockingText4" style="visibility: hidden; color: Yellow">
				<h3 style="color: Yellow">--------->  Bob is waiting to acquire lock on Question3
					held by VP</h3>
				<h3 style="color: Green">&nbsp;&nbsp;---------> VP is waiting to acquire lock on Question1
					which is held by Bob</h3>
			</div>
			<h3>
			<div id="analogy" style="color: #FF9900; visibility: hidden;">
				<span style="float: left">Process1() { </span> <span style="float: right">Process2() { &nbsp;&nbsp;&nbsp;&nbsp;</span>
				<br/><span id="text1" style="float: left">&nbsp;&nbsp;	Lock Q1;</span> <span id="text2" style="float: right">&nbsp;&nbsp;	Lock Q3;</span>
				<br/><span id="text3" style="float: left">&nbsp;&nbsp;	Lock Q2;</span> <span id="text4" style="float: right">&nbsp;&nbsp;	Lock Q1;</span>
				<br/><span id="text5" style="float: left">&nbsp;&nbsp;	Lock Q3;</span> <span style="float: right">&nbsp;&nbsp;	Lock Q2;</span>
				<br/><span style="float: left">&nbsp;&nbsp;	UnLock Q1;</span> <span style="float: right">&nbsp;&nbsp;	UnLock Q3;</span>
				<br/><span style="float: left">&nbsp;&nbsp;	UnLock Q2;</span> <span style="float: right">&nbsp;&nbsp;	UnLock Q1;</span>
				<br/><span style="float: left">&nbsp;&nbsp;	UnLock Q3;</span> <span style="float: right">&nbsp;&nbsp;	UnLock Q2;</span>
				<br/><span style="float: left">} </span> <span style="float: right"> }&nbsp;&nbsp;&nbsp;&nbsp; </span>
			</div></h3>
			<br/>
		</div>

		<div id="right">
			<div id="resources2"><center>
			Resources:
				<button id="Q4" style="background-color:#E96D63; color:#7FCA9F"3>Q3</button>
				<button id="Q5" style="background-color:#E96D63; color:#7FCA9F" >Q1</button>
				<button id="Q6" style="background-color:#E96D63; color:#7FCA9F">Q2</button>
				</center>
			</div>
			<br />
			<h3>Virtual Player (VP) (Process 2)</h3>
			<br /> 
			<h3>QUESTION:</h3>
			<br />
			<form name="vpForm">
				<input type="text" name="question"
					style="width: 300px; height: 50px;font-family: Comic Sans MS;font-size: 15pt;" readonly="readonly"></input> <br />
				<br /> <br /> <input type="text" name="answer"
					style="width: 200px; height: 30px;" readonly="readonly"></input> <br />
				<br /> <input type="button" value="Submit" disabled="disabled" style="font-size:30pt; font-family: Comic Sans MS;"> </input>
			</form>
			<br /> <br /> <br /> <br />
			<div id="load-game">
				<form>
					<input type="button" onclick="loadGame()" value="Load Game"
						disabled="disabled" style="font-size:30pt; font-family: 'Comic Sans MS';"> </input>
				</form>
			</div><br/>
			<img id="lockImage2" src="data/Lock.jpg" width="80" height="80" title="Lock"
				alt="Lock" align="left" style="visibility: hidden;"/> <br /> <br /> <br /> <br />
		</div>
	</div>

	<div id="footer">

		<a href="test.php"> Auckland University </a>
		<p align="right">Team: Nancy, Victor, Aravind</p>

	</div>

</body>
</html>