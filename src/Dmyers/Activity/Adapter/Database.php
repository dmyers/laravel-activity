<?php namespace Dmyers\Activity\Adapter;

// currently unused

class Database extends Base
{
	public function find(array $params);
	
	public function create(array $params);
	
	public function update($id, array $params);
	
	public function delete($id);
}