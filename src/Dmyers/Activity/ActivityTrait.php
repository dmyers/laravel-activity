<?php namespace Dmyers\Activity;

trait ActivityTrait
{
	
	public function activity($params = array())
	{
		$activity = Activity::query();
		
		if (is_int($params)) {
			$activity->where('id', $params);
		}
		
		if (isset($params['doer_id'])) {
			$activity->where('doer_id', $params['doer_id']);
		}
		
		if (isset($params['victim_id'])) {
			$activity->where('victim_id', $params['victim_id']);
		}
		
		if (isset($params['item_id'])) {
			$activity->where('item_id', $params['item_id']);
		}
		
		if (isset($params['item_type'])) {
			$activity->where('item_type', $params['item_type']);
		}
		
		if (isset($params['feed_type'])) {
			$activity->where('feed_type', $params['feed_type']);
		}
		
		return $activity->get();
	}
	
	public static function activityItemType()
	{
		return \Str::lower(get_called_class());
	}
	
	// todo figure out caching
	
	public static function renderActivityFeed($type = null, $doer_id = null, $victim_id = null)
	{
		$instance = new static();
		
		if (isset($instance->activity_feed_type)) {
			$type = $instance->activity_feed_type;
		}
		
		$activity = Activity::query()
			->where('feed_type', $type);
			
		//if (!empty($type)) {}
		
		/*$activity->where(function ($query) use ($doer_id) {
				$query->where('doer_id', $doer_id)
					  ->orWhere('victim_id', $doer_id);
			});
		 */
		
		if (!empty($doer_id)) {
			$activity->where('doer_id', $doer_id);
		}
		
		if (!empty($victim_id)) {
			$activity->where('victim_id', $victim_id);
		}
		
		$feed = $activity->get();
		
		return Activity::renderActivityFeed($feed);
	}
	
	public function addActivity($action, $doer_id = null, $victim_id = null, $feed_type = null)
	{
		if (empty($doer_id)) {
			if (!empty($this->activity_item_id)) {
				$doer_id = $this->{$this->activity_doer_id};
			}
			else {
				// todo track global user from Auth::user() or config or class object
				//Activity::user();
			}
		}
		
		$activity = array(
			'doer_id'   => $doer_id,
			'victim_id' => $victim_id,
			'action'    => $action,
			'item_id'   => $this->{$this->activity_item_id},
			'item_type' => static::activityItemType(),
			'feed_type' => isset($this->activity_feed_type) ? $this->activity_feed_type : $feed_type,
		);
		
		return Activity::create($activity);
	}
	
	public function updateActivity($id, $action = null, $doer_id = null, $victim_id = null, $feed_type = null)
	{
		$activity = Activity::find($id);
		
		if (!empty($action)) {
			$activity->action = $action;
		}
		
		if (!empty($doer_id)) {
			$activity->doer_id = $doer_id;
		}
		
		if (!empty($victim_id)) {
			$activity->victim_id = $victim_id;
		}
		
		if (!empty($feed_type)) {
			$activity->feed_type = $feed_type;
		}
		
		return $activity->save();
	}
	
	public function deleteActivity($id)
	{
		return Activity::destroy($id);
	}
	
	// todo create way to push feed activity into another feed
	
	public function pushActivityFeed($type, $doer_id, $victim_id)
	{
		return Activity::pushFeed();
	}
	
}