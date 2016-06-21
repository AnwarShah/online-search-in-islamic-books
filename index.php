<?php
	header('Content-Type: text/html; charset=windows-1256');
	ini_set('max_execution_time', 300);
?>
<!doctype html>
<html lang='ar'>

<head>
	<meta http-equiv='Content-Language' content='ar-sa'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Khujo.ga</title>
	<style>
	
		body, html {
		  width: 97%;
		}

		footer {
		  width: 97%;
		}
		
		h1, form {
			direction: ltr;
			text-align: center;
			color: darkgreen;
		}
		.inputbox {
			FONT-SIZE: 20px !important;
			FONT-WEIGHT: unset !important;
			FONT-FAMILY: 'Traditional Arabic' !important;
			text-align: center;
			height: 7vh;
			width: 40vw;
			direction: rtl;
			color: darkgreen;
		}
		
		.inputbox:hover {
			FONT-SIZE: 20px !important;
			FONT-WEIGHT: unset !important;
			FONT-FAMILY: 'Traditional Arabic' !important;
			text-align: center;
			height: 7vh;
			width: 40vw;
			direction: rtl;
			color: green;
		}
		
		.submitbutton {
			color: white;
			background-color: darkgreen;
			border: 0;
			height: 8vh;
			outline: 0;
		}
		
		.submitbutton:hover {
			background-color: lightgreen;
			color: black;
			border: 0;
			height: 8vh;
			outline: 0;
		}
		
		.result { 
			text-align: center !important;
			FONT-SIZE: 25px !important;
			FONT-WEIGHT: unset !important;
			FONT-FAMILY: 'Traditional Arabic' !important;
			color: black !important;
			background-color: white !important;
			font-style: normal !important;
		}
		
		.resultshow { 
			text-align: center !important;
			FONT-SIZE: 16px !important;
			FONT-WEIGHT: unset !important;
			FONT-FAMILY: 'Traditional Arabic' !important;
			color: black !important;
			background-color: white !important;
			font-style: normal !important;
		}
		
		.resultLink {
			FONT-SIZE: 16px !important;
			FONT-WEIGHT: unset !important;
			FONT-FAMILY: 'Traditional Arabic' !important;
			color: blue !important;
			background-color: white !important;
			font-style: normal !important;
		}
		
		.notice {
			color: gray;
			FONT-FAMILY: 'Calibri' !important;
		}
		
		.searchedtext {
			text-align: center;
			color: green;
			FONT-FAMILY: 'Sakkal Majalla' !important;
		}
		
		#englishchars {
			display: none;
			text-align: center !important;
			color: red;
			FONT-FAMILY: 'Sakkal Majalla' !important;
		}
		
	</style>
	
	<script type="text/javascript">
	
		var CHARCODE_SHADDA = 1617;
		var CHARCODE_SUKOON = 1618;
		var CHARCODE_SUPERSCRIPT_ALIF = 1648;
		var CHARCODE_TATWEEL = 1600;
		var CHARCODE_ALIF = 1575;

		function isCharTashkeel(letter)
		{
			if (typeof(letter) == "undefined" || letter == null)
				return false;

			var code = letter.charCodeAt(0);
			//1648 - superscript alif
			//1619 - madd: ~
			return (code == CHARCODE_TATWEEL || code == CHARCODE_SUPERSCRIPT_ALIF || code >= 1612 && code <= 1631); //tashkeel
		}

		function stripTashkeel(input)
		{
		  var output = "";
		  //todo consider using a stringbuilder to improve performance
		  for (var i = 0; i < input.length; i++)
		  {
			var letter = input.charAt(i);
			if (!isCharTashkeel(letter)) //tashkeel
			  output += letter;                                
		  }
			return output;                   
		}
	
		function validateForm()
		{
			document.forms["searchform"]["searchedtext"].value = stripTashkeel(document.forms["searchform"]["searchedtext"].value);
			var a=document.forms["searchform"]["searchedtext"].value;
			
			if(a==null || a=="") {
				alert("Please fill the search box.");
				return false;
			} 
			
			var a = document.getElementById("searchbox").value; 
			
			if(a.toLowerCase().indexOf("a")>-1 || a.toLowerCase().indexOf("b")>-1 || a.toLowerCase().indexOf("c")>-1 || a.toLowerCase().indexOf("d")>-1 || a.toLowerCase().indexOf("e")>-1 || a.toLowerCase().indexOf("f")>-1 || a.toLowerCase().indexOf("g")>-1 || a.toLowerCase().indexOf("h")>-1 || a.toLowerCase().indexOf("i")>-1 || a.toLowerCase().indexOf("j")>-1 || a.toLowerCase().indexOf("k")>-1 || a.toLowerCase().indexOf("l")>-1 || a.toLowerCase().indexOf("m")>-1 || a.toLowerCase().indexOf("n")>-1 || a.toLowerCase().indexOf("o")>-1 || a.toLowerCase().indexOf("p")>-1 || a.toLowerCase().indexOf("q")>-1 || a.toLowerCase().indexOf("r")>-1 || a.toLowerCase().indexOf("s")>-1 || a.toLowerCase().indexOf("t")>-1 || a.toLowerCase().indexOf("u")>-1 || a.toLowerCase().indexOf("v")>-1 || a.toLowerCase().indexOf("w")>-1 || a.toLowerCase().indexOf("x")>-1 || a.toLowerCase().indexOf("y")>-1 || a.toLowerCase().indexOf("z")>-1) {
				document.getElementById("englishchars").style.display = "inline";
				return false;
			} else {
				document.getElementById("englishchars").style.display = "none";
				return true;
			}
		}
		
		function hideenglishchars() {
			document.getElementById("englishchars").style.display = "none";
		}
	</script>
	
</head>

<body onload="hideenglishchars()">
	<h1>Khujo.ga</h1>
	<form action="" method="get" name="searchform" onsubmit="return validateForm()">
	<div class="divform">
	  <input type="text" class="inputbox" id="searchbox" name="searchedtext" autofocus />
	  <input type="submit" name="submit" class="submitbutton" value="Search" />
	  <br/>
	  <p id="englishchars">Please don't enter any English letter in the search box, because you'll not find any English letter in Arabic books.</p>
	  <br/>
	  <p class="notice">This is an alpha version. Search in some Arabic books only. All the results appear on single page. So be careful of what you search, not to overload the page.</p>
	</div>
	</form>  
	
	<?php
	
		$search = '';
		$cut = '';
		$found = false;
		
		if(isset($_GET['submit'])) {
			
				function test_input($data) {
				  $data = trim($data);
				  $data = trim($data, "'\"\/\\");
				  $data = trim($data, ";=#");
				  $data = trim($data, "<>");
				  $data = strip_tags($data);
				  
				  $data = trim($data, "&#x3C;&#x73;&#x63;&#x72;&#x69;&#x70;&#x74;&#x3E;");
				  $data = trim($data, "&#x3C;&#x70;&#x68;&#x70;&#x3E;");
				  
				  $data = html_entity_decode($data);
				  
				  $data = trim($data, "abcdefghijklmnopqrstuvwxyz");
				  $data = stripslashes($data);
				  // $data = htmlspecialchars($data); // not working
				  return $data;
				}
			
				$searchedtext =  test_input($_GET['searchedtext']);
				
				// echo $searchedtext;
				$remove = array('ö', 'õ', '?', '?', 'ú', 'ñ', 'ò', 'ð', 'ø', 'ó');
				$searchedtextFiltered = str_replace($remove, '', $searchedtext);
				$search = $searchedtextFiltered;
				echo "<p class='searchedtext'>Searched : $searchedtext </p>";
				
				$resultno = 0;
			
				$iterator = new RecursiveDirectoryIterator('./books/');
				$iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
				$objects = new RecursiveIteratorIterator($iterator);
				
				foreach($objects as $name => $object){
					
					
					
					if($name == '.\index.php') continue;
					// echo file_get_contents($name); // get the contents, and echo it out.
					
					if($search !== '') {
						
						$lines = file($name);
						// Store true when the text is found
						$found = false;
						foreach($lines as $line)
						{
							
							$remove = array('ö', 'õ', '?', '?', 'ú', 'ñ', 'ò', 'ð', 'ø', 'ó');
							$line = str_replace($remove, '', $line);
							
							$lastPos = 0;
							$positions = array();
							
							while (($lastPos = strpos($line, $search, $lastPos))!== false) {
								
								$positions[] = $lastPos;
								$lastPos = $lastPos + strlen($search);
							}

							foreach ($positions as $value) {
								
								
								$pos1 = $value + 100;
								$pos2 = $value - 300;
								
								$startIndex = min($pos1, $pos2);
								$length = abs($pos1 - $pos2);
								$cut = substr($line, $startIndex, $length);
								
								
								
								$remtag = array( '<', '>', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '/', '%', '#', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '=', ')', '(', '"', "'", '&', '\\', ';', '__', '¡ ¡', '*', '. .' );

								$cut = str_replace($remtag, ' ', $cut);
								$cut = str_replace($remtag, ' ', $cut);
								
								$resultno = $resultno + 1;
								echo "<p class='resultshow'>" . 'Found ' . $resultno . ': ' . $name . '</p>';
								
								echo "<div class='result'> <span class='result'>" . $cut . '</span>' . '<a class="resultLink" href="'. $name . '" target="_blank"> Show more... </a><br/><br/></div>';
								
							}
						  
						}
				
					}
					
				}
				
			}
			
		if($cut !== '') $found = true;
		
		if($found == false && $search !== '') {
			echo $found;
			echo '<p style="color: red; text-align: center; FONT-FAMILY: \'Calibri\'"> No match found. Try again with another keyword.</p>';
		}
		
		
		
	?>
	
</body>
 
</html>