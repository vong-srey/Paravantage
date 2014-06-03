/**
* Logic Control Mutual Exclusion Behaviour
*/

	// fields control the next pointer of arrow
	var index=1;
	var arr = new Array();

	// alert message when game loaded.
	var Alert = new CustomAlert();
	window.onload = function(){
		var theDelay = 1;
		var timer = setTimeout("loadText()",(theDelay)*1000)
	}
	
	
	
	// Loading game (text)
	function loadText(){
		Alert.render("Click on Load Game Button")
	}



	// alert message telling user to lock the playGame() first
	function gameCannotBeLoaded(){
		Alert.render("The game cannot be loaded. Please acquire the lock MethodLock to load the game.<br />If you are not acquiring the lock, Race Condition can be occured.")
	}



	// Load game
	function loadGame(){
	
		vpStartPlayGame();

		var xmlhttp;
	
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.open("GET","raceCondition-question.php",true);
		xmlhttp.send();

		// operations after receiving a response from the server
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



	// virtual player start game
	function vpStartPlayGame(){
		document.getElementById("arrowa").style.visibility = "visible";
	}



	// virtual player acquire lock
	function vpAcquireLock(){
		Alert.render("VP (Thread 2) is acquiring the lock MethodLock. But, you (Bob - Thread 1) are holding the lock. <br /> So, VP (Thread 2) is waiting for you to release the lock. Please hurry!!!")
		document.getElementById("arrowa").style.visibility = "hidden";
		document.getElementById("arrowa0").style.visibility = "visible";
		document.getElementById("vpmlock").style.visibility = "visible";
	}



	// virtual player get lock
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



	// virtual player get next question
	function vpNexQuest(){
		document.getElementById("vpRead").style.visibility = "visible";
		
		// game hasnot been finished
		if(index < 4){
			document.vpForm.question.value = arr[index];
		} else {
			document.vpForm.question.value = "";
		}
		
		// tricker the arrows
		document.getElementById("Bob" + index).style.backgroundColor="#00FF00";
		document.getElementById("arrowa"+index).style.visibility = "hidden";
		index=index+1;
		document.getElementById("arrowa"+index).style.visibility = "visible";
	
		// game has finished
		if(index < 6){
			document.getElementById("Q" + index).style.visibility = "hidden";
			document.getElementById("vpQ" + index).style.visibility = "visible";
		}
	
		// if game at the last stage
		if(index == 6){
			document.getElementById("nump").innerHTML = "2";
			var theDelay = 1; 		
			var timer = setTimeout("vpUnlock()",(theDelay)*1000)
			return;
		}else{
			var theDelay = 1; 		
			var timer = setTimeout("vpNexQuest()",(theDelay)*1000)
		}
	}



	// virtual player unlock
	function vpUnlock(){
		document.getElementById("arrowa"+index).style.visibility = "hidden";
		document.getElementById("text2").style.backgroundColor="#00FF00";				
		index=index+1;
		document.getElementById("arrowa"+index).style.visibility = "visible";
	
		var theDelay = 1; 		
		var timer = setTimeout("vpFinished()",(theDelay)*1000);
	}



	// virtual player finished
	function vpFinished(){
		document.getElementById("arrowa"+7).style.visibility = "hidden";
		Alert.render("Bob (Thread 1) and VP (Thread 2) finished the playGame() in the correct order.<br /> <h3>So, nump contains correct value, which is 2 at the end of the game.</h3>But, Mutual Exclusion can lead to a Deadlock.<br /> If you would like to see a Deadlock, please go to DeadLock.php page.");
	}



	// bob acquier lock
	function acquireLock(){
		document.loadgameForm.nolockLoadgame.disabled=true;
		document.load.loadButton.disabled=true;
		document.getElementById("mlock").style.visibility = "visible";
		document.getElementById("arrow").style.visibility = "hidden";
		document.getElementById("arrow0").style.visibility = "visible";
		var theDelay = 2;
		var timer = setTimeout("loadGame()",(theDelay)*1000);
	}



	// bob finished
	function bobFinished(){		
		document.getElementById("arrow7").style.visibility = "hidden";
		var r = confirm("Bob (Thread 1) finished the game playGame() and the MethodLock lock released.\nLet's VP (Thread 2) acquire MethodLock lock and play playGame(). \n Would you like to see VP (Thread 2) process playGame()?");
		if(r == true){
			var theDelay = 2;
			var timer = setTimeout("vpGetLock()",theDelay*1000);
		}
	}



	// bob get next question
	function nextQuest(){
		document.getElementById("bobRead").style.visibility = "visible";
	
		// bob hasnot finished
		if(index < 4){
			document.userForm.question.value = arr[index];
		} else {
			document.userForm.question.value = "";
		}
		
		// tricker the arrows
		document.userForm.answer.value="";
		document.getElementById("Bob" + index).style.backgroundColor="#00FF00";
		document.getElementById("arrow"+index).style.visibility = "hidden";
		index=index+1;
		document.getElementById("arrow"+index).style.visibility = "visible";
	
		// bob finished
		if(index < 6){
			document.getElementById("Q" + index).style.visibility = "hidden";
			document.getElementById("BobQ" + index).style.visibility = "visible";
		}
	
		// bob at the last stage
		if(index == 6){
			document.getElementById("nump").innerHTML = "1";
			document.userForm.submit.disabled=true;	
			var theDelay = 1; 		// need to change to 3
			var timer = setTimeout("unlock()",(theDelay)*1000)
			return;
		}
	}



	// bon unlock
	function unlock(){
		document.userForm.submit.disabled=true;
		document.getElementById("arrow"+index).style.visibility = "hidden";
		document.getElementById("text2").style.backgroundColor="#00FF00";		
			
		index=index+1;
		document.getElementById("arrow"+index).style.visibility = "visible";
	
		var theDelay = 1;
		var timer = setTimeout("releasedLock()",(theDelay)*1000)
	}



	// bob release the lock
	function releasedLock(){

		document.getElementById("arrow5").style.visibility = "hidden";
		document.getElementById("text1").style.backgroundColor="rgb(118, 150, 154)";
		document.getElementById("text2").style.backgroundColor="rgb(118, 150, 154)";	
		document.getElementById("mlock").style.visibility = "hidden";
		document.getElementById("bobRead").style.visibility = "hidden";
		document.getElementById("methodLock").style.visibility = "visible";
		document.getElementById("lockImage1").style.visibility = "hidden";		
	
		for(var i=1; i<6; i++){
			document.getElementById("Bob"+i).style.backgroundColor="rgb(118, 150, 154)";
			document.getElementById("Q" + i).style.visibility = "visible";
			document.getElementById("BobQ" + i).style.visibility = "hidden";
		}
	
			
		var theDelay = 1;
		var timer = setTimeout("bobFinished()",(theDelay)*1000)
	}



	// customised alert message
	function CustomAlert() {
		// set up message window
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
		
		// add OK button
		this.ok = function() {
			document.getElementById('dialogbox').style.display = "none";
			document.getElementById('dialogoverlay').style.display = "none";	
			document.getElementById("analogy").style.visibility = "visible";
			document.getElementById("analogy2").style.visibility = "visible";
		}
	}
