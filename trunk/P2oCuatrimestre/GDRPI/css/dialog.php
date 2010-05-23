<?php
header("Content-Type: text/css; charset=UTF-8");

session_start();
$type = $_SESSION['user']['type'];
$color = $_SESSION['user']['color'];
?>

/*
* jQuery UI CSS Framework
* Copyright (c) 2009 AUTHORS.txt (http://jqueryui.com/about)
* Dual licensed under the MIT (MIT-LICENSE.txt) and GPL (GPL-LICENSE.txt) licenses.
*/

/* Layout helpers
----------------------------------*/
.ui-helper-hidden { display: none; }
.ui-helper-hidden-accessible { position: absolute; left: -99999999px; }
.ui-helper-reset { margin: 0; padding: 0; border: 0; outline: 0; line-height: 1.3; text-decoration: none; font-size: 100%; list-style: none; }
.ui-helper-clearfix:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }
.ui-helper-clearfix { display: inline-block; }
.ui-helper-clearfix { display:block; }
.ui-helper-zfix { width: 100%; height: 100%; top: 0; left: 0; position: absolute; opacity: 0; filter:Alpha(Opacity=0); }

/* Icons
----------------------------------*/
/* states and images */
.ui-icon { display: block; text-indent: -99999px; overflow: hidden; background-repeat: no-repeat; }

/* Resizable
----------------------------------*/
.ui-resizable { position: relative;}
.ui-resizable-handle { position: absolute;font-size: 0.1px;z-index: 99999; display: block;}
.ui-resizable-disabled .ui-resizable-handle, .ui-resizable-autohide .ui-resizable-handle { display: none; }
.ui-resizable-n { cursor: n-resize; height: 7px; width: 100%; top: -5px; left: 0px; }
.ui-resizable-s { cursor: s-resize; height: 7px; width: 100%; bottom: -5px; left: 0px; }
.ui-resizable-e { cursor: e-resize; width: 7px; right: -5px; top: 0px; height: 100%; }
.ui-resizable-w { cursor: w-resize; width: 7px; left: -5px; top: 0px; height: 100%; }
.ui-resizable-se { cursor: se-resize; width: 12px; height: 12px; right: 1px; bottom: 1px; }
.ui-resizable-sw { cursor: sw-resize; width: 9px; height: 9px; left: -5px; bottom: -5px; }
.ui-resizable-nw { cursor: nw-resize; width: 9px; height: 9px; left: -5px; top: -5px; }
.ui-resizable-ne { cursor: ne-resize; width: 9px; height: 9px; right: -5px; top: -5px;}

/* Dialog
----------------------------------*/
.ui-dialog { position: relative; padding: .2em; width: 300px; }
.ui-dialog .ui-dialog-titlebar { padding: .5em .3em .3em 1em; position: relative;  }
.ui-dialog .ui-dialog-title { float: left; margin: .1em 20px .2em 0; } 
.ui-dialog .ui-dialog-titlebar-close { position: absolute; right: .3em; top: 50%; width: 19px; margin: -10px 0 0 0; padding: 1px; height: 18px; }
.ui-dialog .ui-dialog-titlebar-close span { display: block; margin: 1px; }
.ui-dialog .ui-dialog-titlebar-close:hover, .ui-dialog .ui-dialog-titlebar-close:focus { padding: 0; }
.ui-dialog .ui-dialog-content { border: 0; padding: .5em 1em; background: none; overflow: auto; zoom: 1; }
.ui-dialog .ui-dialog-buttonpane { text-align: left; border-width: 1px 0 0 0; background-image: none; margin: .5em 0 0 0; padding: .3em 1em .5em .4em; }
.ui-dialog .ui-dialog-buttonpane button { float: right; margin: .5em .4em .5em 0; cursor: pointer; padding: .2em .6em .3em .6em; line-height: 1.4em; width:auto; overflow:visible; }
.ui-dialog .ui-resizable-se { width: 14px; height: 14px; right: 3px; bottom: 3px; }
.ui-draggable .ui-dialog-titlebar { cursor: move; }

/*
* jQuery UI CSS Framework
* Copyright (c) 2009 AUTHORS.txt (http://jqueryui.com/about)
* Dual licensed under the MIT (MIT-LICENSE.txt) and GPL (GPL-LICENSE.txt) licenses.
*/

/* Component containers
----------------------------------*/
.ui-widget { font-family: Arial,sans-serif; font-size: 1.1em; }
.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button { font-family: Arial,sans-serif; font-size: 1em; }
.ui-widget-content { background:#FFFFFF url(images/ui-bg_flat_75_ffffff_40x100.png) repeat-x scroll 50% 50%; border:1px solid #EEEEEE; color:#333333; }
.ui-widget-content a { color: #333333; }
.ui-widget-header { border: 1px solid #c0c0c0; background: <? echo $color; ?> url(images/ui-bg_highlight-soft_15_cc0000_1x100.png) 50% 50% repeat-x; color: #ffffff; font-weight: bold; }
.ui-widget-header a { color: #ffffff; }

/* Interaction states
----------------------------------*/
.ui-state-default, .ui-widget-content .ui-state-default { border: 1px solid #d8dcdf; background: #eeeeee url(images/ui-bg_highlight-hard_100_eeeeee_1x100.png) 50% 50% repeat-x; font-weight: bold; color: #004276; outline: none; }
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited { color: #004276; text-decoration: none; outline: none; }
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus { border: 1px solid #cdd5da; background: #f6f6f6 url(images/ui-bg_highlight-hard_100_f6f6f6_1x100.png) 50% 50% repeat-x; font-weight: bold; color: #111111; outline: none; }
.ui-state-hover a, .ui-state-hover a:hover { color: #111111; text-decoration: none; outline: none; }
.ui-state-active, .ui-widget-content .ui-state-active { border: 1px solid #eeeeee; background: #ffffff url(images/ui-bg_flat_65_ffffff_40x100.png) 50% 50% repeat-x; font-weight: bold; color: <? echo $color; ?>; outline: none; }
.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited { color: <? echo $color; ?>; outline: none; text-decoration: none; }

/* Icons
----------------------------------*/
/* states and images */
.ui-icon { width: 16px; height: 16px; background-image: url(../images/x-<? echo $type; ?>.png); }
.ui-widget-content .ui-icon { background-image: url(../images/grid-<? echo $type; ?>.png); }
.ui-widget-header .ui-icon { background-image: url(../images/x-white.png); }
.ui-state-hover .ui-icon, .ui-state-focus .ui-icon {background-image: url(../images/x-<? echo $type; ?>.png); }
/* positioning */
.ui-icon-closethick { background-position: 4px 4px; }

/* Misc visuals
----------------------------------*/
/* Corner radius */
.ui-corner-tl { -moz-border-radius-topleft: 6px; -webkit-border-top-left-radius: 6px; }
.ui-corner-tr { -moz-border-radius-topright: 6px; -webkit-border-top-right-radius: 6px; }
.ui-corner-bl { -moz-border-radius-bottomleft: 6px; -webkit-border-bottom-left-radius: 6px; }
.ui-corner-br { -moz-border-radius-bottomright: 6px; -webkit-border-bottom-right-radius: 6px; }
.ui-corner-top { -moz-border-radius-topleft: 6px; -webkit-border-top-left-radius: 6px; -moz-border-radius-topright: 6px; -webkit-border-top-right-radius: 6px; }
.ui-corner-bottom { -moz-border-radius-bottomleft: 6px; -webkit-border-bottom-left-radius: 6px; -moz-border-radius-bottomright: 6px; -webkit-border-bottom-right-radius: 6px; }
.ui-corner-right {  -moz-border-radius-topright: 6px; -webkit-border-top-right-radius: 6px; -moz-border-radius-bottomright: 6px; -webkit-border-bottom-right-radius: 6px; }
.ui-corner-left { -moz-border-radius-topleft: 6px; -webkit-border-top-left-radius: 6px; -moz-border-radius-bottomleft: 6px; -webkit-border-bottom-left-radius: 6px; }
.ui-corner-all { -moz-border-radius: 6px; -webkit-border-radius: 6px; }