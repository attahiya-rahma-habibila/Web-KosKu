<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
        */
        public function up()
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            if (!Schema::hasColumn('pembayarans', 'order_id')) {
                $table->string('order_id')->nullable()->unique()->after('id');
            }

            if (!Schema::hasColumn('pembayarans', 'snap_token')) {
                $table->string('snap_token')->nullable()->after('order_id');
            }
        });
    }

    public function down()
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            if (Schema::hasColumn('pembayarans', 'snap_token')) {
                $table->dropColumn('snap_token');
            }

            if (Schema::hasColumn('pembayarans', 'order_id')) {
                $table->dropColumn('order_id');
            }
        });
    }
};
