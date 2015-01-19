quack
=====

Quack is a forum software written in PHP, MySQL, CSS, HTML and JavaScript. It uses Smarty for templating and Bootstrap for design. Quack uses the codebase from TinyBB but I am slowing rewriting each component.

features
=====

* WYSIWYG Posting
* Module System

module example
=====
The module system hasn't been written in yet, but this is what a module's code may look like

```php
# simple module to add post count to profiles

class Comments extends Module {

	public function __construct(){
	}
	
	public function onViewProfile(Template $profile, User $user){
		$profile->location = 'modules/comments/profile.tpl';
		
		$profile->assign('comments_count', $user->getPostCount());
	}
}
```
The onViewProfile function will be called when Quack has finished loading the profile. Another module example.

```php
# simple module to add post count to profiles

class Comments extends Module {

	public function __construct(){
	}
	
	public function onViewProfile(Template $profile, User $user){
		$profile->location = 'modules/comments/profile.tpl';
		
		if(isset($_POST['like_user'])){
			$this->like($user);
			$profile->assign('success', 'You have liked this user');
		}
	}
	
	public function like(User $user){
		# code to handle the like in the db
	}
}
```
If more than one module changes the same template variable, the template will use the last variable change.

module priority
=====
If a module is important and its template assignments need to be definite, the module's pirority can be changed to 1. 

```php
class Comments extends Module {
	public function __construct(){
		$this->pirority = 1;
	}
}
```
Quack will not run any module with pirority until those without have been ran.
