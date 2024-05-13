<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserJobApplication;
use Illuminate\Support\Facades\Auth;

class UserJobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->expectsJson()) {
            $validatedData = $request->validate([
                'job_id' => 'required'
            ]);

            $user = Auth::guard('sanctum')->user();

            $apply = UserJobApplication::create([
                'user_id' => $user->id,
                'job_listing_id' => $request->job_id
            ]);

            $data = [
                'message' => 'Job applied successfully',
                'apply' => $apply,
            ];
            $httpStatusCode = 200;
        } else {
            $data = [
                'message' => 'Bad Request'
            ];
            $httpStatusCode = 400;
        }

        return response()->json($data, $httpStatusCode);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserJobApplication $userJobApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserJobApplication $userJobApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserJobApplication $userJobApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserJobApplication $userJobApplication)
    {
        //
    }
}
