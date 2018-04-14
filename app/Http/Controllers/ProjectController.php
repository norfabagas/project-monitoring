<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\TeamProject;
use Carbon\Carbon;
use DataTables;
use Validator;
use DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function table()
    {
        if (isset($_GET['status'])) {
          $status = $_GET['status'];

          if ($status == 'running') {
            $projects = DB::table('projects')
              ->where('projects.selesai', '>=', Carbon::now()->format('Y-m-d'))
              ->get();
          } else if ($status == 'deadline') {
            $projects = DB::table('projects')
              ->select('projects.*')
              ->where('projects.selesai', '<=', Carbon::now()->addDays(4)->format('Y-m-d'))
              ->where('projects.selesai', '>=', Carbon::now()->format('Y-m-d'))
              ->get();
          } else if ($status == 'finish') {
            $projects = DB::table('projects')
              ->where('projects.selesai', '<', Carbon::now()->format('Y-m-d'))
              ->get();
          } else {
            $projects = Project::get();
          }

        } else {
          $projects = Project::get();
        }


        return DataTables::of($projects)
          ->addColumn('team', function ($projects) {
            $team = TeamProject::where('id_project', '=', $projects->id)
              ->first();

            return $team->team;
          })
          ->addColumn('category', function ($projects) {
            if ($projects->category == 'studi_kelayakan') {
              return 'Studi Kelayakan';
            } else if ($projects->category == 'riset_pasar') {
              return 'Riset Pasar';
            } else if ($projects->category == 'pelatihan') {
              return 'Pelatihan';
            } else {
              return 'Pengawasan';
            }
          })
          ->addColumn('fee', function ($projects) {
            return number_format($projects->fee, 2, ',', '.');
          })
          ->addColumn('pengeluaran', function ($projects) {
            return number_format($projects->pengeluaran, 2, ',', '.');
          })
          ->addColumn('action', function ($projects) {
            return '
              <button class="btn btn-info btn-sm edit" data-target="modal" data-toggle="#editModal" data-id="'. $projects->id .'"><i class="fa fa-pencil"></i></button>
              <button class="btn btn-danger btn-sm delete" data-id="'. $projects->id .'"><i class="fa fa-times"></i></button>
            ';
          })
          ->make(true);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'category' => 'required',
          'project' => 'required',
          'team_array' => 'required',
          'lokasi' => 'required',
          'mulai' => 'required|date',
          'selesai' => 'required|date|after_or_equal:mulai',
          'fee' => 'required|integer',
          'pengeluaran' => 'required|integer',
        ]);

        if ($validator->fails()) {
          return response()->json([
            'errors' => $validator->getMessageBag()->toArray(),
          ]);
        } else {
          $project = new Project();
          $project->category = $request->category;
          $project->project = $request->project;
          $project->lokasi = $request->lokasi;
          $project->keterangan = $request->keterangan;
          $project->mulai = $request->mulai;
          $project->selesai = $request->selesai;
          $project->fee = $request->fee;
          $project->pengeluaran = $request->pengeluaran;
          $project->save();

          $team = new TeamProject();
          $team->id_project = $project->id;
          $team->team = $request->team_array;
          $team->save();

          return response()->json([
            'msg' => $project,
          ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $team = TeamProject::where('id_project', '=', $id)
          ->first();

        $teamProject = '';
        $array = explode(',', $team->team);
        foreach($array as $a) {

          $teamProject = $teamProject . '<li>' . $a . ' <button class="btn btn-danger delete-item"><i class="fa fa-trash"></i></button> </li>';
        }

        return response()->json([
          'project' => $project,
          'team' => $teamProject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'category' => 'required',
        'project' => 'required',
        'team_array' => 'required',
        'lokasi' => 'required',
        'mulai' => 'required|date',
        'selesai' => 'required|date|after_or_equal:mulai',
        'fee' => 'required|integer',
        'pengeluaran' => 'required|integer',
      ]);

      if ($validator->fails()) {
        return response()->json([
          'errors' => $validator->getMessageBag()->toArray(),
        ]);
      } else {
        $project = Project::find($id);
        $project->category = $request->category;
        $project->project = $request->project;
        $project->lokasi = $request->lokasi;
        $project->keterangan = $request->keterangan;
        $project->mulai = $request->mulai;
        $project->selesai = $request->selesai;
        $project->fee = $request->fee;
        $project->pengeluaran = $request->pengeluaran;
        $project->save();

        $team = TeamProject::where('id_project', '=', $id)
          ->first();
        $team->team = $request->team_array;
        $team->save();

        return response()->json([
          'msg' => $project,
        ]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();

        return response()->json([
          'msg' => $project
        ]);
    }
}
