<?php

namespace App\Console\Commands;

use App\Property;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class CronAddProperty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronAddProperty:cronAddPropertyFunction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cronjob API synchronization of properties';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle() {
        $client = new Client();
        $prop = $client->request('GET', 'https://api.mycrm.com/properties', [
            'headers' => [
                'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
            ]
        ]);
        $data = $prop->getBody();
        $data = json_decode($data, true);
        $mod  = $data['count'] % 100;
          if($mod != 0){
              $rem = 1;
          }else{
              $rem = 0;
          }
        $count = (int)($data['count'] / 100) + $rem;
        $pag=1;
        for($pag; $pag<=$count ; $pag++)
        {
          $client = new Client();
          $prop1 = $client->request('GET', 'https://api.mycrm.com/properties?sort=id&sort_order=desc&page='.$pag.'', [
              'headers' => [
                  'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
              ]
          ]);
          $data1 = $prop1->getBody();
          $data1 = json_decode($data1, true);
          $property_data = $data1['properties'];
          $property_data = json_decode(json_encode($property_data),true);
            foreach($property_data as $key => $pro_api)
            { 
              if(!empty($pro_api['landlord']))
              { 
                  $landlord = $pro_api['landlord']; 
                  if(!empty($landlord['id']))
                  {
                      $landlord = $landlord['id'];
                  }else{
                      $landlord = '';
                  }                 
              }else{
                  $landlord = '';
              }
              // image imploding medium and full
              $images_ml = array();
              $images_fl = array();
              $ame = array();
              $i = 0;
              if(!empty($pro_api['images'])){ 
                  foreach($pro_api['images'] as $im){
                      if(!empty($im['medium']['link'])){
                          $images_m = $im['medium']['link']; 
                          $images_ml[$i] = $images_m;
                          $i++;
                      }else{
                          $images_mlink = '';
                      }     
                  }
                  foreach($pro_api['images'] as $im){
                      if(!empty($im['full']['link'])){
                          $images_f = $im['full']['link']; 
                          $images_fl[$i] = $images_f;
                          $i++;
                      }else{
                          $images_flink = '';
                      }     
                  }
                  $images_mlink = implode(',' , $images_ml); 
                  $images_flink = implode(',' , $images_fl);            
              }else{
                  $images_mlink = '';
                  $images_flink = '';
              }
              // amenities imploding
              if(!empty($pro_api['amenities'])){ 
                  foreach($pro_api['amenities'] as $amenitie){
                      if(!empty($amenitie['name'])){
                          $amenit = $amenitie['name']; 
                          $ame[$i] = $amenit;
                          $i++;
                      }else{
                          $amenities = '';
                      }     
                  }
                  $amenities = implode(',' , $ame);            
              }else{
                  $amenities = '';
              }
              // price
              if(!empty($pro_api['price']['offering_type'])){ $offering_type = $pro_api['price']['offering_type']; }else{ $offering_type = '';}
              if(!empty($pro_api['price']))
                  { 
                      if($offering_type == 'rent'){
                          foreach($pro_api['price']['prices'] as $price){
                              $period = $price['period'];
                              $price_value = $price['value'];
                          }
                      }else{
                          $period = '';
                          $price_value = $pro_api['price']['value'];
                      }
              }else{ 
                  $period = '';
              }
              //language 
              if(!empty($pro_api['languages'])){ 
                  foreach($pro_api['languages'] as $lang){
                      if(!empty($lang['lang']) == 'en'){
                          if(!empty($lang['title'])){
                              $pro_title = $lang['title']; 
                          }else{
                              $pro_title = '';
                          }
                          if(!empty($lang['description'])){
                              $pro_description = $lang['description']; 
                          }else{
                              $pro_description = '';
                          } 
                      }else{
                          $break;
                      }     
                  }            
              }else{
                  $pro_description = '';
              }
                if(!empty($pro_api['id'])){ $id = $pro_api['id']; }else{ $id = '';}
                if(!empty($pro_api['reference'])){ $reference = $pro_api['reference']; }else{ $reference = '';}
                if(!empty($pro_api['developer'])){ $developer = $pro_api['developer']; }else{ $developer = '';}
                if(!empty($pro_api['charges'])){ $charges = $pro_api['charges']; }else{ $charges = '';}
                if(!empty($pro_api['parking'])){ $parking = $pro_api['parking']; }else{ $parking = '';}
                if(!empty($pro_api['location'])){ $loc_id = $pro_api['location']['id']; }else{ $loc_id = '';}
  
                if(!empty($pro_api['location'])){ $loc_city = $pro_api['location']['city']; }else{ $loc_city = '';}
                if(!empty($pro_api['location'])){ $loc_community = $pro_api['location']['community']; }else{ $loc_community = '';}
                if(!empty($pro_api['location'])){ $loc_sub_community = $pro_api['location']['sub_community']; }else{ $loc_sub_community = '';}
                if(!empty($pro_api['location'])){ $loc_tower = $pro_api['location']['tower']; }else{ $loc_tower = '';}
  
  
                if(!empty($pro_api['size'])){ $size = $pro_api['size']; }else{ $size = '';}
                if(!empty($pro_api['bedrooms'])){ $bedrooms = $pro_api['bedrooms']; }else{ $bedrooms = '';}
                if(!empty($pro_api['bathrooms'])){ $bathrooms = $pro_api['bathrooms']; }else{ $bathrooms = '';}
                if(!empty($pro_api['status'])){ $status = $pro_api['status']; }else{ $status = '';}
                if(!empty($pro_api['available_from'])){ $available_from = $pro_api['available_from']; }else{ $available_from = '';}
                if(!empty($pro_api['state'])){ $state = $pro_api['state']; }else{ $state = '';}
                if(!empty($pro_api['view_360'])){ $view_360 = $pro_api['view_360']; }else{ $view_360 = '';}
                if(!empty($pro_api['floor_number'])){ $floor_number = $pro_api['floor_number']; }else{ $floor_number = '';}
                if(!empty($pro_api['unit_number'])){ $unit_number = $pro_api['unit_number']; }else{ $unit_number = '';}
                if(!empty($pro_api['street_number'])){ $street_number = $pro_api['street_number']; }else{ $street_number = '';}
                if(!empty($pro_api['street_name'])){ $street_name = $pro_api['street_name']; }else{ $street_name = '';}
                if(!empty($pro_api['furnished'])){ $furnished = $pro_api['furnished']; }else{ $furnished = '';}
                if(!empty($pro_api['type'])){ $t_category = $pro_api['type']['category']; }else{ $t_category = '';}
                if(!empty($pro_api['type'])){ $t_name = $pro_api['type']['name']; }else{ $t_name = '';}
                if(!empty($pro_api['language_title'])){ $language_title = $pro_api['language_title']; }else{ $language_title = '';}
                if(!empty($pro_api['language_description'])){ $language_description = $pro_api['language_description']; }else{ $language_description = '';}
                if(!empty($pro_api['user'])){ $user_id = $pro_api['user']['id']; }else{ $user_id = '';}
                if(!empty($pro_api['build_year'])){ $build_year = $pro_api['build_year']; }else{ $build_year = '';}
                if(!empty($pro_api['plot_size'])){ $plot_size = $pro_api['plot_size']; }else{ $plot_size = '';}
                if(!empty($pro_api['plot_number'])){ $plot_number = $pro_api['plot_number']; }else{ $plot_number = '';}
                if(!empty($pro_api['built_up_area'])){ $built_up_area = $pro_api['built_up_area']; }else{ $built_up_area = '';}
                if(!empty($pro_api['floors'])){ $floors = $pro_api['floors']; }else{ $floors = '';}
                if(!empty($pro_api['occupancy'])){ $occupancy = $pro_api['occupancy']; }else{ $occupancy = '';}
                if(!empty($pro_api['financial_status'])){ $financial_status = $pro_api['financial_status']; }else{ $financial_status = '';}
                if(!empty($pro_api['project_status'])){ $project_status = $pro_api['project_status']; }else{ $project_status = '';}
                if(!empty($pro_api['project_name'])){ $project_name = $pro_api['project_name']; }else{ $project_name = '';}
                if(!empty($pro_api['renovation'])){ $renovation = $pro_api['renovation']; }else{ $renovation = '';}
                if(!empty($pro_api['dewa_number'])){ $dewa_number = $pro_api['dewa_number']; }else{ $dewa_number = '';}
                if(!empty($pro_api['layout_type'])){ $layout_type = $pro_api['layout_type']; }else{ $layout_type = '';}
                if(!empty($pro_api['freehold'])){ $freehold = $pro_api['freehold']; }else{ $freehold = '';}
                if(!empty($pro_api['selected_license'])){ $selected_license = $pro_api['selected_license']; }else{ $selected_license = '';}
                if(!empty($pro_api['licenses']['rera_listing'])){ $licenses_number = $pro_api['licenses']['rera_listing']['number']; }else{ $licenses_number = '';}
                if(!empty($pro_api['licenses']['rera_listing'])){ $licenses_issue_date = $pro_api['licenses']['rera_listing']['issue_date']; }else{ $licenses_issue_date = '';}
                if(!empty($pro_api['licenses']['rera_listing'])){ $licenses_expiry_date = $pro_api['licenses']['rera_listing']['expiry_date']; }else{ $licenses_expiry_date = '';}
                if(!empty($pro_api['licenses']['rera_listing'])){ $licenses_state = $pro_api['licenses']['rera_listing']['state']; }else{ $licenses_state = '';}
                if(!empty($pro_api['created_at'])){ $created_at = $pro_api['created_at']; }else{ $created_at = '';}
                if(!empty($pro_api['updated_at'])){ $updated_at = $pro_api['updated_at']; }else{ $updated_at = '';}
                if(!empty($pro_api['created_by'])){ $created_by = $pro_api['created_by']; }else{ $created_by = '';}
                if(!empty($pro_api['price'])){ $on_request = $pro_api['price']['on_request'];}else{ $on_request = ''; }
            
                $property = Property::where('p_id',$id)->first();
                if(!$property){
                  $prop_api = new Property;
                  $prop_api->p_id                 = $id;
                  $prop_api->reference            = $reference;
                  $prop_api->developer            = $developer;
                  $prop_api->charges              = $charges;
                  $prop_api->parking              = $parking;
                  $prop_api->l_id                 = $loc_id;
                  $prop_api->city                 = $loc_city;
                  $prop_api->community            = $loc_community;
                  $prop_api->sub_community        = $loc_sub_community;
                  $prop_api->tower                = $loc_tower;
  
                  $prop_api->size                 = $size;
                  $prop_api->bedrooms             = $bedrooms;
                  $prop_api->bathrooms            = $bathrooms;
                  $prop_api->status               = $status;
                  $prop_api->available_from       = $available_from;
                  $prop_api->state                = $state;
                  $prop_api->view_360             = $view_360;
                  $prop_api->floor_number         = $floor_number;
                  $prop_api->unit_number          = $unit_number;
                  $prop_api->street_number        = $street_number;
                  $prop_api->street_name          = $street_name;
                  $prop_api->furnished            = $furnished;
                  $prop_api->t_category           = $t_category;
                  $prop_api->t_name               = $t_name;
                  $prop_api->offering_type        = $offering_type;
                  $prop_api->on_request           = $on_request;
                  $prop_api->price_period         = $period;
                  $prop_api->price_value          = $price_value;
                  $prop_api->pro_title            = $pro_title;
                  $prop_api->pro_description      = $pro_description;
                  $prop_api->user_id              = $user_id;
                  $prop_api->landlord             = $landlord;
                  $prop_api->build_year           = $build_year;
                  $prop_api->plot_size            = $plot_size;
                  $prop_api->plot_number          = $plot_number;
                  $prop_api->built_up_area        = $built_up_area;
                  $prop_api->floors               = $floors;
                  $prop_api->occupancy            = $occupancy;
                  $prop_api->financial_status     = $financial_status;
                  $prop_api->project_status       = $project_status;
                  $prop_api->project_name         = $project_name;
                  $prop_api->renovation           = $renovation;
                  $prop_api->dewa_number          = $dewa_number;
                  $prop_api->layout_type          = $layout_type;
                  $prop_api->freehold             = $freehold;
                  $prop_api->selected_license     = $selected_license;
                  $prop_api->licenses_number      = $licenses_number;
                  $prop_api->licenses_issue_date  = $licenses_issue_date;
                  $prop_api->licenses_expiry_date = $licenses_expiry_date;
                  $prop_api->licenses_state       = $licenses_state;
                  $prop_api->images_mlink         = $images_mlink;
                  $prop_api->images_flink         = $images_flink;
                  $prop_api->amenities_name       = $amenities;
                  $prop_api->p_created_at         = $created_at;
                  $prop_api->p_updated_at         = $updated_at;
                  $prop_api->created_by           = $created_by; 
                  $prop_api->save();
                  echo "cronjob is working...";
                  }
                else{
                  echo "record already found...";
                }
            }
        }
      }
  }
  