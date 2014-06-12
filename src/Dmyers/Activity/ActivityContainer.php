<?php namespace Dmyers\Activity;

// currently unused

class ActivityContainer
{
	protected $id;
	protected $item;
	protected $item_type;
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
	
	public function item($item)
	{
		$this->item = $item;
		$this->item_type = get_class($item);
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
		if (isset($this->doer)) {
			$params['doer_id'] = $this->doer->id;
		}
		
		if (isset($this->victim)) {
			$params['victim_id'] = $this->victim->id;
		}
		
		if (isset($this->item)) {
			$params['item_id'] = $this->item->id;
		}
		
		if (isset($this->item_type)) {
			$params['item_type'] = $this->item_type;
		}
		
		if (isset($this->action)) {
			$params['action'] = $this->item->action;
		}
		
		if (!isset($params['limit'])) {
			$params['limit'] = 10;
		}
		
		if (!isset($params['offset'])) {
			$params['offset'] = 0;
		}
		
		return $this->adapter()->find($params);
	}
	
	public function create(array $params = array())
	{
		if (isset($this->doer)) {
			$params['doer_id'] = $this->doer->id;
		}
		
		if (isset($this->victim)) {
			$params['victim_id'] = $this->victim->id;
		}
		
		if (isset($this->item)) {
			$params['item_id'] = $this->item->id;
		}
		
		if (isset($this->item_type)) {
			$params['item_type'] = $this->item_type;
		}
		
		if (isset($this->action)) {
			$params['action'] = $this->item->action;
		}
		
		$activity_id = $this->adapter()->create($params);
		
		$this->setActivityId($activity_id);
		
		return true;
	}
	
	public function update(array $params = array())
	{
		$activity_id = $this->activity_id;
		
		if (isset($this->doer)) {
			$params['doer_id'] = $this->doer->id;
		}
		
		if (isset($this->victim)) {
			$params['victim_id'] = $this->victim->id;
		}
		
		if (isset($this->item)) {
			$params['item_id'] = $this->item->id;
		}
		
		if (isset($this->item_type)) {
			$params['item_type'] = $this->item_type;
		}
		
		if (isset($this->action)) {
			$params['action'] = $this->item->action;
		}
		
		$updated = $this->adapter()->update($activity_id, $params);
		
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
	
	public function renderFeed($activity, $view = 'laravel-activity::feed')
	{
		return \View::make($view)->with('feed', $activity);
	}
	
	public function setActivityId($id)
	{
		$this->id = $id;
	}
}