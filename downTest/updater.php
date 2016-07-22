<?PHP

header('Content-type: text/plain; charset=utf8', true);

$db = array(
    "16" => "020",
    "14" => "003",
    "13" => "002",
    "18:FE:AA:AA:AA:BB" => "TEMP-1.0.0"
);

$servername = "ha-records.cxdm8r7jhkbf.us-east-1.rds.amazonaws.com";
$username = "phpUser";
$password = "24518000phpUser";
$database = "ha_records";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error)
{
  die("Connection Failed: " . $conn->connect_error);
}

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
    readfile($path);
}

function logger($message) {
    $file = "logger.log";
    $current = file_get_contents($file);
    $current .= $message;
    file_put_contents($file, $current, FILE_APPEND);
}

if(!check_header('HTTP_USER_AGENT', 'ESP8266-http-Update')) {
    header($_SERVER["SERVER_PROTOCOL"].' 403 Forbidden', true, 403);
    echo "only for ESP8266 updater!\n";
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
    exit();
}
$versionTotal = $_SERVER['HTTP_X_ESP8266_VERSION'];
$type = substr($versionTotal, 0, 2);
$serial = substr($versionTotal, 3, 10);
$versionNum = substr($versionTotal, 11);
$sql = "UPDATE devices SET version_num='" . $db[$type] . "' WHERE serial_num='" . $serial . "'";
//if(isset($db[$_SERVER['HTTP_X_ESP8266_STA_MAC']])) {
    if($db[$type] != $versionNum) {
	$filename = "./bin/" . $type . ".bin";
        sendFile($filename/*.$db[$_SERVER['HTTP_X_ESP8266_STA_MAC']]."updated.bin"*/);
        $result = $conn->query($sql);
    } else {
        header($_SERVER["SERVER_PROTOCOL"].' 304 Not Modified', true, 304);
    }
    exit();
//}

header($_SERVER["SERVER_PROTOCOL"].' 500 no version for ESP MAC', true, 500);

?>
