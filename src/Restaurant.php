<?php
    class Restaurant
    {
        private $id;
        private $name;
        private $cuisine_id;
        private $cost;
        private $rating;

        function __construct($name, $cuisine_id, $cost, $rating, $id = null)
        {
            $this->id = $id;
            $this->name = $name;
            $this->cuisine_id = $cuisine_id;
            $this->cost = $cost;
            $this->rating = $rating;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants(name, cuisine_id, cost, rating) VALUES ('{$this->getName()}', {$this->getCuisineId()}, {$this->getCost()}, {$this->getRating()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function deleteRestaurant()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id = {$this->id};");
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $rating = $restaurant['rating'];
                $cost = $restaurant['cost'];
                $new_restaurant = new Restaurant($name, $cuisine_id, $cost, $rating, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

//Getter and Setters
        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
            $GLOBALS['DB']->exec("UPDATE restaurants SET name = {$this->name} WHERE id = {$this->id};");
        }

        function getName()
        {
            return $this->name;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function getCost()
        {
            return $this->cost;
        }

        function getRating()
        {
            return $this->rating;
        }
    }
?>
