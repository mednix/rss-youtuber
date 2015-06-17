<?php
namespace RssYoutuber;

use Madcoda\Youtube;

class Client
{
    private $key;
    private $youtube;
    public function __construct($key)
    {
        $this->key = $key;
        $this->youtube=new Youtube(['key'=>$key]);
    }

    public function playlist($id)
    {
        $playlist=new \stdClass();
        $playlist->videos= $this->youtube->getPlaylistItemsByPlaylistId($id, 100);
        return $playlist;
    }
}
