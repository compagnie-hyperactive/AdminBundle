<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 01/11/17
 * Time: 16:22
 */

use Doctrine\Common\Annotations\AnnotationRegistry;

error_reporting(E_ALL & ~E_USER_DEPRECATED);

$loader = require __DIR__.'/../vendor/autoload.php';

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

return $loader;
