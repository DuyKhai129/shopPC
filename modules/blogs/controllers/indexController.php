<?php 


function construct() {

	load_model('index');
}

function format_currency($n=0){
	$n=(string)$n;
	$n=strrev($n);
	$res='';
	for($i=0;$i<strlen($n);$i++){
		if($i%3==0 && $i!=0){
			$res.='.';
		
		}
		$res.=$n[$i];
	}
	$res=strrev($res);
	return $res;


}


function textShorten($text, $limit = 400){
    $text = $text. " ";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text."...";
    return $text;
 }



function listAction(){

	$data_tmp = getAll();

	$page;
	if(!empty($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page =1;
	}
	
	$numBlog = count($data_tmp);
	$blogOnPage = 5;
	$num = ceil($numBlog/$blogOnPage);
	if(!empty($_GET['page']) && $_GET['page']>$num){
		$page =$num;
	}
	$start = ($page - 1) * $blogOnPage;
	$res =[];
	for ($i=$start; $i < $start+$blogOnPage; $i++) { 
		if(isset($data_tmp[$i]))
        $res[] = $data_tmp[$i];
	};

	
	$data = [$res, $num, $page];
	load_view('list',$data);;
}






function detailAction(){
	
	$id = $_GET['id'];
	$data = getBlogById($id);
	load_view('detail',$data);;
}




 ?>