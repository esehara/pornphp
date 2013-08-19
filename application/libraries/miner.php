<?php

class Miner {

    protected $config = array();
    public $collection = array();

    public function __construct($config) {
        
            $this->config = $config;

    }

    public function check_domain($check_domain)
    {
        return preg_match("/" . $this->config['domain'] . "/", $check_domain)  === 1;
    }

    public function has_url($check_data)
    {
        if ($this->check_domain($check_data['url'])) {
            $this->collection[] = $check_data;
        }
    }


}
