<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Critical Section</title>
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

#arrow{	color: blue; }
#arrow0{	color: blue; }
#arrow1{	color: blue; }
#arrow2{	color: blue; }
#arrow3{	color: blue; }
#arrow4{	color: blue; }
#arrow5{	color: blue; }
#arrow6{	color: blue; }
#arrow7{	color: blue; }
#arrow8{	color: blue; }
#arrow9{	color: blue; }
#arrowa{	color: blue; }
#arrowa0{	color: blue; }
#arrowa1{	color: blue; }
#arrowa2{	color: blue; }
#arrowa3{	color: blue; }
#arrowa4{	color: blue; }
#arrowa5{	color: blue; }
#arrowa6{	color: blue; }
#arrowa7{	color: blue; }
#arrowa8{	color: blue; }
#arrowa9{	color: blue; }

</style>
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
			document.getElementById("analogy2").style.visibility = "visible";
		}
	}
	var Alert = new CustomAlert();
	window.onload = function(){
		var theDelay = 1;
		var timer = setTimeout("loadText()",(theDelay)*1000)
	}
	
	function loadText(){
  		Alert.render("Click on Load Game Button")
	}
	
	function gameCannotBeLoaded(){
  		Alert.render("The game cannot be loaded. Please acquire the lock MethodLock to load the game.<br />If you are not acquiring the lock, Race Condition can be occured.")
	}


	function acquireLock(){
		document.loadgameForm.nolockLoadgame.disabled=true;
		document.load.loadButton.disabled=true;
		document.getElementById("mlock").style.visibility = "visible";
		document.getElementById("arrow").style.visibility = "hidden";
		document.getElementById("arrow0").style.visibility = "visible";
		var theDelay = 2;
		var timer = setTimeout("loadGame()",(theDelay)*1000);
	}

	var arr = new Array();
	function loadGame(){
		
		vpStartPlayGame();

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
				document.getElementById("Q1").style.visibility = "hidden";
				document.getElementById("methodLock").style.visibility = "hidden";

				document.getElementById("mlock").innerHTML = "Holding: MethodLock";
				document.getElementById("BobQ1").style.visibility = "visible";
				document.getElementById("text1").style.backgroundColor="#00FF00"
				document.getElementById("lockImage1").style.visibility = "visible";
				document.getElementById("arrow0").style.visibility = "hidden";
				document.getElementById("arrow1").style.visibility = "visible";
				var theDelay = 4;
		  		var timer = setTimeout("vpAcquireLock()",theDelay*1000)
			}
		}

	}
	
	function vpStartPlayGame(){
		document.getElementById("arrowa").style.visibility = "visible";
	}
	
	function vpAcquireLock(){
		Alert.render("VP (Thread 2) is acquiring the lock MethodLock. But, you (Bob - Thread 1) are holding the lock. <br /> So, VP (Thread 2) is waiting for you to release the lock. Please hurry!!!")
		document.getElementById("arrowa").style.visibility = "hidden";
		document.getElementById("arrowa0").style.visibility = "visible";
		document.getElementById("vpmlock").style.visibility = "visible";
	}
	
	function vpGetLock(){
		document.getElementById("Q1").style.visibility = "hidden";
		document.getElementById("methodLock").style.visibility = "hidden";
		document.getElementById("vpmlock").style.visibility = "visible";
		document.getElementById("vpmlock").innerHTML = "Holding: MethodLock";
		document.getElementById("vpQ1").style.visibility = "visible";
		document.getElementById("text1").style.backgroundColor="#00FF00"
		document.getElementById("lockImage2").style.visibility = "visible";
		document.getElementById("arrowa0").style.visibility = "hidden";
		document.getElementById("arrowa1").style.visibility = "visible";
		document.vpForm.question.value = arr[0];
		
		index = 1;
		var theDelay = 2;
  		var timer = setTimeout("vpNexQuest()",theDelay*1000)
	}
	
	function vpNexQuest(){
		if(index < 3){
			document.vpForm.question.value = arr[index];
		} else {
			document.vpForm.question.value = "";
		}
		document.getElementById("Bob" + index).style.backgroundColor="#00FF00";
		document.getElementById("arrowa"+index).style.visibility = "hidden";

		index=index+1;
		document.getElementById("arrowa"+index).style.visibility = "visible";
		
		if(index < 4){
			document.getElementById("Q" + index).style.visibility = "hidden";
			document.getElementById("vpQ" + index).style.visibility = "visible";
		}
		
		if(index == 4){
			var theDelay = 1; 		
			var timer = setTimeout("vpUnlock()",(theDelay)*1000)
			return;
		}else{
			var theDelay = 1; 		
			var timer = setTimeout("vpNexQuest()",(theDelay)*1000)
		}
	}
	
	function vpUnlock(){
		
		document.getElementById("arrowa"+index).style.visibility = "hidden";
		document.getElementById("text2").style.backgroundColor="#00FF00";				
		index=index+1;
		document.getElementById("arrowa"+index).style.visibility = "visible";
		
		var theDelay = 1; 		
		var timer = setTimeout("vpFinished()",(theDelay)*1000);
	}
	
	function vpFinished(){
		document.getElementById("arrowa"+5).style.visibility = "hidden";
		Alert.render("Bob (Thread 1) and VP (Thread 2) finished the playGame(). <br /> Bob (Thread 1) is the first winner and VP (Thread 2) is the last winner.");
	}
	
	function bobFinished(){		
		var r = confirm("Bob (Thread 1) finished the game playGame() and the MethodLock lock released.\nLet's VP (Thread 2) acquire MethodLock lock and play playGame(). \n Would you like to see VP (Thread 2) process playGame()?");
		if(r == true){
			var theDelay = 2;
			var timer = setTimeout("vpGetLock()",theDelay*1000);
		}
	}

	function nextQuest(){

		if(index < 3){
			document.userForm.question.value = arr[index];
		} else {
			document.userForm.question.value = "";
		}
		document.getElementById("Bob" + index).style.backgroundColor="#00FF00";
		document.getElementById("arrow"+index).style.visibility = "hidden";

		index=index+1;
		document.getElementById("arrow"+index).style.visibility = "visible";
		
		if(index < 4){
			document.getElementById("Q" + index).style.visibility = "hidden";
			document.getElementById("BobQ" + index).style.visibility = "visible";
		}
		
		if(index == 4){
			document.userForm.submit.disabled=true;	
			var theDelay = 1; 		// need to change to 3
			var timer = setTimeout("unlock()",(theDelay)*1000)
			return;
		}
	}
	
	
	function unlock(){
		document.userForm.submit.disabled=true;
		document.getElementById("arrow"+index).style.visibility = "hidden";
		document.getElementById("text2").style.backgroundColor="#00FF00";				
		index=index+1;
		document.getElementById("arrow"+index).style.visibility = "visible";
		
		var theDelay = 1;
		var timer = setTimeout("releasedLock()",(theDelay)*1000)
	}
	
	function releasedLock(){
		document.getElementById("arrow5").style.visibility = "hidden";
		document.getElementById("text1").style.backgroundColor="rgb(118, 150, 154)";
		document.getElementById("text2").style.backgroundColor="rgb(118, 150, 154)";	
		document.getElementById("mlock").style.visibility = "hidden";
		document.getElementById("methodLock").style.visibility = "visible";
		document.getElementById("lockImage1").style.visibility = "hidden";
		for(var i=1; i<4; i++){
			document.getElementById("Bob"+i).style.backgroundColor="rgb(118, 150, 154)";
			document.getElementById("Q" + i).style.visibility = "visible";
			document.getElementById("BobQ" + i).style.visibility = "hidden";
		}
		
		

				
		var theDelay = 1;
		var timer = setTimeout("bobFinished()",(theDelay)*1000)
	}
	
	
	
	</script>

</head>
<body style="background-color: white" onclick="Freeze()">
	<div id="dialogoverlay"></div>
	<div id="dialogbox">
		<div>
			<div id="dialogboxhead"></div>
			<div id="dialogboxbody"></div>
			<div id="dialogboxfoot"></div>
		</div>
	</div>

	<!-- Header:  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	<div id="header"
		style="background-color: rgb(68, 40, 45); font-family: verdana; color: white;">
		<h1>
			<center>Parallel Programming Pitfalls</center>
		</h1>
		<h2>
			<center>Critical Section</center>
		</h2>
			<button id="disable" style="visibility:hidden;" ></button>

			<span style="float: right;"> <a href="index.php"
				style="color: #CC0000"><right> HOME </right></a>
			</span>

	</div>
	<!-- @ Header ends here +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

	<div id="content">
		<div id="resources"
			style="font-family: Comic Sans MS; color: #E96D63; font-size: 12pt;">
			<center>
				Shared &nbsp; Resources:&nbsp; 
					<span id="Game" style="color: #7FCA9F">playGame() Body</span>
					&nbsp;,&nbsp;
					<span id="Q1" style="color: #7FCA9F">Q1</span>
					&nbsp;,&nbsp;
					<span id="Q2" style="color: #7FCA9F">Q2</span>
					&nbsp;,&nbsp;
					<span id="Q3" style="color: #7FCA9F">Q3</span>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Locks:&nbsp; 
					<span id="methodLock" style="color: #7FCA9F">MethodLock</span>
			</center>
		</div>
		
		<div id="left" style="width: 35%;">

			<h3>Bob (Thread 1)
				<span id="mlock" style="visibility: hidden; color: black; font-size: 13pt;">Acquiring MethodLock</span>
			</h3>
			
			<br />
			<h3>
				QUESTION: &nbsp;&nbsp;&nbsp;&nbsp; 
					<span id="BobQ1" style="visibility: hidden; color: #7FCA9F">Q1</span> 
					<span id="BobQ2" style="visibility: hidden; color: #7FCA9F"> , Q2</span>
					<span id="BobQ3" style="visibility: hidden; color: #7FCA9F"> , Q3</span>
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
					disabled="disabled" style="font-size: 30pt;"> </input>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 

			</form>
			<br /> <br /> <br />
			
			<div>
				<form name="loadgameForm">
					<input type="button" style="font-size: 30pt;" name="nolockLoadgame" value="Load Game" onclick="gameCannotBeLoaded()"></input>
				</form>
			</div>
			
			<div id="load-game">
				<form name="load">
					<input type="button" onclick="acquireLock()"
						value="Load Game & Lock The First Question" name="loadButton"
						style="font-size: 30pt;"> </input>
				</form>
			</div>
			<br /> <img id="lockImage1" src="data/Lock.jpg" width="80"
				height="80" title="L1" alt="L1" align="left"
				style="visibility: hidden;" /><img id="lockImage3"
				src="data/Lock.jpg" width="80" height="80" title="L2" alt="L2"
				align="left" style="visibility: hidden;" /><br /> <br /> <br /> <br />
			<br /> <br />
		</div>

		<div>
		</div>
		
		
		<div id="middle" style="background: none repeat scroll 0% 0% rgb(118, 150, 154); width: 20%">
			<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
			<h2>
				<div id="analogy" style="color: #FFF400; visibility: hidden;">
							<span id="arrow">&rarr;</span>
							<span>playGame() { </span> 
							<span id="arrowa" style="visibility: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &larr;</span>
					<br /> 	<span id="arrow0" style="visibility: hidden;">&rarr;</span>
							<span id="text1">&nbsp;AcquireLock</span>
							<span id="arrowa0" style="visibility: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &larr;</span>
					<br /> 	<span id="arrow1" style="visibility: hidden;">&rarr;</span>
							<span id="Bob1">&nbsp;&nbsp;&nbsp; Answer Q1;</span> 
							<span id="arrowa1" style="visibility: hidden;">&nbsp;&nbsp; &larr;</span>
					<br /> 	<span id="arrow2" style="visibility: hidden;">&rarr;</span>
							<span id="Bob2">&nbsp;&nbsp;&nbsp; Answer Q2;</span> 
							<span id="arrowa2" style="visibility: hidden;">&nbsp;&nbsp; &larr;</span>
					<br /> 	<span id="arrow3" style="visibility: hidden;">&rarr;</span>
							<span id="Bob3" >&nbsp;&nbsp;&nbsp; Answer Q3;</span> 
							<span id="arrowa3" style="visibility: hidden;">&nbsp;&nbsp; &larr;</span>
					<br /> 	<span id="arrow4" style="visibility: hidden;">&rarr;</span>
							<span id="text2">&nbsp;UnLock Q3;</span>
							<span id="arrowa4" style="visibility: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &larr;</span>
					<br />	<span id="arrow5" style="visibility: hidden;">&rarr;</span>
							<span>} </span> 
							<span id="arrowa5" style="visibility: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &larr;</span>
					<br />
					<br />
				</div>
			</h2>
			<br />
		</div>

		
				

		<div id="right" style="width: 40%; margin-left:-50px">
			<div style="margin-left:50px">
				<h3>VirtualPlayer-VP (Thread 2)
					<span id="vpmlock" style="visibility: hidden; color: black; font-size: 13pt;">Acquiring MethodLock</span>
				</h3>
				<br />
				
				<h3>
					QUESTION:&nbsp;&nbsp;&nbsp;&nbsp; 
						<span id="vpQ1" style="visibility: hidden; color: #7FCA9F">Q1</span> 
						<span id="vpQ2" style="visibility: hidden; color: #7FCA9F"> , Q2</span>
						<span id="vpQ3" style="visibility: hidden; color: #7FCA9F"> , Q3</span>
					
					</h3>
				<br />
				
				<form name="vpForm">
					<input type="text" name="question"
						style="width: 300px; height: 50px; font-family: Comic Sans MS; font-size: 15pt; color: blue; background-color: rgb(100, 140, 140);"
						readonly="readonly"></input> <br /> <br /> <br /> <input
						type="text" name="answer" style="width: 200px; height: 30px;"
						readonly="readonly"></input> <br /> <br /> <input type="button"
						value="Submit" disabled="disabled"
						style="font-size: 30pt; font-family: Comic Sans MS;"> </input>
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
							style="font-size: 30pt; font-family: Comic Sans MS;"> </input>
					</form>
				</div>
				
				<br /> <img id="lockImage2" src="data/Lock.jpg" width="80"
					height="80" title="L3" alt="L3" align="left"
					style="visibility: hidden;" /> <br /> <br /> <br /> <br /> <br /> <br />
				</div>
			</div>
		</div>
		
		

	<div id="footer">

		<p>
			<a href="test.php"> Auckland University </a> <span
				style="float: right">Team: Nancy, Victor, Aravind</span>
		</p>

	</div>

</body>
</html>