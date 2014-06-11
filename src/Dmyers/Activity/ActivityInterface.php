<?php namespace Dmyers\Activity;

// currently unused

interface ActivityInterface {
	
	public function getActivityDisplayNameAttribute();
	
	public function activity();
	
	public function addActivity();
	
	public function deleteActivity();
	
	public function renderActivityFeed();
	
}