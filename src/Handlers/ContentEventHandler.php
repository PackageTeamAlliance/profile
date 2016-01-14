<?php

namespace Pta\Profile\Handlers;

use Pta\Profile\Models\Profile;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Pta\Profile\Repositories\ProfileRepositoryInterface;

class ContentEventHandler
{
    /**
     * The container instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $app;

    /**
     * Dynamically retrieve objects from the container.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->app[$key];
    }
    /**
     * Constructor.
     *
     * @param  \Illuminate\Container\Container  $app
     * @return void
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }
    
    /**
     * {@inheritDoc}
     */
    public function subscribe(Dispatcher $dispatcher)
    {
        // $dispatcher->listen('pta.content.creating', __CLASS__ . '@creating');
        // $dispatcher->listen('pta.content.created', __CLASS__ . '@created');
        // $dispatcher->listen('pta.content.updating', __CLASS__ . '@updating');
        // $dispatcher->listen('pta.content.updated', __CLASS__ . '@updated');
        // $dispatcher->listen('pta.content.deleted', __CLASS__ . '@deleted');
        // $dispatcher->listen('pta.translation.created', __CLASS__ . '@translation_created');
        // $dispatcher->listen('pta.translation.updated', __CLASS__ . '@translation_updated');
    }
    
    /**
     * {@inheritDoc}
     */
    public function creating(array $data)
    {
    }
    
    /**
     * {@inheritDoc}
     */
    public function created(Content $content)
    {
        $this->flushCache($content);
    }
    
    /**
     * {@inheritDoc}
     */
    public function updating(Content $content, array $data)
    {
    }
    
    /**
     * {@inheritDoc}
     */
    public function updated(Content $content)
    {
        $this->flushCache($content);
    }
    
    /**
     * {@inheritDoc}
     */
    public function deleted(Content $content)
    {
        $this->flushCache($content);
    }
    

    /**
     * Flush the cache.
     *
     * @param  \Ninjaparade\Content\Models\Content  $content
     * @return void
     */
    protected function flushCache(Profile $content)
    {
        // $this->app['cache']->forget('pta.content.all');
        // $this->app['cache']->forget('pta.content.id.' . $content->id);
        // $this->app['cache']->forget('pta.content.slug.' . $content->slug);

        // foreach (config('languages.locale', ['en']) as $lang) {
        //     $this->app['cache']->forget("pta.content.slug.{$content->slug}.{$lang['short_name']}");
        // }

        // for ($i=0; $i < 1000; $i++) {
        //     $this->app['cache']->forget('pta.content.paginate.{$i}');
        // }
    }
}
