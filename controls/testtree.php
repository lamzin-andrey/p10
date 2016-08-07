<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/units/select_tree/php/SelectTree.php';
class CTestTree {
	public $components = [];
	public function __construct() {
		$this->text = 'hello';
		$this->big_categories_list = new SelectTree($this, 'product_categories_test_2', 'get_pct-2');
	}
}

$tt = new CTestTree();
