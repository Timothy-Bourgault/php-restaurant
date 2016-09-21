<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    **/

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=worse_yelp_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Mac and Cheese";
            $test_Cuisine = new Cuisine($name);
            //Act
            $result = $test_Cuisine->getName();
            //Assert
            $this->assertEquals($name, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Mac and Cheese";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            // Act
            $result = Cuisine::getAll();
            // Assert
            $this->assertEquals($test_Cuisine, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Mac and Cheese";
            $test_Cuisine1 = new Cuisine($name);
            $test_Cuisine1->save();
            $name = "American";
            $test_Cuisine2 = new Cuisine($name);
            $test_Cuisine2->save();
            //Act
            $result = Cuisine::getAll();
            //Assert
            $this->assertEquals([$test_Cuisine1, $test_Cuisine2], $result);
        }

        function test_deleteCuisine()
        {
            $cuisine_name1 = "American";
            $test_Cuisine1 = new Cuisine($cuisine_name1);
            $test_Cuisine1->save();
            $cuisine_name2 = "Mac and Cheese";
            $test_Cuisine2 = new Cuisine($cuisine_name2);
            $test_Cuisine2->save();
            $test_Cuisine1_id = $test_Cuisine1->getId();
            $test_Cuisine2_id = $test_Cuisine2->getId();
            $name = "Macaroon Grill";
            $test_Restaurant1 = new Restaurant($name, $test_Cuisine1_id);
            $test_Restaurant1->save();
            $name = "DeAngelos";
            $test_Restaurant2 = new Restaurant($name, $test_Cuisine2_id);
            $test_Restaurant2->save();
            //Act
            $test_Cuisine1->deleteCuisine();
            $result_cuisines = Cuisine::getAll();
            $result_restaurants = Restaurant::getAll();
            //Assert
            $this->assertEquals([$test_Cuisine2], $result_cuisines);
            $this->assertEquals([$test_Restaurant2], $result_restaurants);

        }

        // function test_deleteAll()
        // {
        //     $name = "Mac & Cheese";
        //     $test_Cuisine = new Cuisine($name);
        // }

    }
 ?>
