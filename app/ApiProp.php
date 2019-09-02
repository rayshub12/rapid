<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiProp extends Model
{
    protected $fillable = [
        'p_id', 'reference', 'developer','charges','parking','l_id','size','bedrooms','bathrooms','status','available_from','state','view_360','floor_number','unit_number','street_number','street_name','furnished','t_category','t_name','offering_type','on_request','default_period','cheques','price_period','price_value','language_title','language_description','user_id','landlord','build_year','plot_size','plot_number','built_up_area','floors','occupancy','financial_status','project_status','project_name','renovation','views','right_move_url','dewa_number','layout_type','freehold','selected_license','licenses_number','licenses_issue_date','licenses_expiry_date','licenses_state','images_mlink','images_flink','amenities_name','p_created_at','p_updated_at','created_by',
    ];
}