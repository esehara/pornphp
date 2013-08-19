<?php

class Home_Controller extends Base_Controller {

	public function action_index()
    {
        $database_result = ColumnRender::make(
            ScrapeURL::order_by('created_at','desc')->get());
        $render_valiable = array(
            'database_result' => $database_result);
        return View::make('home.index', $render_valiable);
    }

}
