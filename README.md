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
require 'redcarpet'
markdown = Redcarpet.new("Hello World!")
puts markdown.to_html
```
