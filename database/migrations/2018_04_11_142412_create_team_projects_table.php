<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_project');
            $table->foreign('id_project')->references('id')->on('projects')->onDelete('cascade');
            $table->string('team');
            // $table->unsignedInteger('id_team');
            // $table->foreign('id_team')->references('id')->on('teams')->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('team_projects')->insert([
          [
            'id_project' => '1',
            'team' => 'Ahmad',
          ],
          [
            'id_project' => '1',
            'team' => 'Budianto'
          ],
          [
            'id_project' => '1',
            'team' => 'Shireen',
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
        Schema::dropIfExists('team_projects');
    }
}
