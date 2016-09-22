<?php
    class Cuisine
    {
        private $id;
        private $name;

        function __construct($name, $id = null)
        {
            $this->id = $id;
            $this->name = $name;
        }

        function deleteCuisine()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines WHERE id = {$this->id};");
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE cuisine_id = {$this->id};");
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisines(name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function find($cuisine_name)
        {
            $cuisines = Cuisine::getAll();
            $cuisine_id = null;
            foreach ($cuisines as $cuisine) {
                if ($cuisine->getName() == $cuisine_name) {
                    $cuisine_id = $cuisine->getId();
                }
            }

            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$cuisine_id};");
            $restaurants = array();
            foreach ($returned_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $cost = $restaurant['cost'];
                $rating = $restaurant['rating'];
                $new_restaurant = new Restaurant($name, $cuisine_id, $cost, $rating, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine) {
                $name = $cuisine['name'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($name, $id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }
        static function getCuisineById($id)
        {
            $get_cuisine_by_id = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuisine_id = $cuisine->getId();
                if ($cuisine_id == $id) {
                    $get_cuisine_by_id = $cuisine;
                }
            }
            return $get_cuisine_by_id;
        }

//Getter and Setters
        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
            $GLOBALS['DB']->exec("UPDATE cuisines SET name = {$this->name} WHERE id = {$this->id};");
        }

        function getName()
        {
            return $this->name;
        }
    }
?>
