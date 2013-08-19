<?php

require_once('./application/libraries/videoinfo.php');

class TestVideoInfo extends PHPUnit_Framework_TestCase {

    public function setUp()
    {
        $this->mock_data = array(
            'title' => 'This is Xvideo URL.',
            'url' => 'http://flashservice.xvideos.com/embedframe/foobar');
        $this->mock_page = <<< HTML
    <!DOCTYPE HTML>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>hoge page</title>
    </head>
    <body>
       <embed flashvars='id_video=foobar&amp;url_bigthumb=foobar.jpg' /> 
    </body>
    </html>
HTML;
    }

    public function test_url_rename()
    {
        $videoinfo = VideoInfo::factory('xvideos', $this->mock_data);
        $rewrite_data = $videoinfo->url_rewrite();
        $this->assertEquals('http://www.xvideos.com/videofoobar', $rewrite_data['rewrite_url']);
    }
    public function test_parse_data()
    {
        $videoinfo = VideoInfo::factory('xvideos', $this->mock_data);
        $return_data = $videoinfo->get_videoinfo($this->mock_page);
        $this->assertEquals('foobar.jpg', $return_data['thumbnail']);
    }

}
