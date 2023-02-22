<?php
include_once __DIR__.'/config.php';         
include_once __DIR__.'/tools.php';        
include_once __DIR__.'/functions.php'; 
?>
<span style="font-weight: bold;font-size:14px;">Editor</span>
<fieldset style=" width:550px;box-shadow:5px 5px 20px #999;background-color:#e8e8e8e8;margin-top:10px;margin-left:0px;margin-right:0px;font-size:12px;border-top-left-radius: 10px; border-top-right-radius: 10px;border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
  <form method="post">
  <table style="margin-top:3px;">
// configuration//
<?php
$id = $_POST['id'];
if($id="svxlink") {
    shell_exec("cd /etc/svxlink/");
    $file = "svxlink.conf";
    echo "svxlink.conf";
}
if($id="gpio") {
    shell_exec("cd /etc/svxlink/");
    $file = "gpio.conf";
    echo "gpio.conf";
}
if($id="echolink"){
    shell_exec("cd /etc/svxlink/svxlink.d/");
    $file = "ModuleEchoLink.conf";
    echo "EchoLink.conf";
}
if($if="metarinfo"){
    shell_exec("cd /etc/svxlink/svxlink.d");
    $file = "ModuleMetarInfo.conf";
    echo "metarinfo.conf";
}
// check if form has been submitted
//$filename = by choice;
echo $id;
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."editor.php";
if (isset($_POST['text']))
{
    // save the text contents
    file_put_contents($file, $_POST['text']);

    // redirect to form again
    header(sprintf('Location: %s', $url));
    printf('<a href="%s">Moved</a>.', htmlspecialchars($url));
    exit();
}

// read the textfile
$text = file_get_contents($file);

?>

<?php
$fi = fopen($file, 'r');
explode("\n", fread($fi, filesize($fi)));
print_r($fi, true);

?>
  </table></form></fieldset>