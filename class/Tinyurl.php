<?php
require_once("Base.php");

class UrlShortener_Tinyurl extends UrlShortener_Base {
    public static function shorten($url) {
        $result = self::curl_request("http://tinyurl.com/api-create.php?url=" . urlencode($url));

        $link = "";

        if (preg_match('/http:\/\/tinyurl\.com\/(.+)/i', $result, $match)) {
            $link = "http://tinyurl.com/{$match[1]}";
        }

        return $link;
    }
}