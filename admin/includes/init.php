<?php
(defined('DS')) ? null : define('DS', DIRECTORY_SEPARATOR);

(defined('SITE_ROOT')) ? null : define('SITE_ROOT' , DS . 'xampp' . DS . 'htdocs' . DS . 'projects' . DS . 'mini'); 

(defined('INCLUDES_PATH')) ? null : define('INCLUDES_PATH' , SITE_ROOT . DS . 'includes');



require_once("new_config.php");
require_once("database.php");
require_once("db_object.php");

require_once("functions.php");
require_once("address.php");
require_once("user.php");
require_once("category.php");
require_once("subcategory.php");
require_once("cart.php");
require_once("brand.php");
require_once("product.php");
require_once("comment.php");
require_once("variant.php");
require_once("session.php");
require_once("order_child.php");
require_once("order_master.php");
require_once("card.php");
require_once("payment.php");

?>