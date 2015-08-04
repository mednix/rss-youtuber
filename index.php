<?php
const DEBUG=false;
ini_set('curl.cainfo', '/cacert.pem');
if(DEBUG==true){
    error_reporting(-1);
    ini_set('display_errors', 'On');
}

require 'vendor/autoload.php';

$key='AIzaSyAhYKR543743GnhQmNwIhxULVinpftfIKU';
if(empty($_GET['playlist'])){
    $id=$id='PL784A9CFA20E3E33C';
}
else{
    $id=$_GET['playlist'];
}

$client=new \RssYoutuber\Client($key);
$playlist=new \RssYoutuber\Playlist($client);
$rss=$playlist->id($id)
    ->fetch()
    ->toRss();

//header('Content-Type: application/xml');
echo $rss;