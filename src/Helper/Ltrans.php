<?php
namespace Webtamizhan\Ltrans;


class Ltrans{

    public static function langOption()
    {
        $path = base_path() . '/resources/lang/';
        $lang = scandir($path);
        $files = array_diff($lang, array('.', '..','vendor'));
        $t = array();
        foreach ($files as $value) {
            if (is_dir($path . $value)) {
                $fp = file_get_contents($path . $value . '/config.json');
                $fp = json_decode($fp, true);
                $t[] = $fp;
            }
        }
        return $t;
    }

}