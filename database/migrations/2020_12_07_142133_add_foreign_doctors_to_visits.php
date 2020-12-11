<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignDoctorsToVisits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visits', function (Blueprint $table) {
            //dopasowanie typu id lekarza i id w tabeli users
            $table->integer('doctor_id')->unsigned()->change();
            //nazwa klucza lekarza -> odwołanie do pola id tabeli users
            $table->foreign('doctor_id', 'visits_doctor_id_foreign')->references('id')->on('users')->onDelete('cascade');
            //->change(); mozliwe ze to dodać
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visits', function (Blueprint $table) {
            //liczba mnoga naszej tabeli i liczba pojedyncza 
            //naszej tabeli z ktora sie łączymy
            $table->dropForeign('visits_doctor_id_foreign');
        });
    }
}
