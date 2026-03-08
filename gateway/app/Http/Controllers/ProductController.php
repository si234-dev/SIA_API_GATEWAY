<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductGatewayController extends Controller
{
    private $request;
    private $apiURL = "http://127.0.0.1:8001/api/products";

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function getProducts(){
        $response = Http::get($this->apiURL);
        return response()->json($response->json(), $response->status());
    }

    public function index()
    {
        $response = Http::get($this->apiURL);
        return response()->json($response->json(), $response->status());
    }

    public function add(Request $request){

        $response = Http::post($this->apiURL, [
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return response()->json($response->json(), $response->status());
    }

    public function show($id){

        $response = Http::get($this->apiURL.'/'.$id);

        return response()->json($response->json(), $response->status());
    }

    public function delete($id){

        $response = Http::delete($this->apiURL.'/'.$id);

        return response()->json($response->json(), $response->status());
    }

   public function update(Request $request, $id)
{
    // Send JSON to the API
    $response = Http::withHeaders([
        'Content-Type' => 'application/json'
    ])->put($this->apiURL.'/'.$id, $request->only(['product_name','price','stock']));

    return response()->json($response->json(), $response->status());
}
}