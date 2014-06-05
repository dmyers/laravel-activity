<?php namespace Dmyers\Activity;

use Illuminate\Support\ServiceProvider;

class ActivityServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('dmyers/laravel-activity');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//$this->registerCommands();
	}
	
	/**
	 * Register the artisan commands
	 *
	 * @return void
	 */
	public function registerCommands()
	{
		$this->app['activity.table'] = $this->app->share(function($app)
		{
			return new ActivityTableCommand;
		});

		$this->commands('activity.table');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
