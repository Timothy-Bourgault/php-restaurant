<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Cuisine.php';
    require_once __DIR__.'/../src/Restaurant.php';

    $server = 'mysql:host=localhost;dbname=worse_yelp';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    return $app;
?>
