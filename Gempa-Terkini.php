#!/usr/bin/php
<?php
// Data Gempa Terkini
// Coded By Rafsanzani Suhada
// ZeroByte.ID
require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');

$channelAccessToken = 'xlBy/oeCeY2/qEiGiIZvSMOfRVJEasTAcMmwtKgLYS5wr6lvCAJ+NYsXrETcoFKLcLSs9NeJOBI51FxplgRErnpToxqom0D68ifQlRpufL+bFtMDzL5Ihk96TYs1xM95OTM3J0Wa5Lz+Q8WdaXFvPgdB04t89/1O/w1cDnyilFU=
'; //sesuaikan 
$channelSecret = 'f4d8b2c45d18b226e4531a48e993b6bd';//sesuaikan

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$userId 	= $client->parseEvents()[0]['source']['userId'];
$groupId 	= $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$type 		= $client->parseEvents()[0]['type'];

$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];

$profil = $client->profil($userId);

$pesan_datang = explode(" ", $message['text']);

$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}
#-------------------------[Function]-------------------------#
function main(){
	$url = "http://data.bmkg.go.id/autogempa.xml";
	$get = file_get_contents($url, False);
	$data = simplexml_load_string($get) or die("Error: Cannot create object");
	print " Tanggal   : ".$data->gempa->Tanggal."\n";
	print " Jam       : ".$data->gempa->Jam."\n";
	print "\n";
	print "\033[0;36m"; // Cyan
	print " Lintang   : ".$data->gempa->Lintang."\n";
	print " Bujur     : ".$data->gempa->Bujur."\n";
	print " Magnitude : ".$data->gempa->Magnitude."\n";
	print " Kedalaman : ".$data->gempa->Kedalaman."\n";
	print "\n";
	print "\033[0;32m"; // Hijau
	print " Wilayah   : ".$data->gempa->Wilayah1."\n";
	print " Potensi   : ".$data->gempa->Potensi."\n";
	print "\033[0m"; // Normal
}
system('clear');
print "\033[01;31m"; // Merah tua
print "=================================== \n";
print "   ____                             \n";
print "  / ___| ___ _ __ ___  _ __   __ _  \n";
print " | |  _ / _ \ '_ ` _ \| '_ \ / _` | \n";
print " | |_| |  __/ | | | | | |_) | (_| | \n";
print "  \____|\___|_| |_| |_| .__/ \__,_| \n";
print "                      |_|   TERKINI \n";
print "=================================== \n";
print "\033[0m"; // Normal
main();
?>
