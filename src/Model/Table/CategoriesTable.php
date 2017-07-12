<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class CategoriesTable extends Table
{
	public static function getSelect(){
		$categories = TableRegistry::get('Categories')->find()->select(['id', 'name']);
    	$result = [];
    	foreach ($categories as $c) {
    		$result[$c->id] = $c->name;
    	}
    	return $result;
	}
}