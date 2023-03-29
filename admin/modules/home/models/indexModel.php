<?php

function get_list_users() {

}
function get_user_by_id($id) {

}



function getStatistical($subDay,$now)
{
	return db_fetch_array("SELECT * FROM `tbl_statistical` WHERE order_date BETWEEN '$subDay' AND '$now' ORDER BY order_date ASC");
}
?>