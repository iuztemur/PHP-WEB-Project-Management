<?php 
	$c_str='demo'; 
	//��ȡҪ���е�controller 
	$c_name=$c_str.'Controller'; 
	//����Լ��url�л�ȡ��controller���ֲ�����Controller���˴����롣 
	$c_path='controller/'.$c_name.'.php'; 
	//����Լ��controller�ļ�Ҫ������controller�ļ����£�����Ҫ���ļ�����ͬ�����ļ���Ҫȫ��Сд�� 
	$method='index'; 
	//��ȡҪ���е�action 
	require($c_path); 
	//����controller�ļ� 
	$controller=new $c_name; 
	//ʵ����controller�ļ� 
	$controller->$method(); 
	//���и�ʵ���µ�action 
	/* End of file index.php */ 
?>