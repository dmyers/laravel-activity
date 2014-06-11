<?php namespace Dmyers\Activity;

// currently unused

class ActivityContainer
{
	protected $id;
	protected $item;
	protected $doer;
	protected $victim;
	protected $action;
	
	public function __construct() {}
	
	public function adapter()
	{
		if (!isset($this->adapter)) {
			$this->adapter = new Adapter\Database();
		}
		
		return $this->adapter;
	}
	
	public function item()
	{
		$this->item = $item;
		return $this;
	}
	
	public function action($action)
	{
		$this->action = $action;
		return $this;
	}
	
	public function doer($doer)
	{
		$this->doer = $doer;
		return $this;
	}
	
	public function victim($victim)
	{
		$this->victim = $victim;
		return $this;
	}
	
	public function find(array $params = array())
	{
		return $this->adapter()->find($params);
	}
	
	public function create()
	{
		$activity_id = $this->adapter()->create(array(
			'doer_id'   => $this->doer->id,
			'item_id'   => $this->item->id,
			'item_type' => get_class($this->item),
		));
		
		$this->setActivityId($activity_id);
		
		return true;
	}
	
	public function update()
	{
		$activity_id = $this->activity_id;
		
		$updated = $this->adapter()->update($activity_id, array(
			'doer_id'   => $this->doer->id,
			'item_id'   => $this->item->id,
			'item_type' => get_class($this->item),
		));
		
		if ($updated) {
			return true;
		}
		
		return false;
	}
	
	public function delete()
	{
		$activity_id = $this->activity_id;
		
		$deleted = $this->adapter()->destroy($activity_id);
		
		if ($deleted) {
			return true;
		}
		
		return false;
	}
	
	public function setActivityId($id)
	{
		$this->id = $id;
	}
}