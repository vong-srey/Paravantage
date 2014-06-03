<!-- This page is used as a layout for other pages-->

<!DOCTYPE html>
<html>





<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Home</title>

<!-- CSS that define GUI components -->
<link rel="stylesheet" href="data/style.css" type="text/css"	media="screen">

<!-- all scripts required in this page -->
<script src="ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
</head>





<body onclick="Freeze()">
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
				<center>Home</center>
			</h2>
				<button id="disable" style="visibility:hidden;" ></button>

				<span style="float: right;"> <a href="index.php"
					style="color: #CC0000"><right> HOME </right></a>
				</span>

		</div>
		<!-- @ Header ends here +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		

		<div id="content">
			<!-- Shared Resource section -->
			<div id="resources">
				<center>
					<button style="font-size: 13pt; font-family: Comic Sans MS;" onclick="location.href='./RaceCondition.php'">
					     Race Condition</button>
					<button style="font-size: 13pt; font-family: Comic Sans MS;" onclick="location.href='./MutualExclusion.php'">
						     Mutual Exclusion</button>
					<button style="font-size: 13pt; font-family: Comic Sans MS;" onclick="location.href='./DeadLock.php'">
					     Dead Lock</button>
					<button style="font-size: 13pt; font-family: Comic Sans MS;" onclick="location.href='./HighlyContentedLock.php'">
					     Highly Contended Lock</button>
				</center>
			</div>
			<!-- @ Shared Resource section: ends here-->

			
			<!-- Left Section (for Thread 1) -->
			<div id="left"></div>
			<!-- @ Left Section (for Thread 1) ends here -->

			<!-- empty div to balance the layout-->
			<div> </div>
		
			<!-- displayGame() section -->
			<div id="middle"></div>
			<!-- @ displayGame() section ends here -->
			
			<!-- Thread 2 section -->
			<div id="right"></div>
		<!-- @ Thread 2 section ends here -->
					
					
	<!-- footer begins here: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		<div id="footer">
			<div id="footer-uoa">		
						University Of Auckland , Software Engineering.
			</div>
			
			<div id="footer-author"> Team: Victor, Nancy, Aravind </div>
		</div>
	<!-- footer ends here: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

	</div>

</body>

</html>