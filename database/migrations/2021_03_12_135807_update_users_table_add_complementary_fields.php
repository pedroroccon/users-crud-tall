<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableAddComplementaryFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            // We use the ->default('') attribute in table fields, because SQLite 
            // doesn't allow us to have a null field without setting the column to nullable.
            // In other databases like PostgreSQL and MySQL 
            // we don't need to specify the ->default() attribute
            // Source: https://www.sqlite.org/lang_altertable.html

            $table->string('last_name')->default('')->after('name');
            
            $table->after('password', function($table) {
                $table->string('cpf')->default('')->unique();
                $table->string('phone')->default('');
                $table->string('postcode')->default('');
                $table->string('address')->default('');
                $table->string('number')->default('');
                $table->string('district')->default('');
                $table->string('address_additional')->nullable()->default('');
                $table->string('city')->default('');
                $table->char('state', 2)->default('');
                $table->string('country')->default('Brazil');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'last_name', 
                'cpf', 
                'phone', 
                'postcode', 
                'address', 
                'number', 
                'district', 
                'address_additional', 
                'city', 
                'state', 
                'country', 
            ]);
        });
    }
}
