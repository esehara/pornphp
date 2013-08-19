<?php

class Videoshow_Controller extends Base_Controller {
    
    public function action_index()
    {
        $video_url = Input::get('url');
        $render_valiable = array(
            'video_url' => $video_url);
        return View::make('home.videoshow', $render_valiable);
    }
}
