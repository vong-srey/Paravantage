<?php

if(isSet($_GET["page"])){
	if($_GET["page"]=="racecondition"){
		echo "racecondition";
	} else if($_GET["page"]=="criticalsection" ){
		echo "critical section";		
	} else if($_GET["page"]=="deadlock" ){
		echo "deadlock";
	}
} else {
	
	echo "home page";
}