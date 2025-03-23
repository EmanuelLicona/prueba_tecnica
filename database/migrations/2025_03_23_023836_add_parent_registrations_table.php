<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_registration_id')->nullable()->after('pertenece_iglesia');

            $table->foreign('parent_registration_id')->references('id')->on('registrations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign('registrations_parent_registration_id_foreign');
            $table->dropColumn('parent_registration_id');
        });
    }
};
