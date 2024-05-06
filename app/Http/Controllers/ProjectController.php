<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
// use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponseTrait;

class ProjectController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return $this->apiResponse(true , 'data back successfully' , $projects , Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            $project = new Project;

            $project->title = $request->title;
            $project->category = $request->category;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $project->image = $imageName;
            }

            $project->save();

            return $this->apiResponse(true , 'project created successfully' , $project , Response::HTTP_CREATED);

        } catch (\Throwable $th) {
            return $this->apiResponse(false , 'project created failed' , $th , Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project = Project::get($project);

        return $this->apiResponse(true , 'data back successfully' , $project , Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        try {
            $project = Project::findOrFail($id);

            $project->title = $request->title;
            $project->category = $request->category;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $project->image = $imageName;
            }

            $project->save();

            $image->move(public_path('images'), $imageName);

            return $this->apiResponse(true , 'data Updated successfully' , $project , Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->apiResponse(false , 'project updated failed' , $th , Response::HTTP_BAD_REQUEST);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return $this->apiResponse(true , 'data Deleted successfully' , $project , Response::HTTP_OK);
    }
}
