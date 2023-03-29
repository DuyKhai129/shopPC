<?php

require("../carbon/autoload.php");
    use Carbon\Carbon;
	use Carbon\CarbonInterval;

function construct() {

    load_model('index');
}



function indexAction() {


}


function listAction() {
	$data_tmp = getAllOrder();
	foreach ($data_tmp as $key => $value) {
		$data_tmp[$key]['fullname'] = getNameCus($data_tmp[$key]['custom_id']);
	}
// phan trang
	$page;
	if(!empty($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page =1;
	}
	
	$numProduct = count($data_tmp);
	$productOnPage = 5;
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
	$data = [$res, $num, $page];
	load_view('list',$data);


}

function listNoAction() {

	$data_tmp = getAllOrderNo();
	// echo "<pre>";
	// print_r($data);
	foreach ($data_tmp as $key => $value) {
		$data_tmp[$key]['fullname'] = getNameCus($data_tmp[$key]['custom_id']);
	}
	
// phan trang
	$page;
	if(!empty($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page =1;
	}
	
	$numProduct = count($data_tmp);
	$productOnPage = 5;
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
	$data = [$res, $num, $page];
	load_view('listNo',$data);

}

function detailAction(){

	$id_order = $_GET['id_order'];
	$data = array();
	$check = true;
	$data_order = getAllDetailOrderNo($id_order);// lấy được id order

	foreach ($data_order as $key => $value) {
		
		$id_product = (int)$value['id_product'];
		$data_product = getProductInOrder($id_product);
		$data[$key]['sub_total_price'] = $value['sub_total_price'];
		$data[$key]['qty']  = $value['qty'];
		$data[$key]['code'] = $data_product['code'];
		$data[$key]['image'] = $data_product['image'];
		$data[$key]['name'] = $data_product['name'];
		$data[$key]['price'] = $data_product['price'];
		if($value['qty'] > $data_product['quantity']){
			$data[$key]['mess'] = "Thiếu hàng";
			$check = false;
		}else{
			$data[$key]['mess'] = "Đủ hàng";
		}

	};
	$data[count($data)] = $id_order;
	$data[count($data)] = $check;

	
	load_view('detail',$data);
}



function confirmAction(){

	$id_order = $_GET['id_order'];
	$date = date("d/m/Y",time());
	updateConfirmOrder($id_order,$date);
	// update  lại số lượng hàng trong kho
	$data = getQtyAndIDProductByIdOrder($id_order);
	foreach ($data as $key => $value) {
		$id = $value['id_product'];
		$qty = $value['qty'];
		updateQtyProduct($id,$qty);
	}


	$data_order = getAllDetailOrderNo($id_order);
	$now = Carbon::now("Asia/Ho_Chi_Minh")->toDateString();
	$con=mysqli_connect("localhost","root","","store");
	$sql = "SELECT * FROM `tbl_statistical` WHERE `order_date`='$now'";
	$query = mysqli_query($con,$sql);
	$sub_total_price = 0;
	$qty = 0;
	$order_number = 1;
	foreach ($data_order as $value) {
			$sub_total_price += $value['sub_total_price'];
			$qty += $value['qty'];
	}
	if(mysqli_num_rows($query) == 0){
		$db_statistical = [
			'order_date' => $now,
			'order_number' => $order_number,
			'revenue' => $sub_total_price,
			 'quantity' => $qty,
		];
		insert_statistical($db_statistical);
	} 
	else if(mysqli_num_rows($query) != 0){
		while($row = mysqli_fetch_array($query)){
			$db_statistical = [
				'order_number' => $row['order_number'] + 1,
				'revenue' => $row['revenue'] + $sub_total_price,
				'quantity' => $row['quantity'] + $qty,
			];
			update_statistical_by_day($now,$db_statistical);
		}
	}
		
		
		
		
	

	///////////////////////////////////////
	header('location:?modules=orders&controller=index&action=listNo');
	echo "xac nhan";
}


function cancelAction(){

	$id_order = $_GET['id_order'];
	$date = date("d/m/Y",time());
	updateCancelOrder($id_order,$date);
	header('location:?modules=orders&controller=index&action=listNo');

}






?>