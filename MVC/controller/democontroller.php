<?php 
class DemoController 
{ 
function index() 
{ 
require('model/demomodel.php');
$testModel = new testModel();//选取合适的模型
$msg = $testModel->get();//获取相应的数据
$data['title']=$msg; 
$data['list']=array('A','B','C','D'); 
require('view/demoview.php'); 
} 
} 
/* End of file democontroller.php */ 
?>