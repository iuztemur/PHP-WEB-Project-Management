<?php 
	$c_str='demo'; 
	//获取要运行的controller 
	$c_name=$c_str.'Controller'; 
	//按照约定url中获取的controller名字不包含Controller，此处补齐。 
	$c_path='controller/'.$c_name.'.php'; 
	//按照约定controller文件要建立在controller文件夹下，类名要与文件名相同，且文件名要全部小写。 
	$method='index'; 
	//获取要运行的action 
	require($c_path); 
	//加载controller文件 
	$controller=new $c_name; 
	//实例化controller文件 
	$controller->$method(); 
	//运行该实例下的action 
	/* End of file index.php */ 
?>