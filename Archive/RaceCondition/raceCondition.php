<!DOCTYPE html>
<html>
<script src="ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<script>

	var userName1="Bob";
	var userName2="Virtual Player";
	var Lock=false;

	function submitUser1(){
	//document.write("nancy");
	document.getElementById('loadThread1').disabled=false;
	document.getElementById('submitThread1').disabled=true;
	}
	function loadThread1(){
		
		document.getElementById('readThread1').disabled=false;
		document.getElementById("threadProcessed").innerHTML="Thread1";
		document.getElementById("threadProcessed").style.visibility="visible";
		document.getElementById("middleTop").style.background="none repeat scroll 0% 0% rgb(10,10,80)";
	}
	
	function readThread1(){
	
		document.getElementById("verifyThread1").disabled=false;
		document.getElementById("readThreadLabel1").style.visibility="visible";
		document.getElementById("readThread1").disabled=true;

	}
	function verifyThread1(){
		if(document.getElementById("winnerTextBox").value=="No Winner Yet"){
			document.getElementById("writeThread1").disabled=false;
			document.getElementById("verifyThreadLabel1").style.visibility="visible";				
		}
		else{
			document.getElementById("verifyThreadLabel1").innerHTML="Winner is not null";
			document.getElementById("verifyThreadLabel1").style.visibility="visible";	
		}
		document.getElementById("readThread1").disabled=true;
		document.getElementById("verifyThread1").disabled=true;
	}
	function writeThread1(){	
			document.getElementById("writeThreadLabel1").style.visibility="visible";
			document.getElementById("winnerTextBox").style.visibility="visible";
			document.getElementById("winnerTextBox").value="Bob";
			document.getElementById("loadThread1").disabled=true;
			document.getElementById("writeThread1").disabled=true;	
	}
	function submitUser2(){
	
		document.getElementById('loadThread2').disabled=false;
		document.getElementById('submitThread2').disabled=true;
	}
	function loadThread2(){
		
		document.getElementById('readThread2').disabled=false;
		document.getElementById("threadProcessed").innerHTML="Thread2";
		document.getElementById("threadProcessed").style.visibility="visible";
		document.getElementById("middleTop").style.background="none repeat scroll 0% 0% rgb(50, 100, 10)";
	}
	
	function readThread2(){
	
		document.getElementById("verifyThread2").disabled=false;
		document.getElementById("readThreadLabel2").style.visibility="visible";
		document.getElementById("readThread2").disabled=true;

	}
function verifyThread2(){
		//document.write("nancy");
		if(document.getElementById("winnerTextBox").value=="No Winner Yet"){
			document.getElementById("writeThread2").disabled=false;
			document.getElementById("verifyThreadLabel2").style.visibility="visible";				
		}
		else{
			document.getElementById("verifyThreadLabel2").innerHTML="Winner is not null";
			document.getElementById("verifyThreadLabel2").style.visibility="visible";	
		}
		document.getElementById("readThread2").disabled=true;
		document.getElementById("verifyThread2").disabled=true;
	}
	function writeThread2(){		
		document.getElementById("writeThreadLabel2").style.visibility="visible";
		document.getElementById("winnerTextBox").style.visibility="visible";
		document.getElementById("winnerTextBox").value="Casey";
		document.getElementById("loadThread2").disabled=true;
		document.getElementById("writeThread2").disabled=true;		
	}

</script>

<header>
<meta http-equiv="content-type" content="text/php; charset=UTF-8">
	<title>Home</title>
	<link rel="stylesheet" href="data/raceCondition.css" type="text/css" media="screen">
	<style type="text/css" id="css"></style>
</header>


<body>
	<div id="main">	
	<!-- Header begins here: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		
			<div id="header">
				<h1>Paravantage</h1>
				<a href="index.php"> Home </a>
			</div>
	<!-- Header ends here: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	
	
	<!-- main content begins here: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

		<div id="content">
			<div id="left">	
				<div id="leftTop">
					<!-- name of the thread that the user wants to give-->
					<div id="threadName"><h1> <label id="User1">Bob </label> </h1>
					</div>
					<!--Question Area -->
					<div id="questionArea">	
						<form name="user1Form">
							<input type="button" onclick="" value="Load" name="Submit"
										disabled="disabled" style="font-size: 15pt;">
												</input>
							QUESTION: &nbsp;&nbsp;&nbsp;&nbsp; 
								<span id="BobQ1" style="visibility: hidden; color: #7FCA9F">Q1</span> 
								<span id="BobQ2" style="visibility: hidden; color: #7FCA9F"> , Q2</span>
								<span id="BobQ3" style="visibility: hidden; color: #7FCA9F"> , Q3</span>
															
							<div id="question">
								<input type="text" name="question" 
										style="width: 250Px; height: 30px; font-family: Comic Sans MS; font-size: 15pt; color: blue; background-color: rgb(136, 162, 168)"
											value= "12*120" readonly="true">
								</input>
							</div>
						</form>
						<br>
										
							<div id="answerSubmit" style="width: 425Px; height: 30px">
								<table>
									<tr>
										<td> Answer:
										<td>	<input  type="text" name="answer"
													style="width: 100px; height: 30px;">
												</input> 
										<td>	<input id="submitThread1" type="button" onclick="submitUser1();" value="Submit" name="submit" 
										 style="font-size: 15pt;">
												</input>
									</tr>
								</table>
							</div>
						
					</div>			
				</div>
				<div id="leftBottom">
					<!-- name of the thread that the user wants to give-->
					<div id="threadName"><h1>Thread 1 : Bob</h1>
					</div>
					<!--Question Area -->
					<div id="questionArea">	
						
							<table>
								<tr>
									<td> <input id="getCSThread1" type="button" onclick="csThread1();" value="getLock" name="Submit"
										disabled="disabled" style="font-size: 15pt;">
												</input>
									<td> <span id="getCSThreadLabel1" style="visibility: hidden; color: #7FCA9F">Critical Section created</span>		
								</tr>
								<tr>
									<td> <input id="readThread1" type="button" onclick="readThread1();" value="Read" name="Submit"
										disabled="disabled" style="font-size: 15pt;">
												</input>
									<td> <span id="readThreadLabel1" style="visibility: hidden; color: #7FCA9F">Thread 1 reads winner</span>		
								</tr>
								<tr>	<td> <input id="verifyThread1" type="button" onclick='verifyThread1();' value="Verify" 
										disabled="disabled" style="font-size: 15pt;">
												</input>
									<td> <span id="verifyThreadLabel1" style="visibility: hidden"> Thread 1 verifies winner is null</span>
								</tr>
								<tr>	<td> <input id="writeThread1" type="button" onclick="writeThread1();" value="Write" name="Submit"
										disabled="disabled" style="font-size: 15pt;">
												</input>
									<td> <span id="writeThreadLabel1" style="visibility: hidden; color: #7FCA9F"> Thread 1 Writes winner as Bob</span>
								</tr>
								<tr>
									<td> <input id="leaveCSThread1" type="button" onclick="csThread1();" value="Unlock" name="Submit"
										disabled="disabled" style="font-size: 15pt;">
												</input>
									<td> <span id="leaveCSThreadLabel1" style="visibility: hidden; color: #7FCA9F">Critical Section released</span>		
								</tr>
							</table>		
						
					</div>			
				</div>
			</div>
			
			<div id="middle">
				<div id="middleTop">	
				
					<h1>Processor</h1>
					<br>
					<br>
					<br>
					<table>
						<tr>
							<td> Processed Thread : 
							<td> <span id="threadProcessed" style="visibility: hidden; color: #7FCA9F;font-size:20pt"></span>
						</tr>
						<tr>
							<td>
							<td>	<input id="loadThread1" type="button" onclick="loadThread1();" value="Load Thread 1" name="submit" disabled="true"
										 style="font-size: 15pt;">
							<td>
						</tr>
					
						<tr>
							<td>
							<td>	<input id="loadThread2"type="button" onclick="loadThread2();" value="Load Thread 2" name="submit" disabled="true"
										 style="font-size: 15pt;">
							<td>
						</tr>
					</table>
				</div>
				<div id="middleBottom">	
				
					<h1>Shared Resources</h1>	
					<table>
						<tr>
							<td> <h2> variable Winner : </h2>
							<td> <input id="winnerTextBox" type="text" name="answer" style="width: 200px; height: 30px; font-size: 30px; visibility:hidden " 
								value="No Winner Yet" readonly="true">
								</input> 
						</tr>
						<tr>
							<td> <h2> Locks: </h2>
							<td> <span id="readThreadLabel2" style="color: #7FCA9F">Critical Section</span> 
						</tr>
							
					</table>
				</div>
					
			</div>
						<div id="right">
				<div id="rightTop">
					<!-- name of the thread that the user wants to give-->
					<div id="threadName"><h1>Virtual Player(vp) </h1>
					</div>
					<!--Question Area -->
					<div id="questionArea">	
						<form name="userForm">
							<input type="button" onclick="nextQuest()" value="Load" name="Submit"
										disabled="disabled" style="font-size: 15pt;">
												</input>
							QUESTION: &nbsp;&nbsp;&nbsp;&nbsp; 
								<span id="BobQ1" style="visibility: hidden; color: #7FCA9F">Q1</span> 
								<span id="BobQ2" style="visibility: hidden; color: #7FCA9F"> , Q2</span>
								<span id="BobQ3" style="visibility: hidden; color: #7FCA9F"> , Q3</span>
															
							<div id="question">
								<input type="text" name="question" value="45*45"
										style="width: 250Px; height: 30px; font-family: Comic Sans MS; font-size: 15pt; color: blue; background-color: rgb(136, 162, 168)"
											readonly="readonly">
								</input>
							</div>
						</form>
						<br>
										
							<div id="answerSubmit" style="width: 425Px; height: 30px">
								<table>
									<tr>
										<td> Answer:
										<td>	<input type="text" name="answer"
													style="width: 100px; height: 30px;">
												</input> 
										<td>	<input id="submitThread2" type="button" onclick="submitUser2();" value="Submit" name="submit" 
										 style="font-size: 15pt;">
												</input>
									</tr>
								</table>
							</div>
						
					</div>			
				</div>
				<div id="rightBottom">
					<!-- name of the thread that the user wants to give-->
					<div id="threadName"><h1>Thread 2 : Virtual Player</h1>
					</div>
					<!--Question Area -->
					<div id="questionArea">							
							<table>
								<tr>
									<td> <input id="getCSThread1" type="button" onclick="csThread1();" value="getLock" name="Submit"
										disabled="disabled" style="font-size: 15pt;">
												</input>
									<td> <span id="getCSThreadLabel1" style="visibility: hidden; color: #7FCA9F">Critical Section created</span>		
								</tr>
								<tr>
									<td> <input id="readThread2" type="button" onclick="readThread2();" value="Read" name="Submit"
										disabled="disabled" style="font-size: 15pt;">
												</input>
									<td> <span id="readThreadLabel2" style="visibility: hidden; color: #7FCA9F">Thread 2 reads winner</span>				
								</tr>
								<tr>	<td> <input id="verifyThread2" type="button" onclick="verifyThread2();" value="Verify" name="Submit"
										disabled="disabled" style="font-size: 15pt;">
												</input>
									<td> <span id="verifyThreadLabel2" style="visibility: hidden; color: #7FCA9F"> Thread 2 verifies winner is null</span>
								</tr>
								<tr>	<td> <input id="writeThread2" type="button" onclick="writeThread2();" value="Write" name="Submit"
										disabled="disabled" style="font-size: 15pt;">
												</input>
									<td> <span id="writeThreadLabel2" style="visibility: hidden; color: #7FCA9F">Thread 2 Writes winner vp</span>	
								</tr>
								<tr>
									<td> <input id="leaveCSThread1" type="button" onclick="csThread1();" value="Unlock" name="Submit"
										disabled="disabled" style="font-size: 15pt;">
												</input>
									<td> <span id="leaveCSThreadLabel1" style="visibility: hidden; color: #7FCA9F">Critical Section released</span>		
								</tr>
							</table>
					</div>			
				</div>
			</div>			
		</div>	
	<!-- main content ends here: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
	
	<!-- footer begins here: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		</div>	
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
