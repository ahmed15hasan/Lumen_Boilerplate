<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

 
class RouteServiceProvider extends ServiceProvider { 

   
    protected $path;

    public function __construct($app) {
        parent::__construct($app);
       
        $this->path = __DIR__ . '../../../'; 
         
    }
    /**
    * Bootstrap the application services.
    *
    * @return void
    */
   public function boot()
   {
 

   }

   /**
    * Register the application services.
    *
    * @return void
    */
   public function register()
   {
      //Register Our Package routes
      Route::group([
          'namespace' => 'App\Http\Controllers',
          'prefix' => 'v1'
      ], function ($router) {
          include $this->path.'routes/api.php';
      }); 
      
    }

}