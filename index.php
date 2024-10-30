<html>
<body>
<h1>Time in Riga</h1>
<?php
function getDateTime(){
    date_default_timezone_set("Europe/Riga");
   return date("Y-m-d H:i:s");
};
?>
</body>
<footer>
   <?php echo getDateTime()?>
</footer>
</html>