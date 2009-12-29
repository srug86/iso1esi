<?php
if (!defined('GDRPI')) die(header("Location: noencontrado"));

function users_header() {
  echo '
    <div id="header">
      <div id="title"></div>
      <div id="user">
        <div id="type"></div>
        <div id="data"</div>
      </div>
    </div>
  ';
}

function users_body() {
  echo '
    <div id="body">
      <div id="left">
        <ul id="lnav"></ul>
      </div>
      <div id="right">
        <ul id="tnav"></ul>
        <div id="content">
        </div>
      </div>
    </div>
  ';
}
?>