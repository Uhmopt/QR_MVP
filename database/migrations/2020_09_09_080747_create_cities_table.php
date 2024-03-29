<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name');
            $table->string('alias')->unique();
            $table->string('image');
            $table->string('header_title');
            $table->string('header_subtitle');
            $table->softDeletes();
        });

        Schema::table('restorants', function (Blueprint $table) {
            $table->integer('city_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
        
        if(Schema::hasColumn('restorants', 'is_featured'))
        {
            Schema::table('restorants', function (Blueprint $table) {
                $table->dropColumn('is_featured');
            });
        }
    }
}
