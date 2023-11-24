<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->bootShop();
    }

    public function bootShop() {
        $settings = config('settings');
        config(['mail.mailers.smtp.transport' => empty($settings['mail_mailer']) ? env('MAIL_MAILER', '') : $settings['mail_mailer']]);
        config(['mail.mailers.smtp.host' => empty($settings['host_smtp']) ? env('MAIL_HOST', '') : $settings['host_smtp']]);
        config(['mail.mailers.smtp.port' => empty($settings['port_smtp']) ? env('MAIL_PORT', '') : $settings['port_smtp']]);
        config(['mail.mailers.smtp.encryption' => empty($settings['encryption_smtp']) ? env('MAIL_ENCRYPTION', '') : $settings['encryption_smtp']]);
        config(['mail.mailers.smtp.username' => empty($settings['user_smtp']) ? env('MAIL_USERNAME', '') : $settings['user_smtp']]);
        config(['mail.mailers.smtp.password' => empty($settings['password_smtp']) ? env('MAIL_PASSWORD', '') : $settings['password_smtp']]);
        config(['mail.from' =>
            ['address' => $settings['from_address_smtp'], 'name' => $settings['shop_name']]]
        );
        config(['app.debug' => $settings['debug'] == '0' ? false : true]);
        
        foreach (glob(app_path() . '/Modules/*/Provider.php') as $filename) {
            require_once $filename;
        }
    }
}
