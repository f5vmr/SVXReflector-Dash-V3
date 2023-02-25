<fieldset style="border:#3083b8 2px groove;box-shadow:5px 5px 20px #999; background-color:#f1f1f1; width:555px;margin-top:15px;margin-left:0px;margin-right:5px;font-size:13px;border-top-left-radius: 10px; border-top-right-radius: 10px;border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
<div style="padding:0px;width:550px;background-image: linear-gradient(to bottom, #e9e9e9 50%, #bcbaba 100%);border-radius: 10px;-moz-border-radius:10px;-webkit-border-radius:10px;border: 1px solid LightGrey;margin-left:0px; margin-right:0px;margin-top:4px;margin-bottom:0px;line-height:1.6;white-space:normal;">

<!--h1 id="edit_info" style="color:#00aee8;font: 18pt arial, sans-serif;font-weight:bold; text-shadow: 0.25px 0.25px gray;">Edit Configuration '. $_GET['file']'</h1-->
<?php //echo '<h1 id="edit_info" style="color:#00aee8;font: 18pt arial, sans-serif;font-weight:bold; text-shadow: 0.25px 0.25px gray;">Edit Configuration ' . $_GET['file'] . '</h1>';?>

<?php
$password = "www-data";
$command = "echo '$password' | sudo -S chmod -R 777 /etc/svxlink/";
exec($command);
exec('sudo chown -R www-data:www-data /etc/svxlink/');
exec('sudo chown -R www-data:www:data /var/www/html');

?>

<?php

$nodeInfoFile="/etc/svxlink/node_info.json";
exec('sudo cp ' . $nodeInfoFile . ' ' .$nodeInfoFile .'.bak');
include_once('include/functions.php');
$lines = file($nodeInfoFile);

//echo '<form method="post" enctype="multipart/form-data" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">';
//echo '<table width=60%>';
//echo "Here Now with " . $nodeInfoFile;
$file = file_get_contents($nodeInfoFile);
$node_info = json_decode($file, true);

// Modify the values in the associative array based on user input
$node_info["location"] = $_POST["location"];
$node_info["frequency"] = $_POST["frequency"];

// Encode the modified associative array into a .json string
$json = json_encode($node_info, JSON_PRETTY_PRINT);

// Write the .json string back to the file
file_put_contents("/etc/svxlink/node_info.json", $json);
?>
<?php

$json_file = file_get_contents('/etc/svxlink/node_info.json');
$data = json_decode($json_file, true);

foreach($data['qth'] as $value) {
    $new_var = "$in" . $value['name'];
    echo $new_var;
}

if (fopen($nodeInfoFile,'r'))
  {
  $filedata = file_get_contents($nodeInfoFile);
  //print_r($filedata);
  $nodeInfo = json_decode($filedata,true);
  print_r($nodeInfo);
  build_ini_string(array($nodeInfo));
  //print_r($sectionless . $out);
  };
if (isset($_POST['btnSave']))
    {
        $retval = null;
        $screen = null;
	
    $nodeInfo["Location"] = $_POST['inLocation']; 
    $nodeInfo["Locator"] = $_POST['inLocator'];
    $nodeInfo["SysOp"] = $_POST['inSysOp'];
	  $nodeInfo["LAT"] = $_POST['inLAT']; 
    $nodeInfo["LONG"] = $_POST['inLONG'];
    $nodeInfo["RXFREQ"] = $_POST['inRXFREQ'];
	  $nodeInfo["TXFREQ"] = $_POST['inTXFREQ']; 
    $nodeInfo["Website"] = $_POST['inWebsite'];
    $nodeInfo["Mode"] = $_POST['inMode'];
	  $nodeInfo["Type"] = $_POST['inType']; 
    $nodeInfo["Echolink"] = $_POST['inEcholink'];
    $nodeInfo["nodeLocation"] = $_POST['innodeLocation'];
	  $nodeInfo["Compound"] = $_POST['inCompound'];
    $nodeInfo["CTCSS"] = $_POST['inCTCSS'];
	  $nodeInfo["LinkedTo"] = $_POST['inLinkedTo'];

	  $jsonNodeInfo = json_encode($nodeInfo);
	  file_put_contents("/var/www/html/nodeInfo/node_info.json", $jsonNodeInfo ,FILE_USE_INCLUDE_PATH);

        $retval = null;
        $screen = null;
        exec('sudo cp /etc/svxlink/node_info.json /etc/svxlink/node_info.json.' .date("YmdThis"), $screen, $retval);
        exec('sudo mv /var/www/html/nodeInfo/node_info.json /etc/svxlink/node_info.json', $screen, $retval);
        exec('sudo service svxlink restart 2>&1',$screen,$retval);
    };
    $svxconfig = parse_ini_file($svxConfigFile,true,INI_SCANNER_RAW);
    $inCallsign = $svxconfig['ReflectorLogic']['CALLSIGN'];
    $inPassword = $svxconfig['ReflectorLogic']['AUTH_KEY'];
	  $inLocation = $nodeInfo["nodeLocation"];
    $inLocator = $nodeInfo["loc"]; 
    $inSysOp = $nodeInfo["sysop"];
	  $inLAT = $nodeInfo["lat"];
    $inLONG = $nodeInfo["long"]; 
    $inRXFREQ = $nodeInfo["freq"];
	  $inTXFREQ = $nodeInfo["TXFREQ"];
    $inWebsite = $nodeInfo["Website"]; 
    $inMode = $nodeInfo["Mode"];
	  $inType = $nodeInfo["Type"];
    $inEcholink = $nodeInfo["Echolink"]; 
    $innodeLocation = $nodeInfo["nodeLocation"];
	  $inSysop = $nodeInfo["Sysop"]; 
    $inCTCSS = $nodeInfo["CTCSS"];
	  $inLinkedTo = $nodeInfo["LinkedTo"];
    
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table>
        <tr>
        <th width = "640px">Node Info Input</th>
	<th width = "625px">Action</th>
        </tr>
<tr>
<TD>

<Table style="border-collapse: collapse; border: none;">
        <tr style="border: none;">
                <th width = "30%"></th>
                <th width = "70%"></th>
        </tr>
        <tr style="border: none;"> 
        <td style="border: none;">Location
        </td>
        <td style="border: none;">
        <input type="text" name="inLocation" style="width:98%" value="<?php echo $inLocation;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">Locator</td>
        <td style="border: none;">
        <input  type="text" name="inLocator" style="width:98%" value="<?php echo $inLocator;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">SysOp</td>
        <td style="border: none;">
        <input  type="text" name="inSysOp" style="width:98%" value="<?php echo $inSysOp;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">Lat</td>
        <td style="border: none;">
        <input  type="text" name="inLAT" style="width:98%" value="<?php echo $inLAT;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">Long</td>
        <td style="border: none;">
        <input  type="text" name="inLONG" style="width:98%" value="<?php echo $inLONG;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">Rx Freq</td>
        <td style="border: none;">
        <input  type="text" name="inRXFREQ" style="width:98%" value="<?php echo $inRXFREQ;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">Tx Freq</td>
        <td style="border: none;">
        <input  type="text" name="inTXFREQ" style="width:98%" value="<?php echo $inTXFREQ;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">Website</td>
        <td style="border: none;">
        <input  type="text" name="inWebsite" style="width:98%" value="<?php echo $inWebsite;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">Mode</td>
        <td style="border: none;">
        <input  type="text" name="inMode" style="width:98%" value="<?php echo $inMode;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">Type</td>
        <td style="border: none;">
        <input  type="text" name="inType" style="width:98%" value="<?php echo $inType;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">EchoLink</td>
        <td style="border: none;">
        <input  type="text" name="inEcholink" style="width:98%" value="<?php echo $inEcholink;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">Node Location</td>
        <td style="border: none;">
        <input  type="text" name="innodeLocation" style="width:98%" value="<?php echo $innodeLocation;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">Sysop</td>
        <td style="border: none;">
        <input  type="text" name="inSysop" style="width:98%" value="<?php echo $inSysop;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">Compound</td>
        <td style="border: none;">
        <input  type="text" name="inCompound" style="width:98%" value="<?php echo $inCompound;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">LinkedTo</td>
        <td style="border: none;">
        <input  type="text" name="inLinkedTo" style="width:98%" value="<?php echo $inLinkedTo;?>">
        </td></tr>
        <tr style="border: none;"> 
        <td style="border: none;">CTCSS</td>
        <td style="border: none;">
        <input  type="text" name="inCTCSS" style="width:98%" value="<?php echo $inCTCSS;?>">
        </td></tr>
    </table>
</td>
<td> 
	<button name="btnSave" type="submit" class="red" style="height:100px; width:105px; font-size:12px;">Save <BR><Br> & <BR><BR> ReLoad</button>
</td>
</tr>
</table>


</form>
<p style="margin: 0 auto;"></p>
<p style="margin-bottom:-2px;"></p>
<!--
foreach ($lines as $line_num => $line) {
    echo '<tr><td contenteditable="true" style="text-align:left"><input type="text" style="width:100%" name="line[]" value="' . htmlspecialchars($line) . '"></td></tr>';
}
echo '</table>';
echo '<input type="submit" value="Click to Save Changes">';
echo '</form>';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = '';
    foreach ($_POST['line'] as $line) {
        $data .= $line . "\n";
    }
    
    $success = file_put_contents($file, $data);
    echo $file . "  " . $data;
    if ($success === false) {
        echo 'Error saving changes to file.';
    } else {
        chown ($file,'www-data');
        exec('sudo systemctl restart svxlink');
        echo 'Changes saved and service restarted.';
    }   
        //exec('sudo chown -R www-data:root /etc/svxlink/');
}
//echo "<meta http-equiv='refresh' content='0'>";
exit();
//Header('Location: ' . htmlspecialchars($_SERVER['PHP_SELF']));
//exit(); 
-->
</fieldset>