<?php namespace Dmyers\Activity\Adapter;

// currently unused

class Mysql extends Base
{
	public function find($id);
	
	public function query(array $params);
	
	public function create(array $params);
	
	public function update($id, array $params);
	
	public function delete($id);
}