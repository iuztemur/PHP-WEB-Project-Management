<html> 
<head> 
<title>Demo</title> 
</head> 
<body> 
<h1><?php echo $data['title'];?></h1> 
<?php 
foreach ($data['list'] as $item) 
{ 
echo $item.'<br>'; 
} 
?> 
</body> 
</html> 