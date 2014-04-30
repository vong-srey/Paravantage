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
			document.getElementById("analogy2").style.visibility = "visible";
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
				document.userForm.submit.disabled=false;
				document.getElementById("lockbutton").style.visibility = "visible";
				document.getElementById("Q1").style.visibility = "hidden";
				document.getElementById("Q3").style.visibility = "hidden";
				document.getElementById("L1").style.visibility = "hidden";
				document.getElementById("L3").style.visibility = "hidden";
				document.load.loadButton.disabled=true;
				document.getElementById("BobQ1").style.visibility = "visible";
				document.getElementById("VPQ3").style.visibility = "visible";
				document.getElementById("text1").style.backgroundColor="#00FF00"
				document.getElementById("text4").style.backgroundColor="#00FF00"
				document.getElementById("lockImage2").style.visibility = "visible";
				document.getElementById("lockImage1").style.visibility = "visible";
				document.getElementById("lockbutton").style.visibility = "visible";
				document.getElementById("lockbutton2").style.visibility = "visible";
			}
		}

	}

	var i=1;
	function nextQuest(){
			document.getElementById("Bob"+i).style.backgroundColor="#00FF00"
			if(i==1)
				document.getElementById("VP" +i).style.backgroundColor="#00FF00"
			document.userForm.submit.disabled=true;
			document.userForm.lockbutton.disabled=false;
			i=i+1;
	}
	function nextLock(){
		if( i==2 ) {
			document.userForm.question.value = arr[i-1];
			document.vpForm.answer.value = "";
			document.vpForm.question.value = "";
			document.vpForm.question.style.backgroundImage = "url('data/wait1.png')";
			document.vpForm.question.style.backgroundRepeat="no-repeat"
			document.vpForm.question.style.backgroundSize="50px 50px"
			document.vpForm.question.style.backgroundPosition="top center"
			document.userForm.answer.value="";
			document.getElementById("Bob"+i).style.backgroundColor="#00FF00"
			document.getElementById("VP" +i).style.backgroundColor="#FF0000"
			document.getElementById("Q2").style.visibility = "hidden";
			document.getElementById("L2").style.visibility = "hidden";
			document.getElementById("BobQ2").style.visibility = "visible";
			document.userForm.submit.disabled=false;
			document.userForm.lockbutton.disabled=true;
			document.getElementById("lockImage3").style.visibility = "visible";
			i=i+1;
		}
		else {
			document.userForm.answer.value = "";
			document.userForm.question.value = "";
			document.userForm.question.style.backgroundImage = "url('data/wait1.png')";
			document.userForm.question.style.backgroundRepeat="no-repeat"
			document.userForm.question.style.backgroundSize="50px 50px"
			document.userForm.question.style.backgroundPosition="top center"
 			document.userForm.submit.disabled="disabled";
			document.load.loadButton.disabled="disabled";
			document.userForm.lockbutton.disabled=true;
			document.getElementById("Bob"+i).style.backgroundColor="#FF0000"
			var theDelay = 8;
  			var timer = setTimeout("Freeze()",theDelay*1000)
		}
	}

	function Freeze(){
		var dialogoverlay = document.getElementById('dialogoverlay');
         dialogoverlay.innerHTML = '<img src="data/deadlock.png" width="500" height="500" title="Lock" alt="Lock" align="center" onclick="unfreeze()" />';
		dialogoverlay.style.display = "block";
		dialogoverlay.style.height = winH+"px";
	}
	function unfreeze(){
		document.getElementById('dialogoverlay').style.display = "none";
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
		<h2><center>Deadlock</center></h2> 
		<div align="right">
			<a href="index.php" style="color: #CC0000"><right> HOME </right></a>
		</div>
			
	</div>
	<!-- @ Header ends here +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

	<div id="content">
	<div id="resources" style="font-family: Comic Sans MS; color: #E96D63;font-size: 12pt;"><center>
				Shared &nbsp;&nbsp; Resources:&nbsp;&nbsp;
				<span id="Q1" style="color:#7FCA9F">Q1</span>&nbsp;&nbsp;
				<span id="Q2" style="color:#7FCA9F">Q2</span>&nbsp;&nbsp;
				<span id="Q3" style="color:#7FCA9F">Q3</span>&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				Locks:&nbsp;&nbsp;
				<span id="L1" style="color:#7FCA9F">L1</span>&nbsp;&nbsp;
				<span id="L2" style="color:#7FCA9F">L2</span>&nbsp;&nbsp;
				<span id="L3" style="color:#7FCA9F">L3</span>
				</center>
			</div>
		<div id="left">
			
			<h3>Bob (Thread 1)</h3>
			 <br/>
			<h3>QUESTION:   &nbsp;&nbsp;&nbsp;&nbsp;             
				<span id="BobQ1" style="visibility: hidden;color:#7FCA9F">Q1</span>
				<span id="BobQ2" style="visibility: hidden;color:#7FCA9F"> , Q2</span>
			</h3>
			<br />
			<form name="userForm">
				<div id="p1-question">
					<input type="text" name="question"
						style="width: 300px; height: 50px;font-family: Comic Sans MS;font-size: 15pt;color: blue; background-color:rgb(136, 162, 168)" readonly="readonly"></input>
				</div>
				<br /> <br /> <input type="text" name="answer"
					style="width: 200px; height: 30px;"></input> <br /> <br /> <input
					type="button" onclick="nextQuest()" value="Submit" name="submit" disabled="disabled" style="font-size:30pt;"> </input>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" id="lockbutton" disabled="disabled" name="lockbutton" value="Lock Next Question" onclick="nextLock()" style="visibility: hidden;font-size:30pt;"> </input>
			</form>
			<br /> <br /> <br />
			<div id="load-game">
				<form name="load">
					<input type="button" onclick="loadGame()" value="Load Game & Lock The First Question"
						name="loadButton" style="font-size:30pt;"> </input>
				</form>
			</div>
			<br/>
			<img id="lockImage1" src="data/Lock.jpg" width="80" height="80" title="Lock"
				alt="Lock" align="left" style="visibility: hidden;"/><img id="lockImage3" src="data/Lock.jpg" width="80" height="80" title="Lock"
				alt="Lock" align="left" style="visibility: hidden;"/><br /> <br /><br/><br /><br /><br />
		</div>

		<div id="middle">
			<br/><br /> <br /> <br /> <br />
			<br /> <br /> <br /> <br />
			<br /> <br />
			<h2>
			<div id="analogy" style="color: #FF9900; visibility: hidden;">
				<span style="float: left">Thread1() { </span>
				<br/><span id="text1" style="float: left">&nbsp;&nbsp;	Lock Q1;</span>
				<br/><span id="Bob1" style="float: left">&nbsp;&nbsp;	Answer Q1;</span>
				<br/><span id="Bob2" style="float: left">&nbsp;&nbsp;	Lock Q2;</span>
				<br/><span id="Bob3" style="float: left">&nbsp;&nbsp;	Answer Q2;</span>
				<br/><span id="Bob4" style="float: left">&nbsp;&nbsp;	Lock Q3;</span> 
				<br/><span id="text3" style="float: left">&nbsp;&nbsp;	Answer Q3;</span>
				<br/><span style="float: left">&nbsp;&nbsp;	UnLock Q1;</span> 
				<br/><span style="float: left">&nbsp;&nbsp;	UnLock Q2;</span> 
				<br/><span style="float: left">&nbsp;&nbsp;	UnLock Q3;</span>
				<br/><span style="float: left">} </span>
			</div></h2>
			<br />
		</div>
			
		<div id="middleleft">
			<br/><br /> <br /> <br /> <br />
			<br /> <br /> <br /> <br />
			<br /> <br />
			<h2>
			<div id="analogy2" style="color: #FF9900; visibility: hidden;">
				 <span style="float: left">Thread2() { &nbsp;&nbsp;&nbsp;&nbsp;</span>
				 <br/><span id="text4" style="float: left">&nbsp;&nbsp;	Lock Q3;</span>
				 <br/><span id="VP1" style="float: left">&nbsp;&nbsp;	Answer Q3;</span>
				 <br/><span id="VP2" style="float: left">&nbsp;&nbsp;	Lock Q1;</span>
				 <br/><span style="float: left">&nbsp;&nbsp;	Answer Q1;</span>
				 <br/><span style="float: left">&nbsp;&nbsp;	Lock Q2;</span>
				 <br/><span style="float: left">&nbsp;&nbsp;	Answer Q2;</span>
				 <br/><span style="float: left">&nbsp;&nbsp;	UnLock Q3;</span>
				 <br/><span style="float: left">&nbsp;&nbsp;	UnLock Q1;</span>
				 <br/><span style="float: left">&nbsp;&nbsp;	UnLock Q2;</span>
				<br/><span style="float: left"> }&nbsp;&nbsp;&nbsp;&nbsp; </span>
			</div></h2>
			<br/>
		</div>
		

		<div id="right">
			
			<h3>Virtual Player (VP) (Thread 2)</h3>
			 <br/>
			<h3>QUESTION:&nbsp;&nbsp;&nbsp;&nbsp;             
				<span id="VPQ3" style="visibility: hidden;color:#7FCA9F">Q3</span>
			</h3>
			<br />
			<form name="vpForm">
				<input type="text" name="question"
					style="width: 300px; height: 50px;font-family: Comic Sans MS;font-size: 15pt;color: blue; background-color:rgb(100, 140, 140);" readonly="readonly"></input> <br />
				<br /> <br /> <input type="text" name="answer"
					style="width: 200px; height: 30px;" readonly="readonly"></input> <br />
				<br /> <input type="button" value="Submit" disabled="disabled" style="font-size:30pt; font-family: Comic Sans MS;"> </input>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button id="lockbutton2" disabled="disabled" style="visibility: hidden; font-size:10pt; font-family: Comic Sans MS;"> Lock Next Question</BUTTON>
			</form>
			<br /> <br /> <br />
			<div id="load-game">
				<form>
					<input type="button" onclick="loadGame()" value="Load Game & Lock The First Question"
						disabled="disabled" style="font-size:30pt; font-family: 'Comic Sans MS';"> </input>
				</form>
			</div><br/>
			<img id="lockImage2" src="data/Lock.jpg" width="80" height="80" title="Lock"
				alt="Lock" align="left" style="visibility: hidden;"/> <br /> <br /> <br /> <br /><br /><br />
		</div>
	</div>

	<div id="footer">

		<a href="test.php"> Auckland University </a>
		<p align="right">Team: Nancy, Victor, Aravind</p>

	</div>

</body>
</html>