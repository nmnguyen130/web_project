<?php

defined('ROOTPATH') or exit('Access Denied!');

function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function esc($str)
{
    return htmlspecialchars($str);
}

function redirect($path)
{
    header("Location: " . ROOT . "/" . $path);
    die;
}

/** saves or displays a saved message to the user **/
function message(string $msg = null, bool $clear = false)
{
    $ses     = new Core\Session();

    if (!empty($msg)) {
        $ses->set('message', $msg);
    } else
	if (!empty($ses->get('message'))) {

        $msg = $ses->get('message');

        if ($clear) {
            $ses->pop('message');
        }
        return $msg;
    }

    return false;
}

/** load image. if not exist, load placeholder **/
function get_image(string $file = ''): string
{
    $file = $file ?: '';

    if (file_exists($file)) {
        return ROOT . "/" . $file;
    }

    return ROOT . "/assets/images/no_image.jpg";
}

/** displays input values after a page refresh **/
function old_checked(string $key, string $value, string $default = ""): string
{
    if (isset($_POST[$key])) {
        if ($_POST[$key] == $value) {
            return ' checked ';
        }
    } else {
        if ($_SERVER['REQUEST_METHOD'] == "GET" && $default == $value) {
            return ' checked ';
        }
    }

    return '';
}

function old_value(string $key, mixed $default = "", string $mode = 'post'): mixed
{
    $POST = ($mode == 'post') ? $_POST : $_GET;
    if (isset($POST[$key])) {
        return $POST[$key];
    }

    return $default;
}

function old_select(string $key, mixed $value, mixed $default = "", string $mode = 'post'): mixed
{
    $POST = ($mode == 'post') ? $_POST : $_GET;
    if (isset($POST[$key])) {
        if ($POST[$key] == $value) {
            return " selected ";
        }
    } else

  if ($default == $value) {
        return " selected ";
    }

    return "";
}

/** returns a user readable date format **/
function get_date($date)
{
    return date("jS M, Y", strtotime($date));
}
