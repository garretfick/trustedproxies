<?php namespace Garretfick\Trustedproxies\Models;

use Model;
use Log;

class Settings extends Model {
    const KEY_TRUSTED_PROXIES = 'proxies';
    const KEY_FORWARDED = 'forwarded';
    const KEY_CLIENT_IP = 'client_ip';
    const KEY_CLIENT_HOST = 'client_host';
    const KEY_CLIENT_PROTO = 'client_proto';
    const KEY_CLIENT_PORT = 'client_port';

    public $implement = ['System.Behaviors.SettingsModel'];
    
    public $settingsCode = 'garretfick_trusted_proxies';

    public $settingsFields = 'fields.yaml';

    /**
     * Get all setting values related to headers that can be trusted
     * @return string[]
     */
    public static function getHeaderKeys()
    {
        return [
            self::KEY_FORWARDED,
            self::KEY_CLIENT_IP,
            self::KEY_CLIENT_HOST,
            self::KEY_CLIENT_PROTO,
            self::KEY_CLIENT_PORT
        ];
    }
}