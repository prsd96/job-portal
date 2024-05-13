<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\UserJobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobListingController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $jobs = JobListing::all();
            return response()->json($jobs, 200);
        }
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function jobData(Request $request)
    {
        if ($request->expectsJson()) {
            $validatedData = $request->validate([
                'job_id' => 'required'
            ]);

            $job = JobListing::findOrFail($request->job_id);

            $data = [
                'job' => $job
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
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function saveJob(Request $request)
    {
        if ($request->expectsJson()) 
        {
            $validatedData = $request->validate([
                'job_title' => 'required',
                'company_name' => 'required',
                'location' => 'required'
            ]);

            JobListing::create($validatedData);

            $data = [
                'message' => 'Job has been added to the listing'
            ];
            $httpStatusCode = 200;
        } 
        else 
        {
            $data = [
                'message' => 'Bad Request'
            ];
            $httpStatusCode = 400;
        }
        
        return response()->json($data, $httpStatusCode);
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\JobListing  $jobListing
    * @return \Illuminate\Http\Response
    */
    public function show(JobListing $jobListing)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\JobListing  $jobListing
    * @return \Illuminate\Http\Response
    */
    public function edit(JobListing $jobListing)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\JobListing  $jobListing
    * @return \Illuminate\Http\Response
    */
    public function updateJob(Request $request)
    {
        if ($request->expectsJson()) 
        {
            $validatedData = $request->validate([
                'job_id' => 'required',
                'job_title' => 'required',
                'company_name' => 'required',
                'location' => 'required'
            ]);

            $jobListing = JobListing::find($request->job_id);

            $jobListing->update([
                'job_title' => $validatedData['job_title'],
                'company_name' => $validatedData['company_name'],
                'location' => $validatedData['location'],
            ]);

            $data = [
                'message' => 'Job has been updated.'
            ];
            $httpStatusCode = 200;
        } 
        else 
        {
            $data = [
                'message' => 'Bad Request'
            ];
            $httpStatusCode = 400;
        }

        return response()->json($data, $httpStatusCode);
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\JobListing  $jobListing
    * @return \Illuminate\Http\Response
    */
    public function destroy(JobListing $jobListing)
    {
        //
    }
}
