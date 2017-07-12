<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProductsTable extends Table
{

	public function initialize(array $config)
    {
        $this->hasOne('Categories');
    }

	public function list(){
		$result = $this->find('all', [
			'fields' => [
				'Products.id',
				'Products.name',
				'Products.image',
				'categories.name'
			],
			'join' => [
				'categories' => [
					'table' => 'categories',
					'type' => 'INNER',
					'conditions' => [
						'categories.id = products.category_id'
					]
				]
			]
		])/*->all()*/;
		// echo '<pre>';
		// print_r($result);
		// echo '</pre>';
		return $result;
	}

	public function callSp($sp){
		$result = $this->query('CALL '.$sp);
		echo json_encode($result);
	}
}