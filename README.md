# Worse Yelp #

#### Code review application to practice BDD in PHP, September 2016

#### By April Peng, Ryan Apking, Tim Bourgault

## Description ##

This is a poor man's yelp.

## User Setup/Installation Instructions ##

* Clone git repository
* Using the command line, navigate to the project's root directory
* Install dependencies by running $ composer install
* Navigate to the /web directory and start a local server with $ php -S localhost:8000
* Open a browser and go to the address http://localhost:8000 to view the application

## Specifications ##

* Add and save a Cuisine type.
    * input1: "Mac and Cheese"
    * output: "Mac and Cheese"

* Edit a Cuisine type.
    * input1: "Mac & Cheese"
    * output: "Mac & Cheese"

* Delete a Cuisine type.
    * input1: delete "Mac & Cheese"
    * output: ""

* Add and save a Restaurant.
    * input1: "Macaroon Grill"
    * output: "Macaroon Grill"

* Edit a Restaurant.
    * input1: "Macaroni Grill"
    * output: "Macaroni Grill"

* Delete a Restaurant.
    * input1: delete "Macaroni Grill"
    * output: ""

* Return restaurants within a Cuisine type.
    * input1: "Mac & Cheese"
    * output: "Macaroni Grill"

## Known Bugs ##

There are no known bugs at this time.

## Languages/Technologies Used ##

* PHP
* Silex
* Twig

### License ###

*This application is licensed under the MIT license.*

Copyright (c) 2016 Ryan Apking, Tim Bourgault, April Peng
