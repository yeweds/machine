<?php
// +----------------------------------------------------------------------
// | ThinkPHP
// +----------------------------------------------------------------------
// | Copyright (c) 2008 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

//���������ļ�
require './config.php';
//����ThinkPHP����
require THINK_PATH."/Common/defines.php";
// ϵͳ������
require THINK_PATH."/Common/functions.php";
//����ThinkPHP����
import("Think.Core.Base");
//����Think������
import("Think.Util.Config");
import("Think.Db.Db");
// ���ݿ�������Ϣ����
C($config);

function init() {
    mk_dir(APP_PATH.'Lib/Model/');
    mk_dir(APP_PATH.'Lib/Action/');
}

function buildModel($name='') {
    if(empty($name)) {
        $db =   DB::getInstance();
        $tables = $db->getTables(C('DB_NAME'));
        foreach ($tables as $table){
            $table    =   str_replace(C('DB_PREFIX'),'',$table);
            buildModel($table);
        }
    }else{
        $name   =   ucwords($name);
        echo '��������'.$name.'Model��...';
        $filename = APP_PATH.'Lib/Model/'.$name.'Model.class.php';
        if(!file_exists($filename)) {
            $content =   "<?php \n";
            $content .= "class ".$name."Model extends Model \n{\n";
            $content .= "}\n?>";
            if(file_put_contents($filename,$content)){
                echo "...Complete\n";
            }else{
                echo "...Fail\n";
            };
        }else{
            echo "...Exists\n";
        }
    }
}

function buildAction($name='') {
    if(empty($name)) {
        $db =   DB::getInstance();
        $tables = $db->getTables(C('DB_NAME'));
        foreach ($tables as $table){
            $table    =   str_replace(C('DB_PREFIX'),'',$table);
            buildAction($table);
        }
    }else{
        $name   =   ucwords($name);
        echo '��������'.$name.'Action��...';
        $filename = APP_PATH.'Lib/Action/'.$name.'Action.class.php';
        if(!file_exists($filename)) {
            $content =   "<?php \n";
            $content .= "class ".$name."Action extends Action \n{\n";
            $content .= "}\n?>";
            if(file_put_contents($filename,$content)){
                echo "...Complete\n";
            }else{
                echo "...Fail\n";
            };
        }else{
            echo "...Exists\n";
        }
    }
}
function begin() {
echo "
+------------------------
| [ 1 ] ����Model
| [ 2 ] ����Action
| [ 0 ] �˳�
+------------------------
��������ѡ��:";
    $number = trim(fgets(STDIN,256));
    //fscanf(STDIN, "%d\n", $number); // �� STDIN ��ȡ����
    switch($number) {
    case 0:
        break;
    case 1:
        echo "����Model����[���� User���������ɵ�ǰ���ݿ��ȫ��Model�� ]:";
        $model = trim(fgets(STDIN,256));
        if(strpos($model,',')) {
            echo "��������Model...\n";
            $models = explode(',',$model);
            foreach ($models as $model){
                buildModel($model);
            }
        }else{
            // ����ָ����Model��
            buildModel($model);
        }
        begin();
        break;
    case 2:
        // ����ָ����Action��
        echo "����Action����[���� User ]:";
        $action = trim(fgets(STDIN,256));
        buildAction($action);
        begin();
        break;
    default:
        begin();
    }
}

function help() {
    echo "
�����ʽ��php Build type <...>
example:
build model <name> ����Model��
build action <name> ����Action��
build help ����
    ";
    exit;
}
?>