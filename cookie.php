<?php
@ob_start();
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
if (isset($_COOKIE['counter']))
    $count = $_COOKIE['counter'];
else
    $count = 0;
$count = $count + 1;
setcookie('counter', $count, time() + 24 * 3600, '/', 'localhost', false);
?>
<html>
    <head>
        <title>Counting with a cookie</title>
    </head>
    <body>
        <FORM action="cookie.php" method="GET">
            <INPUT type="submit" name="Count" value="Count">
            <?php
            echo "count is $count";
            ?>
        </FORM>
    </body>
</html>
