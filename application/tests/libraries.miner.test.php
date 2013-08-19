<?php

require_once('./application/libraries/minermanager.php');

class TestMiner extends PHPUnit_Framework_TestCase {

    public function setUp()
    {
        $this->config = array('domain' => 'www.xvideos.com');
        $this->mock_data = array(
            array('title'=>'This is title.',
                  'url'=>'http://www.xvideos.com/foobar'),
            array('title'=>'This is title.',
                  'url'=>'http://www.hatena.com/'),
            array('title'=>'This is title.',
                  'url'=>'http://www.xvideos.com/hogehoge'));
    }

    public function test_check_domain()
    {
        $miner_unit = new Miner($this->config);
        $this->assertTrue($miner_unit->check_domain('http://www.xvideos.com/watch=hogehoge'));
        $this->assertFalse($miner_unit->check_domain('http://www.hatena.com/'));
    }

    public function test_miner_correct_link()
    {
        $miner_unit = new Miner($this->config);
        $test_urllist = array(
            'http://www.xvideos.com/hogehoge',
            'http://www.xvideos.com/fugafuga',
            'http://www.hatena.com/');

        foreach ($test_urllist as $test_url) {
            $miner_unit->has_url(
                array('url' => $test_url));
        }
        
        $this->assertEquals(count($miner_unit->collection), 2);
    }

    public function test_add_miner_to_minermanager()
    {
        $miner_manager = new MinerManager();
        $miner_manager->add_miner(new Miner($this->config));
        $this->assertEquals(count($miner_manager->miners), 1);
    }

    public function test_collect_a_link_targetonly()
    {
        $miner_manager = new MinerManager();
        $miner_manager->add_miner(new Miner($this->config));
        $links = $miner_manager->collect_url($this->mock_data);
        $this->assertEquals(count($links), 2);
        
        $links_correct = False;
        foreach ($links as $link) {
            if ($link['url'] === 'http://www.xvideos.com/foobar') {
                $links_correct = True;
            }
        }
        $this->assertTrue($links_correct);
    }

    public function test_construct_minermanager()
    {
        $config = array(
            array('domain' => 'www.xvideos.com'),
            array('domain' => 'www.hatena.com'));
        $miner_manager = new MinerManager($config);
        $links = $miner_manager->collect_url($this->mock_data);
        $this->assertEquals(count($links), 3);
    }

}
