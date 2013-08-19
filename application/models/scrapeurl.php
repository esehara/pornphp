<?php

class ScrapeURL extends Eloquent {
    
    public static $timestamps = true;

    public static function has_not_url($url) {
        $check = ScrapeURL::where('url', '=', $url)->first();
        return is_null($check);
    }

    public function videoshowlize()
    {
        return urlencode(
            str_replace(
                'http://flashservice.xvideos.com/', '', $this->url));
    }

}
