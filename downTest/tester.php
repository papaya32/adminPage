<?PHP

header('Content-type: text/plain; charset=utf8', true);

$db = array(
    "16" => "022", /*Coffee Controller*/
    "14" => "004", /*Bed Light*/
    "13" => "002", /*Desk Lights*/
    "18:FE:AA:AA:AA:BB" => "TEMP-1.0.0"
);

/*$servername = "ha-records.cxdm8r7jhkbf.us-east-1.rds.amazonaws.com";
$username = "phpUser";
$password = "24518000phpUser";
$database = "ha_records";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error)
{
  die("Connection Failed: " . $conn->connect_error);
}
*/
function check_header($name, $value = false) {
    if(!isset($_SERVER[$name])) {
        return false;
    }
    if($value && $_SERVER[$name] != $value) {
        return false;
    }
    return true;
}

function sendFile($path) {
    header($_SERVER["SERVER_PROTOCOL"].' 200 OK', true, 200);
    header('Content-Type: application/octet-stream', true);
    header('Content-Disposition: attachment; filename='.basename($path));
    header('Content-Length: '.filesize($path), true);
    header('x-MD5: '.md5_file($path), true);
    logger("SENDING FILE: " . $path);
    readfile($path);
}

function logger($message) {
    error_log($message, 0);
//    $file = "logger.log";
 //   $current = file_get_contents($file);
  //  $current .= $message;
    //file_put_contents($file, $current, FILE_APPEND);
}

/*if(!check_header('HTTP_USER_AGENT', 'ESP8266-http-Update')) {
    header($_SERVER["SERVER_PROTOCOL"].' 403 Forbidden', true, 403);
    echo "only for ESP8266 updater!\n";
    logger("CUNT!");
    exit();
}

if(
    !check_header('HTTP_X_ESP8266_STA_MAC') ||
    !check_header('HTTP_X_ESP8266_AP_MAC') ||
    !check_header('HTTP_X_ESP8266_FREE_SPACE') ||
    !check_header('HTTP_X_ESP8266_SKETCH_SIZE') ||
    !check_header('HTTP_X_ESP8266_CHIP_SIZE') ||
    !check_header('HTTP_X_ESP8266_SDK_VERSION') ||
    !check_header('HTTP_X_ESP8266_VERSION')
) {
    header($_SERVER["SERVER_PROTOCOL"].' 403 Forbidden', true, 403);
    echo "only for ESP8266 updater! (header)\n";
    logger("CUNT2");
    exit();
}
    logger("CUNT#");
$versionTotal = $_SERVER['HTTP_X_ESP8266_VERSION'];
$type = substr($versionTotal, 0, 2);
$serial = substr($versionTotal, 3, 10);
$versionNum = substr($versionTotal, 11);
$dat = "VersionTotal: " . $versionTotal;
logger($dat);
//$sql = "UPDATE devices SET version_num='" . $db[$type] . "' WHERE serial_num='" . $serial . "'";
//if(isset($db[$_SERVER['HTTP_X_ESP8266_STA_MAC']])) {
    if($db[$type] != $versionNum) {
	$filename = "/var/www/html/downTest/bin/" . $type . ".bin";
        logger("MADE IT HERE, filename: " . $filename);
        sendFile($filename);
//        $result = $conn->query($sql);
    } else {
        logger("UH OH");
        header($_SERVER["SERVER_PROTOCOL"].' 304 Not Modified', true, 304);
    }
    exit();
//}
*/
	$filename = "/var/www/html/downTest/bin/14.bin";
        logger("MADE IT HERE, filename: " . $filename);
        sendFile($filename);
	echo "good";

header($_SERVER["SERVER_PROTOCOL"].' 500 no version for ESP MAC', true, 500);

?>
