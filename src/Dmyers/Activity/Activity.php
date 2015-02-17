<?php namespace Dmyers\Activity;

class Activity extends \Eloquent
{
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'activity';
	protected $guarded = array('id');
	
	public static function boot()
	{
		parent::boot();
		
		// todo fire some events!
		
		/*Activity::creating(function($event) {
			// fire events 
		});*/
	}
	
	public function getDoerAttribute()
	{
		$authModel = Config::get('auth.model');
        	return with(new $authModel)->find($this->doer_id);
	}
	
	public function getVictimAttribute()
	{
		$authModel = Config::get('auth.model');
        	return with(new $authModel)->find($this->victim_id);
	}
	
	public function getItemAttribute()
	{
		if (empty($this->item_type)) {
			return null;
		}
		
		// todo fix this to be right
		$model = '\\'.\Str::upper($this->item_type);
		
		return $model::find($this->item_id);
	}
	
	public function getDateAttribute()
	{
		return $this->created_at;
	}
	
	// todo how to aggregate/combine multiples together
	
	public static function renderFeed($activity, $view = 'laravel-activity::feed')
	{
		return \View::make($view)->with('feed', $activity);
	}
	
	// todo figure out how to push/clone feeds
	
	public function pushFeed()
	{
		
	}
}
