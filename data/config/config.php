<?php
return array(
//  'APP_GROUP_LIST' => 'oa', //分组
//  'DEFAULT_GROUP' => 'oa', //默认分组
   'DEFAULT_MODULE' => 'index', //默认控制器
//  'TAGLIB_PRE_LOAD' => 'pin', //自动加载标签
   'APP_AUTOLOAD_PATH' => '@.ORG', //自动加载项目类库
    'TMPL_ACTION_SUCCESS' => 'public:success',
   'TMPL_ACTION_ERROR' => 'public:error',
    'DATA_CACHE_SUBDIR'=>true, //缓存文件夹
    'DATA_PATH_LEVEL'=>3, //缓存文件夹层级
    'LOAD_EXT_CONFIG' => 'url,db', //扩展配置
 	'LANG_AUTO_DETECT' => FALSE,	//关闭语言的自动检测，如果你是多语言可以开启
	'LANG_SWITCH_ON' => TRUE,	//开启语言包功能，这个必须开启
	'DEFAULT_LANG' => 'zh-cn',	//默认语言包文件夹名称 /lang/zh-cn/common.php
);