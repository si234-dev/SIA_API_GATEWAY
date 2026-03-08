<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

 Class UserController extends Controller 
{
    private $request;
    public function __construct(Request $request){
    $this->request = $request;
    }



    public function getUsers(){
    $users = User::all();
    return response()->json($users, 200);
    }
    public function index()
    {
    $users = User::all();
    return response()->json($users, 200);
    }

    public function add(Request $request ){
    $rules = [
    'username' => 'required|string|unique:users,username|max:20',
    'password' => 'required|string|min:5|max:20',
    
    ];
    

    $this->validate($request,$rules);

    $user = User::create($request->all());

    return response()->json([
        'message' => 'User created successfully',
        'data' => $user
    ]);


    }
        public function show($id){


// FindOrFail automatically throws an exception if not found
        $user = User::findOrFail($id);
        return response()->json(['message' => 'User retrieved successfully', 'data' => $user]);




        /*
    if (!User::find($id)) {
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }
    $user = User::findOrFail($id);
    return response()->json([
        'message' => 'User retrieved successfully',
        'data' => $user
    ]);

    */


     }

    public function delete($id) {
        $user = User::where('id', $id)->first();
      
    $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);


      /*
        if($user){ 
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
            */
    }

    public function update($id) {
        $data = file_get_contents('php://input');

        $ch = curl_init("http://localhost:8001/users/{$id}");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return response()->json(json_decode($response), 200);
    }






        /*
        if($user){ 
            $user->update($request->all());
            return response()->json([
                'message' => 'User updated successfully',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        */
 



}