<?php

namespace App\Http\Controllers;

use App\Subjects;
use App\Http\Resources\Subjects as SubjectsResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return SubjectsResource::collection(Subjects::all());
    }
}
