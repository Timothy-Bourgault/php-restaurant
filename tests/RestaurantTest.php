<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    **/

    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=worse_yelp_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_getName()
        {
            // Arrange
            $name = "Macaroon Grill";
            $test_Restaurant = new Restaurant($name, 666);
            // Act
            $result = $test_Restaurant->getName();
            // Assert
            $this->assertEquals($name, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Macaroon Grill";
            $test_Restaurant = new Restaurant($name, 666);
            $test_Restaurant->save();
            // Act
            $result = Restaurant::getAll();
            // Assert
            $this->assertEquals($test_Restaurant, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $name = "Macaroon Grill";
            $test_Restaurant1 = new Restaurant($name, 666);
            $test_Restaurant1->save();
            $name = "DeAngelos";
            $test_Restaurant2 = new Restaurant($name, 333);
            $test_Restaurant2->save();
            // Act
            $result = Restaurant::getAll();
            // Assert
            $this->assertEquals([$test_Restaurant1, $test_Restaurant2], $result);
        }
    }
 ?>
