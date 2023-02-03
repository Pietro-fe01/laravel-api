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
        Schema::table('projects', function (Blueprint $table) {
            /* Make TYPE PK (id) to FK (type_id) 
            The ForeignKey may be null and if deleted became null */
            $table->foreignId('type_id')->nullable()->after('id')->constrained()->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // $table->dropForeign('projects_type_id_foreign'); 

            $table->dropForeign(['type_id']); /* they are the same */ 

            $table->dropColumn('type_id');
        });
    }
};
