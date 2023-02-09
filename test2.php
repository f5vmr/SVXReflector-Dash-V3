<?php
$progname = basename($_SERVER['SCRIPT_FILENAME'],".php");
include_once 'include/config.php';
include_once 'include/tools.php';
$svxConfigFile = '/etc/svxlink/svxlink.conf';
if (fopen($svxConfigFile, 'r')) {
    $svxconfig = parse_ini_file($svxConfigFile, true, INI_SCANNER_RAW);
    $callsign = $svxconfig['ReflectorLogic']['CALLSIGN'];
    $fmnetwork = $svxconfig['ReflectorLogic']['FMNET'];
    $tgUri = $svxconfig['ReflectorLogic']['TG_URI'];
}
else { $callsign="NOCALL"; 
       $fmnetwork="not registered";
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" lang="en">
<head>
    <meta name="robots" content="index" />
    <meta name="robots" content="follow" />
    <meta name="language" content="English" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="generator" content="SVXLink" />
    <meta name="Author" content="G4NAB, SP2ONG, SP0DZ" />
    <meta name="Description" content="Dashboard for SVXLink by G4NAB, SP2ONG, SP0DZ" />
    <meta name="KeyWords" content="SVXLink,G4NAB, SP2ONG, SP0DZ" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="pragma" content="no-cache" />
<link rel="shortcut icon" href="images/favicon.ico" sizes="16x16 32x32" type="image/png">    

<?php echo ("<title>" . $callsign ." ". $fmnetwork . " Dashboard</title>"); ?>

<?php include_once "include/browserdetect.php"; ?>
    <script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/functions.js"></script>
    <script type="text/javascript" src="scripts/pcm-player.min.js"></script>
    <script type="text/javascript">
      $.ajaxSetup({ cache: false });
    </script>
    <link href="css/featherlight.css" type="text/css" rel="stylesheet" />
    <script src="scripts/featherlight.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="">

</head>
<body style="background-color: #e1e1e1;font: 11pt arial, sans-serif;">
<center>
<fieldset style="box-shadow:5px 5px 20px #999; background-color:#f1f1f1; width:0px;margin-top:15px;margin-left:0px;margin-right:5px;font-size:13px;border-top-left-radius: 10px; border-top-right-radius: 10px;border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
<div class="container"> 
<div class="header">
<div class="parent">
    <div class="img" style="padding-left:30px"><img src="images/svxlink.ico" /></div>
    <div class="text"style="padding-right:230px">
<center><p style="margin-top:5px;margin-bottom:0px;">
<span style="font-size: 32px;letter-spacing:4px;font-family: &quot;sans-serif&quot;, sans-serif;font-weight:500;color:PaleBlue"><?php echo $callsign; ?></span>
<p style="margin-top:0px;margin-bottom:0px;">
<span style="font-size: 18px;letter-spacing:4px;font-family: &quot;sans-serif&quot;, sans-serif;font-weight:500;color:PaleBlue"><?php echo $fmnetwork; ?></span>
</p></center>
</div></div>
</div>
<?php include_once __DIR__."/include/top_menu.php"; ?>

<div class="content"><center>
<div style="margin-top:0px;">
</div></center>
</div>
<?php
if (isProcessRunning('node')) {
echo '&nbsp;&nbsp;<button class="button link" onclick="playAudioToggle(8080, this)"><b>&nbsp;&nbsp;&nbsp;<img src=images/speaker.png alt="" style="vertical-align:middle">&nbsp;&nbsp;RX Monitor&nbsp;&nbsp;&nbsp;</b></button><br><br>';
}
?>
<?php
if (MENUBUTTON=="TOP") {
include_once __DIR__."/include/buttons.php"; 
}
?>
<html>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username"><br><br>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password"><br><br>
  <input type="submit" value="Submit">
</form>
</html>
<?php
if (!empty($_POST)) {
  // form has been submitted
}
$username = $_POST['username'];
$password = $_POST['password'];

$command = "echo $password | sudo -S whoami";
$output = exec($command);

if (trim($output) === $username) {
  // login successful
  echo "Login successful.";
} else {
  // login failed
  echo "Incorrect username or password.";
}?>