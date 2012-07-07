<?

return array(
    'mode' => 'DEBUG', //DEBUG or NORMAL
    'name' => 'Personal Blog',
    'app_dir_name' => 'blog',
    
    'default_controller' => 'MainController',
    'view'=>'MainView', // MainView.php & class
    'model'=>'MainModel', // MainModel.php & class
    
    // autoloading classes and modules
    'modules'=>array(
            'News',
             ),

    'libs'=>array(
            'Auth',
            'Cookie',
            'Multilang',
            'Sessions',
            'PureValidator',
            ),
    
    'lang'=>array(
            'gr', //The first lang is the default.
            'en'
             ),
    
    'db'=>array(
          'host'=>'localhost',
          'uname'=>'root',
          'pass'=>'',
          'db_name'=>'yaf_blog',
          ),
    
);
    
?>