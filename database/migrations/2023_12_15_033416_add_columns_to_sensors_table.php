<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSensorsTable extends Migration
{
    public function up()
    {
        Schema::table('sensors', function (Blueprint $table) {
            $table->string('pin')->after('sensor_type');
            $table->string('min_value')->nullable()->after('pin');
            $table->string('max_value')->nullable()->after('min_value');
            $table->enum('input_mode', ['digital', 'analog'])->nullable()->after('max_value');
        });
    }

    public function down()
    {
        Schema::table('sensors', function (Blueprint $table) {
            $table->dropColumn('pin');
            $table->dropColumn('min_value');
            $table->dropColumn('max_value');
            $table->dropColumn('input_mode');
        });
    }
}
