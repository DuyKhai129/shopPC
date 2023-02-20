<?php

function construct()
{

	load_model('index');

}

function indexAction()
{

}

function addAction()
{

	$user;
	$type;
	$err = array();
	if (!empty($_POST['btn_submit'])) {

		if (!empty($_POST['user'])) {
			$user = $_POST['user'];
		} else {
			$err['user'] = $_POST['user'];
		}

		if (!empty($_POST['type'])) {
			$type = $_POST['type'];
		} else {
			$err['type'] = $_POST['type'];
		}

		// xử lý ảnh
		$permitted  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "public/uploads/".$unique_image;

			if(!empty($file_name)){
				//Nếu người dùng chọn ảnh
				if ($file_size > 204800000) {

				 $alert = "<span class='success'>Kích thước hình ảnh phải nhỏ hơn 100MB!</span>";
				return $alert;
				} 
				elseif (in_array($file_ext, $permitted) === false) 
				{
				$alert = "<span class='success'>You can upload only:-".implode(', ', $permitted)."</span>";
				return $alert;
				}
				if (empty($err)) {
					move_uploaded_file($file_temp,$uploaded_image);
					$res = [
		
						'image' => $unique_image,
						'user ' => $user,
						'type ' => $type
		
					];
					if (insert_slider($res)) {
		
						echo " <script type='text/javascript'> alert('Thêm mới slider thành công👌👌👌');</script>";
					} else {
		
						echo " <script type='text/javascript'> alert('Thêm mới slider thất bại😭😭😭');</script>";
					}
		
				} else {
		
					echo " <script type='text/javascript'> alert('Thêm mới slider bị thất bại😔😔😔');</script>";
				}
			}
	}


	load_view('add');
}

function deleteAction()
{

	$id = $_GET['id'];
	delete_slider_by_id($id);
	header('location:?modules=sliders&controllers=index&action=list');

}

function listAction()
{
	$data_tmp = getAllSlider();

	$page;
	if (!empty($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}

	$numProduct = count($data_tmp);
	$productOnPage = 5;
	$num = ceil($numProduct / $productOnPage);
	if (!empty($_GET['page']) && $_GET['page'] > $num) {
		$page = $num;
	}
	$start = ($page - 1) * $productOnPage;
	$res = [];
	for ($i = $start; $i < $start + $productOnPage; $i++) {
		if (isset($data_tmp[$i]))
			$res[] = $data_tmp[$i];
	}
	;

	$data = [$res, $num, $page];
	load_view('list', $data);
}

function editAction()
{
	$id = $_GET['id'];
	$data = get_slider_by_id($id);
	load_view('show', $data);

}

function updateAction()
{
	$id = $_GET['id'];
	$unique_image;
	$data = get_slider_by_id($id);
	$data1 = array();
	if (!empty($_POST['btn_submit'])) {
		if (empty($_POST['user'])) {
			$data1['user'] = $data[0]['user'];
		} else {
			$data1['user'] = $_POST['user'];
		}
		if (empty($_POST['type'])) {
			$data1['type'] = $data[0]['type'];
		} else {
			$data1['type'] = $_POST['type'];
		}
		// xử lý ảnh
		$permitted  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "public/uploads/".$unique_image;

		
		
		if (!empty($file_name)) {
			//Nếu người dùng chọn ảnh
			if ($file_size > 204800000) {

				$alert = "<span class='success'>Kích thước hình ảnh phải nhỏ hơn 100MB!</span>";
			   return $alert;
			   } 
			   elseif (in_array($file_ext, $permitted) === false) 
			   {
			   $alert = "<span class='success'>You can upload only:-".implode(', ', $permitted)."</span>";
			   return $alert;
			   }
			move_uploaded_file($file_temp,$uploaded_image);
			$data1['image'] = $unique_image;
		} else {
			$data1['image'] = $data[0]['image'];
		}
	}

	///////////////////////////////////////
	if (update_slider_by_id($id, $data1)) {
		$res = get_slider_by_id($id);
		load_view('show', $res);
		echo " <script type='text/javascript'> alert('Cập nhật slider thành công👌👌👌');</script>";
	} else {
		load_view('show', $data);
		echo " <script type='text/javascript'> alert('Cập nhật slider thất bại😭😭😭');</script>";
	}


}