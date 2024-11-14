<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

            Schema::create('gender', function (Blueprint $table) {
                $table->tinyIncrements('id')->unsigned();
                $table->string('description', 50);
            });

          // Creating 'civil_status' table
          Schema::create('civil_status', function (Blueprint $table) {
            $table->tinyIncrements('id')->unsigned();
            $table->string('description', 50);
        });

        // Creating 'house_ownership_type' table
        Schema::create('house_ownership_type', function (Blueprint $table) {
            $table->tinyIncrements('id')->unsigned();
            $table->string('description', 50);
        });

        // Creating 'shelter_damage_classification' table
        Schema::create('shelter_damage_classification', function (Blueprint $table) {
            $table->tinyIncrements('id')->unsigned();
            $table->string('description', 50);
        });

        // Creating 'family_assistance' table
        Schema::create('family_assistance', function (Blueprint $table) {
            $table->unsignedInteger('id', true)->primary();
            $table->string('first_name', 50);
            $table->string('middle_name', 50);
            $table->string('last_name', 50);
            $table->string('suffix', 20)->nullable();
            $table->date('birthdate');
            $table->integer('age')->unsigned();
            $table->string('birthplace', 225);
            $table->tinyInteger('gender')->unsigned();
            $table->string('permanent_address', 225);
            $table->tinyInteger('civil_status')->unsigned();
            $table->string('religion', 100);
            $table->string('occupation', 100);
            $table->string('primary_contact_no', 11);
            $table->string('alternate_contact_no', 11)->nullable();
            $table->string('mother_maiden_name', 50);
            $table->double('monthly_family_net_income');
            $table->string('id_card_presented', 50);
            $table->string('id_card_number', 50);
            $table->tinyInteger('is4PsBenef');
            $table->tinyInteger('isIP');
            $table->string('ethnicity', 50);
            $table->string('region', 100);
            $table->string('province', 100);
            $table->string('district', 100);
            $table->string('city_municipality', 100);
            $table->string('barangay', 100);
            $table->string('evacuation_center', 100);
            $table->tinyInteger('total_older_person');
            $table->tinyInteger('total_preg_women');
            $table->tinyInteger('total_lactating_women');
            $table->tinyInteger('total_PWD');
            $table->tinyInteger('house_ownership')->unsigned();
            $table->tinyInteger('shelter_damage')->unsigned();
            $table->timestamps();

            // Foreign key references
            $table->foreign('gender')->references('id')->on('gender')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('shelter_damage')->references('id')->on('shelter_damage_classification')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('house_ownership')->references('id')->on('house_ownership_type')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('civil_status')->references('id')->on('civil_status')->onDelete('no action')->onUpdate('cascade');
        });

        // Creating 'family_member' table
        Schema::create('family_member', function (Blueprint $table) {
            $table->unsignedInteger('id', true)->primary();
            $table->unsignedInteger('family_head_id');
            $table->string('fullname', 100);
            $table->string('relation', 50);
            $table->date('birthdate');
            $table->tinyInteger('age');
            $table->tinyInteger('gender')->unsigned();
            $table->string('educational_attainment', 100);
            $table->string('occupation', 100);
            $table->string('remarks', 225);

            // Foreign key references
            $table->foreign('gender')->references('id')->on('gender')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('family_head_id')->references('id')->on('family_assistance')->onDelete('no action')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_member');
        Schema::dropIfExists('family_assistance');
        Schema::dropIfExists('gender');
        Schema::dropIfExists('shelter_damage_classification');
        Schema::dropIfExists('house_ownership_type');
        Schema::dropIfExists('civil_status');
    }
};
