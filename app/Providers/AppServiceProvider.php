<?php

namespace App\Providers;

use App\Lib\Util\AesUtil;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->recoverConfig();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function recoverConfig()
    {
        $configKeys = [
            'database.connections.mysql.password',
            'database.redis.default.password',
            'database.redis.cache.password',
        ];
        foreach ($configKeys as $configKey) {
            if (!Config::has($configKey)) {
                continue;
            }
            if (empty(Config::get($configKey))) {
                continue;
            }
            try {
                $val = AesUtil::decrypt(Config::get($configKey));
                if (!empty($val)) {
                    Config::set($configKey, $val);
                }
            } catch (\Exception $e) {

            }
        }
    }
}
