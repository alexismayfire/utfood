<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 31/10/18
 * Time: 20:07
 */

namespace App\Providers;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

/**
 * Class FakerServiceProvider
 * @package App\Providers
 *
 * Ref: https://medium.com/laravel-news/fake-localized-data-and-laravel-c4cdbecb2c31
 */
class FakerServiceProvider extends ServiceProvider
{
    /**
     * Registra o ServiceProvider
     *
     * @return void
     */
    public function register()
    {
        $this->registerFaker();
    }

    /**
     * Registra a classe faker com local do Brasil
     *
     * @return void
     */
    protected function registerFaker()
    {
        $this->app->singleton(Generator::class, function() {
            return Factory::create('pt_BR');
        });
    }
}
