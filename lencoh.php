 	//语言，放到common控制器下面		
		$language = I('param.language')?I('param.language'):'en';
		
		$this->assign('language',$language);
		
		//得到当前的语言显示在语言列表上
		$m_common_conf = M('common_conf');
		$lang_pagemap['fcid'] = 34;
		$lang_pagemap['status'] = 1;
		$lang_pagemap['value'] = $language;
		$translate_page = $m_common_conf->getFieldByValue($lang_pagemap['value'],'name');
		$this->assign('translate_page',$translate_page);
	
		//语言列表的数组
		$lang_map['fcid'] = 34;
		$lang_map['status'] = 1;
		$translate_language = $m_common_conf->where($lang_map)->select();
		$this->assign('translate_language',$translate_language);		
            
            <select  onchange="location.href=this.options[this.selectedIndex].value;">
                <option value="">{$translate_page}</option>
                 <volist name="translate_language" id="translate_language" >
              	  <option value="http://{$translate_language.intro}{$_SERVER['REQUEST_URI']}">{$translate_language.name}</option>
                </volist>
	    </select>  




	


Site/Config 路由
 return array(
            'APP_SUB_DOMAIN_DEPLOY'   =>    1, // 开启子域名配置
            'APP_SUB_DOMAIN_RULES'    =>    array(
                '*'   =>    array('Site','language=*'),// 三级泛域名指向Zhan模块
            ),
            	'DEFAULT_THEME'    =>    'absoluteadmin',
            	'URL_ROUTER_ON'   => true,
            	'URL_ROUTE_RULES'=>array(
            	    //商品详情
            	    'about/:name_seo'   =>  'About',
            	    'product/:p'   =>  'Product?p=:p',
            	    'goods/:name_seo'   =>  'Goods/index/',
            	    //列表
            	    'product/:name_seo'   =>  'Product/clear',
            	    //新闻
            	    'news/:name_seo'   =>  'News/detail',
            	 
            	    'article/:id'	=>	'Index/ArticleInfo',
            	),
            );


转换了之后  router不需要加路由
//域名自动切换代码
	/* 初始化 */
    protected function _initialize(){
	
        $url = $_SERVER ['HTTP_HOST']; //得到当前访问的域名
        $arr = explode('.',$url); //用 . 号截取url分割
        if($arr[0] =='www'){
           $url=str_replace('www','en',$url);
           header('location:http://'. $url); 
        }
        
        if($arr[2] == null){
            $url='en.'.$url;
           header('location:http://'.$url); 
        }
