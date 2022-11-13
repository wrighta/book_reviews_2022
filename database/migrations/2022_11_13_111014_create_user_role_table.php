<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Laravel names the pivot table with the joint names of the two tables in the many-t0-many relationship
        // Laravel does this in alabetical order which would be role_user
        // However I think role_user makes more sense for the table name.
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            // these attributes must be the same datatype as the ids that defined in the users and roles tables
            // which are unsigned bigInts
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('role_id')->unsigned();
            $table->timestamps();

            // add foreign keys - ids from users and roles table
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_role');
    }
};
