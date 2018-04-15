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
        $total_projects = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->get();
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

        // omset counts
        $omset = 0;
        $total_projects = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->get();
        foreach ($total_projects as $a) {
          $omset = $omset + $a->fee;
        }

        $o[1] = 0;
        $o['jan'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '1')
          ->get();
        foreach ($o['jan'] as $a) {
          $o[1] = $o[1] + $a->fee;
        }

        $o[2] = 0;
        $o['feb'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '2')
          ->get();
        foreach ($o['feb'] as $a) {
          $o[2] = $o[2] + $a->fee;
        }

        $o[3] = 0;
        $o['mar'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '3')
          ->get();
        foreach ($o['jan'] as $a) {
          $o[3] = $o[3] + $a->fee;
        }

        $o[4] = 0;
        $o['apr'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '4')
          ->get();
        foreach ($o['apr'] as $a) {
          $o[4] = $o[4] + $a->fee;
        }

        $o[5] = 0;
        $o['may'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '5')
          ->get();
        foreach ($o['may'] as $a) {
          $o[5] = $o[5] + $a->fee;
        }

        $o[6] = 0;
        $o['jun'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '6')
          ->get();
        foreach ($o['jun'] as $a) {
          $o[6] = $o[6] + $a->fee;
        }

        $o[7] = 0;
        $o['jul'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '7')
          ->get();
          foreach ($o['jul'] as $a) {
          $o[7] = $o[7] + $a->fee;
        }

        $o[8] = 0;
        $o['aug'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '8')
          ->get();
          foreach ($o['jul'] as $a) {
          $o[8] = $o[8] + $a->fee;
        }

        $o[9] = 0;
        $o['sep'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '9')
          ->get();
          foreach ($o['jul'] as $a) {
          $o[9] = $o[9] + $a->fee;
        }

        $o[10] = 0;
        $o['oct'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '10')
          ->get();
          foreach ($o['jul'] as $a) {
          $o[10] = $o[10] + $a->fee;
        }

        $o[11] = 0;
        $o['nov'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '11')
          ->get();
          foreach ($o['jul'] as $a) {
          $o[11] = $o[11] + $a->fee;
        }

        $o[12] = 0;
        $o['dec'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '12')
          ->get();
          foreach ($o['dec'] as $a) {
          $o[12] = $o[12] + $a->fee;
        }

        // pengeluaran counts
        $pengeluaran = 0;
        $total_projects = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->get();
        foreach ($total_projects as $a) {
          $pengeluaran = $pengeluaran + $a->pengeluaran;
        }

        $p[1] = 0;
        $p['jan'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '1')
          ->get();
        foreach ($p['jan'] as $a) {
          $p[1] = $p[1] + $a->pengeluaran;
        }

        $p[2] = 0;
        $p['feb'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '2')
          ->get();
        foreach ($p['feb'] as $a) {
          $p[2] = $p[2] + $a->pengeluaran;
        }

        $p[3] = 0;
        $p['mar'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '3')
          ->get();
        foreach ($p['jan'] as $a) {
          $p[3] = $p[3] + $a->pengeluaran;
        }

        $p[4] = 0;
        $p['apr'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '4')
          ->get();
        foreach ($p['apr'] as $a) {
          $p[4] = $p[4] + $a->pengeluaran;
        }

        $p[5] = 0;
        $p['may'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '5')
          ->get();
        foreach ($p['may'] as $a) {
          $p[5] = $p[5] + $a->pengeluaran;
        }

        $p[6] = 0;
        $p['jun'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '6')
          ->get();
        foreach ($p['jun'] as $a) {
          $p[6] = $p[6] + $a->pengeluaran;
        }

        $p[7] = 0;
        $p['jul'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '7')
          ->get();
          foreach ($p['jul'] as $a) {
          $p[7] = $p[7] + $a->pengeluaran;
        }

        $p[8] = 0;
        $p['aug'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '8')
          ->get();
          foreach ($p['jul'] as $a) {
          $p[8] = $p[8] + $a->pengeluaran;
        }

        $p[9] = 0;
        $p['sep'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '9')
          ->get();
          foreach ($p['jul'] as $a) {
          $p[9] = $p[9] + $a->pengeluaran;
        }

        $p[10] = 0;
        $p['oct'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '10')
          ->get();
          foreach ($p['jul'] as $a) {
          $p[10] = $p[10] + $a->pengeluaran;
        }

        $p[11] = 0;
        $p['nov'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '11')
          ->get();
          foreach ($p['jul'] as $a) {
          $p[11] = $p[11] + $a->pengeluaran;
        }

        $p[12] = 0;
        $p['dec'] = DB::table('projects')
          ->whereYear('projects.selesai', '=', Carbon::now()->format('Y'))
          ->whereMonth('projects.selesai', '<=', '12')
          ->get();
          foreach ($p['dec'] as $a) {
          $p[12] = $p[12] + $a->pengeluaran;
        }



        return view('admin.index')
          ->with('projects', $projects)
          ->with('deadline', $deadline)
          ->with('finish', $finish)
          ->with('running', $running)
          ->with('category', $category)
          ->with('revenue', $revenue)
          ->with('rev', $rev)
          ->with('omset', $omset)
          ->with('o', $o)
          ->with('pengeluaran', $pengeluaran)
          ->with('p', $p);
    }

    public function project()
    {
        return view('admin.project');
    }
}
