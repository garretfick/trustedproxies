<?php namespace Garretfick\Trustedproxies;

use System\Classes\PluginBase;

/**
 * trustedproxy Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'october-trustedproxies',
            'description' => 'Use fideloper/TrustedProxy with OctoberCMS',
            'author'      => 'Garret Fick',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot()
    {
        // This needs to act as middlware because we need to trust the
        // items before doing much processing for the request
        $this->app['Illuminate\Contracts\Http\Kernel']
            ->pushMiddleware('Garretfick\Trustedproxies\Middleware\TrustedProxy');
    }

    /**
     * Registers the permissions to edit the trusted proxy settings.
     * We use a custom permission here because only administators
     * should need to set this information.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'garretfick.trustedproxies.settings_write' => [
                'tab' => 'Trusted Proxies',
                'label' => 'Manage Trusted Proxies'
            ],
        ];
    }

    /**
     * Registers the settings so that we can show a page where
     * the user will exit the proxy settings.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Trusted Proxies',
                'description' => 'Manage Trusted Proxies.',
                'icon'        => 'icon-globe',
                'class'       => 'Garretfick\Trustedproxies\Models\Settings',
                'order'       => 100,
                'category'    => 'System',
                'keywords'    => 'trust proxy proxies load balancer',
                'permissions' => ['garretfick.trustedproxies.settings_write']
            ]
        ];
    }
}
