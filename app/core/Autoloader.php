<?php

class Autoloader
{
	/**
	 * Register the autoloader with PHP.
	 *
	 * This tells PHP: when a class is
         * used that hasn't been
	 * included yet, run this function to try and load it.
	 */
	public static function register(): void
	{

spl_autoload_register(function($class) {

	$paths = [
	     __DIR__ . '/',
	     __DIR__ . '/../controllers/'
		 ];
	foreach ($paths as $path)
{
	$file = $path . $class . '.php';
		if (file_exists($file)) {
			require_once $file;
			return;
		    }
		}
	
	   });
      }
 }
