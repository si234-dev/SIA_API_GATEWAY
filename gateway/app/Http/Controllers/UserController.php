<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\User1Service;
use App\Services\User2Service;

class UserController extends Controller
{
    use ApiResponser;

    public $user1Service;
    public $user2Service;

    public function __construct(User1Service $user1Service, User2Service $user2Service)
    {
        $this->user1Service = $user1Service;
        $this->user2Service = $user2Service;
    }

    public function getUsers()
    {
        return $this->successResponse($this->user1Service->obtainUsers1());
    }

    public function add(Request $request)
    {
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'jobid'    => 'required|numeric|min:1|not_in:0'
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        if ($data['jobid'] <= 5) {
            $job = $this->user1Service->obtainUserJob($data['jobid']);
            if (!$job) {
                return $this->errorResponse('Job not found in Site 1', 404);
            }
            $response = $this->user1Service->createUser1($data);
            return $this->successResponse($response, Response::HTTP_CREATED);
        }

        $job = $this->user2Service->obtainUserJob($data['jobid']);
        if (!$job) {
            return $this->errorResponse('Job not found in Site 2', 404);
        }

        $response = $this->user2Service->createUser2($data);
        return $this->successResponse($response, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return $this->successResponse($this->user1Service->obtainUser1($id));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'jobid'    => 'required|numeric|min:1|not_in:0'
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        if ($data['jobid'] <= 5) {
            $job = $this->user1Service->obtainUserJob($data['jobid']);
            if (!$job) {
                return $this->errorResponse('Job not found in Site 1', 404);
            }
            $updated = $this->user1Service->editUser1($data, $id);
            return $this->successResponse($updated);
        }

        $job = $this->user2Service->obtainUserJob($data['jobid']);
        if (!$job) {
            return $this->errorResponse('Job not found in Site 2', 404);
        }

        $updated = $this->user2Service->editUser2($data, $id);
        return $this->successResponse($updated);
    }

    public function delete($id)
    {
        return $this->successResponse($this->user1Service->deleteUser1($id));
    }

    public function getUserJobs()
    {
        return $this->successResponse($this->user1Service->obtainUserJobs());
    }

    public function showUserJob($id)
    {
        return $this->successResponse($this->user1Service->obtainUserJob($id));
    }
}