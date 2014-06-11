<?php namespace Dmyers\Activity;

// currently unused

interface ActivityInterface {
	
	public function getActivityDisplayNameAttribute();
	
	public function getActivity();
	
	public function trackActivity();
	
	public function removeActivity();
	
}