<?php
// Correct Lumen Syntax: Middleware is an element in the array, not a chained method
$router->group(['middleware' => 'client'], function () use ($router) {

    $router->get('/products', 'ProductController@getProducts');
    $router->post('/products', 'ProductController@add');
    $router->get('/products/{id}', 'ProductController@show');
    $router->put('/products/{id}', 'ProductController@update');
    $router->delete('/products/{id}', 'ProductController@delete');

    $router->get('/users', 'UserController@getUsers');
    $router->post('/users', 'UserController@add');
    $router->get('/users/{id}', 'UserController@show');
    $router->put('/users/{id}', 'UserController@update');
    $router->delete('/users/{id}', 'UserController@delete');
});






$router->get('/test-success', function () use ($router) {
    return response()->json(['message' => 'Success!']);
});






// ======= Users API (Site1 on port 8000) =======






/*

// GET all users
$router->get('/users', function () {
    $response = file_get_contents('http://localhost:8000/users');
    return response()->json(json_decode($response), 200);
});

// GET a single user
$router->get('/users/{id}', function ($id) {
    $response = file_get_contents("http://localhost:8000/users/{$id}");
    return response()->json(json_decode($response), 200);
});

$router->post('/users', function () {

    $data = http_build_query($_POST);

    $ch = curl_init('http://localhost:8000/users');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
});

// PUT (update) user
$router->put('/users/{id}', function ($id) {

    // parse x-www-form-urlencoded input from raw body
    parse_str(file_get_contents("php://input"), $data);

    $ch = curl_init("http://localhost:8000/users/{$id}");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
});

// DELETE user
$router->delete('/users/{id}', function ($id) {
    $ch = curl_init("http://localhost:8000/users/{$id}");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return response()->json(json_decode($response), 200);
});


// ======= Products API (Site2 on port 8001) =======

// GET all products
$router->get('/products', function () {
    $response = file_get_contents('http://localhost:8001/products');
    return response()->json(json_decode($response), 200);
});

// GET a single product
$router->get('/products/{id}', function ($id) {
    $response = file_get_contents("http://localhost:8001/products/{$id}");
    return response()->json(json_decode($response), 200);
});

// POST (create) product
// POST product
// POST product
$router->post('/products', function () {

    // get input
    $raw = file_get_contents('php://input');

    // try decode JSON first
    $data = json_decode($raw, true);

    // if JSON fails (null), parse as x-www-form-urlencoded
    if (!$data) {
        parse_str($raw, $data);
    }

    if (!$data) {
        return response()->json(['error' => 'No data provided'], 400);
    }

    $ch = curl_init('http://localhost:8001/products');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
});

// PUT product
$router->put('/products/{id}', function ($id) {

    $raw = file_get_contents('php://input');

    // parse input
    $data = json_decode($raw, true);
    if (!$data) {
        parse_str($raw, $data);
    }

    if (!$data) {
        return response()->json(['error' => 'No data provided'], 400);
    }

    $ch = curl_init("http://localhost:8001/products/{$id}");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
});

// DELETE product
$router->delete('/products/{id}', function ($id) {
    $ch = curl_init("http://localhost:8001/products/{$id}");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return response()->json(json_decode($response), 200);
});

*/
