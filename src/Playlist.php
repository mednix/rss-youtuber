<?php
namespace RssYoutuber;

use Suin\RSSWriter\Channel;
use Suin\RSSWriter\Feed;
use Suin\RSSWriter\Item;

class Playlist
{
    /**
     * @var Client
     */
    private $client;
    private $id;
    private $videos;

    public function __construct(Client $client)
    {

        $this->client = $client;
    }

    public function id($id)
    {
        $this->id=$id;
        return $this;
    }

    public function fetch()
    {
        $this->videos=$this->client->playlist($this->id)->videos;
        return $this;
    }
    public function toRss(){
        $feed=new Feed();
        $channel = new Channel();
        $channel->title("Youtube Videos")
            ->description("Latest videos of a playlist")
            ->url('https://agile-citadel-4128.herokuapp.com')
            ->appendTo($feed);
        foreach($this->videos as $video){
            $item = new Item();
            $thumbnail=!empty($video->snippet->thumbnails)?$video->snippet->thumbnails->default->url: 'https://c1.staticflickr.com/3/2210/2400278641_a0ce6c1511.jpg';
            $item->title($video->snippet->title)
                ->description($video->snippet->description)
                ->url('http://www.youtube.com/v/'.$video->snippet->resourceId->videoId)
                //->pubDate($video->snippet->publishedAt)
                ->enclosure($thumbnail, 10000, 'image/jpeg')
                ->appendTo($channel);
        }
        return $feed->render();
    }
}
