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

        // relazione 1 a molti appartamenti / utente
        Schema::table('apartments', function (Blueprint $table){
            $table->foreignId('user_id')->constrained();
           });
        // relazione 1 a molti gallery / apartment
        Schema::table('galleries', function (Blueprint $table){
            $table->foreignId('apartment_id')->constrained('apartments')->onDelete('cascade');
        });
          // relazione 1 a molti views / apartment
          Schema::table('views', function (Blueprint $table){
            $table->foreignId('apartment_id')->constrained('apartments')->onDelete('cascade');
        });
           // relazione 1 a molti messages / apartment
           Schema::table('messages', function (Blueprint $table){
            $table->foreignId('apartment_id')->constrained('apartments')->onDelete('cascade');
        });
        // relazione molti molti appartamenti
       Schema::table('apartment_sponsor', function (Blueprint $table){
            $table->foreignId('apartment_id')->constrained();
            $table->foreignId('sponsor_id')->constrained();
       });
       Schema::table('apartment_service', function (Blueprint $table){
        $table->foreignId('apartment_id')->constrained();
        $table->foreignId('service_id')->constrained();
       });

   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        // relazione 1 a molti appartamenti / utente
        Schema::table('apartments', function (Blueprint $table){
            $table->dropForeign('apartments_user_id_foreign');
            $table->dropColumn('user_id');
        });
        // relazione 1 a molti gallery / apartment

        Schema::table('galleries', function (Blueprint $table){
            $table->dropForeign(['apartment_id']);
            $table->dropColumn('apartment_id');
        });
         // relazione 1 a molti views / apartment

         Schema::table('views', function (Blueprint $table){
            $table->dropForeign(['apartment_id']);
            $table->dropColumn('apartment_id');
        });
         // relazione 1 a molti messages / apartment

         Schema::table('messages', function (Blueprint $table){
            $table->dropForeign(['apartment_id']);
            $table->dropColumn('apartment_id');
        });

        // relazione molti molti appartamenti
        Schema::table('apartment_service', function (Blueprint $table){
            $table->dropForeign('apartment_service_apartment_id_foreign');
            $table->dropColumn('apartment_id');

            $table->dropForeign('apartment_service_service_id_foreign');
            $table->dropColumn('service_id');
        });
        Schema::table('apartment_sponsor', function (Blueprint $table){
            $table->dropForeign('apartment_sponsor_apartment_id_foreign');
            $table->dropColumn('apartment_id');

            $table->dropForeign('apartment_sponsor_sponsor_id_foreign');
            $table->dropColumn('sponsor_id');
        });

    }
};
