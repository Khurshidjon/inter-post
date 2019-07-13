<?php
 namespace App\Facades;

 use Illuminate\Support\Facades\Facade;

 class TrackingClass extends Facade
 {
     protected static function getFacadeAccessor()
     {
         return 'Tracking';
     }
 }