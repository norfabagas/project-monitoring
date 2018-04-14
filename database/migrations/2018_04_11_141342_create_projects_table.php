<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project');
            $table->string('lokasi');
            $table->text('keterangan')->nullable();
            $table->date('mulai');
            $table->date('selesai');
            $table->integer('fee');
            $table->timestamps();
        });

        DB::table('projects')->insert([
          [
            'project' => 'Monitoring',
            'lokasi' => 'Jakarta',
            'keterangan' => 'Masih tahap 1',
            'mulai' => \Carbon\Carbon::now()->subDays(10),
            'selesai' => \Carbon\Carbon::now()->addDays(10),
            'fee' => 12000000,
          ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
