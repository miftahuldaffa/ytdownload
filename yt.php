<?php
/*
@ YtConv - YouTube video converter 
@ This project was created by Dfv47 with Black Coder Crush. 
@ Copyright 25 - 12 - 2k19 @m_d4fv
*/

$r = "\033[91m";
$g = "\033[92m";
$y = "\033[93m";
$b = "\033[94m";
$m = "\033[95m";
$c = "\033[96m";
$w ="\033[97m";
$n = "\033[0m";
$a = "\033[1;30m";

@system("clear");
echo "$a

$c __ __  $r YouTube$w Converter                
$c|  |  |___ _ _ ___ ___ ___  $r@$w M Daffa
$c|_   _| . | | |  _| . |   | $r@$w Black Coder Crush
$c  |_| |___|___|___|___|_|_| $r@$w https:/github.com/md4fv
    \n";
echo "$c Url YouTube    $w:$c ";
$url = trim(fgets(STDIN, 1024));
echo "$c Save as        $w:$c ";
$save = trim(fgets(STDIN, 1024));
$data = "function=validate&args[dummy]=1&args[urlEntryUser]=".$url."&args[fromConvert]=urlconverter&args[requestExt]=mp3&args[nbRetry]=0&args[videoResolution]=-1&args[audioBitrate]=0&args[audioFrequency]=0&args[channel]=stereo&args[volume]=0&args[startFrom]=-1&args[endTo]=-1&args[custom_resx]=-1&args[custom_resy]=-1&args[advSettings]=false&args[aspectRatio]=-1";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://www2.onlinevideoconverter.com/webservice");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8'
  ));
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $server_output = json_decode($server_output, TRUE);
        if ($server_output['result']['status'] == "default") {
        echo "VIDEO TITLE    : ".$server_output['result']['title']."\n";
        $judul = $server_output['result']['title'];
        echo "Please Wait... Downloading The MP3 File....";
        $id = "id=".$server_output['result']['dPageId'];
        $res = file_get_contents("https://www.onlinevideoconverter.com/en/success?".$id);
        preg_match("'class=\"download-button\" href=\"https:\/\/(.*?).onlinevideoconverter.com\/download(.*?)file=(.*?)\" id=\"downloadq\">Download<\/a>'si", $res, $match);
        $url_d = $match[1];
        $id_d = $match[3];
        shell_exec('wget -O '.$save.' http://'.$url_d.'.onlinevideoconverter.com/download?file='.$id_d.' 2>&1');
        echo "$r \n*$w Success !! \n";
        echo "$c Saved to       $w:$c $save\n";
}
    else {
        echo "$r \n*$w Failed to Convert !!\n";
    }

?>