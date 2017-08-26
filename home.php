<?php?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Rexx test</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
    $( "#datepicker1" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
$( function() {
    $( "#datepicker2" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
</script>
</head>
<body>
<form action="action.php" method = "POST">
<p>Start Date: <input type="text" name= "sale_date" id="datepicker1"></p>
<br />
<p>End Date: <input type="text" name= "sale_date_end" id="datepicker2"></p>
<br />
<input type="submit" name = "submit" value="Submit">
</form>
</body>
</html>
<?php?>

