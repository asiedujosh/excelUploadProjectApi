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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('recordId')->nullable();
            $table->string('domain')->nullable();
            $table->string('subDomain')->nullable();
            $table->string('category')->nullable();
            $table->string('subCategory')->nullable();
            $table->string('healthOutcome')->nullable();
            $table->string('variable')->nullable();
            $table->string('variableName')->nullable();
            $table->string('variableDescription')->nullable();
            $table->string('sex')->nullable();
            $table->string('race')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('age')->nullable();
            $table->string('geography')->nullable();
            $table->string('dataUnit')->nullable();
            $table->string('dataYear')->nullable();
            $table->string('dataSourceName')->nullable();
            $table->string('dataSource')->nullable();
            $table->string('dataPortalName')->nullable();
            $table->string('dataPortal')->nullable();
            $table->string('dataFormat')->nullable();
            $table->string('dataLocation')->nullable();
            $table->string('accessedDate')->nullable();
            $table->string('processed')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
