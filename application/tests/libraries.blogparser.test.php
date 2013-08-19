<?php

require_once('./application/libraries/blogparser.php');

class TestBlogParser extends PHPUnit_Framework_TestCase {

    public function setUp()
    {
        $this->config = array(
            'entry' => 'div.blogentry',
            'title' => 'h2',
            'url_tag' => 'a',
            'url_attr' => 'href');

        $this->mock_html = <<< __HTML
        <!DOCTYPE HTML>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Test Blog</title>
        </head>
        <body>

        <div class="blogentry">
            <h2>これがタイトルです</h2>
            <a href="http://www.foobar.com/"></a>
        </div>
        
        <div class="blogentry">
            <h2>これがタイトルです</h2>
            <a href="http://www.foobar.com/"></a>
        </div>
        
        <div class="blogentry">
            <h2>これがタイトルです</h2>
            <a href="http://www.foobar.com/"></a>
        </div>
        
        </body>
        </html>
__HTML;
    }

    public function test_get_entrydom()
    {
        $parser = new BlogParser($this->config);
        $entries = $parser->get_entries($this->mock_html);
        $this->assertEquals(count($entries), 3);
    }

    public function test_find_title_and_link_in_entry()
    {
        $parser = new BlogParser($this->config);
        $entries = $parser->parse_entries($this->mock_html);
        $this->assertEquals(count($entries), 3);
        $this->assertEquals($entries[0]['title'], 'これがタイトルです');
        $this->assertEquals($entries[0]['url'], 'http://www.foobar.com/');
    }
}
