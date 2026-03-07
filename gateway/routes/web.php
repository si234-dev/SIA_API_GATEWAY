<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/test-success', function () use ($router) {
    return response()->json(['message' => 'Success!']);
});

// ======= Users API (Site1 on port 8000) =======

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

// POST (create) user
$router->post('/users', function () {
    $data = file_get_contents('php://input'); // raw JSON

    $ch = curl_init('http://localhost:8000/users');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return response()->json(json_decode($response), 200);
});

// PUT (update) user
$router->put('/users/{id}', function ($id) {
    $data = file_get_contents('php://input'); // raw JSON

    $ch = curl_init("http://localhost:8000/users/{$id}");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return response()->json(json_decode($response), 200);
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
$router->post('/products', function () {
    $data = file_get_contents('php://input'); // raw JSON

    $ch = curl_init('http://localhost:8001/products');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return response()->json(json_decode($response), 200);
});

// PUT (update) product
$router->put('/products/{id}', function ($id) {
    $data = file_get_contents('php://input'); // raw JSON

    $ch = curl_init("http://localhost:8001/products/{$id}");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return response()->json(json_decode($response), 200);
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



