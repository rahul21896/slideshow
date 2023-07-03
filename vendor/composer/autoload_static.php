<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit077229b15377be21c36fa763b1d3ea41 {

	public static $files = [
		'a741957e538405136c5d0e73a177ff06' => __DIR__ . '/../..' . '/inc/setup.php',
	];

	public static $prefixLengthsPsr4 = [
		'R' => 
		[
			'RahulDhamecha\\MySlideshow\\' => 26,
		],
	];

	public static $prefixDirsPsr4 = [
		'RahulDhamecha\\MySlideshow\\' => 
		[
			0 => __DIR__ . '/../..' . '/inc',
		],
	];

	public static $classMap = [
		'RahulDhamecha\\MySlideshow\\Install' => __DIR__ . '/../..' . '/inc/class-install.php',
	];

	public static function getInitializer( ClassLoader $loader ) {
		return \Closure::bind(
			function () use ( $loader ) {
				$loader->prefixLengthsPsr4 = ComposerStaticInit077229b15377be21c36fa763b1d3ea41::$prefixLengthsPsr4;
				$loader->prefixDirsPsr4    = ComposerStaticInit077229b15377be21c36fa763b1d3ea41::$prefixDirsPsr4;
				$loader->classMap          = ComposerStaticInit077229b15377be21c36fa763b1d3ea41::$classMap;

			},
			null,
			ClassLoader::class
		);
	}
}
