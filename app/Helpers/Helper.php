<?php

function style_version($path) {
    try {
        $ts = '?v=' . filemtime(public_path() . $path);
    } catch (Exception $ex) {
        $ts = '';
    }
    return '<link rel="stylesheet" href="' . URL::asset('public/') . $path . $ts . '" />';
}

function script_version($path) {

    try {
        $ts = '?v=' . filemtime(public_path() . $path);
    } catch (Exception $ex) {
        $ts = '';
    }
    return ' <script type="text/javascript" src="' . URL::asset('public/') . $path . $ts . '"></script>';
}
