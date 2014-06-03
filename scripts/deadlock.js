/**
* Logic Control Deadlock Behaviour
*/

	// field control the speed of the Virtual Player
	var deadlock = false;
	
	// fields control the next pointer of arrow
	var index=1;
	var arr = new Array();
	
	// alert message when game loaded.
	var Alert = new CustomAlert();
	window.onload = function(){
		var theDelay = 1;
		var timer = setTimeout("loadText()",(theDelay)*1000)
	}
	
	
	
	// load game text
	function loadText(){
  		Alert.render("Click on Load Game Button")
	}

	
	
	// load game
	function loadGame(){

		var xmlhttp;
		
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.open("GET","deadlock-question.php",true);
		xmlhttp.send();

		// operations when receiving data from server
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
				document.getElementById("text1").style.backgroundColor="#00FF00"
				document.getElementById("lockImage1").style.visibility = "visible";
				document.getElementById("lockbutton").style.visibility = "visible";
				document.getElementById("arrow").style.visibility = "hidden";
				document.getElementById("arrow1").style.visibility = "visible";
				var theDelay = 1;
		  		var timer = setTimeout("VPanalogy()",theDelay*1000)
			}
		}

	}



	// virtual player start
	function VPanalogy(){
		document.vpForm.question.value = arr[2];
		document.getElementById("Q3").style.visibility = "hidden";
		document.getElementById("L3").style.visibility = "hidden";
		document.getElementById("VPQ3").style.visibility = "visible";
		document.getElementById("text4").style.backgroundColor="#00FF00";
		document.getElementById("lockImage2").style.visibility = "visible";
		document.getElementById("lockbutton2").style.visibility = "visible";
	}

	
	
	// virtual player next question
	function nextQuest(){
		document.getElementById("Bob" + index).style.backgroundColor="#00FF00";
		document.getElementById("arrow"+index).style.visibility = "hidden";
		if(index==1) {
			document.getElementById("VP"+index).style.backgroundColor="#00FF00";
		}
		document.userForm.submit.disabled=true;
		document.userForm.lockbutton.disabled=false;
		index=index+1;
		document.getElementById("arrow"+index).style.visibility = "visible";
	}
	
	
	
	// bob next question
	function nextLock(){
		// special case, when index =2
		if( index==2 ) {
			document.userForm.question.value = arr[index-1];
			document.vpForm.answer.value = "";
			document.vpForm.question.value = "";
			document.vpForm.question.style.backgroundImage = "url('data/wait1.png')";
			document.vpForm.question.style.backgroundRepeat="no-repeat"
			document.vpForm.question.style.backgroundSize="50px 50px"
			document.vpForm.question.style.backgroundPosition="top center"
			document.userForm.answer.value="";
			document.getElementById("Bob"+index).style.backgroundColor="#00FF00"
			document.getElementById("VP" +index).style.backgroundColor="#FF0000"
			document.getElementById("Q2").style.visibility = "hidden";
			document.getElementById("L2").style.visibility = "hidden";
			document.getElementById("BobQ2").style.visibility = "visible";
			document.userForm.submit.disabled=false;
			document.userForm.lockbutton.disabled=true;
			document.getElementById("lockImage3").style.visibility = "visible";
			document.getElementById("arrow"+index).style.visibility = "hidden";
			index=index+1;
			document.getElementById("arrow"+index).style.visibility = "visible";
			
		// general case
		} else {
			document.userForm.answer.value = "";
			document.userForm.question.value = "";
			document.userForm.question.style.backgroundImage = "url('data/wait1.png')";
			document.userForm.question.style.backgroundRepeat="no-repeat"
			document.userForm.question.style.backgroundSize="50px 50px"
			document.userForm.question.style.backgroundPosition="top center"
 			document.userForm.submit.disabled="disabled";
			document.load.loadButton.disabled="disabled";
			document.userForm.lockbutton.disabled=true;
			document.getElementById("Bob"+index).style.backgroundColor="#FF0000"
			var theDelay = 0.5;
 			var timer = setTimeout("setDeadlockFrozen()",theDelay*1000)
		}
	}
	
	
	
	// showing deadlock
	function setDeadlockFrozen(){
		deadlock = true;
	}



	// freeze the window to show the deadlock image
	function Freeze(){
		if(deadlock){
			deadlock = false;
			var dialogoverlay = document.getElementById('dialogoverlay');
	         dialogoverlay.innerHTML = '<img src="data/deadlock.png" width="500" height="500" title="Lock" alt="Lock" align="center" onclick="unfreeze()" />';
			dialogoverlay.style.display = "block";
			dialogoverlay.style.height = winH+"px";			
		}
	}
	
	
	
	// unfreeze the window
	function unfreeze(){
		document.getElementById('dialogoverlay').style.display = "none";
		Alert.render("The use of lock (to make Mutual Exclusion) can lead to a Deadlock.<br />In order to solve the DeadLock, your thread has to release the Lock before it acquire another Lock.<br />However, The Lock still can lead to ContentedLock.<br />Please go to HighlyContentedLock.php to see the Contented Lock example.")
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
	}
