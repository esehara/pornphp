<?php

require_once(dirname(__FILE__) . '/simple_html_dom.php');

class VideoInfo {

    public function __construct($url_data)
    {
        $this->input_data = $url_data;
    }

    public static function factory($urltype, $url_data)
    {
        $videoinfo = new VideoInfo($url_data);
        
        switch ($urltype) {
            case 'xvideos':
                $parser = new XvideoParser($url_data);
                break;
        }

        $videoinfo->parser = $parser;
        return $videoinfo;
    }

    public function url_rewrite()
    {
        return $this->parser->rewrite(
            $this->input_data);
    }
    
    public function get_videoinfo($html_string = null) 
    {
        if (is_null($html_string)) {
            $url_data = $this->url_rewrite();
            $html_dom = file_get_html($url_data['rewrite_url']);
        } else {
            $url_data = $this->input_data;
            $html_dom = str_get_html($html_string);
        }

        return $this->parser->get_videoinfo($html_dom, $url_data);
    }

}

class XvideoParser {

    public function rewrite($url_data)
    {
        $rewrite_url = str_replace('flashservice.xvideos.com','www.xvideos.com',$url_data['url']);
        $rewrite_url = str_replace('/embedframe/', '/video', $rewrite_url);
        $url_data['rewrite_url'] = $rewrite_url;
        return $url_data;
    }

    public function get_videoinfo($html_dom, $url_data)
    {
        $attribute = $html_dom->find('embed', 0)->flashvars;
        $attribute = htmlspecialchars_decode($attribute);
        parse_str($attribute, $parse_data);
        $url_data['thumbnail'] = $parse_data['url_bigthumb'];
        return $url_data;
    }
}
