<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use jeremykenedy\LaravelBlocker\App\Models\BlockedType;

class CreateLaravelBlockerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $blocked = new BlockedType();
        $connection = $blocked->getConnectionName();
        $table = $blocked->getTableName();
        $tableCheck = Schema::connection($connection)->hasTable($table);

        if (! $tableCheck) {
            Schema::connection($connection)->create($table, function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug')->unique();
                $table->string('name');
                $table->timestamps();
                $table->softDeletes();
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
        $blockedType = new BlockedType();
        $connection = $blockedType->getConnectionName();
        $table = $blockedType->getTableName();

        Schema::connection($connection)->dropIfExists($table);
    }
}
