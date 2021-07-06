<?php
namespace Resources\utility;

class HtmlTags {

    public static $EmphasisTags = "<strong><b> <i><em> <u><ins> <del><s> <small> <mark>";
    public static $ListTags = "<li><lu>";
    public static $HeaderTags = "<h1><h2><h3><h4><h5>";
    public static $ScriptTags = "<script>";
    public static $ImageTags = "<img>";

    private static $DescriptionTags = null;

    public static function getDescriptionTags() {

        if (!self::$DescriptionTags) {
            self::$DescriptionTags = self::$EmphasisTags.self::$ListTags.self::$HeaderTags.self::$ImageTags;
        }

        return self::$DescriptionTags;
    }

    public function __get ($name) {
        return $this->$name ?? null;
    }
    function __set ($name, $value) {
        return $value;
    }
}