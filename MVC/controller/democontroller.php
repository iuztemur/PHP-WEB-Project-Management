<?php 
class DemoController 
{ 
function index() 
{ 
require('model/demomodel.php');
$testModel = new testModel();//ѡȡ���ʵ�ģ��
$msg = $testModel->get();//��ȡ��Ӧ������
$data['title']=$msg; 
$data['list']=array('A','B','C','D'); 
require('view/demoview.php'); 
} 
} 
/* End of file democontroller.php */ 
?>