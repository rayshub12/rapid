<?php

namespace App\Http\Controllers;

use App\City;
use App\State;
use App\Amenity;
use App\Property;
use App\Subscriber;
use App\PropertyType;
use App\ApiProp;
use GuzzleHttp\Client;
use App\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // Homepage Controller
    public function index()
    {
        $client = new Client();
        $prop = $client->request('GET', 'https://api.mycrm.com/properties?per_page=50&sort=id&sort_order=desc', [
            'headers' => [
                'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
            ]
        ]);
        $data = $prop->getBody();
        $data = json_decode($data, true);
        $property_data = $data['properties'];
        $property_data = json_decode(json_encode($property_data));
        // echo"<pre>";print_r($property_data); die;
        foreach($property_data as $key => $prop_data)
        {
            if($prop_data->price->offering_type == 'sale'){
                $property_data[$key]->property_for = 1;
            }elseif($prop_data->price->offering_type == 'rent'){
                $property_data[$key]->property_for = 2;
            }
            $property_data[$key]->name = $prop_data->languages[0]->title;
            $property_data[$key]->property_type = $prop_data->type->name;
            if(!empty($prop_data->price->prices[0]->value)){
                $property_data[$key]->property_price = $prop_data->price->prices[0]->value;
            }elseif(!empty($prop_data->price->value)){
                $property_data[$key]->property_price = $prop_data->price->value;
            }
            $property_data[$key]->city_name = $prop_data->location->community;
            $property_data[$key]->state_name = $prop_data->location->city;
        }
        $properties = json_decode(json_encode($property_data));
        return view('homepage', compact('properties'));
    }
    // View Signle Property Detail Page
    public function singleProperty(Request $request, $id=null)
    {
        // dd($request->all());
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Property Enquiry Email
            $to =['manjeet.singh@magicgroupinc.com','hrishabh@isupportcomputer.org'];
            $email = $to;
            $messageData = ['email'=>$data['email'], 'phone'=>$data['phone'], 'name'=>$data['full_name'], 'prop_name'=>$data['prop_name'], 'prop_url'=>$data['prop_url'], 'enquiry_message'=>$data['enquiry_message']];
            Mail::send('emails.enquiry', $messageData, function($message) use($email){
                $message->to($email)->subject('A User Send an Enquiry about Property');
            });

            return redirect()->back()->with('flash_message_success', 'An Email has been sent to the admin.');
        }

        $property_count = Property::where('id', $id)->count();

        if($property_count > 0){
            $property = Property::where('id', $id)->get();
            $property = json_decode(json_encode($property));
            // echo "<pre>"; print_r($property); die;

            foreach($property as $key => $val){
                $city_count = City::where(['id'=> $val->city])->count();
                if($city_count > 0){
                    $city_name = City::where(['id'=> $val->city])->first();
                    $property[$key]->city_name = $city_name->name;
                }
                $state_count = State::where(['id'=> $val->state])->count();
                if($state_count > 0){
                    $state_name = State::where(['id'=> $val->state])->first();
                    $property[$key]->state_name = $state_name->name;
                }
            }

            $property = json_decode(json_encode($property[0]));

        }else{
            $client = new Client();
            $prop = $client->request('GET', 'https://api.mycrm.com/properties/'.$id, [
                    'headers' => [
                        'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
                    ]
            ]);

            // Single Property
            $data = $prop->getBody();
            $data = json_decode($data, true);
            $property = $data['property'];
            $property = json_decode(json_encode($property));

            if($property->price->offering_type == 'sale'){
                $property->property_for = 1;
            }elseif($property->price->offering_type == 'rent'){
                $property->property_for = 2;
            }
            $property->name = $property->languages[0]->title;
            $property->property_type = $property->type->name;
            if(!empty($property->price->prices[0]->value)){
                $property->property_price = $property->price->prices[0]->value.' /'.$property->price->prices[0]->period;
            }elseif(!empty($property->price->value)){
                $property->property_price = $property->price->value;
            }
            $property->city_name = $property->location->community;
            $property->state_name = $property->location->city;
            $property->property_code = $property->reference;
            $property->property_area = $property->size;
            if($property->furnished == "furnished"){
                $property->furnish_type = 'F';
            }elseif(!empty($property->furnished == "unfurnished")){
                $property->furnish_type = 'U';
            }elseif(!empty($property->furnished == "semi-furnished")){
                $property->furnish_type = 'S';
            }
            $property->description = $property->languages[0]->description;
            $property->city = $property->location->city;
            $property->am = $property->amenities;
        }

        $property = json_decode(json_encode($property));

        $client = new Client();
        $prop_all = $client->request('GET', 'https://api.mycrm.com/properties', [
            'headers' => [
                'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
            ]
        ]);

        // All Property
        $data = $prop_all->getBody();
        $data = json_decode($data, true);
        $property_all = $data['properties'];
        $property_all = json_decode(json_encode($property_all));

        $client1 = new Client();
        $i = 1;
        $location_data = array();
        do{
            $location = $client1->request('GET', 'https://api.mycrm.com/locations?filters[]&page='.$i.'', [
                'headers' => [
                    'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
                    ]
                ]);
            $data1          = $location->getBody();
            $data1          = json_decode($data1, true);
            $loc            = $data1['location'];
            $location_data  = array_merge($location_data,$loc);
            $mod            = $data1['count'] % 100;
            if($mod != 0){
                $rem = 1;
            }else{
                $rem = 0;
            }
            $count          = (int)($data1['count'] / 100) + $rem;
            $i++;
        }while($count >= $i);
        
        $location_data = json_decode(json_encode($location_data));

        return view('frontend.property.single_property', compact('property', 'property_all','location_data'));
    }

    public function singleOffPlan(Request $request, $id=null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Property Enquiry Email
            $to =['manjeet.singh@magicgroupinc.com','hrishabh@isupportcomputer.org'];
            $email = $to;
            $messageData = ['email'=>$data['email'], 'phone'=>$data['phone'], 'name'=>$data['full_name'], 'prop_name'=>$data['prop_name'], 'prop_url'=>$data['prop_url'], 'enquiry_message'=>$data['enquiry_message']];
            Mail::send('emails.enquiry', $messageData, function($message) use($email){
                $message->to($email)->subject('A User Send an Enquiry about Property');
            });

            return redirect()->back()->with('flash_message_success', 'An Email has been sent to the admin.');
        }

        $property_count = Property::where('id', $id)->count();

        if($property_count > 0){
            $property = Property::where('id', $id)->get();
            $property = json_decode(json_encode($property));
            // echo "<pre>"; print_r($property); die;

            foreach($property as $key => $val){
                $city_count = City::where(['id'=> $val->city])->count();
                if($city_count > 0){
                    $city_name = City::where(['id'=> $val->city])->first();
                    $property[$key]->city_name = $city_name->name;
                }
                $state_count = State::where(['id'=> $val->state])->count();
                if($state_count > 0){
                    $state_name = State::where(['id'=> $val->state])->first();
                    $property[$key]->state_name = $state_name->name;
                }
            }

            $property = json_decode(json_encode($property[0]));

        }else{
            $client = new Client();
            $prop = $client->request('GET', 'https://api.mycrm.com/properties/'.$id, [
                    'headers' => [
                        'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
                    ]
            ]);

            // Single Property
            $data = $prop->getBody();
            $data = json_decode($data, true);
            $property = $data['property'];
            $property = json_decode(json_encode($property));

            if($property->price->offering_type == 'sale'){
                $property->property_for = 1;
            }elseif($property->price->offering_type == 'rent'){
                $property->property_for = 2;
            }
            $property->name = $property->languages[0]->title;
            $property->property_type = $property->type->name;
            if(!empty($property->price->prices[0]->value)){
                $property->property_price = $property->price->prices[0]->value.' /'.$property->price->prices[0]->period;
            }elseif(!empty($property->price->value)){
                $property->property_price = $property->price->value;
            }
            $property->city_name = $property->location->community;
            $property->state_name = $property->location->city;
            $property->property_code = $property->reference;
            $property->property_area = $property->size;
            if($property->furnished == "furnished"){
                $property->furnish_type = 'F';
            }elseif(!empty($property->furnished == "unfurnished")){
                $property->furnish_type = 'U';
            }elseif(!empty($property->furnished == "semi-furnished")){
                $property->furnish_type = 'S';
            }
            $property->description = $property->languages[0]->description;
            $property->city = $property->location->city;
            $property->am = $property->amenities;
        }

        $property = json_decode(json_encode($property));

        $client = new Client();
        $prop_all = $client->request('GET', 'https://api.mycrm.com/properties', [
            'headers' => [
                'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
            ]
        ]);

        // All Property
        $data = $prop_all->getBody();
        $data = json_decode($data, true);
        $property_all = $data['properties'];
        $property_all = json_decode(json_encode($property_all));

        $client1 = new Client();
        $i = 1;
        $location_data = array();
        do{
            $location = $client1->request('GET', 'https://api.mycrm.com/locations?filters[]&page='.$i.'', [
                'headers' => [
                    'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
                    ]
                ]);
            $data1          = $location->getBody();
            $data1          = json_decode($data1, true);
            $loc            = $data1['location'];
            $location_data  = array_merge($location_data,$loc);
            $mod            = $data1['count'] % 100;
            if($mod != 0){
                $rem = 1;
            }else{
                $rem = 0;
            }
            $count          = (int)($data1['count'] / 100) + $rem;
            $i++;
        }while($count >= $i);
        
        $location_data = json_decode(json_encode($location_data));

        return view('frontend.property.single_offPlanProperty', compact('property', 'property_all','location_data'));
    }

    // Property Category Page Function
    public function propertyCategory($url=null)
    {
        $property_type_code = PropertyType::where('url', $url)->get();
        $properties = Property::where('property_type', $property_type_code[0]->type_code)->orderBy('created_at', 'desc')->paginate(20);
        // $properties = json_decode(json_encode($properties));

        foreach($properties as $key => $val)
        {
            $prop_type = PropertyType::where(['type_code' => $val->property_type])->first();
            $properties[$key]->property_type = $prop_type->name;

            $city_name = City::where(['id' => $val->city])->first();
            $properties[$key]->city_name = $city_name->name;

            $state_name = State::where(['id' => $val->state])->first();
            $properties[$key]->state_name = $state_name->name;

            $prop_img_count = PropertyImage::where(['property_id' => $val->id])->count();
            if($prop_img_count > 0)
            {
                $prop_img = PropertyImage::where(['property_id' => $val->id])->first();
                $properties[$key]->image_name = $prop_img->image_name;
            }
        }
        // echo "<pre>"; print_r($properties); die;
        // $client1 = new Client();
        // $prop1 = $client1->request('GET', 'https://api.mycrm.com/properties?filters[type][id]=1', [
        //     'headers' => [
        //         'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
        //     ]
        // ]);
        // $data1 = $prop1->getBody();
        // $data1 = json_decode($data1, true);
        // $property_data1 = $data1['properties'];
        // $property_data1 = json_decode(json_encode($property_data1));
        // foreach($property_data1 as $key => $prop_data1)
        // {
        //     if($prop_data1->price->offering_type == 'sale'){
        //         $property_data1[$key]->property_for = 1;
        //     }elseif($prop_data1->price->offering_type == 'rent'){
        //         $property_data1[$key]->property_for = 2;
        //     }   
        //     $property_data1[$key]->property_type = $prop_data1->type->name;
            
        // }
        // $properties1 = $property_data1;
        // $properties1 = json_decode(json_encode($properties1));
        $client1 = new Client();
        $i = 1;
        $location_data = array();
        do{
            $location = $client1->request('GET', 'https://api.mycrm.com/locations?filters[]&page='.$i.'', [
                'headers' => [
                    'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
                    ]
                ]);
            $data1          = $location->getBody();
            $data1          = json_decode($data1, true);
            $loc            = $data1['location'];
            $location_data  = array_merge($location_data,$loc);
            $mod            = $data1['count'] % 100;
            if($mod != 0){
                $rem = 1;
            }else{
                $rem = 0;
            }
            $count          = (int)($data1['count'] / 100) + $rem;
            $i++;
        }while($count >= $i);
        
        $location_data = json_decode(json_encode($location_data));

        return view('frontend.property.property_category_offplan', compact('properties','properties1','location_data'));
    }

    // Property Category Page Function
    public function propertyInCategory(Request $request, $property_for=null,$page=null, $url_id=null, $url_name=null, $self_id=null)
    {   
      
        $client = new Client();
        $prop = $client->request('GET', 'https://api.mycrm.com/properties?filters[type][id]='.$url_id.'&filters[offering_type]='.$property_for.'&per_page=20&page='.$page.'', [
            'headers' => [
                'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
            ]
        ]);
        $data = $prop->getBody();
        $data = json_decode($data, true);
        $property_data = $data['properties'];
        $counterApi= $data['count'];
        $property_data = json_decode(json_encode($property_data));
        // echo "<pre>"; print_r($property_data); die;
        foreach($property_data as $key => $prop_data)
        {
            if($prop_data->price->offering_type == 'sale'){
                $property_data[$key]->property_for = 1;
            }elseif($prop_data->price->offering_type == 'rent'){
                $property_data[$key]->property_for = 2;
            }
            $property_data[$key]->name = $prop_data->languages[0]->title;
            $property_data[$key]->property_type = $prop_data->type->name;
            if(!empty($prop_data->price->prices[0]->value)){
                $property_data[$key]->property_price = $prop_data->price->prices[0]->value;
            }elseif(!empty($prop_data->price->value)){
                $property_data[$key]->property_price = $prop_data->price->value;
            }
            $property_data[$key]->city_name = $prop_data->location->community;
            $property_data[$key]->state_name = $prop_data->location->city;
        }
        $properties = Property::where('property_for', $self_id)->orderBy('created_at', 'desc')->get();
        $properties = json_decode(json_encode($properties));
        $counterDb  = count($properties);
        foreach($properties as $key => $val)
        {
            $prop_type = PropertyType::where(['type_code' => $val->property_type])->first();
            $properties[$key]->property_type = $prop_type->name;

            $city_name = City::where(['id' => $val->city])->first();
            $properties[$key]->city_name = $city_name->name;

            $state_name = State::where(['id' => $val->state])->first();
            $properties[$key]->state_name = $state_name->name;

            $prop_img_count = PropertyImage::where(['property_id' => $val->id])->count();
            if($prop_img_count > 0)
            {
                $prop_img = PropertyImage::where(['property_id' => $val->id])->first();
                $properties[$key]->image_name = $prop_img->image_name;
            }
        }
        $properties = array_merge($properties, $property_data);
        $counter = $counterApi + $counterDb;
        $numOfpages = intval($counter/20)+1;
        $current_page = $page;
            if($current_page == 1){
                $has_next_page = true;
                $has_previous_page = false;
                $next_page = $current_page + 1;
            }elseif($current_page < $numOfpages){
                $has_next_page = true;
                $has_previous_page = true;
                $next_page = $current_page + 1;
            }elseif($numOfpages <= $current_page ){
                $has_next_page = false;
                $has_previous_page = true;
                $next_page = $current_page;
            }


        $client1 = new Client();
        $prop1 = $client1->request('GET', 'https://api.mycrm.com/properties?filters[offering_type]='.$property_for, [
            'headers' => [
                'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
            ]
        ]);
        $data1 = $prop1->getBody();
        $data1 = json_decode($data1, true);
        $property_data1 = $data1['properties'];
        $property_data1 = json_decode(json_encode($property_data1));
        foreach($property_data1 as $key => $prop_data1)
        {
            if($prop_data1->price->offering_type == 'sale'){
                $property_data1[$key]->property_for = 1;
            }elseif($prop_data1->price->offering_type == 'rent'){
                $property_data1[$key]->property_for = 2;
            }   
            $property_data1[$key]->property_type = $prop_data1->type->name;
            
        }
        $properties1 = $property_data1;
        $propdata2 = json_decode(json_encode($property_data1), true);
        $properties1 = json_decode(json_encode($properties1));
        
        $client1 = new Client();
        $i = 1;
        $location_data = array();
        do{
            $location = $client1->request('GET', 'https://api.mycrm.com/locations?filters[]&page='.$i.'', [
                'headers' => [
                    'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
                    ]
                ]);
            $data1          = $location->getBody();
            $data1          = json_decode($data1, true);
            $loc            = $data1['location'];
            $location_data  = array_merge($location_data,$loc);
            $mod            = $data1['count'] % 100;
            if($mod != 0){
                $rem = 1;
            }else{
                $rem = 0;
            }
            $count          = (int)($data1['count'] / 100) + $rem;
            $i++;
        }while($count >= $i);
        
        $location_data = json_decode(json_encode($location_data));
        return view('frontend.property.property_category', compact('counter','location_data','properties1', 'prop_data1','properties','numOfpages','current_page','has_next_page','has_previous_page','next_page'));
    }


    // Property by Buy/Rent/Off Plan function
    /// Property by Buy/Rent function
   
    public function propertyFor(Request $request, $id=null,$url=null, $page=null)
    {
        if($id == 1){
            $property_for = 'sale';
        }elseif($id == 2){
            $property_for = 'rent';
        }elseif($id == 3) {
            $property_for = 'off-plan';
        }
        $type   = $id ;
        $client = new Client();
        $prop = $client->request('GET', 'https://api.mycrm.com/properties?filters[offering_type]='.$property_for.'&per_page=20&page='.$page.'', [
            'headers' => [
                'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
            ]
        ]);
        $data = $prop->getBody();
        $data = json_decode($data, true);
        $property_data = $data['properties'];
        $counterApi= $data['count'];
        $property_data = json_decode(json_encode($property_data));
        foreach($property_data as $key => $prop_data)
        {
            if($prop_data->price->offering_type == 'sale'){
                $property_data[$key]->property_for = 1;
            }elseif($prop_data->price->offering_type == 'rent'){
                $property_data[$key]->property_for = 2;
            }
            $property_data[$key]->name = $prop_data->languages[0]->title;
            $property_data[$key]->property_type = $prop_data->type->name;
            if(!empty($prop_data->price->prices[0]->value)){
                $property_data[$key]->property_price = $prop_data->price->prices[0]->value;
            }elseif(!empty($prop_data->price->value)){
                $property_data[$key]->property_price = $prop_data->price->value;
            }
            $property_data[$key]->city_name = $prop_data->location->community;
            $property_data[$key]->state_name = $prop_data->location->city;
        }
        $properties = Property::where('property_for', $id)->orderBy('created_at', 'desc')->get();
        $properties = json_decode(json_encode($properties));
        $counterDb  = count($properties);
        foreach($properties as $key => $val)
        {
            $prop_type = PropertyType::where(['type_code' => $val->property_type])->first();
            $properties[$key]->property_type = $prop_type->name;

            $city_name = City::where(['id' => $val->city])->first();
            $properties[$key]->city_name = $city_name->name;

            $state_name = State::where(['id' => $val->state])->first();
            $properties[$key]->state_name = $state_name->name;

            $prop_img_count = PropertyImage::where(['property_id' => $val->id])->count();
            if($prop_img_count > 0)
            {
                $prop_img = PropertyImage::where(['property_id' => $val->id])->first();
                $properties[$key]->image_name = $prop_img->image_name;
            }
        }
        $properties = array_merge($properties, $property_data);
        $counter = $counterApi + $counterDb;
        $numOfpages = intval($counter/20)+1;
        $current_page = $page;
            if($current_page == 1){
                $has_next_page = true;
                $has_previous_page = false;
                $next_page = $current_page + 1;
            }elseif($current_page < $numOfpages){
                $has_next_page = true;
                $has_previous_page = true;
                $next_page = $current_page + 1;
            }elseif($numOfpages <= $current_page ){
                $has_next_page = false;
                $has_previous_page = true;
                $next_page = $current_page;
            }
        $client1 = new Client();
        $prop1 = $client1->request('GET', 'https://api.mycrm.com/properties?filters[offering_type]='.$property_for, [
            'headers' => [
                'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
            ]
        ]);
        $data1 = $prop1->getBody();
        $data1 = json_decode($data1, true);
        $property_data1 = $data1['properties'];
        $property_data1 = json_decode(json_encode($property_data1));
        foreach($property_data1 as $key => $prop_data1)
        {
            if($prop_data1->price->offering_type == 'sale'){
                $property_data1[$key]->property_for = 1;
            }elseif($prop_data1->price->offering_type == 'rent'){
                $property_data1[$key]->property_for = 2;
            }   
            $property_data1[$key]->property_type = $prop_data1->type->name;
            
        }
        $properties1 = $property_data1;
        $properties1 = json_decode(json_encode($properties1));
        $client1 = new Client();
        $i = 1;
        $location_data = array();
        do{
            $location = $client1->request('GET', 'https://api.mycrm.com/locations?filters[]&page='.$i.'', [
                'headers' => [
                    'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
                    ]
                ]);
            $data1          = $location->getBody();
            $data1          = json_decode($data1, true);
            $loc            = $data1['location'];
            $location_data  = array_merge($location_data,$loc);
            $mod            = $data1['count'] % 100;
            if($mod != 0){
                $rem = 1;
            }else{
                $rem = 0;
            }
            $count          = (int)($data1['count'] / 100) + $rem;
            $i++;
        }while($count >= $i);
        $location_data = json_decode(json_encode($location_data));
        
        return view('frontend.property.property_category', compact('counter','location_data','properties1','url','type','properties','numOfpages','current_page','has_next_page','has_previous_page','next_page'));
    }


    //off plan
    public function offPlan(Request $request,$url=null,$id=null,$page=null)
    {
        $properties = Property::where('property_for', $id)->orderBy('created_at', 'desc')->paginate(20);
        // $properties = json_decode(json_encode($properties));
        // echo "<pre>"; print_r($properties); die;
        $counterDb  = count($properties);
        foreach($properties as $key => $val)
        {
            $prop_type = PropertyType::where(['type_code' => $val->property_type])->first();
            $properties[$key]->property_type = $prop_type->name;

            $city_name = City::where(['id' => $val->city])->first();
            $properties[$key]->city_name = $city_name->name;

            $state_name = State::where(['id' => $val->state])->first();
            $properties[$key]->state_name = $state_name->name;

            $prop_img_count = PropertyImage::where(['property_id' => $val->id])->count();
            if($prop_img_count > 0)
            {
                $prop_img = PropertyImage::where(['property_id' => $val->id])->first();
                $properties[$key]->image_name = $prop_img->image_name;
            }
        }
        $counter = $counterDb;
        $numOfpages = intval($counter/20)+1;
        $current_page = $page;
            if($current_page == 1){
                $has_next_page = true;
                $has_previous_page = false;
                $next_page = $current_page + 1;
            }elseif($current_page < $numOfpages){
                $has_next_page = true;
                $has_previous_page = true;
                $next_page = $current_page + 1;
            }elseif($numOfpages <= $current_page ){
                $has_next_page = false;
                $has_previous_page = true;
                $next_page = $current_page;
            }
        $client1 = new Client();
        $i = 1;
        $location_data = array();
        do{
            $location = $client1->request('GET', 'https://api.mycrm.com/locations?filters[]&page='.$i.'', [
                'headers' => [
                    'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
                    ]
                ]);
            $data1          = $location->getBody();
            $data1          = json_decode($data1, true);
            $loc            = $data1['location'];
            $location_data  = array_merge($location_data,$loc);
            $mod            = $data1['count'] % 100;
            if($mod != 0){
                $rem = 1;
            }else{
                $rem = 0;
            }
            $count          = (int)($data1['count'] / 100) + $rem;
            $i++;
        }while($count >= $i);
        
        $location_data = json_decode(json_encode($location_data));
        return view('frontend.property.property_category_offplan', compact('counter','location_data','url','properties','numOfpages','current_page','has_next_page','has_previous_page','next_page'));
    }

    // Property by State
    public function cityProperty(Request $request,$id=null)
    {

        $properties = Property::where(['city' => $id, 'property_for' => 3])->orderBy('created_at', 'desc')->paginate(20);
        // $properties = json_decode(json_encode($properties));

        foreach($properties as $key => $val)
        {
            $prop_type = PropertyType::where(['type_code' => $val->property_type])->first();
            $properties[$key]->property_type = $prop_type->name;

            $city_name = City::where(['id' => $val->city])->first();
            $properties[$key]->city_name = $city_name->name;

            $state_name = State::where(['id' => $val->state])->first();
            $properties[$key]->state_name = $state_name->name;

            $prop_img_count = PropertyImage::where(['property_id' => $val->id])->count();
            if($prop_img_count > 0)
            {
                $prop_img = PropertyImage::where(['property_id' => $val->id])->first();
                $properties[$key]->image_name = $prop_img->image_name;
            }
        }

        return view('frontend.property.property_category_offplan', compact('properties'));
    }

    // Subscribe Now
    public function subscribe(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();

            Subscriber::create([
                'email' => $data['email']
            ]);

            // echo "<pre>"; print_r($data); die;
            return redirect()->back()->with('subscribe_message','You are added to Subscribers List Successfully!');
        }
    }

    // Subscriber List in Admin Panel
    public function subscriberList()
    {
        return view('admin.subscribe.subscriber_list');
    }

    // Home Page Search Function Start
    // public function search(Request $request)
    // {
    //     if($request->get('query'))
    //     {
            
    //         $client = new Client();
            
    //         // print_r(sizeof($a)); die;
    //         $query = $request->get('query');
    //         $data = City::where('name', 'LIKE', "%{$query}%")->get();
    //         echo "<pre>"; print_r($data); die;
    //         $output = '';
    //         foreach($data as $key => $p)
    //         // for($i=0 ; $i < sizeof($a) ; $i++)
    //         {
    //             // $flag = '<span class="flag_name">'.$key.'</span>';
    //             $output .= '<option id="city_search" value="'.$key.'">'.$p.'</li>';
    //         }
    //         $output .= '</select>';
    //         echo $output;
    //     }
    // }

    // Home Page Search-Result Function Start
   public function searchresult(Request $request)
    {
        $data = $request->all();
        if( $data['property_type'] == 1 || $data['property_type'] == 2)
        {
        $scityID = $data['location_id'];
        $type= $data['property_type'];
        if($type == 1){
            $url= "sale"; 
        }elseif($type == 2){
            $url= "rent"; 
        }
        $client = new Client();
        if(!empty($scityID)){
            $prop = $client->request('GET', 'https://api.mycrm.com/properties?filters[location_ids][]='.$scityID.'&filters[offering_type]='.$url.'&per_page=20', [
                'headers' => [
                    'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
                ]
            ]);
        }else{
            $prop = $client->request('GET', 'https://api.mycrm.com/properties?filters[offering_type]='.$url.'&per_page=20', [
                'headers' => [
                    'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
                ]
            ]);
        }

        $data = $prop->getBody();
        $data = json_decode($data, true);
        $property_data = $data['properties'];
        $counterApi= $data['count'];
        $property_data = json_decode(json_encode($property_data));
        foreach($property_data as $key => $prop_data)
        {
            if($prop_data->price->offering_type == 'sale'){
                $property_data[$key]->property_for = 1;
            }elseif($prop_data->price->offering_type == 'rent'){
                $property_data[$key]->property_for = 2;
            }
            $property_data[$key]->name = $prop_data->languages[0]->title;
            $property_data[$key]->property_type = $prop_data->type->name;
            if(!empty($prop_data->price->prices[0]->value)){
                $property_data[$key]->property_price = $prop_data->price->prices[0]->value;
            }elseif(!empty($prop_data->price->value)){
                $property_data[$key]->property_price = $prop_data->price->value;
            }
            $property_data[$key]->city_name = $prop_data->location->community;
            $property_data[$key]->state_name = $prop_data->location->city;
        }
        $properties = $property_data;
        $counter = $counterApi;
        $numOfpages = intval($counter/20)+1;
        $current_page = 1;
            if($current_page == 1){
                $has_next_page = true;
                $has_previous_page = false;
                $next_page = $current_page + 1;
            }elseif($current_page < $numOfpages){
                $has_next_page = true;
                $has_previous_page = true;
                $next_page = $current_page + 1;
            }elseif($numOfpages <= $current_page ){
                $has_next_page = false;
                $has_previous_page = true;
                $next_page = $current_page;
            }
            
        $data1 = $prop->getBody();
        $data1 = json_decode($data1, true);
        $property_data1 = $data1['properties'];
        $property_data1 = json_decode(json_encode($property_data1));
        foreach($property_data1 as $key => $prop_data1)
        {
            if($prop_data1->price->offering_type == 'sale'){
                $property_data1[$key]->property_for = 1;
            }elseif($prop_data1->price->offering_type == 'rent'){
                $property_data1[$key]->property_for = 2;
            }   
            $property_data1[$key]->property_type = $prop_data1->type->name;
            
        }
        $properties1 = $property_data1;
        $propdata2 = json_decode(json_encode($property_data1), true);
        $properties1 = json_decode(json_encode($properties1));

        $client1 = new Client();
        $i = 1;
        $location_data = array();
        do{
            $location = $client1->request('GET', 'https://api.mycrm.com/locations?filters[]&page='.$i.'', [
                'headers' => [
                    'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
                    ]
                ]);
            $data1          = $location->getBody();
            $data1          = json_decode($data1, true);
            $loc            = $data1['location'];
            $location_data  = array_merge($location_data,$loc);
            $mod            = $data1['count'] % 100;
            if($mod != 0){
                $rem = 1;
            }else{
                $rem = 0;
            }
            $count          = (int)($data1['count'] / 100) + $rem;
            $i++;
        }while($count >= $i);
        
        $location_data = json_decode(json_encode($location_data));
        
        return view('frontend.property.property_category', compact('counter','location_data','properties1','url','type','properties','numOfpages','current_page','has_next_page','has_previous_page','next_page'));
        }
        else{
            $scityID = $data['search_text'];
            $spropID = $data['property_type'];
            
            if(empty($scityID)){
                $properties = Property::where(['property_for'=>$spropID])->paginate(20);
            }else{
                $properties = Property::where([[ 'city','=', $scityID], ['property_for', '=', $spropID]])->paginate(20);
            }
            $counterDb  = count($properties);
            foreach($properties as $key => $val)
            {
                $prop_type = PropertyType::where(['type_code' => $val->property_type])->first();
                $properties[$key]->property_type = $prop_type->name;
    
                $city_name = City::where(['id' => $val->city])->first();
                $properties[$key]->city_name = $city_name->name;
    
                $state_name = State::where(['id' => $val->state])->first();
                $properties[$key]->state_name = $state_name->name;
    
                $prop_img_count = PropertyImage::where(['property_id' => $val->id])->count();
                if($prop_img_count > 0)
                {
                    $prop_img = PropertyImage::where(['property_id' => $val->id])->first();
                    $properties[$key]->image_name = $prop_img->image_name;
                }
            }
            
        $client1 = new Client();
        $i = 1;
        $location_data = array();
        do{
            $location = $client1->request('GET', 'https://api.mycrm.com/locations?filters[]&page='.$i.'', [
                'headers' => [
                    'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
                    ]
                ]);
            $data1          = $location->getBody();
            $data1          = json_decode($data1, true);
            $loc            = $data1['location'];
            $location_data  = array_merge($location_data,$loc);
            $mod            = $data1['count'] % 100;
            if($mod != 0){
                $rem = 1;
            }else{
                $rem = 0;
            }
            $count          = (int)($data1['count'] / 100) + $rem;
            $i++;
        }while($count >= $i);
        
        $location_data = json_decode(json_encode($location_data));
        
        return view('frontend.property.property_category_offplan', compact('location_data','properties'));
        }
    }
    
    // contact-form 
     public function contactQuery(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // dd ($data);
            $to =['manjeet.singh@magicgroupinc.com','hrishabh@isupportcomputer.org'];
            $email = $to;
            // echo "<pre>"; print_r($messageData); die;
            $messageData = ['username'=>$data['username'],'email'=>$data['email'],'phone'=>$data['phone'],'query'=>$data['message']];

            Mail::send('emails.contact_query', $messageData, function($message) use($email){
                $message->to($email)->subject('User Send a Query');
            });

            return redirect()->back()->with('flash_message_success', 'Thanks we will contact you as soon as possible!');
        }
        return view('contact');
    }
    
    // career-form 
     public function careerQuery(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // dd ($data);
            $to =['manjeet.singh@magicgroupinc.com','hrishabh@isupportcomputer.org'];
            $email = $to;
            // echo "<pre>"; print_r($messageData); die;
            if(!empty($data['resume'])){
                $file_data = $data['resume'];
            }else{
                $file_data = 0;
            }
            $messageData = ['fullname'=>$data['fullname'],'email'=>$data['email'],'phone'=>$data['phone'],'course'=>$data['course'],'description'=>$data['description']];

             Mail::send('emails.career_temp', $messageData, function($message) use($email,$file_data){
                $message->to($email)->subject('Resume | User Send a Resume');
                if ($file_data != 0) {
                   
                        $message->attach($file_data->getRealPath(),
                        [
                            'as' => $file_data->getClientOriginalName(),
                            'mime' => $file_data->getClientMimeType(),
                        ]);
                        // echo "<pre>"; print_r($array_len); die;
                }
            });

            return redirect()->back()->with('flash_message_success', 'Thanks for your showing your interest we will contact you as soon as possible!');
        }
        return view('career');
    }
    
    public function req_api( Request $request ){
        $counter = $request->all();
        $hit = $counter['count'];
        $client = new Client();
        $prop = $client->request('GET', 'https://api.mycrm.com/properties?filters[]&sort_order=desc&page='.$hit.'', [
            'headers' => [
                'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
            ]
        ]);
        $data = $prop->getBody();
        $data = json_decode($data, true);
        $property_data = $data['properties'];
        $property_data = json_decode(json_encode($property_data),true);
        foreach($property_data as $key => $pro_api)
        { 
            if(!empty($pro_api['landlord'])){ 
                $landlord = $pro_api['landlord']; 
               if(!empty($landlord['id'])){
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

            $prop_api = new Property;
                $prop_api->p_id                 = $id;
                $prop_api->reference            = $reference;
                $prop_api->developer            = $developer;
                $prop_api->charges              = $charges;
                $prop_api->parking              = $parking;
                $prop_api->l_id                 = $loc_id;
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
        }
        return $hit;
    }
}