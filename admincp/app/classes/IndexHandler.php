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


class IndexHandler extends WebHandler {
    public $method = "index";
    
    public function globalAssign($handler){
        global $user;
        
        $handler->assign('user', $user);
    }
    public function index(){
        global $tpl;
        echo "Hiya!! lol";
        
        $tpl->display('../lib/tpl/users.tpl');
    }
    
    public function users(){
        global $tpl, $conn;
        
        $this->globalAssign($tpl);
        $find = mysqli_query($conn, "SELECT * FROM members ORDER BY id DESC LIMIT 20");
        $users = array();
        while($row = mysqli_fetch_array($find)){
            $users[] = $row;
        }
        $tpl->assign('users', $users);
        $tpl->display('../lib/tpl/users.tpl');
    }
}