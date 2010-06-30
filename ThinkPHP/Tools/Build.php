#!/usr/local/php/bin/php
<?php
// ���������ļ�
require "./config.php";
// ���ع����ļ�
require "./common.php";

echo "
// +----------------------------------------------------------------------
// | ThinkPHP
// +----------------------------------------------------------------------
// | Copyright (c) 2008 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
";

init();
// ��������
if($argc ==1) {
    // ���뽻��ģʽ
    begin();
}else{
    // �����Զ�ģʽ
    $type = $argv[1];
    $name = $argv[2];
    switch(strtolower($type)) {
        case 'help':
            help();
            break;
        case 'model':
            buildModel($name);
            break;
        case 'action':
            buildAction($name);
            break;
    }
}

?>