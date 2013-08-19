<?php

class Debug_Controller extends Base_Controller {

    public function action_parse()
    {

        $parse_blog_result = array();
        $parse_manager_result = array();
        $parse_info_result = array();

        $config = Config::get('pornphp.blog');
        foreach($config as $seed) {
            $parser = new BlogParser($seed);
            $parse_blog_result = array_merge($parse_blog_result, $parser->parse_entries());
        }  
        
        $config = Config::get('pornphp.miner');
        $miner_manager = new MinerManager($config);
        $parse_manager_result = $miner_manager->collect_url($parse_blog_result);
       
        $videoinfo = VideoInfo::factory('xvideos', null);
        foreach ($parse_manager_result as $info_seed)
        {
            $videoinfo->input_data = $info_seed;
            $parse_info_result[] = $videoinfo->get_videoinfo();
        }

        $render_valiable = array(
            'parse_blog_result' => $parse_blog_result,
            'parse_manager_result' => $parse_manager_result,
            'parse_info_result' => $parse_info_result);

        return View::make('debug.parse', $render_valiable);
    }

    public function action_index()
    {
        $database_result = ColumnRender::make(
            ScrapeURL::order_by('created_at', 'desc')->get());
        $render_valiable = array(
            'database_result' => $database_result);
        return View::make('debug.index', $render_valiable);
    }

    public function action_reload()
    {

        $parse_blog_result = array();
        $parse_manager_result = array();
        $parse_info_result = array();

        $config = Config::get('pornphp.blog');
        foreach($config as $seed) {
            $parser = new BlogParser($seed);
            $parse_blog_result = array_merge($parse_blog_result, $parser->parse_entries());
        }  
        
        $config = Config::get('pornphp.miner');
        $miner_manager = new MinerManager($config);
        $parse_manager_result = $miner_manager->collect_url($parse_blog_result);
       
        $videoinfo = VideoInfo::factory('xvideos', null);
        foreach ($parse_manager_result as $info_seed)
        {
            $videoinfo->input_data = $info_seed;
            $parse_info_result[] = $videoinfo->get_videoinfo();
        }

        foreach($parse_info_result as $url_data) {
            if (ScrapeURL::has_not_url($url_data['url'])) {
                $scrapeurl = new ScrapeURL;
                $scrapeurl->title = $url_data['title'];
                $scrapeurl->url = $url_data['url'];
                $scrapeurl->via = 'None';
                $scrapeurl->domain = 'None';
                $scrapeurl->thumb = $url_data['thumbnail'];
                $scrapeurl->flash = 'None';
                $scrapeurl->save();
            }
        }

        return 'OK';
    }
}
