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

/**
 +------------------------------------------------------------------------------
 * Firebird数据库驱动类 剑雷 2007.12.28
 +------------------------------------------------------------------------------
 * @category   Think
 * @package  Think
 * @subpackage  Db
 * @author    liu21st <liu21st@gmail.com>
 * @version   $Id$
 +------------------------------------------------------------------------------
 */
Class DbIbase extends Db{

    /**
     +----------------------------------------------------------
     * 架构函数 读取数据库配置信息
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $config 数据库配置数组
     +----------------------------------------------------------
     */
    public function __construct($config=''){
        if ( !extension_loaded('interbase') ) {
            throw_exception(L('_NOT_SUPPERT_').':Interbase or Firebird');
        }
        if(!empty($config)) {
            $this->config   =   $config;
        }
        //读取数据结果集类型
        $this->resultType=C('DATA_RESULT_TYPE');
    }

    /**
     +----------------------------------------------------------
     * 连接数据库方法
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function connect($config='',$linkNum=0) {
        if ( !isset($this->linkID[$linkNum]) ) {
            if(empty($config))  $config =   $this->config;
            $conn = $this->pconnect ? 'ibase_pconnect':'ibase_connect';
            // 处理不带端口号的socket连接情况
            $host = $config['hostname'].($config['hostport']?"/{$config['hostport']}":'');
            $this->linkID[$linkNum] = $conn($host.':'.$config['database'], $config['username'], $config['password'],C('DB_CHARSET'),0,3);
            if ( !$this->linkID[$linkNum]) {
                throw_exception(ibase_errmsg());
            }
            //剑雷 2007.12.28
           if ( ($svc = ibase_service_attach($config['hostname'], $config['username'], $config['password'])) != FALSE)
            {
                $ibase_info = ibase_server_info ($svc, IBASE_SVC_SERVER_VERSION) . '/' . ibase_server_info($svc, IBASE_SVC_IMPLEMENTATION);
                ibase_service_detach ($svc);
            }
            else
            {
                $ibase_info = 'Unable to Determine';
            }
            $this->dbVersion = $ibase_info;

            // 标记连接成功
            $this->connected    =   true;
            // 注销数据库连接配置信息
            if(1 != C('DB_DEPLOY_TYPE')) unset($this->config);
        }
        return $this->linkID[$linkNum];
    }

    /**
     +----------------------------------------------------------
     * 释放查询结果
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function free() {
        @ibase_free_result($this->queryID);
        $this->queryID = 0;
    }

    /**
     +----------------------------------------------------------
     * 执行查询 主要针对 SELECT, SHOW 等指令
     * 返回数据集
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param string $str  sql指令
     +----------------------------------------------------------
     * @return resultSet
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    protected function _query($str='') {
        $this->initConnect(false);
        if ( !$this->_linkID ) return false;
        if ( $str != '' ) $this->queryStr = $str;
        if (!$this->autoCommit && $this->isMainIps($this->queryStr)) {
            $this->startTrans();
        }else {
            //释放前次的查询结果
            if ( $this->queryID ) {    $this->free();    }
        }
        $this->Q(1);
        $this->queryID = ibase_query($this->_linkID, $this->queryStr);
        $this->debug();
        if ( !$this->queryID ) {
            if ( $this->debug || C('DEBUG_MODE'))
                throw_exception($this->error());
            else
                return false;
        } else {
            //$this->numCols = ibase_num_fields($this->queryID);
            $this->resultSet = $this->getAll();
            $this->numRows  =   count($this->resultSet);
            return $this->resultSet;
        }
    }

    /**
     +----------------------------------------------------------
     * 执行语句 针对 INSERT, UPDATE 以及DELETE
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param string $str  sql指令
     +----------------------------------------------------------
     * @return integer
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    protected function _execute($str='') {
        $this->initConnect(true);
        if ( !$this->_linkID ) return false;
        if ( $str != '' ) $this->queryStr = $str;
        if (!$this->autoCommit && $this->isMainIps($this->queryStr)) {
            $this->startTrans();
        }else {
            //释放前次的查询结果
            if ( $this->queryID ) {    $this->free();    }
        }
        $this->W(1);
        $result =   ibase_query($this->_linkID, $this->queryStr) ;
        $this->debug();
        if ( false === $result) {
            if ( $this->debug || C('DEBUG_MODE'))
                throw_exception($this->error());
            else
                return false;
        } else {
            $this->numRows = ibase_affected_rows($this->_linkID);
            //剑雷 2007.12.28
            //$this->lastInsID = mysql_insert_id($this->_linkID);
            $this->lastInsID =0;

            return $this->numRows;
        }
    }

    public function startTrans() {
        $this->initConnect(true);
        if ( !$this->_linkID ) return false;
        //数据rollback 支持
        if ($this->transTimes == 0) {
            ibase_trans( IBASE_DEFAULT, $this->_linkID);
        }
        $this->transTimes++;
        return ;
    }

    /**
     +----------------------------------------------------------
     * 用于非自动提交状态下面的查询提交
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function commit()
    {
        if ($this->transTimes > 0) {
            $result =  ibase_commit($this->_linkID);
            $this->transTimes = 0;
            if(!$result){
                throw_exception($this->error());
                return false;
            }
        }
        return true;
    }

    /**
     +----------------------------------------------------------
     * 事务回滚
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function rollback()
    {
        if ($this->transTimes > 0) {
            $result =ibase_rollback($this->_linkID);
            $this->transTimes = 0;
            if(!$result){
                throw_exception($this->error());
                return false;
            }
        }
        return true;
    }

    /**
     +----------------------------------------------------------
     * 获得下一条查询结果 简易数据集获取方法
     * 查询结果放到 result 数组中
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function next() {
        if ( !$this->queryID ) {
            throw_exception($this->error());
            return false;
        }
        if($this->resultType== DATA_TYPE_OBJ){
            // 返回对象集
            $this->result = @ibase_fetch_object($this->queryID);
            $stat = is_object($this->result);
        }else{
            // 返回数组集
            $this->result = @ibase_fetch_assoc($this->queryID);
            $stat = is_array($this->result);
        }
        return $stat;
    }

    /**
     +----------------------------------------------------------
     * BLOB字段解密函数 Firebird特有
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param $blob 待解密的BLOB
     +----------------------------------------------------------
     * @return 二进制数据
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
     public function BlobDecode($blob)
    {
        $maxblobsize = 262144;
        if  (PHP_VERSION >= 5) {
            $blob_data = ibase_blob_info($this->_linkID, $blob );
            $blobid = ibase_blob_open($this->_linkID, $blob );
        } else {

            $blob_data = ibase_blob_info( $blob );
            $blobid = ibase_blob_open( $blob );
        }

        if( $blob_data[0] > $maxblobsize ) {

            $realblob = ibase_blob_get($blobid, $maxblobsize);

            while($string = ibase_blob_get($blobid, 8192)){
                $realblob .= $string;
            }
        } else {
            $realblob = ibase_blob_get($blobid, $blob_data[0]);
        }

        ibase_blob_close( $blobid );
        return( $realblob );
    }

    /**
     +----------------------------------------------------------
     * 获得一条查询结果
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param integer $seek 指针位置
     * @param string $str  SQL指令
     +----------------------------------------------------------
     * @return array
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function getRow($sql = null,$seek=0) {
        //if (!empty($sql)) $this->_query($sql);
        //剑雷 2007.12.30
        if (!empty($sql)) {
          $this->initConnect(false);
          if ( !$this->_linkID ) return false;

          if ( $this->queryID ) {    $this->free();    }
          $this->queryStr = $sql;
          $this->Q(1);
          $this->queryID = ibase_query($this->_linkID, $this->queryStr);
          $this->debug();
        }

        if ( !$this->queryID ) {
            throw_exception($this->error());
            return false;
        }

            //剑雷 2007.12.30
            //由于前面调用了$this->query使$this->queryID记录指针已经到了最末尾,只能重新查询一次
            $this->queryID=ibase_query($this->_linkID, $sql);

            if($this->resultType== DATA_TYPE_OBJ){
              //返回对象集
              while ($seek>=0)
              {
                $result = ibase_fetch_object($this->queryID);
                if (!$result){ $seek=-1;} else { $seek--;}
              }
             }else{
              // 返回数组集
              while ($seek>=0)
              {
               $result = ibase_fetch_assoc($this->queryID);
                if (!$result){ $seek=-1;} else { $seek--;}
              }
            }
        //剑雷 2007.12.30 自动解密BLOB字段
        //取BLOB字段清单
            $bloblist = array();
            $fieldCount = ibase_num_fields($this->queryID);
            for ($i = 0; $i < $fieldCount; $i++) {
             $col_info = ibase_field_info($this->queryID, $i);
             if ($col_info['type']=='BLOB') {
               $bloblist[]=trim($col_info['name']);
             }
            }

       //如果有BLOB字段,就进行解密处理
           if (!empty($bloblist)) {
               foreach($bloblist as $field) {
                 if ($this->resultType== DATA_TYPE_OBJ) {
                   if (!empty($result->$field)) $result->$field=$this->BlobDecode($result->$field);
                 }else{
                   if (!empty($result[$field])) $result[$field]=$this->BlobDecode($result[$field]);
                 }
               }
           }

          return $result;
    }

    /**
     +----------------------------------------------------------
     * 获得所有的查询数据
     * 查询结果放到 resultSet 数组中
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $resultType  数据集类型
     +----------------------------------------------------------
     * @return array
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function getAll($sql = null,$resultType=null) {
        //if (!empty($sql)) $this->_query($sql);
        //剑雷 2007.12.30 由于没有类似mysql_data_seek($this->queryID,0)的方法,只有更改写法,不调用_query方法,以免影响记录集指针

        if (!empty($sql)) {
          $this->initConnect(false);
          if ( !$this->_linkID ) return false;

          if ( $this->queryID ) {    $this->free();    }
          $this->queryStr = $sql;
          $this->Q(1);
          $this->queryID = ibase_query($this->_linkID, $this->queryStr);
          $this->debug();
        }

        if ( !$this->queryID ) {
            throw_exception($this->error());
            return false;
        }
        //返回数据集
        $result = array();
        if(is_null($resultType)){ $resultType   =  $this->resultType ; }
        $fun = ($resultType== DATA_TYPE_OBJ) ?  'ibase_fetch_object' : 'ibase_fetch_assoc';
        while ( $row = $fun($this->queryID)) {
            $result[]   =   $row;
        }

        //剑雷 2007.12.30 自动解密BLOB字段
        //取BLOB字段清单
        $bloblist = array();
        $fieldCount = ibase_num_fields($this->queryID);
        for ($i = 0; $i < $fieldCount; $i++) {
         $col_info = ibase_field_info($this->queryID, $i);
         if ($col_info['type']=='BLOB') {
           $bloblist[]=trim($col_info['name']);
         }
        }
       //如果有BLOB字段,就进行解密处理
       if (!empty($bloblist)) {
         $i=0;
         foreach ($result as $row) {
           foreach($bloblist as $field) {
             if ($resultType== DATA_TYPE_OBJ) {
               if (!empty($row->$field)) $row->$field=$this->BlobDecode($row->$field);
             }else{
               if (!empty($row[$field])) $result[$i][$field]=$this->BlobDecode($row[$field]);
             }
          }
          $i++;
        }
      }
     return $result;
    }

    /**
     +----------------------------------------------------------
     * 取得数据表的字段信息
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function getFields($tableName) {
        $result   =  $this->_query('SELECT RDB$FIELD_NAME AS FIELD, RDB$DEFAULT_VALUE AS DEFAULT1, RDB$NULL_FLAG AS NULL1 FROM RDB$RELATION_FIELDS WHERE RDB$RELATION_NAME=UPPER(\''.$tableName.'\') ORDER By RDB$FIELD_POSITION');
        $info   =   array();
        foreach ($result as $key => $val) {
            if(is_object($val)) {
                $val    =   get_object_vars($val);
            }
            $info[trim($val['FIELD'])] = array(
                'name'    => trim($val['FIELD']),
                'type'    => '',
                'notnull' => (bool) ($val['NULL1'] ==1), // 1表示不为Null
                'default' => $val['DEFAULT1'],
                'primary' => false,
                'autoInc' => false,
            );
       }
      //剑雷 取表字段类型
     $sql='select first 1 * from '. $tableName;
     $rs_temp = ibase_query ($this->_linkID, $sql);
     $fieldCount = ibase_num_fields($rs_temp);

     for ($i = 0; $i < $fieldCount; $i++)
     {
       $col_info = ibase_field_info($rs_temp, $i);
       $info[trim($col_info['name'])]['type']=$col_info['type'];
     }
     ibase_free_result ($rs_temp);

     //剑雷 取表的主键
     $sql='select b.rdb$field_name as FIELD_NAME from rdb$relation_constraints a join rdb$index_segments b
on a.rdb$index_name=b.rdb$index_name
where a.rdb$constraint_type=\'PRIMARY KEY\' and a.rdb$relation_name=UPPER(\''.$tableName.'\')';
     $rs_temp = ibase_query ($this->_linkID, $sql);
     while ($row=ibase_fetch_object($rs_temp)) {
      $info[trim($row->FIELD_NAME)]['primary']=True;
     }
     ibase_free_result ($rs_temp);

     return $info;
    }

    /**
     +----------------------------------------------------------
     * 取得数据库的表信息
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function getTables($dbName='') {
        $sql='SELECT DISTINCT RDB$RELATION_NAME FROM RDB$RELATION_FIELDS WHERE RDB$SYSTEM_FLAG=0';
        $result   =  $this->_query($sql);
        $info   =   array();
        foreach ($result as $key => $val) {
            $info[$key] = trim(current($val));
        }
        return $info;
    }

    /**
     +----------------------------------------------------------
     * 关闭数据库
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function close() {
        if (!empty($this->queryID))
            ibase_free_result($this->queryID);
        if (!ibase_close($this->_linkID)){
            throw_exception($this->error());
        }
        $this->_linkID = 0;
    }

    /**
     +----------------------------------------------------------
     * 数据库错误信息
     * 并显示当前的SQL语句
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function error() {
        $this->error = ibase_errmsg();
        if($this->queryStr!=''){
            $this->error .= "\n [ SQL语句 ] : ".$this->queryStr;
        }
        return $this->error;
    }

    /**
     +----------------------------------------------------------
     * SQL指令安全过滤
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $str  SQL字符串
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function escape_string($str) {
        return addslashes($str);
    }

}//类定义结束
?>