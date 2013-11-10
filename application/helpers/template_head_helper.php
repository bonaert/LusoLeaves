<?php

if (!function_exists('format_external_css')) {
    function format_external_css($css_file)
    {
        $decl = '<link rel="stylesheet" type="text/css" href="%s" />';
        $css = '';
        foreach ($css_file as $item) {
            if (!empty($item)) {
                $css .= sprintf($decl, $item);
            }
        }
        return $css;
    }
}

if (!function_exists('format_internal_css')) {
    function format_internal_css($css_file)
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

if (!function_exists('format_external_js')) {
    function format_external_js($js_file)
    {
        $decl = '<script type="text/javascript" src="%s"></script>';
        $js = '';
        foreach ($js_file as $item) {
            if (!empty($item)) {
                $js .= sprintf($decl, $item);
            }
        }

        return $js;
    }
}

if (!function_exists('format_internal_js')) {
    function format_internal_js($internal_js)
    {
        $decl = '<script type="text/javascript" src="%s%s"></script>';
        $base = base_url() . 'assets/js/';
        $js = '';
        foreach ($internal_js as $item) {
            if (!empty($item)) {
                $js .= sprintf($decl, $base, $item);
            }
        }

        return $js;
    }
}