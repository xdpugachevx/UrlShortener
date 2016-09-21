<?php
require_once("Base.php");

class UrlShortener_Uto extends UrlShortener_Base {
    public static function shorten($url) {
        $result = self::curl_request("http://u.to/", array(
            "url" => $url,
            "a" => "add",
        ));

        $link = "";

        if (preg_match('/val\(\'http:\/\/u\.to\/(.+?)\'\)/i', $result, $match)) {
            $link = "http://u.to/{$match[1]}";
        }

        return $link;
    }
}