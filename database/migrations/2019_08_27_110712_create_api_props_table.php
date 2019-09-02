<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiPropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_props', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('p_id')->nullable();
            $table->string('reference')->nullable();
            $table->string('developer')->nullable();
            $table->string('charges')->nullable();
            $table->integer('parking')->nullable();
            $table->string('l_id')->nullable();
            $table->integer('size')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->string('status')->nullable();
            $table->string('available_from')->nullable();
            $table->string('state')->nullable();
            $table->string('view_360')->nullable();
            $table->string('floor_number')->nullable();
            $table->string('unit_number')->nullable();
            $table->string('street_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('furnished')->nullable();
            $table->string('t_category')->nullable();
            $table->string('t_name')->nullable();
            $table->string('offering_type')->nullable();
            $table->string('on_request')->nullable();
            $table->string('default_period')->nullable();
            $table->string('cheques')->nullable();
            $table->string('price_period')->nullable();
            $table->string('price_value')->nullable();
            $table->string('user_id')->nullable();
            $table->string('landlord')->nullable();
            $table->string('build_year')->nullable();
            $table->string('plot_size')->nullable();
            $table->string('plot_number')->nullable();
            $table->string('built_up_area')->nullable();
            $table->string('floors')->nullable();
            $table->string('occupancy')->nullable();
            $table->string('financial_status')->nullable();
            $table->string('project_status')->nullable();
            $table->string('project_name')->nullable();
            $table->string('renovation')->nullable();   
            $table->string('dewa_number')->nullable();
            $table->string('layout_type')->nullable();
            $table->string('freehold')->nullable();
            $table->string('selected_license')->nullable();
            $table->integer('licenses_number')->nullable();
            $table->string('licenses_issue_date')->nullable();
            $table->string('licenses_expiry_date')->nullable();
            $table->string('licenses_state')->nullable();
            $table->string('images_mlink')->nullable();
            $table->string('images_flink')->nullable();
            $table->string('amenities_name')->nullable();
            $table->string('p_created_at')->nullable();
            $table->string('p_updated_at')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_props');
    }
}
