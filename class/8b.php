<?php
require_once("Base.php");

class UrlShortener_8b extends UrlShortener_Base {
    public static function shorten($url) {
        $result = self::curl_request("http://8b.kz/ajax/new_url", array(
            "custom" => "",
            "url" => $url,
        ));

        $jsonResponse = json_decode($result, true);

        return isset($jsonResponse["key"]) ? "http://8b.kz/" . $jsonResponse["key"] : "";
    }
}