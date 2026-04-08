<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class JobOpening extends Model
{
    public function job_locations(){
		return $this->belongsToMany('App\JobLocation','job_location_job_opening');
	}
	public function job_departments(){
		return $this->belongsTo('App\JobDepartment', 'department');
	}
}
