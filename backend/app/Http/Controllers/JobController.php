<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * List all job vacancies
     * @return \App\Models\Job[]|\Illuminate\Database\Eloquent\Collection
     */
    public function listVacancies(){
        try {
            $response = Job::orderBy('id', 'desc')->paginate(10);
        } catch (QueryException $exception) {
            $response = $exception->errorInfo;
        }
        return $response;
    }

    public function addVacancy(Request $request){
            $messages=
                [
                    'title.required'        =>   "Title is required",
                    'title.max'             =>    "Title exceeds maximum character of 255",
                    'title.unique'          =>   "Title is already exists",
                    'description.required'  =>   "Description is required",
                    'location.required'     =>   "Location is required",
                    'salary.required'       =>   "Salary is required",
                    'salary.numeric'        =>   "Salary must be numeric",
                    'salary.min'            =>   "Salary must be greater than zero",
                ];

            $rules = [
                'title'       => 'required|max:255|unique:jobs',
                'description' => 'required',
                'location'    => 'required',
                'salary'      => 'required|min:1|numeric'
            ];

            $validation =  Validator::make($request->all(),$rules,$messages);
            if($validation->fails()){
                return response()->json(['validation_errors'=>$validation->errors()]);
            }else {
                try {
                    Job::create([
                        'title' => $request->input('title'),
                        'description' => $request->input('description'),
                        'location'  => $request->input('location'),
                        'salary'   => $request->input('salary')
                    ]);
                    $response = "successfully added a new job";
                } catch (QueryException $exception) {
                    $response = $exception->errorInfo;
                }
                return $response;
            }
    }

    public function updateVacancy(Request $request){
        try {
            $job=Job::find($request->input('id'));
            $job->update($request->all());
            $response = "new job saved";
        } catch (QueryException $exception) {
            $response = $exception->errorInfo;
        }
        return $response;
    }

    public function deleteVacancy(Request $request){
        try {
            Job::destroy($request->input('id'));
            $response = "job deleted";
        } catch (QueryException $exception) {
            $response = $exception->errorInfo;
        }
        return $response;
    }

    public function filterVacancy(Request $request)
    {
        return Job::where('title','like','%'.$request->input('keyword').'%')
                   ->orWhere('location','like','%'.$request->input('keyword').'%')
                   ->orWhere('salary','like','%'.$request->input('keyword').'%')
                   ->orderBy('id', 'desc')
                   ->paginate(10);
    }
}
