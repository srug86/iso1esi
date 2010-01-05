<?php
header("Content-Type: text/css; charset=UTF-8");

session_start();
$color = $_SESSION['user']['color'];
?>

#header {
    height: 145px;
    color: white;
    text-align: left;
    border-bottom: 1px solid #C0C0C0;
    background-color: <? echo $color; ?>;
}

#header #type {
    float: left;
    width: 570px;
    font-size: 70pt;
    margin: 52px 0 -18px 15px;
}

#header #data {
    float: right;
    width: 410px;
}

#header #data a {
    color: white;
}

#header #data #refers {
    float: left;
    width: 292px;
    margin-top: 10px;
    text-align: right;
}

#header #data #photo {
    float: right;
    margin: 10px;
}

#header #data img {
    border: 1px solid white;
}

#body {
    background-color: white;
}

#body #left {
    float: left;
    width: 205px;
}

#body #left ul {
    position: relative;
    z-index: 1001;
    padding: 0;
    margin: 41px 0 0 10px;
    list-style-type: none;
}

#body #left ul li {
    float: left;
    width: 190px;
    height: 25px;
    line-height: 22px;
    padding-left: 5px;
    text-align: left;
}

#body #left ul li#lon {
    border: 1px solid <? echo $color; ?>;
    border-right-color: white;
    background-color: white;
    color: <? echo $color; ?>;
    font-weight: bold;
}

#body #left ul li.loff {
    color: <? echo $color; ?>;
}

#body #left ul li.loff:hover {
    color: white;
    background-color: <? echo $color; ?>;
    border-right: 1px solid <? echo $color; ?>;
}

#body #right {
    float: left;
    width: 784px;
}

#body #right a#logout {
    float: right;
    margin-top: 17px;
    color: <? echo $color; ?>;
}

#body #right ul {
    position: relative;
    z-index: 1001;
    float: left;
    height: 12px;
    padding: 0px;
    margin-left: 1px;
    list-style-type: none;
}

#body #right ul li {
    float: left;
    height: 25px;
    padding: 0 10px;
    line-height: 22px;
}

#body #right ul li#ron {
    border: 1px solid <? echo $color; ?>;
    border-bottom-color: white;
    background-color: white;
    color: <? echo $color; ?>;
    font-weight: bold;
}

#body #right ul li#roff {
    padding-top: 1px;
    color: <? echo $color; ?>;
}

#body #right ul li#roff:hover {
    color: white;
    background-color: <? echo $color; ?>;
    border-bottom: 1px solid <? echo $color; ?>;
}

#body #right #content {
    position: relative;
    z-index: 1000;
    margin-left: 1px;
    border: 1px solid <? echo $color; ?>;
    height: 300px;
    clear: both;
    background-color: white;
    padding: 10px 20px;
}

#body #right #content #buttons {
    text-align: left;
    border: 1px solid 
}