<!DOCTYPE html>
<html>





<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Mutual Exclusion</title>

<!-- CSS that define GUI components -->
<link rel="stylesheet" href="data/style.css" type="text/css"media="screen">
<link rel="stylesheet" href="data/mutualexclusion.css" type="text/css" id="css">
	
<!-- all scripts required in this page -->
<script src="ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="./scripts/mutualexclusion.js" type="text/javascript"></script>

</head>





<body onclick="Freeze()">
	<div id="dialogoverlay"> </div>
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
				<center>Mutual Exclusion</center>
			</h2>
				<button id="disable" style="visibility:hidden;" ></button>

				<span style="float: right;"> <a href="Home.php"
					style="color: #CC0000"><right> HOME </right></a>
				</span>
		</div>
		<!-- @ Header ends here +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


		<div id="content">
			<!-- Shared Resource section -->
			<div id="resources">
				<center>
					Shared &nbsp; Resources:&nbsp; 
						<span id="Game" style="color: #7FCA9F">playGame() Body</span>
						&nbsp;,&nbsp;
						<span id="Q1"></span>
						<span id="Q2" style="color: #7FCA9F">Q1</span>
						&nbsp;,&nbsp;
						<span id="Q3" style="color: #7FCA9F">Q2</span>
						&nbsp;,&nbsp;
						<span id="Q4" style="color: #7FCA9F">Q3</span>
						<span id="Q5"></span>
						&nbsp;,&nbsp;
						<span style="color: #7FCA9F">nump=</span>					
						<span id="nump" style="color: #7FCA9F">0</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Locks:&nbsp; 
						<span id="methodLock" style="color: #7FCA9F">MethodLock</span>
				</center>
			</div>
			<!-- @ Shared Resource section ends here -->
		
			<!-- Left Section (for Thread 1) -->
			<div id="left">

				<h2>Processor 1</h2>
				<h3>Bob (Thread 1)
					<span id="mlock" style="visibility: hidden; color: white; font-size: 13pt;">Acquiring MethodLock</span>
				</h3>
			
				<span id="bobRead" style="visibility: hidden; color: yellow; font-size: 13pt;">read=0</span>
				<h3>
					QUESTION: &nbsp;&nbsp;&nbsp;&nbsp; 
						<span id="BobQ1"></span>
						<span id="BobQ2" style="visibility: hidden; color: #7FCA9F">Q1</span> 
						<span id="BobQ3" style="visibility: hidden; color: #7FCA9F"> , Q2</span>
						<span id="BobQ4" style="visibility: hidden; color: #7FCA9F"> , Q3</span>
						<span id="BobQ5"></span>
				</h3>
				<form name="userForm">
					<div id="p1-question">
						<input type="text" name="question"
							style="width: 300px; height: 50px; font-family: Comic Sans MS; font-size: 15pt; color: blue; background-color: rgb(136, 162, 168)"
							readonly="readonly"></input>
					</div>
					<br /> <br /> 
					
					<input type="text" name="answer"
						style="width: 200px; height: 30px;"></input> <br /> <br /> <input
						type="button" onclick="nextQuest()" value="Submit" name="submit"
						disabled="disabled"> </input>

					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 

				</form>
				<br />
			
				<div>
					<form name="loadgameForm">
						<input type="button" name="nolockLoadgame" value="Load Game" onclick="gameCannotBeLoaded()"></input>
					</form>
				</div>
			
				<div id="load-game">
					<form name="load">
						<input type="button" onclick="acquireLock()"
							value="Load Game & Lock The First Question" name="loadButton"
							> </input>
					</form>
				</div>
				<br /> 
				<img id="lockImage1" src="data/Lock.jpg" width="80"
					height="80" title="L1" alt="L1" align="left"
					style="visibility: hidden;" /><img id="lockImage3"
					src="data/Lock.jpg" width="80" height="80" title="L2" alt="L2"
					align="left" style="visibility: hidden;" /><br /> <br /> <br /> <br />
			</div>
			<!-- @ Left Section (for Thread 1) ends here -->

			<!-- empty div to balance the layout-->
			<div> </div>
		
			<!-- displayGame() section -->
			<div id="middle">
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
								<span id="Bob1">&nbsp;&nbsp;int read=nump;</span> 
								<span id="arrowa1" style="visibility: hidden;">&nbsp;&nbsp; &larr;</span>
							
							
						<br /> 	<span id="arrow2" style="visibility: hidden;">&rarr;</span>
								<span id="Bob2">&nbsp;&nbsp;Answer Q1;</span> 
								<span id="arrowa2" style="visibility: hidden;">&nbsp;&nbsp; &larr;</span>
						<br /> 	<span id="arrow3" style="visibility: hidden;">&rarr;</span>
								<span id="Bob3">&nbsp;&nbsp;Answer Q2;</span> 
								<span id="arrowa3" style="visibility: hidden;">&nbsp;&nbsp; &larr;</span>
						<br /> 	<span id="arrow4" style="visibility: hidden;">&rarr;</span>
								<span id="Bob4" >&nbsp;&nbsp;Answer Q3;</span> 
								<span id="arrowa4" style="visibility: hidden;">&nbsp;&nbsp; &larr;</span>
							
						<br /> 	<span id="arrow5" style="visibility: hidden;">&rarr;</span>
								<span id="Bob5" >&nbsp;&nbsp;nump=read+1;</span> 
								<span id="arrowa5" style="visibility: hidden;">&nbsp;&nbsp; &larr;</span>
									
									
						<br /> 	<span id="arrow6" style="visibility: hidden;">&rarr;</span>
								<span id="text2">&nbsp;UnLock;</span>
								<span id="arrowa6" style="visibility: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &larr;</span>
						<br />	<span id="arrow7" style="visibility: hidden;">&rarr;</span>
								<span>} </span> 
								<span id="arrowa7" style="visibility: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &larr;</span>
						<br />
						<br />
						<br />
						<br />
					</div>
				</h2>
				<br />
			</div>
			<!-- @ displayGame() section ends here -->
			
			<!-- Thread 2 section -->
			<div id="right">
				<div style="margin-left:50px">
					<h2>Processor 2</h2>
					<h3>VirtualPlayer-VP (Thread 2)
						<span id="vpmlock" style="visibility: hidden; color: white; font-size: 13pt;">Acquiring MethodLock</span>
					</h3>

					<span id="vpRead" style="visibility: hidden; color: yellow; font-size: 13pt;">read=1</span>
					<h3>
						QUESTION:&nbsp;&nbsp;&nbsp;&nbsp; 
							<span id="vpQ1"></span>
							<span id="vpQ2" style="visibility: hidden; color: #7FCA9F">Q1</span> 
							<span id="vpQ3" style="visibility: hidden; color: #7FCA9F"> , Q2</span>
							<span id="vpQ4" style="visibility: hidden; color: #7FCA9F"> , Q3</span>
							<span id="vpQ5"></span>
					
					</h3>
				
					<form name="vpForm">
						<input type="text" name="question"
							style="width: 300px; height: 50px; font-family: Comic Sans MS; font-size: 15pt; color: blue; background-color: rgb(100, 140, 140);"
							readonly="readonly"></input> <br /> <br /> <br /> <input
							type="text" name="answer" style="width: 200px; height: 30px;"
							readonly="readonly"></input> <br /> <br /> <input type="button"
							value="Submit" disabled="disabled"
							> </input>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button id="lockbutton2" disabled="disabled"
							style="visibility: hidden; font-size: 10pt; font-family: Comic Sans MS;">
							Lock Next Question</BUTTON>
					</form>
					<br /> <br />			
				
					<div id="load-game">
						<form>
							<input type="button" onclick="loadGame()"
								value="Load Game & Lock The First Question" disabled="disabled"
								> </input>
						</form>
					</div>
				
					<br /> <img id="lockImage2" src="data/Lock.jpg" width="80"
						height="80" title="L3" alt="L3" align="left"
						style="visibility: hidden;" /> <br /> <br /> <br /> <br /> 
				</div>
			</div>
		</div>
		<!-- @ Thread 2 section ends here -->
		
		

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