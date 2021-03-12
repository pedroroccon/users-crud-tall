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

            // O default('') aqui é utilizado pois o SQLite não permite
            // que uma coluna seja adicionada com o valor NULL 
            // se ela não for "nullable". Ao utilziar outras bases 
            // de dados, esta ação não é necessária.
            // Fonte: https://www.sqlite.org/lang_altertable.html

            $table->string('last_name')->default('')->after('name');
            
            $table->after('password', function($table) {
                $table->string('cpf')->default('')->unique();
                $table->string('phone')->default('');
                $table->string('zipcode')->default('');
                $table->string('address')->default('');
                $table->string('number')->default('');
                $table->string('complement')->default('');
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
                'zipcode', 
                'address', 
                'number', 
                'complement', 
                'city', 
                'state', 
                'country', 
            ]);
        });
    }
}
