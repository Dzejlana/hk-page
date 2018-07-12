<?php
require '../vendor/autoload.php';
require 'PersistenceManager.php';

flight::register("db", "PersistenceManager" );

Flight::route('/', function(){
    echo 'hello world!';
});

flight::route("POST /items", function() {
  $request = flight::request()->data->getData();
flight::db()->add_items($request);
});

/* POST an updated version of an item (should be PUT, but it doesn't work with FlightPHP for some reason; use POST) */
Flight::route("POST /items/@id", function($id) {
    $request = Flight::request()->data->getData();
    /* Put the ID of an item to be updated into the array containing new item data and send it all to the database */
    $request["id"] = $id;
    $response = Flight::db()->update_item($request);
    if ($response)
        Flight::json($response);
    else
        Flight::halt(404, Flight::json(array("status" => "NOT FOUND")));
});

});

Flight::start();

 ?>
