<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\User2Service;

class ProductController extends Controller
{
    use ApiResponser;

    public $product2Service;

    public function __construct(User2Service $product2Service)
    {
        $this->product2Service = $product2Service;
    }

    public function getProducts()
    {
        return $this->successResponse($this->product2Service->obtainProducts());
    }

    public function add(Request $request)
    {
        $rules = [
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'price'       => 'required|numeric'
        ];

        $this->validate($request, $rules);

        $response = $this->product2Service->createProduct($request->all());
        return $this->successResponse($response, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return $this->successResponse($this->product2Service->obtainProduct($id));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'price'       => 'required|numeric'
        ];

        $this->validate($request, $rules);

        $updated = $this->product2Service->editProduct($request->all(), $id);
        return $this->successResponse($updated);
    }

    public function delete($id)
    {
        return $this->successResponse($this->product2Service->deleteProduct($id));
    }
}