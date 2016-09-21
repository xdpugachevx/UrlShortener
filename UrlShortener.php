<?php


class UrlShortener {
    public function __construct() {

    }

    public function shorten($url, $shortenerClass = null) {
        if (!$shortenerClass) {
            $shortenerClasses = array();
            foreach (scandir(__DIR__ . "/class") as $file) {
                if ($file != "." && $file != ".." && $file != "Base.php" && $file != "8b.php" && $file != "Uto.php") {
                    $shortenerClasses[] = basename($file, ".php");
                }
            }

            $shortenerClass = $shortenerClasses[mt_rand(0, count($shortenerClasses) - 1)];
        }

        $shortenerClassName = "UrlShortener_{$shortenerClass}";

        require_once("class/{$shortenerClass}.php");
        return $shortenerClassName::shorten($url);
    }
}