<?php
require_once("Base.php");

class UrlShortener_Googl extends UrlShortener_Base {
    public static function shorten($url) {
        $apiUrl = "https://www.googleapis.com/urlshortener/v1/url?" .
            http_build_query(array(
                "key" => "AIzaSyDO7BfA6g79WtBY7xUTKuf6-ZKOqQQ7y1Q"
            ));

        $result = self::curl_request($apiUrl, array(
            "longUrl" => $url,
        ), true);

        $jsonResponse = json_decode($result, true);

        return isset($jsonResponse["id"]) ? $jsonResponse["id"] : "";
    }
}