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
	$name;
	$code;
	$image;
	$description;
	$user;
	$err = array();
	if (!empty($_POST['btn_submit'])) {
		if (!empty($_POST['name'])) {
			$name = $_POST['name'];
		} else {
			$err['name'] = "name không được rỗng";
		}

		if (!empty($_POST['user'])) {
			$user = $_POST['user'];
		} else {
			$err['user'] = "user không được rỗng";
		}

		if (!empty($_POST['code'])) {
			$code = $_POST['code'];
		} else {
			$err['code'] = "code không được rỗng";
		}

		if (!empty($_POST['description'])) {
			$description = $_POST['description'];
		} else {
			$err['description'] = "description không được rỗng";
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
					$data = [
						'name' => $name,
						'code' => $code,
						'image' => $unique_image,
						'description' => $description,
						'user' => $user
					];
					if (insert_brand($data)) {
		
						echo " <script type='text/javascript'> alert('Thêm mới thương hiệu thành công👌👌👌');</script>";
					} else {
		
						echo " <script type='text/javascript'> alert('Thêm mới thương hiệu thất bại😭😭😭');</script>";
					}
		
				} else {
		
					echo " <script type='text/javascript'> alert('Thêm mới thương hiệu thất bại😔😔😔');</script>";
				}
			}

	}
	load_view('add');


}

function listAction()
{

	$data_tmp = getAll();
	// phaan trang
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

function deleteAction()
{

	$id = $_GET['id'];
	delete_brand_by_id($id);
	header('location:?modules=brands&controllers=index&action=list');
}



function editAction()
{

	$id = $_GET['id'];
	$data = get_brand_by_id($id);
	load_view('show', $data);

}

function updateAction()
{
	$id = $_GET['id'];
	$image;
	$data = get_brand_by_id($id);
	$data1 = array();
	if (!empty($_POST['btn_submit'])) {

		if (empty($_POST['name'])) {
			$data1['name'] = $data[0]['name'];
		} else {
			$data1['name'] = $_POST['name'];
		}

		if (empty($_POST['code'])) {
			$data1['code'] = $data[0]['code'];
		} else {
			$data1['code'] = $_POST['code'];
		}

		if (empty($_POST['user'])) {
			$data1['user'] = $data[0]['user'];
		} else {
			$data1['user'] = $_POST['user'];
		}

		if (empty($_POST['description'])) {
			$data1['description'] = $data[0]['description'];
		} else {
			$data1['description'] = $_POST['description'];
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
	if (update_brand_by_id($id, $data1)) {
		$res = get_brand_by_id($id);
		load_view('show', $res);
		echo " <script type='text/javascript'> alert('Cập nhật thương hiệu thành công👌👌👌');</script>";
	} else {
		load_view('show', $data);
		echo " <script type='text/javascript'> alert('Cập nhật thương hiệu thất bại😭😭😭');</script>";
	}


}