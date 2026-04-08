<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class FranchiseState extends Model
{
	public function franchise_districts(){
		return $this->hasMany('App\FranchiseDistrict', 'state');
	}
    
}
