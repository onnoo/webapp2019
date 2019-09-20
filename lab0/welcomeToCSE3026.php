<!DOCTYPE html>
<html>
	<head>
		<!-- metadata -->
		<meta charset="utf-8" />
		<meta name="author" content="Scott Uk-Jin Lee" />
		<meta name="description" content="PHP demo page for CSE3026: Web Application Development." />
		
		<title>CSE3026 PHP Demo: Welcome to CSE3026!</title>
	</head>

	<body>
		<h1>Welcome to CSE3026: Web Application Development Course!</h1>
		<p>
			Hello, 
			<strong>
				<?php
					$name = $_GET["name"];
					print "$name!"; 
				?>
			</strong>
			<br>
			Welcome to the first lab session of CSE3026: Web Application Development Course.
			<br>
			Hope that the lab sessions can help you better understand the concepts learned during the lectures.
		</p>
		
		<hr>
		
		<address>
			Written by <a href="mailto:scottlee@hanyang.ac.kr">Scott Lee</a>. / 2019-09-01
		</address>
	</body>
</html>