<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type="text/javascript">
	function mktime(hour,minute,month,day,year){
   		return (new Date(year, month, day, hour, minute, 0)).getTime()/1000;
 	}
 	var timeAtual =mktime(16, 26, 8, 5, 2013); 
 	var timeAntigo = mktime(16, 26 - 30, 8, 5, 2013);
 	console.log(timeAtual +" "+ timeAntigo);
	</script>
</head>
<body>

	
</body>
</html>