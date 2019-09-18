<?php

namespace App\Mail;
namespace App\Http\Controllers;

use Image;
use Storage;
use App\City;
use App\State;
use App\Amenity;
use App\Country;
use App\Property;
use App\Location;
use App\PropertyType;
use App\PropertyImage;
use App\FloorImage;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class PropertyController extends Controller
{
    // Add Property Types
    public function addPropertyType(Request $request)
    {
        if ($request->isMethod('post')) {
            
            $request->validate([
                'property_type_name' => 'required',
            ]);
            $data = $request->all();
            // dd($data);
            if (!empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }

            $url = str_slug($data['property_type_name']);

            $property_type = PropertyType::create([
                'name'          => $data['property_type_name'],
                'type_code'     => $data['type_code'],
                'url'           => $url,
                'description'   => $data['description'],
                'status'        => $status
            ]);

            return redirect('/admin/prop_type')->with('flash_message_success', 'Property Type Created Successfully!');
        }
        return view('admin.property.add_property_type');
    }

    // View all Property Types
    public function propertyTypes()
    {
        $property_type = PropertyType::orderBy('created_at', 'desc')->get();

        return view('admin.property.property_type', compact('property_type'));
    }

    // Enable Property Type
    public function enablePropertyType($id = null)
    {
        if (!empty($id)) {
            PropertyType::where('id', $id)->update(['status' => 1]);
            return redirect()->back()->with('flash_message_success', 'Property Type Enabled Successfully!');
        }
    }

    // Disable Property Type
    public function disablePropertyType($id = null)
    {
        if (!empty($id)) {
            PropertyType::where('id', $id)->update(['status' => 0]);
            return redirect()->back()->with('flash_message_success', 'Property Type Disabled Successfully!');
        }
    }

    // Get Property Location
    public function getLocation(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = Location::where('tower', 'LIKE', "%{$query}%")->orWhere('community', 'LIKE', "%{$query}%")->orWhere('sub_community', 'LIKE', "%{$query}%")->orderBy('created_at', 'desc')->distinct()->get();
            $output = '<select class="get_location">';
            foreach ($data as $row) {
                $flag = '<span class="flag_name">' . $row->l_id . '</span>';
                $output .= '<option value='.$row->l_id.' id="type_search">' .$row->tower.', '. $row->sub_community.', '.$row->community.', '.$row->city . '</option>';
            }
            $output .= '</select>';
            echo $output;
            // echo $flag;
        }
    }

    // Add New Property
    public function addProperty(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            $location_data = Location::where('l_id', $data['location_id'])->first();

            // echo"<pre>";print_r($l_city);die;

            if (!empty($data['feature'])) {
                $featured = 1;
            } else {
                $featured = 0;
            }

            if (!empty($data['commercial'])) {
                $commercial = 1;
            } else {
                $commercial = 0;
            }

            if(!empty($data['amenity'])){
                $amenities = $data['amenity'];
                $amenity = implode(',', $amenities);
            }else{
                $amenity = '';
            }

            $reference_code = 'rpdeals-'.rand(1000001, 999999999);
            // echo"<pre>";print_r($reference_code);die;

            $property = Property::create([
                'pro_title'             => $data['property_name'],
                'reference'              => $reference_code,
                'offering_type'         => $data['property_for'],
                't_name'                => $data['property_type'],
                'project_status'        => $data['project_status'],
                'price_value'           => $data['property_price'],
                'pro_description'       => $data['description'],
                'size'                  => $data['property_area'],
                't_category'            => $data['property_category'],
                'furnished'          => $data['furnish_type'],
                'occupancy'             => $data['occupancy'],
                'status'                => $data['availability'],
                'bedrooms'              => $data['bedrooms'],
                'bathrooms'             => $data['bathrooms'],
                'parking'               => $data['parking'],
                'developer'             => $data['property_developer'],
                'freehold'              => $data['property_tenure'],
                'floor_number'          => $data['floor_number'],
                'street_number'         => $data['street_number'],
                'street_name'           => $data['street_name'],
                'licenses_number'       => $data['rera_number'],
                'amenities_name'        => $amenity,
                'unit_number'           => $data['unit_no'],
                'city'                  => $location_data['city'],
                'community'             => $location_data['community'],
                'sub_community'         => $location_data['sub_community'],
                'tower'                 => $location_data['tower'],
                'l_id'                  => $data['location_id'],
                'add_by'                => Auth::user()->id
            ]);

            // Upload image
            if ($request->hasFile('file')) {
                $image_array = Input::file('file');
                // if($image_array->isValid()){
                $array_len = count($image_array);
                for ($i = 0; $i < $array_len; $i++) {
                    // $image_name = $image_array[$i]->getClientOriginalName();
                    $image_size = $image_array[$i]->getClientSize();
                    $extension = $image_array[$i]->getClientOriginalExtension();
                    $filename = 'Rapid_Leads_' . rand(1, 99999) . '.' . $extension;
                    // $watermark = Image::make(public_path('/images/frontend/images/logo.png'));
                    $large_image_path = public_path('images/frontend/property_images/large/' . $filename);
                    // Resize image
                    Image::make($image_array[$i])->resize(960, 540)->save($large_image_path);

                    // Store image in property folder
                    $property->image = $filename;
                    $propertyimage = PropertyImage::create([
                        'image_name' => $filename,
                        'image_size' => $image_size,
                        'property_id' => $property->id,
                    ]);
                }
            } else {
                $filename = "default.png";
                $property->image = "default.png";
                $propertyimage = PropertyImage::create([
                    'image_name' => $filename,
                    'image_size' => '7.4',
                    'property_id' => $property->id,
                ]);
            }
            
            
            // floor plan Upload image
            if ($request->hasFile('file1')) {
                $image_array1 = Input::file('file1');
                // if($image_array->isValid()){
                $array_len1 = count($image_array1);
                for ($i = 0; $i < $array_len1; $i++) {
                    // $image_name = $image_array[$i]->getClientOriginalName();
                    $image_size1 = $image_array1[$i]->getClientSize();
                    $extension1 = $image_array1[$i]->getClientOriginalExtension();
                    $filename1 = 'Rapid_Leads_' . rand(1, 99998) . '.' . $extension1;
                    // $watermark = Image::make(public_path('/images/frontend/images/logo.png'));
                    $large_image_path1 = public_path('images/frontend/property_images/large/' . $filename1);
                    // Resize image
                    Image::make($image_array1[$i])->resize(960, 540)->save($large_image_path1);

                    // Store image in property folder
                    // $property->image = $filename1;
                    $propertyimage1 = FloorImage::create([
                        'image_name' => $filename1,
                        'image_size' => $image_size1,
                        'property_id' => $property->id,
                    ]);
                }
            } else {
                $filename1 = "default.png";
                $property->image = "default.png";
                $propertyimage1 = FloorImage::create([
                    'image_name' => $filename1,
                    'image_size' => '7.4',
                    'property_id' => $property->id,
                ]);
            }

            return redirect('/admin/property')->with('flash_message_success', 'Property Submited Successfully!');
        }

        $countrylist = Country::where('iso2', 'AE')->get();
        $states = State::where('country', 'AE')->get();
        $propertytype = PropertyType::where('status', 1)->orderBy('name', 'asc')->get();
        $amenities = Amenity::where('status', 1)->orderBy('name', 'asc')->get();
        $location = Location::orderBy('created_at', 'desc')->distinct()->get();
        return view('admin.property.add_property', compact('propertytype', 'countrylist', 'states', 'amenities', 'location'));
    }

    // Edit Property and Update Property Information
    public function editProperty(Request $request, $id=null)
    {
        
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $p_detail = Property::where('reference', $id)->first();

            $location = Location::where('l_id', $data['location_id'])->first();

            // echo "<pre>"; print_r($location); die;
            if(!empty($data['amenity'])){
                $amenities = $data['amenity'];
                $amenity = implode(',', $amenities);
            }else{
                $am = Property::select('amenities_name')->where('reference', $id)->first();
                // echo "<pre>"; print_r($am); die;
                $amenity = $am->amenities_name;
            }

            // Upload image
            if ($request->hasFile('file')) {
                $image_array = Input::file('file');
                // if($image_array->isValid()){
                $array_len = count($image_array);
                for ($i = 0; $i < $array_len; $i++) {
                    // $image_name = $image_array[$i]->getClientOriginalName();
                    $image_size = $image_array[$i]->getClientSize();
                    $extension = $image_array[$i]->getClientOriginalExtension();
                    $filename = 'Rapid_Leads_' . rand(1, 99999) . '.' . $extension;
                    // $watermark = Image::make(public_path('/images/frontend/images/logo.png'));
                    $large_image_path = public_path('images/frontend/property_images/large/' . $filename);
                    // Resize image
                    Image::make($image_array[$i])->resize(960, 540)->save($large_image_path);

                    // Store image in property folder
                    PropertyImage::create([
                        'image_name' => $filename,
                        'image_size' => $image_size,
                        'property_id' => $p_detail->id,
                    ]);

                    // if (!empty($filename)) {
                    //     PropertyImage::where(['property_id' => $id])->update(['image_name' => $filename, 'image_size' => $image_size]);
                    // }
                }
            } else {
                $propertyimg_count = PropertyImage::where(['property_id' => $id])->count();
                if(empty($propertyimg_count)){
                    $filename = "default.png";
                    // $property->image = "default.png";
                    PropertyImage::create([
                        'image_name' => $filename,
                        'image_size' => '7',
                        'property_id' => $p_detail->id,
                    ]);
                }
            }
            
            // floor plan Upload image
            if ($request->hasFile('file1')) {
                $image_array1 = Input::file('file1');
                // if($image_array->isValid()){
                $array_len1 = count($image_array1);
                for ($i = 0; $i < $array_len1; $i++) {
                    // $image_name = $image_array[$i]->getClientOriginalName();
                    $image_size1 = $image_array1[$i]->getClientSize();
                    $extension1 = $image_array1[$i]->getClientOriginalExtension();
                    $filename1 = 'Rapid_Leads_' . rand(1, 99999) . '.' . $extension1;
                    // $watermark = Image::make(public_path('/images/frontend/images/logo.png'));
                    $large_image_path1 = public_path('images/frontend/property_images/large/' . $filename1);
                    // Resize image
                    Image::make($image_array1[$i])->resize(960, 540)->save($large_image_path1);

                    // Store image in property folder
                    FloorImage::create([
                        'image_name' => $filename1,
                        'image_size' => $image_size1,
                        'property_id' => $p_detail->id,
                    ]);

                    // if (!empty($filename1)) {
                    //     FloorImage::where(['property_id' => $id])->update(['image_name' => $filename1, 'image_size' => $image_size1]);
                    // }
                }
            } else {
                $propertyimg_count1 = FloorImage::where(['property_id' => $id])->count();
                if(empty($propertyimg_count1)){
                    $filename1 = "default.png";
                    // $property->image = "default.png";
                    FloorImage::create([
                        'image_name' => $filename1,
                        'image_size' => '7',
                        'property_id' => $p_detail->id,
                    ]);
                }
            }
            
            Property::where('reference', $id)->update([
                'offering_type'=>$data['property_for'],'pro_title'=>$data['property_name'],'t_name'=>$data['property_type'], 'project_status'=>$data['project_status'],
                'price_value'=>$data['property_price'],'pro_description'=>$data['description'], 'developer'=>$data['property_developer'],'parking'=>$data['parking'],'size'=>$data['property_area'],
                't_category'=>$data['property_category'],'furnished'=>$data['furnish_type'],'bedrooms'=>$data['bedrooms'],'bathrooms'=>$data['bathrooms'],'licenses_number' => $data['rera_number'],
                'occupancy'=>$data['occupancy'],'status'=>$data['availability'], 'freehold'=>$data['property_tenure'],'floor_number'=>$data['floor_number'],'amenities_name'=>$amenity,'unit_number'=>$data['unit_no'],'street_number'=>$data['street_number'],
                'street_name'=>$data['street_name'],'city'=>$location['city'],'community'=>$location['community'],'sub_community'=>$location['sub_community'],'tower'=>$location['tower'],
            ]);

            return redirect('/admin/property')->with('flash_message_success', 'Property Updated Successfully!');
        }

        $property = Property::where('reference', $id)->first();
        $property = json_decode(json_encode($property));

        // echo "<pre>"; print_r($property); die;

        $propertytype = PropertyType::where('status', 1)->orderBy('name', 'asc')->get();
        $amenities = Amenity::where('status', 1)->orderBy('name', 'asc')->get();
        $location = Location::orderBy('created_at', 'desc')->distinct()->get();

        return view('admin.property.edit_property', compact('property', 'propertytype', 'amenities', 'location'));
    }

    // Delete Property image on edit page
    public function deletePropertyImage(Request $request, $id=null)
    {
        if(!empty($id))
        {
            PropertyImage::where('id', $id)->delete();
            return redirect()->back()->with('flash_message_success', 'Image Deleted Successfully!');
        }
    }
    
    // Delete Floor Plan image on edit page
    public function deleteFloorPlanImage(Request $request, $id=null)
    {
        if(!empty($id))
        {
            FloorImage::where('id', $id)->delete();
            return redirect()->back()->with('flash_message_success', 'Image Deleted Successfully!');
        }
    }

    // Creating unique Slug
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Property::class, 'url', $request->property_name, ['unique' => true]);
        // echo "<pre>"; print_r($slug); die;
        return response()->json(['slug' => $slug]);
    }

    // Getting City List according to State
    public function getCityList(Request $request)
    {
        $cities = City::where("state_id", $request->state_id)->pluck("name", "id");
        return response()->json($cities);
    }

    // Add Amenities
    public function addAmenity(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            // dd($data);
            if(!empty($data['status'])){
                $status = 0;
            }else {
                $status = 1;
            }

            $amenity = Amenity::create([
                'name'          => $data['amenity_name'],
                'amenity_code'  => $data['amenity_code'],
                'description'   => $data['description'],
                'status'        => $status
            ]);

            return redirect('/admin/amenities')->with('flash_message_success', 'Amenity Added Successfully!');
        }
        return view('admin.property.add_amenities');
    }

    // View All Amenities in List
    public function allAmenity()
    {
        $amenities = Amenity::orderBy('created_at', 'desc')->get();

        return view('admin.property.amenities', compact('amenities'));
    }

    // Enable Amenity
    public function enableAmenity($id=null)
    {
        if(!empty($id)){
            Amenity::where('id', $id)->update(['status' => '1']);
            return redirect()->back()->with('flash_message_success', 'Amenity Enabled Successfully!');
        }
    }

    // Disable Amenity
    public function disableAmenity($id=null)
    {
        if(!empty($id)){
            Amenity::where('id', $id)->update(['status'=> '0']);
            return redirect()->back()->with('flash_message_success', 'Amenity Disabled Successfully!');
        }
    }

    // Delete Amenity
    public function deleteAmenity($id=null)
    {
        if(!empty($id)){
            Amenity::where('id', $id)->delete();
            return redirect()->back()->with('flash_message_success', 'Amenity Deleted Successfully!');
        }
    }

    // View All Property in Dashboard
    public function allProperty()
    {
        $properties = Property::orderBy('created_at', 'desc')->paginate(10);
    
        return view('admin.property.view_property', compact('properties'));
    }

    // Property Enquiry Form
    public function enquiryForm(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            echo "<pre>"; print_r($data); die;
        }
        return redirect()->back();
    }

    // List Your property
    public function listYourProperty(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if(!empty($data['term_condition'])){
                $term_condition = 'Accpeted';
            }else{
                $term_condition = 'Non Accpeted';
            }
            if(!empty($data['privacy'])){
                $privacy = 'Accpeted';
            }else{
                $privacy = 'Not Accpeted';
            }

            // $country = json_encode(Country::where('iso2', $data['country'])->pluck('name'));
            // $state = json_encode(State::where('id', $data['state'])->pluck('name'));
            // $city = json_encode(City::where('id', $data['city'])->pluck('name'));

            // Property data email for List Property by User
            $to =['manjeet.singh@magicgroupinc.com','abhishek87@magicgroupinc.com'];
            $email = $to;
            // if(!empty($data['file'])){
            //     $file_data = $data['file'];
            // }else{
            //     $file_data = 0;
            // }
            $messageData = ['office_location'=>$data['office'],'prefix'=>$data['prefix'],'fname'=>$data['fname'],'lname'=>$data['lname'],
                            'phone'=>$data['phone'],'email'=>$data['email'],'building_no'=>$data['building_no'],'building_name'=>$data['building_name'],
                            'community'=>$data['community'],'emirate'=>$data['emirate'],'property_type'=>$data['property_type'],'bedrooms'=>$data['bedrooms'],
                            'property_area'=>$data['property_area'],'considering_for'=>$data['considering_for'],'term_condition'=>$term_condition,
                            'privacy'=>$privacy];
            
                // echo "<pre>"; print_r($messageData); die;

            Mail::send('emails.list_property', $messageData, function($message) use($email){
                $message->to($email)->subject('List User Property | User Send Property Details');
                // if ($file_data != 0) {
                //     $array_len = count($file_data);
                //     for ($i = 0; $i < $array_len; $i++) {
                //         $message->attach($file_data[$i]->getRealPath(),
                //         [
                //             'as' => $file_data[$i]->getClientOriginalName(),
                //             'mime' => $file_data[$i]->getClientMimeType(),
                //         ]);
                //         // echo "<pre>"; print_r($array_len); die;
                //     }
                // }
            });

            return redirect()->back()->with('flash_message_success', 'Property Submitted Successfully!');
        }

        $property_type = PropertyType::orderBy('name', 'asc')->get();

        return view('frontend.property.list_property', compact('property_type'));
    }

    // Delete Property
    public function deleteProperty($id=null)
    {
        if(!empty($id))
        {
            Property::where('reference', $id)->delete();
            return redirect()->back()->with('flash_message_success', 'Property Deleted Successfully!');
        }
    }

    // List Your Property New
    public function listYourProperty2(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            echo "<pre>"; print_r($data); die;  
        }

        return view('frontend.property.list_property_2');
    }

    // Consume API Data
    // public function apiData(Request $request)
    // {
    //     $client = new Client();
    //     $prop = $client->request('GET', 'https://api.mycrm.com/properties?filters[offering_type]=sale&per_page=20', [
    //         'headers' => [
    //             'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
    //         ]
    //     ]);

    //     $data = $prop->paginate(20);

    //     $data = $data->getBody();
    //     // $data = $data->paginate(10);
    //     $data = json_decode($data, true);
    //     $property_data = $data['properties'];
    //     $property_data = json_decode(json_encode($property_data));
        
    //     // echo "<pre>"; print_r($property_data); die;

    //     return view('frontend.api', compact('property_data'));
    // }

    // View Single Api Property
    // public function apiProperty($id=null)
    // {
    //     $client = new Client();
    //     $prop = $client->request('GET', 'https://api.mycrm.com/properties/'.$id, [
    //         'headers' => [
    //             'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
    //         ]
    //     ]);

    //     $prop_all = $client->request('GET', 'https://api.mycrm.com/properties', [
    //         'headers' => [
    //             'Authorization' => 'Bearer 6ad4485a523c28cf90e5cbe9d185dfbd11fc422f',
    //         ]
    //     ]);

    //     // Single Property
    //     $data = $prop->getBody();
    //     $data = json_decode($data, true);
    //     $property_data = $data['property'];
    //     $property_data = json_decode(json_encode($property_data));

    //     // All Property
    //     $data = $prop_all->getBody();
    //     $data = json_decode($data, true);
    //     $property_all = $data['properties'];
    //     $property_all = json_decode(json_encode($property_all));
        
    //     // echo "<pre>"; print_r($property_data); die;

    //     return view('frontend.property.api_single_property', compact('property_data', 'property_all'));
    // }

}