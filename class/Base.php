<?php

class UrlShortener_Base {
    public static function shorten($url) {
        return "";
    }

    protected static function curl_request($url, $post = null, $jsonPost = false) {
        $errorsCount = 0;

        while (true) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            if ($post) {
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost ? json_encode($post) : http_build_query($post));
                if ($jsonPost) {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        "Content-Type: application/json",
                    ));
                }
            }

            $result = curl_exec($ch);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($result === false) {
                $errorsCount++;
                if ($errorsCount <= 3) {
                    consoleLog(sprintf("CURL error: %s. Try one more time.", $curlError));
                    sleep(10);
                } else {
                    consoleLog(sprintf("CURL error: %s. Terminate.", $curlError));
                    throw new Exception('CURL');
                    die;
                }
            } else {
                break;
            }
        }

        return $result;
    }
}