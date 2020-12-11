<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignPatientsToVisits extends Migration
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
            $table->integer('patient_id')->unsigned()->change();
            //nazwa klucza lekarza -> odwołanie do pola id tabeli users
            $table->foreign('patient_id', 'visits_patient_id_foreign')->references('id')->on('users')->onDelete('cascade');
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
            $table->dropForeign('visits_patient_id_foreign');
        });
    }
}
