<?php

class Model_get extends CI_Model{
	function getData($page){	//取得したデータを『$page』に挿入
		$query = $this->db->get_where("pageData", array("page" => $page));	//pageDataのカラム内にあるpageテーブルから情報を取得する
		return $query->result();	//結果を表示する
	}
}
