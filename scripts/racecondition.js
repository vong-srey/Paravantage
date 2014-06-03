/**
* Logic Control Race Condition Behaviour
*/

	// field control the speed of the Virtual Player
	var theDelayVPNex=1.5;
	
	// fields control the next pointer of arrow
	var index=1;
	var vpindex=1;
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



	// Load game
	function loadGame(){
		
		vpStartPlayGame();

		var xmlhttp;
		
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.open("GET","racecondition-question.php",true);
		xmlhttp.send();

		// operations after receiving a response from the server
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				var a =xmlhttp.responseText;
				arr = a.split("|");
				document.userForm.question.value = arr[0];
				document.userForm.submit.disabled=false;				
				document.getElementById("methodLock").style.visibility = "hidden";
				document.getElementById("BobQ1").style.visibility = "visible";
				document.getElementById("arrow0").style.visibility = "hidden";
				document.getElementById("arrow1").style.visibility = "visible";
			}
		}

	}
	
	
	
	// virtual player start game
	function vpStartPlayGame(){
		document.getElementById("arrowa").style.visibility = "visible";
	}
	
	
	
	// virutal player acquire lock
	function vpAcquireLock(){
		document.getElementById("arrowa").style.visibility = "hidden";
		document.getElementById("arrowa0").style.visibility = "visible";
		document.getElementById("vpmlock").style.visibility = "visible";
		vpGetLock();
	}
	
	
	
	// virtual player get the lock
	function vpGetLock(){
		document.getElementById("methodLock").style.visibility = "hidden";
		document.getElementById("vpmlock").style.visibility = "visible";
		document.getElementById("vpQ1").style.visibility = "visible";
		document.getElementById("arrowa0").style.visibility = "hidden";
		document.getElementById("arrowa1").style.visibility = "visible";
		document.vpForm.question.value = arr[0];
		
		vpindex = 1;
  		var timer = setTimeout("vpNexQuest()",theDelayVPNex*1000)
	}
	
	
	
	// virtual player get next question
	function vpNexQuest(){
		// game hasnot been finished, loading the question
		if(vpindex < 4){
			document.vpForm.question.value = arr[vpindex];
		} else {
			document.vpForm.question.value = "";
		}
		
		// set arrow pointers (visible and hidden)
		document.getElementById("arrowa"+vpindex).style.visibility = "hidden";
		vpindex=vpindex+1;
		document.getElementById("arrowa"+vpindex).style.visibility = "visible";
		if(vpindex < 5){
			document.getElementById("vpQ" + vpindex).style.visibility = "visible";
		}
		
		// game has been finished
		if(vpindex == 5){
			document.getElementById("nump").innerHTML = "1";
			var timer = setTimeout("vpUnlock()",(theDelayVPNex)*1000)
			return;
		}else{
			var timer = setTimeout("vpNexQuest()",(theDelayVPNex)*1000)
		}
	}
	
	
	
	// virtual player unlock
	function vpUnlock(){
		document.getElementById("arrowa"+vpindex).style.visibility = "hidden";	
		vpindex=vpindex+1;
		document.getElementById("arrowa"+vpindex).style.visibility = "visible";
		document.getElementById("arrowa6").style.visibility = "hidden";
		document.getElementById("vpmlock").style.visibility = "hidden";
	}
	
	
	
	// Bob acquire a lock
	function acquireLock(){
		document.load.loadButton.disabled=true;
		document.getElementById("mlock").style.visibility = "visible";
		document.getElementById("arrow").style.visibility = "hidden";
		document.getElementById("arrow0").style.visibility = "visible";
		loadGame();
	}


	
	// Bob finished
	function bobFinished(){		
		document.getElementById("arrow6").style.visibility = "hidden";
		document.getElementById("arrowa"+5).style.visibility = "hidden";
		Alert.render("Bob (Thread 1) and VP (Thread 2) finished the playGame() in an incorrect order.<br /> <h3>nump is supposed to be 2. But, because of the Race Condition, the value of nump is 1.</h3>There are many solutions for this issue. But, we are showing only Mutual Exclusion.<br /> If you would like to see Mutual Exclusion, please go to MutualExclusion.php page.");
	}



	// bob load next question
	function nextQuest(){
		// tricker to start virtual player
		if(index==1){
	  		var timer = setTimeout("vpAcquireLock()",theDelayVPNex*1000)
		}

		// game has not been finished
		if(index < 4){
			document.userForm.question.value = arr[index];
		} else {
			document.userForm.question.value = "";
		}
		
		// trciker arrow pointers
		document.userForm.answer.value="";
		document.getElementById("arrow"+index).style.visibility = "hidden";
		index=index+1;
		document.getElementById("arrow"+index).style.visibility = "visible";
		
		// game has been finished
		if(index < 6){
			document.getElementById("BobQ" + index).style.visibility = "visible";
		}
		
		// game is almost finish
		if(index == 6){
			document.getElementById("nump").innerHTML = "1";
			document.userForm.submit.disabled=true;	
			var theDelay = 1; 		// need to change to 3 if we want slower
			var timer = setTimeout("unlock()",(theDelay)*1000)
			return;
		}
	}
	
	
	
	// bob unlock the question
	function unlock(){
		document.userForm.submit.disabled=true;
		document.getElementById("arrow"+index).style.visibility = "hidden";		
				
		index=index+1;
		document.getElementById("arrow"+index).style.visibility = "visible";
		
		var theDelay = 1;
		var timer = setTimeout("releasedLock()",(theDelay)*1000)
	}
	
	
	
	// bob release the lock
	function releasedLock(){
		document.getElementById("arrow5").style.visibility = "hidden";
		document.getElementById("text1").style.backgroundColor="rgb(118, 150, 154)";
		document.getElementById("mlock").style.visibility = "hidden";
		document.getElementById("methodLock").style.visibility = "visible";

		// hidden all the arrows
		for(var i=1; i<6; i++){
			document.getElementById("BobQ" + i).style.visibility = "hidden";
		}
		
		var theDelay = 1;
		var timer = setTimeout("bobFinished()",(theDelay)*1000)
	}
	
	// a customised alert message
	function CustomAlert() {
		// set up a customised window
		this.render = function(dialog) {
			// set up window, its layout and colours
			var winW = window.innerWidth;
			var winH = window.innerHeight;
			var dialogoverlay = document.getElementById('dialogoverlay');
			var dialogbox = document.getElementById('dialogbox');
			dialogoverlay.style.display = "block";
			dialogoverlay.style.height = winH+"px";
			dialogbox.style.left = (winW/2) - (550 * .5)+"px";
			dialogbox.style.top = "100px";
			dialogbox.style.display = "block";
			// set up default element, and title
			document.getElementById('dialogboxhead').innerHTML = "Acknowledge This Message";
			document.getElementById('dialogboxbody').innerHTML = dialog;
			document.getElementById('dialogboxfoot').innerHTML = '<button onclick="Alert.ok()">OK</button>';
		}
		// set up OK button
		this.ok = function() {
			document.getElementById('dialogbox').style.display = "none";
			document.getElementById('dialogoverlay').style.display = "none";	
			document.getElementById("analogy").style.visibility = "visible";
			document.getElementById("analogy2").style.visibility = "visible";
		}
	}
	
	