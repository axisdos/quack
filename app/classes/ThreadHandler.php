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

$view = new Smarty;
$view->assign('user', $user);
class ThreadHandler extends WebHandler {
    
    public $method = "showthread";
    
    public function showthread($url){
        global $user, $conn;
        
		
        $identifier = (int) $url[1];
        $find = mysqli_query($conn, "SELECT *, tinybb_threads.date as postdate FROM tinybb_threads INNER JOIN members ON tinybb_threads.thread_author = members.username WHERE tinybb_threads.thread_key = '{$identifier}'") or die(mysqli_error($conn));
        
        if(mysqli_num_rows($find) == 0){
            $view = new Smarty;
            $view->assign('msg', 'The thread could not be found');
            $view->display('lib/tpl/error.tpl');
            return;
        }
        
        $purifier = new HTMLPurifier();
        
        $fetch = mysqli_fetch_array($find);
        $view = new Smarty;
		if(isset($user['username'])){ $view->assign('user', $user); }
        $fetch['thread_content'] = $purifier->purify($fetch['thread_content']);
        $view->assign('firstpost', $fetch);
        
        
        // find subposts
        
        $subposts = mysqli_query($conn,"SELECT *, tinybb_replies.date as postdate FROM tinybb_replies INNER JOIN members ON tinybb_replies.reply_author = members.username WHERE tinybb_replies.thread_key = '{$identifier}'");
        
        if(mysqli_num_rows($subposts) == 0){
            $view->assign('noreplies', 1);
        } else {
            $posts = array();
            
            while($post = mysqli_fetch_array($subposts)){
                $post['reply_content'] = $purifier->purify($post['reply_content']);
                $posts[] = $post;
            }
            
            $view->assign('subposts', $posts);
        }
        
        $view->display('lib/tpl/showthread.tpl');
        
        
    }
    
    public function postreply($url){
        global $view, $user;
		
		if(!isset($user['username'])){
			$view->assign('msg', 'You are not signed in');
			$view->display('lib/tpl/error.tpl');
			return;
		}
		
		if(!isset($url[2]) || !ctype_digit($url[2])){
			$view->assign('msg', 'Cannot find the thread ID');
			$view->display('lib/tpl/error.tpl');
			return;
		}
		
		$identifier = (float) $url[2];
		$query = "SELECT thread_title FROM tinybb_threads WHERE thread_key = '{$identifier}'";
		$query = mysqli_query($conn,$query);
		
		if(mysqli_num_rows($query) == 0){
			$view->assign('msg', 'Cannot find the thread ID');
			$view->display('lib/tpl/error.tpl');
			return;
		}
		
		if(isset($_POST['addpost'])){
			$id = rand(0, 9999999999999);
			$author = $user['username'];
			$content = mysqli_real_escape_string($conn,$_POST['content']);
			$thread = (float) $url[2];
			$date = date("d-m-Y H:i:s");
			
			if(strlen($content) < 5 || strlen($content) > 5000){
				$view->assign('error', 'Posts most contain at least 5 characters and no more than 5,000');
			} else {
			    $sql = "INSERT INTO tinybb_replies(
				reply_content,
				reply_author,
				reply_key,
				thread_key, 
				date

			)
			VALUES 
			(
				'$content',
				'$author',
				'$id',
				'$thread',
				'$date'
			)";
			
			mysqli_query($conn,$sql);
			$view->assign('postadded', 1);
			$view->assign('thread', (float) $url[2]);
			}
		}
		
		$view->display('lib/tpl/postreply.tpl');
		
    }
}

