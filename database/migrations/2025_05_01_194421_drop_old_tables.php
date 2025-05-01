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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('albums');
        Schema::dropIfExists('artists');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('media_types');
        Schema::dropIfExists('playlist_track');
        Schema::dropIfExists('playlists');
        Schema::dropIfExists('tracks');
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
