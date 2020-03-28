<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use jeremykenedy\LaravelBlocker\App\Models\BlockedItem;
use jeremykenedy\LaravelBlocker\App\Models\BlockedType;

class CreateLaravelBlockerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $blocked = new BlockedItem();
        $connection = $blocked->getConnectionName();
        $table = $blocked->getTableName();
        $tableCheck = Schema::connection($connection)->hasTable($table);

        if (! $tableCheck) {
            Schema::connection($connection)->create($table, function (Blueprint $table) {
                $blockedType = new BlockedType();
                $connectionType = $blockedType->getConnectionName();
                $tableTypeName = $blockedType->getTableName();
                $table->increments('id');
                $table->integer('typeId')->unsigned()->index();
                $table->foreign('typeId')->references('id')->on($tableTypeName)->onDelete('cascade');
                $table->string('value')->unique();
                $table->longText('note')->nullable();
                $table->unsignedBigInteger('userId')->unsigned()->index()->nullable();
                // $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
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
        $blocked = new BlockedItem();
        $connection = $blocked->getConnectionName();
        $table = $blocked->getTableName();

        Schema::connection($connection)->dropIfExists($table);
    }
}
