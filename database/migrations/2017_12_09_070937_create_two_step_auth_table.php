<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use jeremykenedy\laravel2step\App\Models\TwoStepAuth;

class CreateTwoStepAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $twoStepAuth = new TwoStepAuth();
        $connection = $twoStepAuth->getConnectionName();
        $table = $twoStepAuth->getTableName();
        $tableCheck = Schema::connection($connection)->hasTable($table);

        if (!$tableCheck) {
            Schema::connection($connection)->create($table, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('userId')->unsigned()->index();
                $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
                $table->string('authCode')->nullable();
                $table->integer('authCount');
                $table->boolean('authStatus')->default(false);
                $table->dateTime('authDate')->nullable();
                $table->dateTime('requestDate')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $twoStepAuth = new TwoStepAuth();
        $connection = $twoStepAuth->getConnectionName();
        $table = $twoStepAuth->getTableName();

        Schema::connection($connection)->dropIfExists($table);
    }
}
