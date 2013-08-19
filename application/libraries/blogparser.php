<?php

require_once(dirname(__FILE__) . '/simple_html_dom.php');

class BlogParser {
    
    protected $config = array();

    public function __construct($config) {
        $this->config = $config;
    }

    public function get_html($url) {
        return file_get_html($url);
    }

    public function get_entries($html_string = null) {

        if (!is_null($html_string)) {
            $html_dom = str_get_html($html_string);
        } else {
            $html_dom = $this->get_html($this->config['target']);
        }

        return $html_dom->find($this->config['entry']);
    }

    public function parse_entries($html_string = null) {
        $result_parse = array();
        
        $entries = $this->get_entries($html_string);
        
        foreach($entries as $entry) {

            $titledom = $entry->find($this->config['title'], 0);
            $urldom = $entry->find($this->config['url_tag'], 0);

            $parse_data = array();
            if (!is_null($titledom) && !is_null($urldom)) {
                $parse_title = $titledom->plaintext;
                $parse_url = $urldom->{$this->config['url_attr']};
                $result_parse[] = array(
                    'title' => $parse_title,
                    'url' => $parse_url);
            }
        }
        
        return $result_parse;
    }

}
