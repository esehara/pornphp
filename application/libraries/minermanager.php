<?php

require_once(dirname(__FILE__) . '/simple_html_dom.php');
require_once(dirname(__FILE__) . '/miner.php');

class MinerManager {

    public $miners = array();

    public function __construct($config = null) {
        if (!is_null($config)) {
            foreach($config as $seed) {
                $miner = new Miner($seed);
                $this->add_miner($miner);
            }
        }
    }

    public function add_miner($miner) {
        $this->miners[] = $miner;
    }

    public function collect_url($html_string) {
        $this->miners_collect_url($html_string);
        return $this->miners_tell_urllist();
    }

    public function miners_tell_urllist() {
        $result_urllist = array();
        foreach ($this->miners as $miner) {
            $result_urllist = array_merge($result_urllist, $miner->collection);
        }
        return $result_urllist;
    }

    public function miners_collect_url($parse_data) {
        
        foreach ($parse_data as $data) {
            $this->miners_check($data);
        }
    }

    public function miners_check($parse_data)
    {
        $miners_member = count($this->miners);
        for ($i = 0; $i < $miners_member ; $i++) {
            $this->miners[$i]->has_url($parse_data);
        }
    }

}
