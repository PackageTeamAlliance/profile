<?php
namespace Pta\Profile\Providers;

use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
    /**
     * Providers to register
     *
     * @var array
     */
    protected $providers = [];
    
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBindings();
        
        $this->registerConfig();
        
        $this->registerViews();
    
        $this->registerTranslations();
        
        $this->registerMigration();
        
        $this->registerRoutes();

        $this->registerAssets();


        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }
    
    public function registerAssets()
    {
        $this->publishes([
          realpath(__DIR__ . '/../../resources/assets/modules') => public_path('module/assets/'),
        ], 'core-assets');
    }
    
    /**
     * Register Bindings in IoC.
     *
     * @return void
     */
    protected function registerBindings()
    {
    }
    
    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $configPath = realpath(__DIR__ . '/../../config/config.php');
        
        $this->publishes([ $configPath => config_path('profile.php'), 'config']);
        
        $this->mergeConfigFrom($configPath, 'profile');
    }
    
    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $this->loadViewsFrom(realpath(__DIR__ . '/../../resources/views'), 'pta/profile');
        
        $this->publishes([realpath(__DIR__ . '/../../resources/views') => base_path('resources/views/vendor/pta/profile'), ]);
    }
    
    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../../resources/lang'), 'pta/profile');
    }
    
    public function registerMigration()
    {
        $this->publishes([realpath(__DIR__ . '/../../database/migrations') => database_path('/migrations') ], 'migrations');
    }

    
    public function registerRoutes()
    {
        $router = $this->app['router'];
        
        $prefix = config('profile.route_prefix');
        
        $security = $this->app['config']->get('profile.security.protected', true);

        if (!$this->app->routesAreCached()) {
            $group = [];
            
            $group['prefix'] = $prefix;
            
            if ($security) {
                $group['middleware'] = config('profile.security.middleware');
                $group['can'] = config('profile.security.permission_name');
            }
            
            $router->group($group, function () use ($router) {
                
                require realpath(__DIR__ . '/../Http/routes.php');
            });
        }
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
