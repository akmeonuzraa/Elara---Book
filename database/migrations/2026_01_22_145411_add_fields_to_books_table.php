<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // This migration can be left empty or deleted since we already
        // included all fields in the create_books_table migration
        // Or use it to add additional fields later if needed
    }

    public function down(): void
    {
        //
    }
};