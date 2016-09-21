<?php
require_once("Base.php");

class UrlShortener_Bitly extends UrlShortener_Base {
    public static function shorten($url) {
        $apiUrl = "https://api-ssl.bitly.com/v3/shorten?" . http_build_query(array(
                "access_token" => "0358b5de55e5578018085d6a4f6edebdecc959b5",
                "domain" => "bitly.com",
                "longUrl" => $url,
            ));

        $result = self::curl_request($apiUrl);

        $jsonResponse = json_decode($result, true);

        return isset($jsonResponse["data"]["url"]) ? $jsonResponse["data"]["url"] : "";
    }
}