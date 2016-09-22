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

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app['debug']=true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig', array('cuisines' => Cuisine::getAll(), 'restaurants' => Restaurant::getAll()));
    });

    $app->post("/add_cuisine", function() use ($app) {
        $cuisine = new Cuisine($_POST['cuisine_name']);
        $cuisine->save();
        return $app->redirect('/');
    });

    $app->post("/add_restaurant", function() use ($app) {
        $restaurant = new Restaurant($_POST['restaurant_name'], $_POST['cuisine_id'], $_POST['cost'], $_POST['rating']);
        $restaurant->save();
        return $app->redirect('/');
    });

    $app->get("/filter_by_cuisine/{cuisine_name}", function($cuisine_name) use ($app) {
        $filtered_restaurants = Cuisine::find($cuisine_name);
        return $app['twig']->render('home.html.twig', array('cuisines' => Cuisine::getAll(), 'restaurants' => $filtered_restaurants));
    });

    $app->get("/edit_restaurant/{restaurant_id}", function($restaurant_id) use ($app) {
        $restaurant = Restaurant::getRestaurantById($restaurant_id);
        return $app['twig']->render('edit_restaurant.html.twig', array('restaurant' => $restaurant));
    });

    $app->patch("/edit_restaurant/{restaurant_id}", function($restaurant_id) use ($app) {
        $restaurant = Restaurant::getRestaurantById($restaurant_id);
        $restaurant->setName($_POST['restaurant_name']);
        return $app['twig']->render('edit_restaurant.html.twig', array('restaurant' => $restaurant));
    });

    $app->delete("/edit_restaurant/{restaurant_id}", function($restaurant_id) use ($app) {
        $restaurant = Restaurant::getRestaurantById($restaurant_id);
        $restaurant->deleteRestaurant();
        return $app->redirect('/');
    });

    $app->patch("/edit_cuisine/{cuisine_id}", function($cuisine_id) use ($app) {
        $cuisine = Cuisine::getCuisineById($cuisine_id);
        $cuisine->setName($_POST['cuisine_name']);
        return $app['twig']->render('edit_restaurant.html.twig', array('cuisine' => $cuisine));
    });

    $app->delete("/edit_cuisine/{cuisine_id}", function($cuisine_id) use ($app) {
        $cuisine = Cuisine::getCuisineById($cuisine_id);
        $cuisine->deleteCuisine();
        return $app->redirect('/');
    });
        // Restaurant::delete
    return $app;
?>
