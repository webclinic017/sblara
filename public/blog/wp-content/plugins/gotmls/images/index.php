<?php
/**
 * GOTMLS Plugin Global Variables and Functions
 * @package GOTMLS
*/

if (!function_exists("GOTMLS_define")) {
function GOTMLS_define($DEF, $val) {
	if (!defined($DEF))
		define($DEF, $val);
}}

$file = basename(__FILE__);
GOTMLS_define("GOTMLS_local_images_path", substr(__FILE__, 0, strlen(__FILE__) - strlen($file)));
GOTMLS_define("GOTMLS_plugin_path", substr(dirname(__FILE__), 0, strlen(dirname(__FILE__)) - strlen(basename(dirname(__FILE__)))));
if (is_file(GOTMLS_plugin_path.$file) && ($contents = @file_get_contents(GOTMLS_plugin_path.$file)) && preg_match('/\nversion:\s*([0-9\.]+)/i', $contents, $match))
	GOTMLS_define("GOTMLS_Version", $match[1]);
else
	GOTMLS_define("GOTMLS_Version", "Unknown");
GOTMLS_define("GOTMLS_require_version", "3.3");

if (!function_exists("__")) {
function __($text, $domain) {
	return $text;
}}

$GLOBALS["GOTMLS"] = array(
	"tmp"=>array("HeadersError"=>"", "onLoad"=>"", "file_contents"=>"", "new_contents"=>"", "threats_found"=>array(), 
		"skip_dirs" => array(".", ".."), "scanfiles" => array(), 
		"mt" => ((isset($_GET["mt"])&&is_numeric($_GET["mt"]))?$_GET["mt"]:microtime(true)), 
		"threat_files" => array("htaccess"=>".htaccess","timthumb"=>"thumb.php"), 
		"threat_levels" => array(__("htaccess Threats",'gotmls')=>"htaccess",__("TimThumb Exploits",'gotmls')=>"timthumb",__("Backdoor Scripts",'gotmls')=>"backdoor",__("Known Threats",'gotmls')=>"known",__("Core File Changes",'gotmls')=>"wp_core",__("Potential Threats",'gotmls')=>"potential"), 
		"default_ext"=>"ieonly.", "skip_ext"=>array("png", "jpg", "jpeg", "gif", "bmp", "tif", "tiff", "psd", "fla", "flv", "mov", "mp3", "exe", "zip", "pdf", "css", "pot", "po", "mo", "so", "doc", "docx", "svg", "ttf"),
		"execution_time" => 60,
		"default" => array("msg_position" => array('80px', '40px', '400px', '600px'))));
GOTMLS_define("GOTMLS_script_URI", preg_replace('/\&(last_)?mt=[0-9\.]+/', '', str_replace('&amp;', '&', htmlspecialchars($_SERVER["REQUEST_URI"], ENT_QUOTES))).'&mt='.$GLOBALS["GOTMLS"]["tmp"]["mt"]);

if (!function_exists("GOTMLS_encode")) {
function GOTMLS_encode($unencoded_string) {
	if (function_exists("base64_encode"))
		$encoded_string = base64_encode($unencoded_string);
	elseif (function_exists("mb_convert_encoding"))
		$encoded_string = mb_convert_encoding($unencoded_string, "BASE64", "UTF-8");
	else
		$encoded_string = "Cannot encode: $unencoded_string function_exists: ";
	$encoded_array = explode("=", $encoded_string.'=');
	return strtr($encoded_array[0], "+/0", "-_=").(count($encoded_array)-1);
}}

if (!function_exists("GOTMLS_decode")) {
function GOTMLS_decode($encoded_string) {
	$tail = 0;
	if (strlen($encoded_string) > 1 && is_numeric(substr($encoded_string, -1)) && substr($encoded_string, -1) > 0)
		$tail = substr($encoded_string, -1) - 1;
	else
		$encoded_string .= "$tail";
	$encoded_string = strtr(substr($encoded_string, 0, -1), "-_=", "+/0").str_repeat("=", $tail);
	if (function_exists("base64_decode"))
		return base64_decode($encoded_string);
	elseif (function_exists("mb_convert_encoding"))
		return mb_convert_encoding($encoded_string, "UTF-8", "BASE64");
	else
		return "Cannot decode: $encoded_string";
}}

if (isset($_GET["SESSION"]) && is_numeric($_GET["SESSION"]) && preg_match('|(.*?/gotmls\.js\?SESSION=)|', GOTMLS_script_URI, $match)) {
	header("Content-type: text/javascript");
	if (is_file(GOTMLS_plugin_path."safe-load/session.php"))
		require_once(GOTMLS_plugin_path."safe-load/session.php");
	if (isset($_SESSION["GOTMLS_SESSION_TEST"])) 
		die("/* GOTMLS SESSION PASS */\nif('undefined' != typeof stopCheckingSession && stopCheckingSession)\n\tclearTimeout(stopCheckingSession);\nshowhide('GOTMLS_patch_searching', true);\nif (autoUpdateDownloadGIF = document.getElementById('autoUpdateDownload'))\n\tdonationAmount = autoUpdateDownloadGIF.src.replace(/^.+\?/,'');\nif ((autoUpdateDownloadGIF.src == donationAmount) || donationAmount=='0') {\n\tif (patch_searching_div = document.getElementById('GOTMLS_patch_searching')) {\n\t\tif (autoUpdateDownloadGIF.src == donationAmount)\n\t\t\tpatch_searching_div.innerHTML = '<span style=\"color: #F00;\">".__("You must register and donate to use this feature!",'gotmls')."</span>';\n\t\telse\n\t\t\tpatch_searching_div.innerHTML = '<span style=\"color: #F00;\">".__("This feature is available to those who have donated!",'gotmls')."</span>';\n\t}\n} else {\n\tshowhide('GOTMLS_patch_searching');\n\tshowhide('GOTMLS_patch_button', true);\n}\n");
	else {
		$_SESSION["GOTMLS_SESSION_TEST"] = $_GET["SESSION"] + 1;
		if ($_GET["SESSION"] > 0)
			die("/* GOTMLS SESSION FAIL */\nif('undefined' != typeof stopCheckingSession && stopCheckingSession)\n\tclearTimeout(stopCheckingSession);\ndocument.getElementById('GOTMLS_patch_searching').innerHTML = '<div class=\"error\">".__("Your Server could not start a Session!",'gotmls')."</div>';");
		else
			die("/* GOTMLS SESSION TEST */\nif('undefined' != typeof stopCheckingSession && stopCheckingSession)\n\tclearTimeout(stopCheckingSession);\nstopCheckingSession = checkupdateserver('".$match[0].$_SESSION["GOTMLS_SESSION_TEST"]."', 'GOTMLS_patch_searching');");
	}
} elseif ((isset($_SERVER["DOCUMENT_ROOT"]) && ($SCRIPT_FILE = str_replace($_SERVER["DOCUMENT_ROOT"], "", isset($_SERVER["SCRIPT_FILENAME"])?$_SERVER["SCRIPT_FILENAME"]:isset($_SERVER["SCRIPT_NAME"])?$_SERVER["SCRIPT_NAME"]:"")) && strlen($SCRIPT_FILE) > strlen("/".basename(__FILE__)) && substr(__FILE__, -1 * strlen($SCRIPT_FILE)) == substr($SCRIPT_FILE, -1 * strlen(__FILE__))) || !defined("GOTMLS_plugin_path")) {
	header("Content-type: image/gif");
	$img_src = GOTMLS_local_images_path.'GOTMLS-16x16.gif';
	if (!(file_exists($img_src) && $img_bin = @file_get_contents($img_src)))
		$img_bin = GOTMLS_decode('R0lGODlhEAAQAIABAAAAAP///yH5BAEAAAEALAAAAAAQABAAAAIshB0Qm+eo2HuJNWdrjlFm3S2hKB7kViKaxZmr98YgSo/jzH6tiU0974MADwUAOw==');
	die($img_bin);
} elseif (isset($_GET["no_error_reporting"]))
	@error_reporting(0);

GOTMLS_define("GOTMLS_Failed_to_list_LANGUAGE", __("Failed to list files in directory!",'gotmls'));
GOTMLS_define("GOTMLS_Run_Quick_Scan_LANGUAGE", __("Quick Scan",'gotmls'));
GOTMLS_define("GOTMLS_View_Quarantine_LANGUAGE", __("View Quarantine",'gotmls'));
GOTMLS_define("GOTMLS_View_Scan_Log_LANGUAGE", __("View Scan Log",'gotmls'));
GOTMLS_define("GOTMLS_require_version_LANGUAGE", sprintf(__("This Plugin requires WordPress version %s or higher",'gotmls'), GOTMLS_require_version));
GOTMLS_define("GOTMLS_Scan_Settings_LANGUAGE", __("Scan Settings",'gotmls'));
GOTMLS_define("GOTMLS_Loading_LANGUAGE", __("Loading, Please Wait ...",'gotmls'));
GOTMLS_define("GOTMLS_Automatically_Fix_LANGUAGE", __("Automatically Fix SELECTED Files Now",'gotmls'));

if (isset($_SERVER['HTTP_HOST']))
	$SERVER_HTTP = 'HOST://'.$_SERVER['HTTP_HOST'];
elseif (isset($_SERVER['SERVER_NAME']))
	$SERVER_HTTP = 'NAME://'.$_SERVER['SERVER_NAME'];
elseif (isset($_SERVER['SERVER_ADDR']))
	$SERVER_HTTP = 'ADDR://'.$_SERVER['SERVER_ADDR'];
else
	$SERVER_HTTP = 'NULL://not.anything.com';
if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"])
	$SERVER_HTTP .= ":".$_SERVER["SERVER_PORT"];
$SERVER_parts = explode(":", $SERVER_HTTP);
if ((isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on" || $_SERVER["HTTPS"] == 1)) || (count($SERVER_parts) > 2 && $SERVER_parts[2] == '443'))
	$GLOBALS["GOTMLS"]["tmp"]["protocol"] = "https:";
else
	$GLOBALS["GOTMLS"]["tmp"]["protocol"] = "http:";
if (function_exists("get_option")) {
	$GLOBALS["GOTMLS"]["tmp"]["settings_array"] = get_option('GOTMLS_settings_array', array());
	$GLOBALS["GOTMLS"]["tmp"]["definitions_array"] = get_option('GOTMLS_definitions_array', array());
	GOTMLS_define("GOTMLS_siteurl", get_option("siteurl"));
	$GLOBALS["GOTMLS"]["log"] = get_option('GOTMLS_scan_log/'.(isset($_SERVER["REMOTE_ADDR"])?$_SERVER["REMOTE_ADDR"]:"0.0.0.0").'/'.$GLOBALS["GOTMLS"]["tmp"]["mt"], array());
	if (!(isset($GLOBALS["GOTMLS"]["log"]["settings"]) && is_array($GLOBALS["GOTMLS"]["log"]["settings"])))
		$GLOBALS["GOTMLS"]["log"]["settings"] = $GLOBALS["GOTMLS"]["tmp"]["settings_array"];
} else {
	GOTMLS_define("GOTMLS_siteurl", $GLOBALS["GOTMLS"]["tmp"]["protocol"].$SERVER_parts[1].((count($SERVER_parts) > 2 && ($SERVER_parts[2] == '80' || $SERVER_parts[2] == '443'))?"":":".$SERVER_parts[2])."/");
	$GLOBALS["GOTMLS"]["log"] = array();
	$GLOBALS["GOTMLS"]["tmp"]["settings_array"] = array();
	$GLOBALS["GOTMLS"]["tmp"]["definitions_array"] = array();
}
GOTMLS_define("GOTMLS_installation_key", md5(GOTMLS_siteurl));
if (function_exists("plugins_url"))
	GOTMLS_define("GOTMLS_images_path", plugins_url('/', __FILE__));
elseif (function_exists("plugin_dir_url"))
	GOTMLS_define("GOTMLS_images_path", plugin_dir_url(__FILE__));
elseif (isset($_SERVER["DOCUMENT_ROOT"]) && ($_SERVER["DOCUMENT_ROOT"]) && strlen($_SERVER["DOCUMENT_ROOT"]) < __FILE__ && substr(__FILE__, 0, strlen($_SERVER["DOCUMENT_ROOT"])) == $_SERVER["DOCUMENT_ROOT"])
	GOTMLS_define("GOTMLS_images_path", substr(dirname(__FILE__), strlen($_SERVER["DOCUMENT_ROOT"])));
elseif (isset($_SERVER["SCRIPT_FILENAME"]) && isset($_SERVER["DOCUMENT_ROOT"]) && ($_SERVER["DOCUMENT_ROOT"]) && strlen($_SERVER["DOCUMENT_ROOT"]) < strlen($_SERVER["SCRIPT_FILENAME"]) && substr($_SERVER["SCRIPT_FILENAME"], 0, strlen($_SERVER["DOCUMENT_ROOT"])) == $_SERVER["DOCUMENT_ROOT"])
	GOTMLS_define("GOTMLS_images_path", substr(dirname($_SERVER["SCRIPT_FILENAME"]), strlen($_SERVER["DOCUMENT_ROOT"])));
else
	GOTMLS_define("GOTMLS_images_path", "/wp-content/plugins/update/images/");

$GOTMLS_chmod_file = (0644);
$GOTMLS_chmod_dir = (0755);
$GOTMLS_image_alt = array("wait"=>"...", "checked"=>"&#x2714;", "blocked"=>"X", "question"=>"?", "threat"=>"!");
$GOTMLS_dir_at_depth = array();
$GOTMLS_dirs_at_depth = array();

if (isset($_REQEUST['img']) && substr(strtolower($_SERVER["SCRIPT_FILENAME"]), -15) == "/admin-ajax.php" && !in_array(GOTMLS_get_ext($_REQEUST['img']), $GLOBALS["GOTMLS"]["tmp"]["skip_ext"]))
	include(dirname(__FILE__)."/../safe-load/index.php");
if (!(isset($GLOBALS["GOTMLS"]["tmp"]["settings_array"]["msg_position"]) && is_array($GLOBALS["GOTMLS"]["tmp"]["settings_array"]["msg_position"]) && count($GLOBALS["GOTMLS"]["tmp"]["settings_array"]["msg_position"]) == 4))
	$GLOBALS["GOTMLS"]["tmp"]["settings_array"]["msg_position"] = $GLOBALS["GOTMLS"]["tmp"]["default"]["msg_position"];
if (!isset($GLOBALS["GOTMLS"]["tmp"]["settings_array"]["menu_group"]))
	$GLOBALS["GOTMLS"]["tmp"]["settings_array"]["menu_group"] = 0;
if (!isset($GLOBALS["GOTMLS"]["tmp"]["settings_array"]["scan_what"]))
	$GLOBALS["GOTMLS"]["tmp"]["settings_array"]["scan_what"] = 2;
if (!isset($GLOBALS["GOTMLS"]["tmp"]["settings_array"]["scan_depth"]))
	$GLOBALS["GOTMLS"]["tmp"]["settings_array"]["scan_depth"] = -1;
if (!(isset($GLOBALS["GOTMLS"]["tmp"]["settings_array"]["exclude_ext"]) && is_array($GLOBALS["GOTMLS"]["tmp"]["settings_array"]["exclude_ext"])))
	$GLOBALS["GOTMLS"]["tmp"]["settings_array"]["exclude_ext"] = $GLOBALS["GOTMLS"]["tmp"]["skip_ext"];
if (!isset($GLOBALS["GOTMLS"]["tmp"]["settings_array"]["check_custom"]))
	$GLOBALS["GOTMLS"]["tmp"]["settings_array"]["check_custom"] = "";
if (!(isset($GLOBALS["GOTMLS"]["tmp"]["settings_array"]['exclude_dir']) && is_array($GLOBALS["GOTMLS"]["tmp"]["settings_array"]['exclude_dir'])))
	$GLOBALS["GOTMLS"]["tmp"]["settings_array"]["exclude_dir"] = array();
$GOTMLS_total_percent = 0;
function GOTMLS_admin_notices() {
    if (!is_admin())
		return;
   	elseif ($GLOBALS["GOTMLS"]["tmp"]["HeadersError"])
		echo $GLOBALS["GOTMLS"]["tmp"]["HeadersError"];
}

function GOTMLS_array_recurse($array1, $array2) {
	foreach ($array2 as $key => $value) {
		if (!isset($array1[$key]) || (isset($array1[$key]) && !is_array($array1[$key])))
			$array1[$key] = array();
		if (is_array($value))
			$value = GOTMLS_array_recurse($array1[$key], $value);
		$array1[$key] = $value;
	}
	return $array1;
}

function GOTMLS_array_replace_recursive($array1 = array()) {
	$args = func_get_args();
	$array1 = $args[0];
	if (!is_array($array1))
		$array1 = array();
	for ($i = 1; $i < count($args); $i++)
		if (is_array($args[$i]))
			$array1 = GOTMLS_array_recurse($array1, $args[$i]);
	return $array1;
}

function GOTMLS_update_scan_log($scan_log) {
	if (is_array($scan_log)) {
		$GLOBALS["GOTMLS"]["log"] = GOTMLS_array_replace_recursive($GLOBALS["GOTMLS"]["log"], $scan_log);
		if (isset($GLOBALS["GOTMLS"]["log"]["scan"]["percent"]) && is_numeric($GLOBALS["GOTMLS"]["log"]["scan"]["percent"]) && ($GLOBALS["GOTMLS"]["log"]["scan"]["percent"] >= 100))
			$GLOBALS["GOTMLS"]["log"]["scan"]["finish"] = time();
		if (isset($GLOBALS["GOTMLS"]["log"]["scan"]))
			update_option('GOTMLS_scan_log/'.(isset($_SERVER["REMOTE_ADDR"])?$_SERVER["REMOTE_ADDR"]:"0.0.0.0").'/'.$GLOBALS["GOTMLS"]["tmp"]["mt"], $GLOBALS["GOTMLS"]["log"]);
	}
}

function GOTMLS_loaded() {
	if (headers_sent($filename, $linenum)) {
		if (!$filename)
			$filename = __("an unknown file",'gotmls');
		if (!is_numeric($linenum))
			$linenum = __("unknown",'gotmls');
		$GLOBALS["GOTMLS"]["tmp"]["HeadersError"] = '<div class="error">'.sprintf(__('<b>Headers already sent</b> in %1$s on line %2$s.<br />This is not a good sign, it may just be a poorly written plugin but Headers should not have been sent at this point.<br />Check the code in the above mentioned file to fix this problem.','gotmls'), $filename, $linenum).'</div>';
	} elseif (!session_id() && isset($_GET["SESSION"]))
		@session_start();
	if (session_id() && isset($_GET["SESSION"]) && $_GET["SESSION"] == "GOTMLS_debug" && !isset($_SESSION["GOTMLS_debug"]))
		$_SESSION["GOTMLS_debug"]=array();
}

if (!function_exists("add_action")) {
	GOTMLS_loaded();
	GOTMLS_admin_notices();
}

function GOTMLS_fileperms($file) {
	if ($perms = @fileperms($file)) {
		if (($perms & 0xC000) == 0xC000) {
			$info = 's';    // Socket
		} elseif (($perms & 0xA000) == 0xA000) {
			$info = 'l';    // Symbolic Link
		} elseif (($perms & 0x8000) == 0x8000) {
			$info = '-';    // Regular
		} elseif (($perms & 0x6000) == 0x6000) {
			$info = 'b';    // Block special
		} elseif (($perms & 0x4000) == 0x4000) {
			$info = 'd';    // Directory
		} elseif (($perms & 0x2000) == 0x2000) {
			$info = 'c';    // Character special
		} elseif (($perms & 0x1000) == 0x1000) {
			$info = 'p';    // FIFO pipe
		} else
			$info = 'u';    // Unknown
		// Owner
		$info .= (($perms & 0x0100) ? 'r' : '-');
		$info .= (($perms & 0x0080) ? 'w' : '-');
		$info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-'));
		// Group
		$info .= (($perms & 0x0020) ? 'r' : '-');
		$info .= (($perms & 0x0010) ? 'w' : '-');
		$info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-'));
		// World
		$info .= (($perms & 0x0004) ? 'r' : '-');
		$info .= (($perms & 0x0002) ? 'w' : '-');
		$info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-'));
		return $info;
	} else
		return "stat failed!";
}

function GOTMLS_get_ext($filename) {
	$nameparts = explode(".", ".$filename");
	return strtolower($nameparts[(count($nameparts)-1)]);
}

function GOTMLS_preg_match_all($threat_definition, $threat_name) {
	if (@preg_match_all($threat_definition, $GLOBALS["GOTMLS"]["tmp"]["file_contents"], $threats_found)) {
		$start = -1;
		foreach ($threats_found[0] as $find) {
			$potential_threat = str_replace("\r", "", $find);
			$flen = strlen($potential_threat);
			while (($start = strpos(str_replace("\r", "", $GLOBALS["GOTMLS"]["tmp"]["file_contents"]), $potential_threat, $start+1)) !== false)
				$GLOBALS["GOTMLS"]["tmp"]["threats_found"]["$start-".($flen+$start)] = "$threat_name";
			$GLOBALS["GOTMLS"]["tmp"]["new_contents"] = str_replace($find, "", $GLOBALS["GOTMLS"]["tmp"]["new_contents"]);
		}
		return count($GLOBALS["GOTMLS"]["tmp"]["threats_found"]);
	} else 
		return false;
}

function GOTMLS_check_threat($check_threats, $file='UNKNOWN') {
	global $wp_version;
	$GLOBALS["GOTMLS"]["tmp"]["threats_found"] = array();
	$GLOBALS["GOTMLS"]["log"]["scan"]["last_threat"] = microtime(true);
	if (is_array($check_threats)) {
		$path = str_replace("//", "/", "/".str_replace("\\", "/", substr($file, strlen(ABSPATH))));
		if (substr($file, 0, strlen(ABSPATH)) == ABSPATH && isset($check_threats["$wp_version"]["$path"])) {
			if (($check_threats["$wp_version"]["$path"] != md5($GLOBALS["GOTMLS"]["tmp"]["file_contents"])."O".strlen($GLOBALS["GOTMLS"]["tmp"]["file_contents"])) && ($source = GOTMLS_get_URL("http://core.svn.wordpress.org/tags/$wp_version$path")) && ($check_threats["$wp_version"]["$path"] == md5($source)."O".strlen($source))) {
				$GLOBALS["GOTMLS"]["tmp"]["new_contents"] = $source;
				$len = strlen($GLOBALS["GOTMLS"]["tmp"]["file_contents"]);
				if (strlen($source) < $len)
					$len = strlen($source);
				for ($start = 0, $end = 0; ($start == 0 || $end == 0) && $len > 0; $len--){
					if ($start == 0 && substr($source, 0, $len) == substr($GLOBALS["GOTMLS"]["tmp"]["file_contents"], 0, $len))
						$start = $len;
					if ($end == 0 && substr($source, -1 * $len) == substr($GLOBALS["GOTMLS"]["tmp"]["file_contents"], -1 * $len))
						$end = $len;
				}
				$GLOBALS["GOTMLS"]["tmp"]["threats_found"]["$start-".(strlen($GLOBALS["GOTMLS"]["tmp"]["file_contents"])-$end)] = "Core File Modified";
			}
		} else {
			foreach ($check_threats as $threat_name=>$threat_definitions) {
				$GLOBALS["GOTMLS"]["log"]["scan"]["last_threat"] = microtime(true);
				if (is_array($threat_definitions) && count($threat_definitions) > 1 && strlen(array_shift($threat_definitions)) == 5 && (!(isset($GLOBALS["GOTMLS"]["tmp"]["settings_array"]["dont_check"]) && is_array($GLOBALS["GOTMLS"]["tmp"]["settings_array"]["dont_check"]) && in_array($threat_name, $GLOBALS["GOTMLS"]["tmp"]["settings_array"]["dont_check"]))))
					while ($threat_definition = array_shift($threat_definitions))
						GOTMLS_preg_match_all($threat_definition, $threat_name);
				if (isset($_SESSION["GOTMLS_debug"])) {
					$_SESSION["GOTMLS_debug"]["threat_name"] = $threat_name;
					$file_time = round(microtime(true) - $GLOBALS["GOTMLS"]["log"]["scan"]["last_threat"], 5);
					if (isset($_GET["GOTMLS_debug"]) && is_numeric($_GET["GOTMLS_debug"]) && $file_time > $_GET["GOTMLS_debug"])
						echo "\n//GOTMLS_debug $file_time $threat_name $file\n";
					if (isset($_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_name"]]["total"]))
						$_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_name"]]["total"] += $file_time;
					else
						$_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_name"]]["total"] = $file_time;
					if (isset($_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_name"]]["count"]))
						$_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_name"]]["count"] ++;
					else
						$_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_name"]]["count"] = 1;
					if (!isset($_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_name"]]["least"]) || $file_time < $_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_name"]]["least"])
						$_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_name"]]["least"] = $file_time;
					if (!isset($_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_name"]]["most"]) || $file_time > $_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_name"]]["most"])
						$_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_name"]]["most"] = $file_time;
				}
			}
		}
	} elseif (strlen($check_threats) && isset($_GET['eli']) && substr($check_threats, 0, 1) == '/')
		GOTMLS_preg_match_all($check_threats, $check_threats);
	if (isset($_SESSION["GOTMLS_debug"])) {
		$file_time = round(microtime(true) - $GLOBALS["GOTMLS"]["log"]["scan"]["last_threat"], 5);
		if (isset($_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_level"]]["total"]))
			$_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_level"]]["total"] += $file_time;
		else
			$_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_level"]]["total"] = $file_time;
		if (isset($_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_level"]]["count"]))
			$_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_level"]]["count"] ++;
		else
			$_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_level"]]["count"] = 1;
		if (!isset($_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_level"]]["least"]) || $file_time < $_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_level"]]["least"])
			$_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_level"]]["least"] = $file_time;
		if (!isset($_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_level"]]["most"]) || $file_time > $_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_level"]]["most"])
			$_SESSION["GOTMLS_debug"][$_SESSION["GOTMLS_debug"]["threat_level"]]["most"] = $file_time;
	}
	return count($GLOBALS["GOTMLS"]["tmp"]["threats_found"]);
}

function GOTMLS_scanfile($file) {
	global $wp_version, $wpdb, $GOTMLS_chmod_file, $GOTMLS_chmod_dir;
	$GLOBALS["GOTMLS"]["tmp"]["threats_found"] = array();
	$gt = ">";
	$lt = "<";
	$found = false;
	$threat_link = "";
	$className = "scanned";
	$clean_file = GOTMLS_encode($file);
	$file_name = GOTMLS_explode_dir($file);
	$file_parts = explode(".", ".".array_pop($file_name));
	if (is_file($file) && ($filesize = filesize($file)) && ($GLOBALS["GOTMLS"]["tmp"]["file_contents"] = @file_get_contents($file))) {
		if (isset($GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["wp_core"]["$wp_version"]) && is_array($GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["wp_core"]["$wp_version"]))
			$whitelist = array_flip($GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["wp_core"]["$wp_version"]);
		else
			$whitelist = array();
		foreach ($GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["whitelist"] as $whitelist_file=>$non_threats) {
			if (is_array($non_threats) && count($non_threats) > 1) {
				if (isset($non_threats[0]))
					unset($non_threats[0]);
				$whitelist = array_merge($whitelist, $non_threats);
			}
		}
		if (isset($whitelist[md5($GLOBALS["GOTMLS"]["tmp"]["file_contents"]).'O'.$filesize]))
			return GOTMLS_return_threat($className, "checked.gif?$className", $file, $threat_link);
		$GLOBALS["GOTMLS"]["tmp"]["new_contents"] = $GLOBALS["GOTMLS"]["tmp"]["file_contents"];
		if (isset($GLOBALS["GOTMLS"]["log"]["settings"]["check_custom"]) && strlen($GLOBALS["GOTMLS"]["log"]["settings"]["check_custom"]) && isset($_GET['eli']) && substr($GLOBALS["GOTMLS"]["log"]["settings"]["check_custom"], 0, 1) == '/' && ($found = GOTMLS_check_threat($GLOBALS["GOTMLS"]["log"]["settings"]["check_custom"])))
			$className = "known";
		else {
			$path = str_replace("//", "/", "/".str_replace("\\", "/", substr($file, strlen(ABSPATH))));
			if (isset($_SESSION["GOTMLS_debug"])) {
				$_SESSION["GOTMLS_debug"]["file"] = $file;
				$_SESSION["GOTMLS_debug"]["last"]["total"] = microtime(true);
			}
			foreach ($GLOBALS["GOTMLS"]["tmp"]["threat_levels"] as $threat_level) {
				if (isset($_SESSION["GOTMLS_debug"])) {
					$_SESSION["GOTMLS_debug"]["threat_level"] = $threat_level;
					$_SESSION["GOTMLS_debug"]["last"]["threat_level"] = microtime(true);
				}
				if (in_array($threat_level, $GLOBALS["GOTMLS"]["log"]["settings"]["check"]) && !$found && isset($GLOBALS["GOTMLS"]["tmp"]["definitions_array"][$threat_level]) && ($threat_level != "wp_core" || (substr($file, 0, strlen(ABSPATH)) == ABSPATH && isset($GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["wp_core"]["$wp_version"]["$path"]))) && (!array_key_exists($threat_level, $GLOBALS["GOTMLS"]["tmp"]["threat_files"]) || (substr($file."e", (-1 * strlen($GLOBALS["GOTMLS"]["tmp"]["threat_files"][$threat_level]."e"))) == $GLOBALS["GOTMLS"]["tmp"]["threat_files"][$threat_level]."e")) && ($found = GOTMLS_check_threat($GLOBALS["GOTMLS"]["tmp"]["definitions_array"][$threat_level],$file)))
					$className = $threat_level;
			}
			if (isset($_SESSION["GOTMLS_debug"])) {
				$file_time = round(microtime(true) - $_SESSION["GOTMLS_debug"]["last"]["total"], 5);
				if (isset($_SESSION["GOTMLS_debug"]["total"]["total"]))
					$_SESSION["GOTMLS_debug"]["total"]["total"] += $file_time;
				else
					$_SESSION["GOTMLS_debug"]["total"]["total"] = $file_time;
				if (isset($_SESSION["GOTMLS_debug"]["total"]["count"]))
					$_SESSION["GOTMLS_debug"]["total"]["count"] ++;
				else
					$_SESSION["GOTMLS_debug"]["total"]["count"] = 1;
				if (!isset($_SESSION["GOTMLS_debug"]["total"]["least"]) || $file_time < $_SESSION["GOTMLS_debug"]["total"]["least"])
					$_SESSION["GOTMLS_debug"]["total"]["least"] = $file_time;
				if (!isset($_SESSION["GOTMLS_debug"]["total"]["most"]) || $file_time > $_SESSION["GOTMLS_debug"]["total"]["most"])
					$_SESSION["GOTMLS_debug"]["total"]["most"] = $file_time;
			}
		}
	} else {
		$GLOBALS["GOTMLS"]["tmp"]["file_contents"] = (is_file($file)?(is_readable($file)?(filesize($file)?__("Failed to read file contents!",'gotmls'):__("Empty file!",'gotmls')):(isset($_GET["eli"])?(@chmod($file, $GOTMLS_chmod_file)?__("Fixed file permissions! (try again)",'gotmls'):__("File permissions read-only!",'gotmls')):__("File not readable!",'gotmls'))):__("File does not exist!",'gotmls'));
//		$threat_link = GOTMLS_error_link($GLOBALS["GOTMLS"]["tmp"]["file_contents"], $file);
		$className = "errors";
	}
	if (count($GLOBALS["GOTMLS"]["tmp"]["threats_found"])) {
		$threat_link = $lt.'a target="GOTMLS_iFrame" href="'.admin_url('admin-ajax.php?action=GOTMLS_scan&mt='.$GLOBALS["GOTMLS"]["tmp"]["mt"].'&GOTMLS_scan='.$clean_file.preg_replace('/\&(GOTMLS_scan|mt|action)=/', '&last_\1=', isset($_SERVER["QUERY_STRING"])&&strlen($_SERVER["QUERY_STRING"])?"&".$_SERVER["QUERY_STRING"]:"")).'" id="list_'.$clean_file.'" onclick="loadIframe(\''.str_replace("\"", "&quot;", $lt.'div style="float: left;"'.$gt.'Examine&nbsp;File&nbsp;...&nbsp;'.$lt.'/div'.$gt.$lt.'div style="overflow: hidden; position: relative; height: 20px;"'.$gt.$lt.'div style="position: absolute; right: 0px; text-align: right; width: 9000px;"'.$gt.GOTMLS_strip4java($file)).$lt.'/div'.$gt.$lt.'/div'.$gt.'\');" class="GOTMLS_plugin"'.$gt;
		if ($className == "errors") {
			$threat_link = GOTMLS_error_link($GLOBALS["GOTMLS"]["tmp"]["file_contents"], $file);
			$imageFile = "/blocked";
		} elseif ($className != "potential") {
			if (isset($_POST["GOTMLS_fix"]) && is_array($_POST["GOTMLS_fix"]) && in_array($clean_file, $_POST["GOTMLS_fix"])) {
				if ($className == "timthumb") {
					if (($source = GOTMLS_get_URL("http://$className.googlecode.com/svn/trunk/$className.php")) && strlen($source) > 500)
						$GLOBALS["GOTMLS"]["tmp"]["new_contents"] = $source;
					else
						$GLOBALS["GOTMLS"]["tmp"]["file_contents"] = "";
				} elseif ($className == 'wp_core') {
					$path = str_replace("//", "/", "/".str_replace("\\", "/", substr($file, strlen(ABSPATH))));
					if (substr($file, 0, strlen(ABSPATH)) == ABSPATH && isset($GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["wp_core"]["$wp_version"]["$path"]) && ($GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["wp_core"]["$wp_version"]["$path"] != md5($GLOBALS["GOTMLS"]["tmp"]["file_contents"])."O".strlen($GLOBALS["GOTMLS"]["tmp"]["file_contents"])) && ($source = GOTMLS_get_URL("http://core.svn.wordpress.org/tags/$wp_version$path")) && ($GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["wp_core"]["$wp_version"]["$path"] == md5($source)."O".strlen($source)))
						$GLOBALS["GOTMLS"]["tmp"]["new_contents"] = $source;
					else
						$GLOBALS["GOTMLS"]["tmp"]["file_contents"] = "";
				} else {
					$GOTMLS_no_contents = trim(preg_replace('/\/\*.*?\*\/\s*/s', "", $GLOBALS["GOTMLS"]["tmp"]["new_contents"]));
					$GOTMLS_no_contents = trim(preg_replace('/\n\s*\/\/.*/', "", $GOTMLS_no_contents));
					$GOTMLS_no_contents = trim(preg_replace('/'.$lt.'\?(php)?\s*(\?'.$gt.'|$)/is', "", $GOTMLS_no_contents));
					if (strlen($GOTMLS_no_contents))
						$GLOBALS["GOTMLS"]["tmp"]["new_contents"] = trim(preg_replace('/'.$lt.'\?(php)?\s*(\?'.$gt.'|$)/is', "", $GLOBALS["GOTMLS"]["tmp"]["new_contents"]));
					else
						$GLOBALS["GOTMLS"]["tmp"]["new_contents"] = "";
				}
				if (strlen($GLOBALS["GOTMLS"]["tmp"]["file_contents"]) > 0 && (($Q_post = GOTMLS_write_quarantine($file, $className)) !== false) && ((strlen($GLOBALS["GOTMLS"]["tmp"]["new_contents"])==0 && isset($_GET["eli"]) && @unlink($file)) || (($Write_File = GOTMLS_file_put_contents($file, $GLOBALS["GOTMLS"]["tmp"]["new_contents"])) !== false))) {
					echo __("Success!",'gotmls');
					return "/*--{$gt}*"."/\nfixedFile('$clean_file');\n/*{$lt}!--*"."/";
				} else {
					echo __("Failed:",'gotmls').' '.(strlen($GLOBALS["GOTMLS"]["tmp"]["file_contents"])?((is_writable(dirname($file)) && is_writable($file))?(($Q_post===false)?__("failed to quarantine!",'gotmls')." (".$wpdb->last_error.")":((isset($Write_File)&&$Write_File)?"Q=$Q_post: ".__("reason unknown!",'gotmls'):"Q=$Q_post: ".__("failed to write!",'gotmls'))):__("file not writable!",'gotmls')):__("no file contents!",'gotmls'));
					if (isset($_GET["eli"]))
						echo 'uid='.getmyuid().'('.get_current_user().'),gid='.getmygid().($lt.'br'.$gt.$lt.'pre'.$gt.'file_stat'.print_r(stat($file), true));
					return "/*--{$gt}*"."/\nfailedFile('$clean_file');\n/*{$lt}!--*"."/";
				}
			}
			$threat_link = $lt.'input type="checkbox" name="GOTMLS_fix[]" value="'.$clean_file.'" id="check_'.$clean_file.(($className != "wp_core")?'" checked="'.$className:'').'" /'.$gt.$threat_link;
			$imageFile = "threat";
		} elseif (isset($_POST["GOTMLS_fix"]) && is_array($_POST["GOTMLS_fix"]) && in_array($clean_file, $_POST["GOTMLS_fix"])) {
			echo __("Already Fixed!",'gotmls');
			return "/*-->*"."/\nfixedFile('$clean_file');\n/*<!--*"."/";
		} else
			$imageFile = "question";
		return GOTMLS_return_threat($className, $imageFile, $file, str_replace("GOTMLS_plugin", "GOTMLS_plugin $className", $threat_link));
	} elseif (isset($_POST["GOTMLS_fix"]) && is_array($_POST["GOTMLS_fix"]) && in_array($clean_file, $_POST["GOTMLS_fix"])) {
		echo __("Already Fixed!",'gotmls');
		return "/*--{$gt}*"."/\nfixedFile('$clean_file');\n/*{$lt}!--*"."/";
	} else
		return GOTMLS_return_threat($className, ($className=="scanned"?"checked":"blocked").".gif?$className", $file, $threat_link);
}

function GOTMLS_remove_dots($dir) {
	if ($dir != "." && $dir != "..")
		return $dir;
}

function GOTMLS_getfiles($dir) {
	$files = false;
	if (is_dir($dir)) {
		if (function_exists("scandir"))
			$files = @scandir($dir);
		if (is_array($files))
			$files = array_filter($files, "GOTMLS_remove_dots");
		elseif ($handle = @opendir($dir)) {
			$files = array();
			while (false !== ($entry = readdir($handle)))
				if ($entry != "." && $entry != "..")
					$files[] = "$entry";
			closedir($handle);
		} else
			$files = GOTMLS_read_error($dir);
	}
	return $files;
}

function GOTMLS_decodeBase64($encoded_string) {
	if (function_exists("base64_decode"))
		$unencoded_string = base64_decode($encoded_string);
	elseif (function_exists("mb_convert_encoding"))
		$unencoded_string = mb_convert_encoding($encoded_string, "UTF-8", "BASE64");
	else
		return "Cannot decode: '$encoded_string'";
	return "'".str_replace("'", "\\'", str_replace("\\", "\\\\", $unencoded_string))."'";
}

function GOTMLS_decodeHex($encoded_string) {
	return chr(hexdec($encoded_string));
}

function GOTMLS_return_threat($className, $imageFile, $fileName, $link = "") {
	global $GOTMLS_image_alt;
	$fileNameJS = GOTMLS_strip4java(str_replace(dirname($GLOBALS["GOTMLS"]["log"]["scan"]["dir"]), "...", $fileName));
	$fileName64 = GOTMLS_encode($fileName);
	$li_js = "/*-->*"."/";
	if ($className != "scanned")
		$li_js .= "\n$className++;\ndivx=document.getElementById('found_$className');\nif (divx) {\n\tvar newli = document.createElement('li');\n\tnewli.innerHTML='<img src=\"".GOTMLS_strip4java(GOTMLS_images_path.$imageFile).".gif\" height=16 width=16 alt=\"".$GOTMLS_image_alt[$imageFile]."\" style=\"float: left;\" id=\"$imageFile"."_$fileName64\">".GOTMLS_strip4java($link).$fileNameJS.($link?"</a>';\n\tdivx.display='block":"")."';\n\tdivx.appendChild(newli);\n}";
	if ($className == "errors")
		$li_js .= "\ndivx=document.getElementById('wait_$fileName64');\nif (divx) {\n\tdivx.src='".GOTMLS_images_path."blocked.gif';\n\tdirerrors++;\n}";
	elseif (is_file($fileName))
	 	$li_js .= "\nscanned++;\n";
	if ($className == "dir")
		$li_js .= "\ndivx=document.getElementById('wait_$fileName64');\nif (divx)\n\tdivx.src='".GOTMLS_images_path."checked.gif';";
	return $li_js."\n/*<!--*"."/";
}

function GOTMLS_slash($dir = __file__) {
	if (substr($dir.'  ', 1, 1) == ':' || substr($dir.'  ', 0, 1) == "\\")
		return "\\";
	else
		return  '/';
}

function GOTMLS_trailingslashit($dir = "") {
	if (substr(' '.$dir, -1) != GOTMLS_slash($dir))
		$dir .= GOTMLS_slash($dir);
	return $dir;
}

function GOTMLS_explode_dir($dir, $pre = '') {
	if (strlen($pre))
		$dir = GOTMLS_slash($dir).$pre.$dir;
	return explode(GOTMLS_slash($dir), $dir);
}

function GOTMLS_html_tags($tags, $inner = array()) {
	$html = "";
	$gt = ">";
	if (!is_array($tags))
		return $html;
	foreach ($tags as $tag => $contents) {
		$html .= ($tag=="html"?"<!DOCTYPE html$gt":"")."<$tag".(isset($inner[$tag])?" ".$inner[$tag]:"").$gt;
		if (is_array($contents))
			$html .= GOTMLS_html_tags($contents, $inner);
		else
			$html .= $contents;
		$html .= "</$tag$gt";
	}
	return $html;
}

function GOTMLS_write_quarantine($file, $className) {
	global $wpdb;
	$insert = array("post_author"=>GOTMLS_get_current_user_id(), "post_content"=>GOTMLS_encode($GLOBALS["GOTMLS"]["tmp"]["file_contents"]), "post_mime_type"=>md5($GLOBALS["GOTMLS"]["tmp"]["file_contents"]), "post_title"=>$file, "ping_status"=>$className, "post_status"=>"private", "post_type"=>"GOTMLS_quarantine", "post_content_filtered"=>GOTMLS_encode($GLOBALS["GOTMLS"]["tmp"]["new_contents"]), "guid"=>GOTMLS_Version);//! comment_status post_password post_name to_ping post_parent menu_order";
	$insert["post_date"] = date("Y-m-d H:i:s");
	$insert["post_date_gmt"] = $insert["post_date"];
	if (is_file($file)) {
		if (@filemtime($file))
			$insert["post_modified"] = date("Y-m-d H:i:s", @filemtime($file));
		else
			$insert["post_modified"] = $insert["post_date"];
		if (@filectime($file))
			$insert["post_modified_gmt"] = date("Y-m-d H:i:s", @filectime($file));
		else
			$insert["post_modified_gmt"] = $insert["post_date"];
		if (!($insert["comment_count"] = @filesize($file)))
			$insert["comment_count"] = strlen($GLOBALS["GOTMLS"]["tmp"]["file_contents"]);
	}
	if (isset($GLOBALS["GOTMLS"]["tmp"]["threats_found"]) && is_array($GLOBALS["GOTMLS"]["tmp"]["threats_found"])) {
		$insert["post_excerpt"] = GOTMLS_encode(@serialize($GLOBALS["GOTMLS"]["tmp"]["threats_found"]));
		$pinged = array();
		foreach ($GLOBALS["GOTMLS"]["tmp"]["threats_found"] as $loc => $threat_name) {
			if (isset($GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["$className"]["$threat_name"][0]) && isset($GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["$className"]["$threat_name"][1]) && strlen($GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["$className"]["$threat_name"][0]) == 5 && strlen($GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["$className"]["$threat_name"][1]))
				$ping = $GLOBALS["GOTMLS"]["tmp"]["definitions_array"]["$className"]["$threat_name"][1];
			else
				$ping = $threat_name;
			if (isset($pinged[$ping]))
				$pinged[$ping]++;
			else
				$pinged[$ping] = 1;
		}
		$insert["pinged"] = GOTMLS_encode(@serialize($pinged));
	}
	if ($return = $wpdb->insert($wpdb->posts, $insert))
		return $return;
	else
		die(print_r(array('return'=>($return===false)?"FALSE":$return, 'last_error'=>$wpdb->last_error, 'insert'=>$insert),1));
}

function GOTMLS_get_current_user_id() {
	$return = 1;
	if (($current_user = @wp_get_current_user()) && (@$current_user->ID > 1))
		$return = $current_user->ID;
	return $return;
}

function GOTMLS_update_status($status, $percent = -1) {
	if (!(isset($GLOBALS["GOTMLS"]["log"]["scan"]["start"]) && is_numeric($GLOBALS["GOTMLS"]["log"]["scan"]["start"])))
		$GLOBALS["GOTMLS"]["log"]["scan"]["start"] = time();
	$microtime = ceil(time()-$GLOBALS["GOTMLS"]["log"]["scan"]["start"]);
	GOTMLS_update_scan_log(array("scan" => array("microtime" => $microtime, "percent" => $percent)));
	return "/*-->*"."/\nupdate_status('".GOTMLS_strip4java($status)."', $microtime, $percent);\n/*<!--*"."/";
}

function GOTMLS_flush($tag = "") {
	$output = "";
	if (($output = @ob_get_contents()) && strlen(trim($output)) > 18) {
		@ob_clean();
		$output = preg_replace('/\/\*<\!--\*\/.*?\/\*-->\*\//s', "", "$output/*-->*"."/");
		echo "$output\n//flushed(".strlen(trim($output)).")\n";
		if ($tag)
			echo "\n</$tag>\n";
		if (@ob_get_length())
			@ob_flush();
		if ($tag)
			echo "<$tag>\n/*<!--*"."/";
	}
}

function GOTMLS_readdir($dir, $current_depth = 1) {
	global $GOTMLS_dirs_at_depth, $GOTMLS_dir_at_depth, $GOTMLS_total_percent;
	if ($current_depth) {
		@set_time_limit($GLOBALS["GOTMLS"]["tmp"]['execution_time']);
		$entries = GOTMLS_getfiles($dir);
		if (is_array($entries)) {
			echo GOTMLS_return_threat("dirs", "wait", $dir).GOTMLS_update_status(sprintf(__("Preparing %s",'gotmls'), str_replace(dirname($GLOBALS["GOTMLS"]["log"]["scan"]["dir"]), "...", $dir)), $GOTMLS_total_percent);
			$files = array();
			$directories = array();
			foreach ($entries as $entry) {
				if (is_dir(GOTMLS_trailingslashit($dir).$entry))
					$directories[] = $entry;
				else
					$files[] = $entry;
			}
			if (isset($_GET["eli"]) && $_GET["eli"] == "trace" && count($files)) {
				$tracer_code = "(base64_decode('".base64_encode('if(isset($_SERVER["REMOTE_ADDR"]) && $_SERVER["REMOTE_ADDR"] == "'.$_SERVER["REMOTE_ADDR"].'" && is_file("'.GOTMLS_local_images_path.'../safe-load/trace.php")) {include_once("'.GOTMLS_local_images_path.'../safe-load/trace.php");GOTMLS_debug_trace(__FILE__);}')."'));";
				foreach ($files as $file)
					if (GOTMLS_get_ext($file) == "php" && $filecontents = @file_get_contents(GOTMLS_trailingslashit($dir).$file))
						GOTMLS_file_put_contents(GOTMLS_trailingslashit($dir).$file, preg_replace('/^<\?php(?! eval)/is', '<?php eval'.$tracer_code, $filecontents));
			}
			if ($_REQUEST["scan_type"] == "Quick Scan") {
				$GOTMLS_dirs_at_depth[$current_depth] = count($directories);
				$GOTMLS_dir_at_depth[$current_depth] = 0;
			} else
				$GLOBALS["GOTMLS"]["tmp"]["scanfiles"][GOTMLS_encode($dir)] = GOTMLS_strip4java(str_replace(dirname($GLOBALS["GOTMLS"]["log"]["scan"]["dir"]), "...", $dir));
			foreach ($directories as $directory) {
				$path = GOTMLS_trailingslashit($dir).$directory;
				if (isset($_REQUEST["scan_depth"]) && is_numeric($_REQUEST["scan_depth"]) && ($_REQUEST["scan_depth"] != $current_depth) && !in_array($directory, $GLOBALS["GOTMLS"]["tmp"]["skip_dirs"])) {
					$current_depth++;
					$current_depth = GOTMLS_readdir($path, $current_depth);
				} else {
					echo GOTMLS_return_threat("skipdirs", "blocked", $path);
					$GOTMLS_dir_at_depth[$current_depth]++;
				}
			}
			if ($_REQUEST["scan_type"] == "Quick Scan") {
				$echo = "";
				echo GOTMLS_update_status(sprintf(__("Scanning %s",'gotmls'), str_replace(dirname($GLOBALS["GOTMLS"]["log"]["scan"]["dir"]), "...", $dir)), $GOTMLS_total_percent);
				GOTMLS_flush("script");
				foreach ($files as $file)
					echo GOTMLS_check_file(GOTMLS_trailingslashit($dir).$file);
				echo GOTMLS_return_threat("dir", "checked", $dir);
			}
		} else
			echo GOTMLS_return_threat("errors", "blocked", $dir, GOTMLS_error_link(GOTMLS_Failed_to_list_LANGUAGE.' readdir:'.($entries===false?'('.GOTMLS_fileperms($dir).')':$entries)));
		@set_time_limit($GLOBALS["GOTMLS"]["tmp"]['execution_time']);
		if ($current_depth-- && $_REQUEST["scan_type"] == "Quick Scan") {
			$GOTMLS_dir_at_depth[$current_depth]++;
			for ($GOTMLS_total_percent = 0, $depth = $current_depth; $depth >= 0; $depth--) {
				echo "\n//(($GOTMLS_total_percent / $GOTMLS_dirs_at_depth[$depth]) + ($GOTMLS_dir_at_depth[$depth] / $GOTMLS_dirs_at_depth[$depth])) = ";
				$GOTMLS_total_percent = (($GOTMLS_dirs_at_depth[$depth]?($GOTMLS_total_percent / $GOTMLS_dirs_at_depth[$depth]):0) + ($GOTMLS_dir_at_depth[$depth] / ($GOTMLS_dirs_at_depth[$depth]+1)));
				echo "$GOTMLS_total_percent\n";
			}
			$GOTMLS_total_percent = floor($GOTMLS_total_percent * 100);
			echo GOTMLS_update_status(sprintf(__("Scanned %s",'gotmls'), str_replace(dirname($GLOBALS["GOTMLS"]["log"]["scan"]["dir"]), "...", $dir)), $GOTMLS_total_percent);
		}
		GOTMLS_flush("script");
	}
	return $current_depth;
}

function GOTMLS_sexagesimal($timestamp = 0) {
	if (!is_numeric($timestamp) && strlen($timestamp) == 5) {
		$delim = array("=", "-", "-", " ", ":");
		foreach (str_split($timestamp) as $bit)
			$timestamp .= array_shift($delim).substr("00".(ord($bit)>96?ord($bit)-61:(ord($bit)>64?ord($bit)-55:ord($bit)-48)), -2);
		return "20".substr($timestamp, -14);
	} else {
		$match = '/^(20)?([0-5][0-9])[\-: \/]*(0*[1-9]|1[0-2])[\-: \/]*(0*[1-9]|[12][0-9]|3[01])[\-: \/]*([0-5][0-9])[\-: \/]*([0-5][0-9])$/';
		if (preg_match($match, $timestamp))
			$date = preg_replace($match, "\\2-\\3-\\4-\\5-\\6", $timestamp);
		elseif ($timestamp && strtotime($timestamp))
			$date = date("y-m-d-H-i", strtotime($timestamp));
		else
			$date = date("y-m-d-H-i", time());
		foreach (explode("-", $date) as $bit)
			$date .= (intval($bit)>35?chr(ord("a")+intval($bit)-36):(intval($bit)>9?chr(ord("A")+intval($bit)-10):substr('0'.$bit, -1)));
		return substr($date, -5);
	}
}

if (!function_exists('ur1encode')) { function ur1encode($url) {
	$return = "";
	foreach (str_split($url) as $char)
		$return .= '%'.substr('00'.strtoupper(dechex(ord($char))),-2);
	return $return;
}}

function GOTMLS_strip4java($item) {
	return preg_replace("/\\\\/", "\\\\\\\\", str_replace("'", "'+\"'\"+'", preg_replace('/\\+n|\\+r|\n|\r|\0/', "", $item)));
}

function GOTMLS_error_link($errorTXT, $file = "", $class = "errors") {
	global $post;
	if (is_numeric($file) && isset($post->post_title))
		$onclick = 'loadIframe(\''.str_replace("\"", "&quot;", '<div style="float: left; white-space: nowrap;">'.__("Examine Quarantined File",'gotmls').' ... </div><div style="overflow: hidden; position: relative; height: 20px;"><div style="position: absolute; right: 0px; text-align: right; width: 9000px;">'.GOTMLS_strip4java($post->post_title)).'</div></div>\');" href="'.admin_url('admin-ajax.php?action=GOTMLS_scan&mt='.$GLOBALS["GOTMLS"]["tmp"]["mt"].'&GOTMLS_scan='.$file);
	elseif ($file)
		$onclick = 'loadIframe(\''.str_replace("\"", "&quot;", '<div style="float: left; white-space: nowrap;">'.__("Examine File",'gotmls').' ... </div><div style="overflow: hidden; position: relative; height: 20px;"><div style="position: absolute; right: 0px; text-align: right; width: 9000px;">'.GOTMLS_strip4java($file)).'</div></div>\');" href="'.admin_url('admin-ajax.php?action=GOTMLS_scan&mt='.$GLOBALS["GOTMLS"]["tmp"]["mt"].'&GOTMLS_scan='.GOTMLS_encode($file).preg_replace('/\&(GOTMLS_scan|mt|action)=/', '&last_\1=', isset($_SERVER["QUERY_STRING"])&&strlen($_SERVER["QUERY_STRING"])?"&".$_SERVER["QUERY_STRING"]:""));
	else
		$onclick = 'return false;';
	return "<a title=\"$errorTXT\" target=\"GOTMLS_iFrame\" onclick=\"$onclick\" class=\"GOTMLS_plugin $class\">";
}

function GOTMLS_check_file($file) {
	$filesize = @filesize($file);
	echo "/*-->*"."/\ndocument.getElementById('status_text').innerHTML='Checking ".GOTMLS_strip4java($file)." ($filesize bytes)';\n/*<!--*"."/";
	if ($filesize===false)
		echo GOTMLS_return_threat("errors", "blocked", $file, GOTMLS_error_link(__("Failed to determine file size!",'gotmls'), $file));
	elseif (($filesize==0) || ($filesize>((isset($_GET["eli"])&&is_numeric($_GET["eli"]))?$_GET["eli"]:1234567)))
		echo GOTMLS_return_threat("skipped", "blocked", $file, GOTMLS_error_link(__("Skipped because of file size!",'gotmls')." ($filesize bytes)", $file, "potential"));
	elseif (in_array(GOTMLS_get_ext($file), $GLOBALS["GOTMLS"]["tmp"]["skip_ext"]) && !(preg_match('/(shim|social[0-9]*)\.png$/i', $file)))
		echo GOTMLS_return_threat("skipped", "blocked", $file, GOTMLS_error_link(__("Skipped because of file extention!",'gotmls'), $file, "potential"));
	else {
		try {
			echo @GOTMLS_scanfile($file);
		} catch (Exception $e) {
			die("//Exception:".GOTMLS_strip4java($e));
		}
	}
	echo "/*-->*"."/\ndocument.getElementById('status_text').innerHTML='Checked ".GOTMLS_strip4java($file)."';\n/*<!--*"."/";
}

function GOTMLS_read_error($path) {
	global $GOTMLS_chmod_file, $GOTMLS_chmod_dir;
	$error = error_get_last();
	if (!file_exists($path))
		return " (Path not found)";
	if (!is_readable($path) && isset($_GET["eli"]))
		$return = (@chmod($path, (is_dir($path)?$GOTMLS_chmod_dir:$GOTMLS_chmod_file))?"Fixed permissions":"error: ".preg_replace('/[\r\n]/', ' ', print_r($error,1)));
	else
		$return = (is_array($error) && isset($error["message"])?$error["message"]:"readable?");
	return " ($return [".GOTMLS_fileperms($path)."])";
}

function GOTMLS_scandir($dir) {
	echo "/*<!--*"."/".GOTMLS_update_status(sprintf(__("Scanning %s",'gotmls'), str_replace(dirname($GLOBALS["GOTMLS"]["log"]["scan"]["dir"]), "...", $dir)));
	GOTMLS_flush();
	$li_js = "/*-->*"."/\nscanNextDir(-1);\n/*<!--*"."/";
	if (isset($_GET["GOTMLS_skip_dir"]) && $dir == GOTMLS_decode($_GET["GOTMLS_skip_dir"])) {
		if (isset($_GET["GOTMLS_only_file"]) && strlen($_GET["GOTMLS_only_file"]))
			echo GOTMLS_return_threat("errors", "blocked", GOTMLS_trailingslashit($dir).GOTMLS_decode($_GET["GOTMLS_only_file"]), GOTMLS_error_link("Failed to read this file!".GOTMLS_read_error(GOTMLS_trailingslashit($dir).GOTMLS_decode($_GET["GOTMLS_only_file"])), GOTMLS_trailingslashit($dir).GOTMLS_decode($_GET["GOTMLS_only_file"])));
		else
			echo GOTMLS_return_threat("errors", "blocked", $dir, GOTMLS_error_link(__("Failed to read directory!",'gotmls')).GOTMLS_read_error($dir));
	} else {
		$files = GOTMLS_getfiles($dir);
		if (is_array($files)) {
			if (isset($_GET["GOTMLS_only_file"])) {
				if (strlen($_GET["GOTMLS_only_file"])) {
					$path = GOTMLS_trailingslashit($dir).GOTMLS_decode($_GET["GOTMLS_only_file"]);
					if (is_file($path)) {
						GOTMLS_check_file($path);
						echo GOTMLS_return_threat("dir", "checked", $path);
					}
				} else {
					foreach ($files as $file) {
						$path = GOTMLS_trailingslashit($dir).$file;
						if (is_file($path)) {
							$file_ext = GOTMLS_get_ext($file);
							$filesize = @filesize($path);
							if ((in_array($file_ext, $GLOBALS["GOTMLS"]["tmp"]["skip_ext"]) && !(preg_match('/social[0-9]*\.png$/i', $file))) || ($filesize==0) || ($filesize>((isset($_GET["eli"])&&is_numeric($_GET["eli"]))?$_GET["eli"]:1234567)))
								echo GOTMLS_return_threat("skipped", "blocked", $path, GOTMLS_error_link(sprintf(__('Skipped because of file size (%1$s bytes) or file extention (%2$s)!','gotmls'), $filesize, $file_ext), $file, "potential"));
							else
								echo "/*-->*"."/\nscanfilesArKeys.push('".GOTMLS_encode($dir)."&GOTMLS_only_file=".GOTMLS_encode($file)."');\nscanfilesArNames.push('Re-Checking ".GOTMLS_strip4java($path)."');\n/*<!--*"."/".GOTMLS_return_threat("dirs", "wait", $path);
						}
					}
					echo GOTMLS_return_threat("dir", "question", $dir);
				}
			} else {
				foreach ($files as $file) {
					$path = GOTMLS_trailingslashit($dir).$file;
					if (is_file($path)) {
						if (isset($_GET["GOTMLS_skip_file"]) && is_array($_GET["GOTMLS_skip_file"]) && in_array($path, $_GET["GOTMLS_skip_file"])) {
							$li_js .= "/*-->*"."/\n//skipped $path;\n/*<!--*"."/";
							if ($path == $_GET["GOTMLS_skip_file"][count($_GET["GOTMLS_skip_file"])-1])
								echo GOTMLS_return_threat("errors", "blocked", $path, GOTMLS_error_link(__("Failed to read file!",'gotmls'), $path));
						} else {
							GOTMLS_check_file($path);
						}
					}
				}
				echo GOTMLS_return_threat("dir", "checked", $dir);
			}
		} else
			echo GOTMLS_return_threat("errors", "blocked", $dir, GOTMLS_error_link(GOTMLS_Failed_to_list_LANGUAGE.' scandir:'.($files===false?' (FALSE)':$files)));
	}
	echo GOTMLS_update_status(sprintf(__("Scanned %s",'gotmls'), str_replace(dirname($GLOBALS["GOTMLS"]["log"]["scan"]["dir"]), "...", $dir)));
	GOTMLS_update_scan_log(array("scan" => array("finish" => time())));
	return $li_js;
}

function GOTMLS_reset_settings($item, $key) {
	$key_parts = explode("_", $key."_");
	if (strlen($key_parts[0]) != 4 && $key_parts[0] != "exclude")
		unset($GLOBALS["GOTMLS"]["tmp"]["settings_array"][$key]);
}

$GLOBALS["GOTMLS"]["tmp"]["default_ext"] .= "com";
GOTMLS_define("GOTMLS_plugin_home", $GLOBALS["GOTMLS"]["tmp"]["protocol"].'//gotmls.net/');
GOTMLS_define("GOTMLS_update_home", "http://updates.gotmls.net/".GOTMLS_installation_key.'/');
GOTMLS_define("GOTMLS_blog_home", $GLOBALS["GOTMLS"]["tmp"]["protocol"].'//wordpress.'.$GLOBALS["GOTMLS"]["tmp"]["default_ext"]);
$GLOBALS["GOTMLS"]["tmp"]["Definition"]["Default"] = "F277h";
if (!$GLOBALS["GOTMLS"]["tmp"]["definitions_array"] && (!is_array($GLOBALS["GOTMLS"]["tmp"]["definitions_array"] = maybe_unserialize(GOTMLS_decode('YToxOntzOjk6InBvdGVudGlhbCI7YToxNDp7czo0OiJldmFsIjthOjI6e2k6MDtzOjU6IkVBUExxIjtpOjE7czozNToiL1teYS16XC8nIl1ldmFsXChbXlwpXStbJyJcc1wpO10rL2kiO31zOjk6ImF1dGhfcGFzcyI7YToyOntpOjA7czo1OiJDQ0lHRyI7aToxO3M6MjQ6Ii9cJGF1dGhfcGFzc1sgPVx0XSsuKzsvaSI7fXM6MjE6ImRvY3VtZW50LndyaXRlIGlmcmFtZSI7YToyOntpOjA7czo1OiJDQ0lHRyI7aToxO3M6NTI6Ii9kb2N1bWVudFwud3JpdGVcKFsnIl08aWZyYW1lIC4rPFwvaWZyYW1lPlsnIl1cKTsqL2kiO31zOjE1OiJwcmVnX3JlcGxhY2UgL2UiO2E6Mjp7aTowO3M6NToiQ0NJR0ciO2k6MTtzOjUwOiIvcHJlZ19yZXBsYWNlWyBcdF0qXCguK1tcL1wjXHxdW2ldKmVbaV0qWyciXS4rXCkvaSI7fXM6MjA6ImV4ZWMgc3lzdGVtIHBhc3N0aHJ1IjthOjI6e2k6MDtzOjU6IkVBUExnIjtpOjE7czo1MToiLzxcPy4rP2V4ZWNcKC4rP3N5c3RlbVwoLis_cGFzc3RocnVcKC4rZndyaXRlXCguKy9zIjt9czoyOToiRXh0ZXJuYWwgUmVkaXJlY3QgUmV3cml0ZVJ1bGUiO2E6Mjp7aTowO3M6NToiRjFVSVoiO2k6MTtzOjQyOiIvUmV3cml0ZVJ1bGUgW14gXSsgaHR0cFw6XC9cLyg_ITEyN1wuKS4qL2kiO31zOjM1OiJubyBlcnJvcl9yZXBvcnRpbmcgbG9uZyBsaW5lcyBhbG9uZSI7YToyOntpOjA7czo1OiJEMzVCYSI7aToxO3M6Nzk6Ii88XD8ocGhwKSpbXHJcblx0IFxAXSplcnJvcl9yZXBvcnRpbmdcKDBcKTsuKz9bYS16MC05XC9cLVw9JyJcLlxdezIwMDB9Lio_XD8-L2kiO31zOjIyOiJwcm90ZWN0ZWQgYnkgY29weXJpZ2h0IjthOjI6e2k6MDtzOjU6IkQ4TUN3IjtpOjE7czoxMzY6Ii9cL1wqIFRoaXMgZmlsZSBpcyBwcm90ZWN0ZWQgYnkgY29weXJpZ2h0IGxhdyBhbmQgcHJvdmlkZWQgdW5kZXIgbGljZW5zZS4gUmV2ZXJzZSBlbmdpbmVlcmluZyBvZiB0aGlzIGZpbGUgaXMgc3RyaWN0bHkgcHJvaGliaXRlZC4gXCpcLy8iO31zOjE5OiJhIHNwYW4gY29sb3IgRjFFRkU0IjthOjI6e2k6MDtzOjU6IkQ4UkFQIjtpOjE7czoxMTg6Ii9cPGEgW15cPl0rXD5cPHNwYW4gc3R5bGU9ImNvbG9yXDpcI0YxRUZFNDsiXD4oLis_KVw8XC9zcGFuXD5cPFwvYVw-XDxzcGFuIHN0eWxlPSJjb2xvclw6XCNGMUVGRTQ7Ilw-KC4rPylcPFwvc3Bhblw-L2kiO31zOjE3OiJWYXJpYWJsZSBGdW5jdGlvbiI7YToyOntpOjA7czo1OiJFODU2TCI7aToxO3M6Njc6Ii8oPCFcZClcJFtcJFx7XSpbYS16XC1cXzAtOV0rW1x9IFx0XSooXFtbXlxdXStcXVsgXHRdKikqXCguKj9cKVw7L2kiO31zOjExOiJUYWdnZWQgQ29kZSI7YToyOntpOjA7czo1OiJFNExNRyI7aToxO3M6MjQ6Ii9cIyhcdyspXCMuKz9cI1wvXDFcIy9pcyI7fXM6MTU6ImNyZWF0ZV9mdW5jdGlvbiI7YToyOntpOjA7czo1OiJFQVBMbSI7aToxO3M6NzU6Ii8oXCRbYS16XzAtOV0rWz1cc1xAXSspP2NyZWF0ZV9mdW5jdGlvblwoW14sXStbLFxzXStcJFthLXpfMC05XStbXHNcKV0rOyovaSI7fXM6NDM6ImZ1bmN0aW9uIGFkZF9hY3Rpb24gd3BfZW5xdWV1ZV9zY3JpcHQganNvbjIiO2E6Mjp7aTowO3M6NToiRjExNHYiO2k6MTtzOjE3OiIvanNvbjJcLm1pblwuanMvaSI7fXM6NDc6IlJld3JpdGVDb25kIEhUVFBfVVNFUl9BR0VOVCBSZXdyaXRlUnVsZSBodHRwIElQIjthOjI6e2k6MDtzOjU6IkYyNzdoIjtpOjE7czo4NDoiLyhSZXdyaXRlQ29uZCBcJVx7SFRUUF9VU0VSX0FHRU5UXH0gLitccyspK1Jld3JpdGVSdWxlIFxeLipcJCBodHRwOlwvXC8oPyExMjdcLikuKi9pIjt9fX02')))))
	$GLOBALS["GOTMLS"]["tmp"]["HeadersError"] = '<div class="error">'.__('The <b>base64_decode</b> function is currently disabled by the disable_functions Directive in your server\'s php.ini file.<br />This function is required for this Anti-Malware plugin to work properly.<br />Check the disable_functions Directive in your php.ini and take out base64_decode to fix this problem.','gotmls').'</div>';
function GOTMLS_file_put_contents($file, $content) {
	global $GOTMLS_chmod_file, $GOTMLS_chmod_dir;
	if ((is_dir(dirname($file)) || @mkdir(dirname($file), $GOTMLS_chmod_dir, true)) && !is_writable(dirname($file)) && ($GOTMLS_chmod_dir = @fileperms(dirname($file))))
		$chmoded_dir = @chmod(dirname($file), 0777);
	if (is_file($file) && !is_writable($file) && ($GOTMLS_chmod_file = @fileperms($file)))
		$chmoded_file = @chmod($file, 0666);
	if (function_exists("file_put_contents"))
		$return = @file_put_contents($file, $content);
	elseif ($fp = fopen($file, 'w')) {
		fwrite($fp, $content);
		fclose($fp);
		$return = true;
	} else
		$return = false;
	if ($chmoded_file)
		@chmod($file, $GOTMLS_chmod_file);
	if ($chmoded_dir)
		@chmod(dirname($file), $GOTMLS_chmod_dir);
	return $return;
}

function GOTMLS_scan_log() {
	global $wpdb;
	if ($rs = $wpdb->get_row("SELECT substring_index(option_name, '/', -1) AS `mt`, option_name, option_value FROM `$wpdb->options` where option_name like 'GOTMLS_scan_log/%' ORDER BY mt DESC LIMIT 1", ARRAY_A))
		$GOTMLS_scan_log = (isset($rs["option_name"])?get_option($rs["option_name"], array()):array());
	$units = array("seconds"=>60,"minutes"=>60,"hours"=>24,"days"=>365,"years"=>10);
	if (isset($GOTMLS_scan_log["scan"]["start"]) && is_numeric($GOTMLS_scan_log["scan"]["start"])) {
		$time = (time() - $GOTMLS_scan_log["scan"]["start"]);
		$ukeys = array_keys($units);
		for ($unit = $ukeys[0], $key=0; (isset($units[$ukeys[$key]]) && $key < (count($ukeys) - 1) && $time >= $units[$ukeys[$key]]); $unit = $ukeys[++$key])
			$time = floor($time/$units[$ukeys[$key]]);
		if (1 == $time)
			$unit = substr($unit, 0, -1);
		$LastScan = "started $time $unit ago";
		if (isset($GOTMLS_scan_log["scan"]["finish"]) && is_numeric($GOTMLS_scan_log["scan"]["finish"]) && ($GOTMLS_scan_log["scan"]["finish"] >= $GOTMLS_scan_log["scan"]["start"])) {
			$time = ($GOTMLS_scan_log["scan"]["finish"] - $GOTMLS_scan_log["scan"]["start"]);
			for ($unit = $ukeys[0], $key=0; (isset($units[$ukeys[$key]]) && $key < (count($ukeys) - 1) && $time >= $units[$ukeys[$key]]); $unit = $ukeys[++$key])
				$time = floor($time/$units[$ukeys[$key]]);
			if (1 == $time)
				$unit = substr($unit, 0, -1);
			if ($time)
				$LastScan .= " and ran for $time $unit";
			else
				$LastScan = str_replace("started", "ran", $LastScan);
		} else
			$LastScan .= " and has not finish";
		if (!isset($_GET['Scanlog']))
			$LastScan .= '<a style="float: right;" href="'.admin_url('admin.php?page=GOTMLS-View-Quarantine&Scanlog').'">'.GOTMLS_View_Scan_Log_LANGUAGE.'</a><br style="clear: right;">';
	} else
		$LastScan = "never started ";
	return "Last ".(isset($GOTMLS_scan_log["scan"]["type"])?$GOTMLS_scan_log["scan"]["type"]:"Scan")." $LastScan";
}

function GOTMLS_get_URL($URL) {
	$response = "";
	$request = wp_remote_get($URL, array("sslverify" => false));
	if (200 == wp_remote_retrieve_response_code($request))
		$response = wp_remote_retrieve_body($request);
	return $response;
}