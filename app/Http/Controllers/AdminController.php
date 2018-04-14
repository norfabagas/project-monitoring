<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Carbon\Carbon;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::count();

        $deadline = DB::table('projects')
          ->select('projects.*')
          ->where('projects.selesai', '<=', Carbon::now()->addDays(4)->format('Y-m-d'))
          ->where('projects.selesai', '>=', Carbon::now()->format('Y-m-d'))
          ->count();

        $finish = DB::table('projects')
          ->where('projects.selesai', '<', Carbon::now()->format('Y-m-d'))
          ->count();

        $running = DB::table('projects')
          ->where('projects.selesai', '>=', Carbon::now()->format('Y-m-d'))
          ->count();

        return view('admin.index')
          ->with('projects', $projects)
          ->with('deadline', $deadline)
          ->with('finish', $finish)
          ->with('running', $running);
    }

    public function project()
    {
        return view('admin.project');
    }
}
