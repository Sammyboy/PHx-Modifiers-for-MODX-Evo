<?php
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
// 
//  replace
//  PHx-Modifier for the MODX Evolution content management framework
//
//  Search and replace substrrings
//
//  Version:    1.0
//
//  Usage:      [*variable:replace_str=`search string==replace string||search string==replace string`]
//
//  Example:    [*myTV:replace_str=`[==&#91;||]==&#93;||{==&#123;||}==&#125;`]
//
//  License:    http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
//  Author:     sam (sam@gmx-topmail.de)
//
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

if (strlen($options) == 0) return $output;

if (!function_exists('search_replace')) {
    function search_replace($s, $r, $sql) {
        $e = '/('.implode('|', array_map('preg_quote', $s)).')/';
        $r = array_combine($s, $r);
        return preg_replace_callback($e, function($v) use ($s, $r) { return $r[$v[1]]; }, $sql);
    } 
}

$options   = explode("||", trim($options));
for ($i=0; $i<count($options); $i++) {
    list($key, $value) = explode("==", trim($options[$i]));
    $replace[trim($key)] = trim($value);
}

return search_replace(array_keys($replace), array_values($replace), $output);
?>
