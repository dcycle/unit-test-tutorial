<?php

/**
 * @file
 * PHPUnit class autoloader.
 *
 * PHPUnit knows nothing about Drupal, so provide PHPUnit with the bare
 * minimum it needs to know in order to find classes by namespace.
 *
 * Used by the PHPUnit test runner and referenced in ./phpunit.xml.
 */

spl_autoload_register(function ($class) {
  if (substr($class, 0, strlen('Drupal\\auto_entitylabel\\')) == 'Drupal\\auto_entitylabel\\') {
    $class2 = str_replace('Drupal\\auto_entitylabel\\', '', $class);
    $path = 'src/' . str_replace('\\', '/', $class2) . '.php';
    require_once $path;
  }
});
