<?php
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// 
//  dateLang
//  PHx-Modifier for the MODX Evolution content management framework
//
//  Translates date names into a foreign language, defined in the files
//  "/assets/snippets/dateLang/date_lang_*.php", where * should be a land code.
//
//  Version:    1.0
//
//  Usage:      [*variable:dateLang=`language-code`]
//
//  Example:    [*createdon:date=`%A, %d. %B %Y`:dateLang=`en_de`*]
//              (tanslates the date from english into german language)
//
//  License:    http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
//  Author:     sam (sam@gmx-topmail.de)
//
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

if (strlen($options) == 0) return $output;
include(MODX_BASE_PATH."assets/plugins/phx/modifiers/dateLang/dateLang_".trim($options).".php");

if (!function_exists('search_replace')) {
    function search_replace($s, $r, $sql) {
        $e = '/('.implode('|', array_map('preg_quote', $s)).')/';
        $r = array_combine($s, $r);
        return preg_replace_callback($e, function($v) use ($s, $r) { return $r[$v[1]]; }, $sql);
    } 
}
return search_replace(array_keys($_dateLang), array_values($_dateLang), $output);
?>
