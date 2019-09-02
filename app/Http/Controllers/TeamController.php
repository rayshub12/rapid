<?php

namespace App\Http\Controllers;

use Image;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TeamController extends Controller
{
    // Add New Team Member
    public function addTeamMember(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $team = new Team();

            $team->name         = $data['name'];
            $team->designation  = $data['position'];
            $team->description  = $data['description'];

            // Upload User image/icon
            if ($request->hasFile('member_image')) {
                $image_tmp = Input::file('member_image');
                if ($image_tmp->isValid()) {

                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'Repid_Deals_Team_' . rand(1, 99999) . '.' . $extension;
                    $large_image_path = 'images/frontend/team_images/large/' . $filename;
                    // Resize image
                    Image::make($image_tmp)->resize(512, 512)->save($large_image_path);

                    // Store image in Testimonial folder
                    $team->image = $filename;
                }
            }
            $team->save();

            return redirect()->back()->with('flash_message_success', 'Team member Added Successfully!');
        }
        return view('admin.team.add_new_member');
    }
}
