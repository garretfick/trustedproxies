<?php namespace GarretFick\Trustedproxies\Middleware;

use Closure;
use Config;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Fideloper\Proxy\TrustProxies;
use Garretfick\Trustedproxies\Models\Settings;

/**
 * Class TrustedProxies
 *
 * @package GarretFick\Trustedproxies\Middlware
 */
class TrustedProxy extends TrustProxies
{
    /**
     * Add srcset and sizes attributes to all local
     * images and create the various image sizes.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If we should not be processing this, then just continue. For now
        if ( ! $this->isRelevant($request)) {
            return $response;
        }

        // The default middleware expects configuration in the config. So set them from
        // the configuration
        $this->setSettingsToConfig();

        // Otherwise, forward this to the parent class
        return parent::handle($request, $next);
    }

    protected function setSettingsToConfig()
    {
        $settings = Settings::instance();
        $this->config->set('trustedproxy.proxies', $settings->proxies);

        // Construct the array for the headers property
        $headers = [];
        foreach (Settings::getHeaderKeys() as $key) {
           $headers[$key] = $settings->$key;
        }

        $this->config->set('trustedproxy.headers', $headers);
    }

    /**
     * Checks whether the response should be processed
     * by this middleware.
     *
     * @param $request
     *
     * @return bool
     */
    protected function isRelevant($request)
    {
        // This is relevant for all requests
        return true;
    }
}