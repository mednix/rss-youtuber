<?php
require 'vendor/autoload.php';

$key='AIzaSyAhYKR543743GnhQmNwIhxULVinpftfIKU';
$id='PL784A9CFA20E3E33C';

$client=new \RssYoutuber\Client($key);
$playlist=new \RssYoutuber\Playlist($client);
$rss=$playlist->id($id)
    ->fetch()
    ->toRss();

header('Content-Type: application/xml');
echo $rss;