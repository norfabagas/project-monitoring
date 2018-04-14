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

        $category = [];

        $category['studi'] = Project::where('category', '=', 'studi_kelayakan')
          ->count();

        $category['riset'] = Project::where('category', '=', 'riset_pasar')
          ->count();

        $category['pelatihan'] = Project::where('category', '=', 'pelatihan')
          ->count();

        $category['pengawasan'] = Project::where('category', '=', 'pengawasan')
          ->count();

        // revenue counts
        $revenue = 0;
        $total_projects = Project::get();
        foreach ($total_projects as $a) {
          $revenue = $revenue + ($a->fee - $a->pengeluaran);
        }

        $rev[1] = 0;
        $rev['jan'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '1')
          ->get();
        foreach ($rev['jan'] as $a) {
          $rev[1] = $rev[1] + ($a->fee - $a->pengeluaran);
        }

        $rev[2] = 0;
        $rev['feb'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '2')
          ->get();
        foreach ($rev['feb'] as $a) {
          $rev[2] = $rev[2] + ($a->fee - $a->pengeluaran);
        }

        $rev[3] = 0;
        $rev['mar'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '3')
          ->get();
        foreach ($rev['jan'] as $a) {
          $rev[3] = $rev[3] + ($a->fee - $a->pengeluaran);
        }

        $rev[4] = 0;
        $rev['apr'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '4')
          ->get();
        foreach ($rev['apr'] as $a) {
          $rev[4] = $rev[4] + ($a->fee - $a->pengeluaran);
        }

        $rev[5] = 0;
        $rev['may'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '5')
          ->get();
        foreach ($rev['may'] as $a) {
          $rev[5] = $rev[5] + ($a->fee - $a->pengeluaran);
        }

        $rev[6] = 0;
        $rev['jun'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '6')
          ->get();
        foreach ($rev['jun'] as $a) {
          $rev[6] = $rev[6] + ($a->fee - $a->pengeluaran);
        }

        $rev[7] = 0;
        $rev['jul'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '7')
          ->get();
          foreach ($rev['jul'] as $a) {
          $rev[7] = $rev[7] + ($a->fee - $a->pengeluaran);
        }

        $rev[8] = 0;
        $rev['aug'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '8')
          ->get();
          foreach ($rev['jul'] as $a) {
          $rev[8] = $rev[8] + ($a->fee - $a->pengeluaran);
        }

        $rev[9] = 0;
        $rev['sep'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '9')
          ->get();
          foreach ($rev['jul'] as $a) {
          $rev[9] = $rev[9] + ($a->fee - $a->pengeluaran);
        }

        $rev[10] = 0;
        $rev['oct'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '10')
          ->get();
          foreach ($rev['jul'] as $a) {
          $rev[10] = $rev[10] + ($a->fee - $a->pengeluaran);
        }

        $rev[11] = 0;
        $rev['nov'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '11')
          ->get();
          foreach ($rev['jul'] as $a) {
          $rev[11] = $rev[11] + ($a->fee - $a->pengeluaran);
        }

        $rev[12] = 0;
        $rev['dec'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '12')
          ->get();
          foreach ($rev['dec'] as $a) {
          $rev[12] = $rev[12] + ($a->fee - $a->pengeluaran);
        }

        $year = [];

        $year[1] = 0;
        $year['one'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->get();
        foreach ($year['one'] as $a) {
          $year[1] = $year[1] + ($a->fee - $a->pengeluaran);
        }

        $year[2] = 0;
        $year['two'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->subMonths(12)->format('Y'))
          ->get();
        foreach ($year['two'] as $a) {
          $year[2] = $year[2] + ($a->fee - $a->pengeluaran);
        }

        $year[3] = 0;
        $year['three'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->subMonths(24)->format('Y'))
          ->get();
        foreach ($year['three'] as $a) {
          $year[3] = $year[3] + ($a->fee - $a->pengeluaran);
        }

        $year[4] = 0;
        $year['four'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->subMonths(36)->format('Y'))
          ->get();
        foreach ($year['four'] as $a) {
          $year[4] = $year[4] + ($a->fee - $a->pengeluaran);
        }

        $year['max'] = 0;
        for ($i = 1; $i <=4; $i++) {
          if ($year[$i] >= $year['max']) {
            $year['max'] = $year[$i];
          }
        }

        return view('admin.index')
          ->with('projects', $projects)
          ->with('deadline', $deadline)
          ->with('finish', $finish)
          ->with('running', $running)
          ->with('category', $category)
          ->with('revenue', $revenue)
          ->with('rev', $rev)
          ->with('year', $year);
    }

    public function project()
    {
        return view('admin.project');
    }
}
