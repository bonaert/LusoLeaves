<?php


if (!function_exists('format_css')) {
    function format_css($css_file)
    {
        $decl = '<link rel="stylesheet" type="text/css" href="%s%s" />';
        $base = base_url() . 'assets/css/';
        $css = '';
        foreach ($css_file as $item) {
            if (!empty($item)) {
                $css .= sprintf($decl, $base, $item);
            }
        }
        return $css;
    }
}


if (!function_exists('format_js')) {
    function format_js($js_file)
    {
        $decl = '<script type="text/javascript" src="%s%S"></script>';
        $base = base_url() . 'assets/js/';
        $js = '';
        foreach ($js_file as $item) {
            if (!empty($item)) {
                $js .= sprintf($decl, $base, $item);
            }
        }

        return $js;
    }
}