<?php
namespace App\Services;

use App\Traits\ConsumesExternalService;

class User2Service
{
    use ConsumesExternalService;

    public $baseUri;
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.users2.base_uri');
        $this->secret  = config('services.users2.secret');
    }

    public function obtainProducts()
{
    return $this->performRequest('GET', '/api/products');
}

public function obtainProduct($id)
{
    return $this->performRequest('GET', "/api/products/{$id}");
}

public function createProduct($data)
{
    return $this->performRequest('POST', '/api/products', $data);
}

public function editProduct($data, $id)
{
    return $this->performRequest('PUT', "/api/products/{$id}", $data);
}

public function deleteProduct($id)
{
    return $this->performRequest('DELETE', "/api/products/{$id}");
}

public function obtainUserJob($id)
{
    return $this->performRequest('GET', "/api/userjob/{$id}");
}

public function createUser2($data)
{
    return $this->performRequest('POST', '/api/users', $data);
}

public function editUser2($data, $id)
{
    return $this->performRequest('PUT', "/api/users/{$id}", $data);
}

public function deleteUser2($id)
{
    return $this->performRequest('DELETE', "/api/users/{$id}");
}

}