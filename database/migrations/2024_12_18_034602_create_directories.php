<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */    public function up()
    {
        // Crear directorios si no existen
        if (!Storage::disk('public')->exists('products-images')) {
            Storage::disk('public')->makeDirectory('products-images');
        }

        if (!Storage::disk('public')->exists('companies-images')) {
            Storage::disk('public')->makeDirectory('companies-images');
        }
    }

    public function down()
    {
        // Opcional: Eliminar los directorios si deseas revertir la migración
        Storage::disk('public')->deleteDirectory('products-images');
        Storage::disk('public')->deleteDirectory('companies-images');
    }
};
