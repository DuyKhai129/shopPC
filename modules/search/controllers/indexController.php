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

function searchAction(){
	$key_word = null;
	if(!empty($_POST['btn_submit']))
		{$key_word = $_POST['key_word'];}
	if(!empty($_GET['key_word']))
		{$key_word = $_GET['key_word'];}
	
	$data_tmp = searchProduct($key_word);

	// phân trang
	$page;
	if(!empty($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page =1;
	}
	$numProduct = count($data_tmp);
	$productOnPage = 8;
	$num = ceil($numProduct/$productOnPage);
	if(!empty($_GET['page']) && $_GET['page']>$num){
		$page =$num;
	}
	$start = ($page - 1) * $productOnPage;
	$res =[];
	for ($i=$start; $i < $start+$productOnPage; $i++) { 
		if(isset($data_tmp[$i]))
        $res[] = $data_tmp[$i];
	};
	$data = [$res,$num,$page,$key_word,$data_tmp];
	load_view('index',$data);
}




function filterAction(){
	$r_price = null;
	$r_brand = null;
	$r_category = null;

	if(!empty($_POST['r-price'])){
		$r_price = $_POST['r-price'];
	}

	if(!empty($_POST['r-brand'])){
		$r_brand = $_POST['r-brand'];
	}

	if(!empty($_POST['r-category'])){
		$r_category = $_POST['r-category'];
	}

	$input = ['r_price' => $r_price, 'r_brand' => $r_brand, 'r_category'=> $r_category];

	// phân trang
	$data = getProductFilter($input);
	// $page;
	// if(!empty($_GET['page'])){
	// 	$page = $_GET['page'];
	// }else{
	// 	$page =1;
	// }
	// $numProduct = count($data_tmp);
	// $productOnPage = 5;
	// $num = ceil($numProduct/$productOnPage);
	// if(!empty($_GET['page']) && $_GET['page']>$num){
	// 	$page =$num;
	// }
	// $start = ($page - 1) * $productOnPage;
	// $res =[];
	// for ($i=$start; $i < $start+$productOnPage; $i++) { 
	// 	if(isset($data_tmp[$i]))
 //        $res[] = $data_tmp[$i];
	// };

	// $data = [$res,$num,$page,$key_word,$data_tmp];



	//echo count($data);
	load_view('filter',$data);
	// print_r($data);
	// echo "<pre>";
}





//btn_filter
 ?>