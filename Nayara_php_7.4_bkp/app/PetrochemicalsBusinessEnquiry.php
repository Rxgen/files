<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PetrochemicalsBusinessEnquiry extends Model
{
    protected $table = 'petrochemicals_business_enquiries';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'org_name','mobile', 'email','state', 'district','query'
	];
}