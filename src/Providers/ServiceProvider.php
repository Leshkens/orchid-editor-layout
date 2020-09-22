<?php

declare(strict_types=1);

namespace Leshkens\OrchidEditorJsLayout\Providers;

use Orchid\Platform\Dashboard;
use Illuminate\Support\Facades\View;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * @const string
     */
    const PACKAGE_NAME = 'orchid-editorjs-layout';

    /**
     * @const string
     */
    const PACKAGE_PATH = __DIR__ . '/../../';

    /**
     * @const string
     */
    const CONFIG_PATH = __DIR__ . '/../../config/platform-editorjs.php';

    /**
     * @var Dashboard
     */
    protected $dashboard;

    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;

        $this->loadViewsFrom(self::PACKAGE_PATH . 'resources/views',
            self::PACKAGE_NAME);

        $this->loadTranslationsFrom(self::PACKAGE_PATH . 'resources/lang', self::PACKAGE_NAME);

        $this->registerResources();

        $this->publishes([
            //self::CONFIG_PATH => config_path('platform-editorjs.php'),
            self::PACKAGE_PATH . 'resources/lang' => resource_path('lang/vendor/orchid-editorjs-layout'),
            self::PACKAGE_PATH . 'resources/views' => resource_path('views/vendor/orchid-editorjs-layout')
        ], 'config');
    }

    /**
     *
     */
    public function register()
    {
//        $this->mergeConfigFrom(
//            self::CONFIG_PATH,
//            'platform-editorjs'
//        );
    }

    /**
     * @return $this
     */
    protected function registerResources(): self
    {
        $this->dashboard->addPublicDirectory(self::PACKAGE_NAME,
            self::PACKAGE_PATH . '/public');

        View::composer('platform::app', function () {
            $this->dashboard
                ->registerResource('scripts', orchid_mix('/js/orchid_editorjs_layout.js', self::PACKAGE_NAME))
                ->registerResource('stylesheets', orchid_mix('/css/orchid_editorjs_layout.css', self::PACKAGE_NAME));
        });

        return $this;
    }
}
