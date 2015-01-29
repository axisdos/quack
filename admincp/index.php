<?php

/* 
 * Copyright (C) 2015 Joshua.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301  USA
 */
require_once "../config.php";
require_once "../inc/tinybb-settings.php";
require_once "app/classes/FakeUser.class.php";
require_once "../app/classes/WebHandler.php";
$fakeuser = new FakeUser();

$user = (isset($user['username'])) ? $user : $fakeuser->toArray();


if(strpos($_GET['page'], '/') !== false){
    $controller = explode('/', $_GET['page']);
    ucfirst($controller[0]);
    if(file_exists('app/classes/' . $controller[0] . 'Handler.php')){
        require_once 'app/classes/'. $controller[0] . 'Handler.php';
        $n = $controller[0] . "Handler";
        $p = new $n();
        $page = 'none';
    }
}
?>
