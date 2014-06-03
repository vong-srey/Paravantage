<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Deadlock</title>
<link rel="stylesheet" href="data/deadlock.css" type="text/css"
	media="screen">

<script src="ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<script>

	var index=1;
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
		var right = document.getElementById("right");
		var right2 = document.getElementById("middleRight");
		right.style.backgroundColor = "#FFF";
		right.style.borderColor="blue";
		right2.style.borderColor="blue";
		right2.style.backgroundColor = "#FFF";
		var theDelay = 1;
		var timer3 = setTimeout("loadText()",(theDelay)*1000)
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
				document.userForm.submit.disabled=false;
				document.getElementById("lockbutton").style.visibility = "visible";
				document.getElementById("Q0").style.visibility = "hidden";
				document.getElementById("L0").style.visibility = "hidden";
				document.load.loadButton.disabled=true;
				document.getElementById("BobQ0").style.visibility = "visible";
				document.getElementById("text1").style.backgroundColor="#00FF00"
				document.getElementById("lockImage0").style.visibility = "visible";
				document.getElementById("lockbutton").style.visibility = "visible";
				document.getElementById("arrow").style.visibility = "hidden";
				document.getElementById("arrow1").style.visibility = "visible";
			}
		}

	}
	
	function nextQuest(){
		document.getElementById("Bob" + index).style.backgroundColor="#00FF00";
		document.getElementById("arrow"+index).style.visibility = "hidden";
		document.userForm.submit.disabled=true;
		if(index <5) {
			document.userForm.lockbutton.disabled=false;
		}
		else {
			document.userForm.lockbutton.disabled=false;
			document.userForm.lockbutton.value="Unlock";
		}
		index=index+1;
		document.getElementById("arrow"+index).style.visibility = "visible";
	}

	var counter=4;
	function nextLock(){
		if( index<6 ) {
			document.userForm.question.value = arr[index-1];
			document.userForm.answer.value="";
			document.getElementById("Bob"+index).style.backgroundColor="#00FF00"
			document.getElementById("Q"+index).style.visibility = "hidden";
			document.getElementById("L"+index).style.visibility = "hidden";
			document.getElementById("BobQ"+index).style.visibility = "visible";
			document.userForm.submit.disabled=false;
			document.userForm.lockbutton.disabled=true;
			document.getElementById("lockImage"+index).style.visibility = "visible";
			document.getElementById("arrow"+index).style.visibility = "hidden";
			index=index+1;
			document.getElementById("arrow"+index).style.visibility = "visible";
		}
		else if(index <8) {
			document.getElementById("arrow"+index).style.visibility = "hidden";
			document.getElementById("Bob"+index).style.backgroundColor="#00FF00"
			index=index+1;
			document.getElementById("lockImage"+counter).style.visibility = "hidden";
			document.getElementById("Q"+counter).style.visibility = "visible";
			document.getElementById("L"+counter).style.visibility = "visible";
			document.getElementById("BobQ"+counter).style.visibility = "hidden";
			counter =counter-2;
			document.getElementById("arrow"+index).style.visibility = "visible";
// 			var theDelay = 8;
//   			var timer = setTimeout("Freeze()",theDelay*1000)
		}
		else {
			document.getElementById("lockImage"+counter).style.visibility = "hidden";
			document.getElementById("L"+counter).style.visibility = "visible";
			document.getElementById("Q"+counter).style.visibility = "visible";
			document.getElementById("BobQ"+counter).style.visibility = "hidden";
			document.getElementById("Bob"+index).style.backgroundColor="#00FF00"
			Alert.render("Bob Wins!!!");
			document.userForm.lockbutton.disabled=true;
		}
	}
	</script>

</head>
<body>
	<div id="dialogoverlay"></div>
	<div id="dialogbox">
		<div>
			<div id="dialogboxhead"></div>
			<div id="dialogboxbody"></div>
			<div id="dialogboxfoot"></div>
		</div>
	</div>
<div id="main">
	<!-- Header:  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	<div id="header">
		<h1>
			<center>Parallel Programming Pitfalls</center>
		</h1>
		<h2>
			<center>Deadlock</center>
		</h2>
			<button id="disable"
				style="font-family: Comic Sans MS; background-color: #E96D63; color: #7FCA9F; font-size: 10pt;"
				onclick="window.location.href='Deadlock.php'">Enable VP</button>

			<span style="float: right;"> <a href="index.php"
				style="color: #CC0000"><right> HOME </right></a>
			</span>

	</div>
	<!-- @ Header ends here +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

	<div id="content">
		<div id="resources">
			<center>
				Shared &nbsp;&nbsp; Resources:&nbsp;&nbsp; <span id="Q0"
					style="color: #7FCA9F">Q1</span>&nbsp;&nbsp; <span id="Q2"
					style="color: #7FCA9F">Q2</span>&nbsp;&nbsp; <span id="Q4"
					style="color: #7FCA9F">Q3</span>&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp; Locks:&nbsp;&nbsp; <span id="L0"
					style="color: #7FCA9F">L1</span>&nbsp;&nbsp; <span id="L2"
					style="color: #7FCA9F">L2</span>&nbsp;&nbsp; <span id="L4"
					style="color: #7FCA9F">L3</span>
			</center>
		</div>
		<div id="left">

			<h3>Processor 1: Bob (Thread 1)</h3>
			<br />
			<h3>
				QUESTION: &nbsp;&nbsp;&nbsp;&nbsp; <span id="BobQ0"
					style="visibility: hidden; color: #7FCA9F">Q1</span> <span
					id="BobQ2" style="visibility: hidden; color: #7FCA9F"> , Q2</span>
					<span
					id="BobQ4" style="visibility: hidden; color: #7FCA9F"> , Q3</span>
			</h3>
			<br />
			<form name="userForm">
				<div id="p1-question">
					<input type="text" name="question"
						style="width: 300px; height: 50px; font-family: Comic Sans MS; font-size: 15pt; color: blue; background-color: rgb(136, 162, 168)"
						readonly="readonly"></input>
				</div>
				<br /> <br /> <input type="text" name="answer"
					style="width: 200px; height: 30px;"></input> <br /> <br /> <input
					type="button" onclick="nextQuest()" value="Submit" name="submit"
					disabled="disabled" > </input>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input
					type="button" id="lockbutton" disabled="disabled" name="lockbutton"
					value="Lock Next Question" onclick="nextLock()"
					style="visibility: hidden;"> </input>

			</form>
			<br /> <br /> <br />
			<div id="load-game">
				<form name="load">
					<input type="button" onclick="loadGame()"
						value="Load Game & Lock The First Question" name="loadButton">
					</input>
				</form>
			</div>
			<br /> <img id="lockImage1" src="data/Lock.jpg" width="80"
				height="80" title="L1" alt="L1" align="left"
				style="visibility: hidden;" /><img id="lockImage2"
				src="data/Lock.jpg" width="80" height="80" title="L2" alt="L2"
				align="left" style="visibility: hidden;" /><img id="lockImage4" src="data/Lock.jpg" width="80"
				height="80" title="L3" alt="L3" align="left"
				style="visibility: hidden;" /><br /> <br /> <br /> <br />
			<br /> <br />
		</div>
		<div id="middleLeft">
			<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
			<br />
			<h2>
				<div id="analogy" style="color: #FFF400; visibility: hidden;">
					<span style="float: left">Thread1() { </span> <br /> <span
						id="arrow">&rarr;</span><span id="text1">&nbsp;&nbsp; Lock Q1;</span>
					<br /> <span id="arrow1" style="visibility: hidden;">&rarr;</span><span
						id="Bob1">&nbsp;&nbsp; Answer Q1;</span> <br /> <span id="arrow2"
						style="visibility: hidden;">&rarr;</span><span id="Bob2">&nbsp;&nbsp;
						Lock Q2;</span> <br /> <span id="arrow3"
						style="visibility: hidden;">&rarr;</span><span id="Bob3">&nbsp;&nbsp;
						Answer Q2;</span> <br /> <span id="arrow4"
						style="visibility: hidden;">&rarr;</span><span id="Bob4">&nbsp;&nbsp;
						Lock Q3;</span> <br /> <span id="text3" style="float: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Answer Q3;</span> <br /> <span style="float: left">&nbsp;&nbsp;
						UnLock Q3;</span> <br /> <span style="float: left">&nbsp;&nbsp;
						UnLock Q2;</span> <br /> <span style="float: left">&nbsp;&nbsp;
						UnLock Q1;</span> <br /> <span style="float: left">} </span>
				</div>
			</h2>
			<br />
		</div>
		<div id="middleRight">
			<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
			<br />
			<h2>
				<div id="analogy2" style="visibility: hidden;">
					<span style="float: left">Thread2() { &nbsp;&nbsp;&nbsp;&nbsp;</span>
					<br /> <span id="text4" style="float: left">&nbsp;&nbsp; Lock Q3;</span>
					<br /> <span id="VP1" style="float: left">&nbsp;&nbsp; Answer Q3;</span>
					<br /> <span id="VP2" style="float: left">&nbsp;&nbsp; Lock Q1;</span>
					<br /> <span style="float: left">&nbsp;&nbsp; Answer Q1;</span> <br />
					<span style="float: left">&nbsp;&nbsp; Lock Q2;</span> <br /> <span
						style="float: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Answer Q2;</span> <br /> <span
						style="float: left">&nbsp;&nbsp; UnLock Q3;</span> <br /> <span
						style="float: left">&nbsp;&nbsp; UnLock Q1;</span> <br /> <span
						style="float: left">&nbsp;&nbsp; UnLock Q2;</span> <br /> <span
						style="float: left"> }&nbsp;&nbsp;&nbsp;&nbsp; </span>
				</div>
			</h2>
			<br />
		</div>
		<div id="right">

				<h3>Virtual Player (VP) (Thread 2)</h3>
				<br />
				<h3>
					QUESTION:&nbsp;&nbsp;&nbsp;&nbsp; <span id="VPQ3"
						style="visibility: hidden; color: #7FCA9F">Q3</span>
				</h3>
				<br />
				<form name="vpForm">
					<input type="text" name="question"
						style="width: 300px; height: 50px; font-family: Comic Sans MS; font-size: 15pt; color: blue;"
						readonly="readonly"></input> <br /> <br /> <br /> <input
						type="text" name="answer" style="width: 200px; height: 30px;"
						readonly="readonly"></input> <br /> <br /> <input type="button"
						value="Submit" disabled="disabled"
						style="font-family: Comic Sans MS;"> </input>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button id="lockbutton2" disabled="disabled"
						style="visibility: hidden; font-size: 10pt; font-family: Comic Sans MS;">
						Lock Next Question</BUTTON>
				</form>
				<br /> <br /> <br />
				<div id="load-game">
					<form>
						<input type="button" onclick="loadGame()"
							value="Load Game & Lock The First Question" disabled="disabled"
							> </input>
					</form>
				</div>
				<br /> <img id="lockImage21" src="data/Lock.jpg" width="80"
					height="80" title="L3" alt="L3" align="left"
					style="visibility: hidden;" /> <br /> <br /> <br /> <br /> <br /> <br />
		</div>
	</div>
<!-- footer begins here: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			
		<div id="footer">
			<div id="footer-uoa">		
					University Of Auckland , Software Engineering.
			</div>
			<div id="footer-author">
				Team: Victor, Nancy, Aravind
			</div>
		</div>
<!-- footer ends here: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
</div>
</body>
</html>