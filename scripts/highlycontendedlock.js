/**
* Logic Control Highly Contended Lock Behaviour
*/

	// field set the deadlock view
	var deadlock = false;
	
	// fields control the next pointer of arrow
	var index=1;
	var idx=1;
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



	// loading game
	function loadGame(){

		var xmlhttp;
		
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.open("GET","HContendedLock-question.php",true);
		xmlhttp.send();

		// operations after receiving the data from server
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				var a =xmlhttp.responseText;
				arr = a.split("|");
				document.userForm.question.value = arr[0];
				document.userForm.submit.disabled=false;
				document.getElementById("lockbutton").style.visibility = "visible";
				document.getElementById("Q1").style.visibility = "hidden";
				document.getElementById("L1").style.visibility = "hidden";
				document.load.loadButton.disabled=true;
				document.getElementById("BobQ1").style.visibility = "visible";
				document.getElementById("text1").style.backgroundColor="#006400"
				document.getElementById("lockImage1").style.visibility = "visible";
				document.getElementById("lockbutton").style.visibility = "visible";
				document.getElementById("arrow").style.visibility = "hidden";
				document.getElementById("arrow1").style.visibility = "visible";
				var theDelay = 1;
		  		var timer = setTimeout("VPanalogy()",theDelay*1000)
			}
		}

	}



	// virtual player presentation
	function VPanalogy(){
		document.vpForm.question.style.backgroundImage = "url('data/wait1.png')";
		document.vpForm.question.style.backgroundRepeat="no-repeat"
		document.vpForm.question.style.backgroundSize="50px 50px"
		document.vpForm.question.style.backgroundPosition="top center"
		document.getElementById("VP2").style.backgroundColor="#FF0000";
	}

	
	
	// virtual player next question
	function nextQuest(){
		document.getElementById("Bob" + index).style.backgroundColor="#006400";
		document.getElementById("arrow"+index).style.visibility = "hidden";
		document.userForm.submit.disabled=true;
		document.userForm.lockbutton.disabled=false;
		index=index+1;
		idx = idx+1;
		document.getElementById("arrow"+index).style.visibility = "visible";
		document.userForm.lockbutton.value="Unlock";
	}



	// bob get next lock
	var questionCounter = 1;
	function nextLock(){
		// even questions
		if( idx%2 == 0 ) {
			// bob has not finished
			if(idx <6) {
				document.userForm.question.value = "";
				document.userForm.answer.value="";
				document.userForm.lockbutton.value="Lock Next Question";
				document.getElementById("Bob"+index).style.backgroundColor="#006400"
				document.userForm.submit.disabled=true;
				document.userForm.lockbutton.disabled=false;
				document.getElementById("arrow"+index).style.visibility = "hidden";
				document.getElementById("BobQ"+(idx-1)).style.visibility = "hidden";
				document.getElementById("lockImage"+(idx-1)).style.visibility = "hidden";
				document.getElementById("lImage"+(idx-1)).style.visibility = "visible";
				document.getElementById("VPQ"+(idx-1)).style.visibility = "visible";
				document.getElementById("VP"+idx).style.backgroundColor="#006400";
				document.vpForm.question.style.backgroundImage = "none";
				document.vpForm.question.value = arr[questionCounter-1];
				index=index+1;
				idx = idx+1;
				document.getElementById("arrow"+index).style.visibility = "visible";

			// bob has finished
			} else {
				Alert.render("Bob Wins!!!");
				document.getElementById("lockImage"+(idx-1)).style.visibility = "hidden";
				document.getElementById("lImage"+(idx-1)).style.visibility = "visible";
				document.getElementById("BobQ"+(idx-1)).style.visibility = "hidden";
				document.getElementById("Bob"+index).style.backgroundColor="#006400";
				document.getElementById("VP7").style.backgroundColor="#006400";
				document.getElementById("VPQ"+(idx-1)).style.visibility = "visible";
				document.vpForm.question.value = arr[questionCounter-1];
				document.userForm.question.value = "";
				document.userForm.answer.value="";
				document.userForm.submit.disabled=true;
				document.userForm.lockbutton.disabled=true;
				document.getElementById("arrow"+index).style.visibility = "hidden";
				document.vpForm.question.style.backgroundImage = "none";
				var theDelay = 2;
		  		var timer = setTimeout("message()",theDelay*1000)
			}

		// odd questions
		} else {
 			document.getElementById("VPQ"+(idx-2)).style.visibility = "hidden";
 			document.getElementById("Q"+(idx-2)).style.visibility = "visible";
			document.getElementById("L"+(idx-2)).style.visibility = "visible";
			document.getElementById("lImage"+(idx-2)).style.visibility = "hidden";
 			document.getElementById("VP"+idx).style.backgroundColor="#006400";
 			document.getElementById("VP"+idx+idx).style.backgroundColor="#006400";
 			document.vpForm.question.value = "";
 			document.vpForm.question.style.backgroundImage = "url('data/wait1.png')";
 			document.vpForm.question.style.backgroundRepeat="no-repeat"
 			document.vpForm.question.style.backgroundSize="50px 50px"
 			document.vpForm.question.style.backgroundPosition="top center"
 			document.userForm.question.value = arr[questionCounter++];
 			document.getElementById("Q"+idx).style.visibility = "hidden";
			document.getElementById("L"+idx).style.visibility = "hidden";
			document.getElementById("BobQ"+idx).style.visibility = "visible";
			document.getElementById("lockImage"+idx).style.visibility = "visible";
			document.userForm.submit.disabled=false;
			document.userForm.lockbutton.disabled=true;
			document.getElementById("Bob"+index).style.backgroundColor="#006400"
			document.getElementById("arrow"+index).style.visibility = "hidden";
			document.getElementById("arrow"+(index+1)).style.visibility = "visible";
			index=index+1;
			document.getElementById("VP"+index).style.backgroundColor="#FF0000";
 		}
	}



	// message at the end of the game
	function message(){
		Alert.render("1. Threads that all use the same lock become queued to use the lock and end up serializing the processing.!!!"
				+ "<br/> 2. If threads try to acquire a lock faster than the rate at which a thread can execute the corresponding critical section,"+
				"then program performance will suffer as threads will form a \"convoy\" waiting to acquire the lock.");
	}
	
	
	
	// our customised alert message
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
		
		// set up OK button
		this.ok = function() {
			document.getElementById('dialogbox').style.display = "none";
			document.getElementById('dialogoverlay').style.display = "none";	
			document.getElementById("analogy").style.visibility = "visible";
			document.getElementById("analogy2").style.visibility = "visible";
		}
		
		// set up message
		this.message = function(dialog) {
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
	}