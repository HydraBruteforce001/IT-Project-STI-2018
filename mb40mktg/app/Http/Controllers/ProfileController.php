<?php

namespace App\Http\Controllers;

use App\Config\UserType;
use App\Config\VerificationStatus;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function getAllProfiles() {
        /*$profiles = Profile::select("*")
            ->join('users', 'tbl_profiles.user_id', '=', 'users.id')->get();*/
        $profiles = DB::select(DB::raw("
        SELECT *, profile.id FROM tbl_profiles profile
        INNER JOIN users u ON u.id = profile.user_id"));
        foreach ($profiles as $profile) {
            $profile->usertype_str = UserType::getUserTypeStr($profile->user_type);
            $profile->verified_str = VerificationStatus::getVerificationState($profile->verified);
        }
        return $profiles;
    }

    public function getProfile($id)
    {
        return $this->getByKeyProfile("profile.id", $id);
    }

    public function getUserProfile($id)
    {
        return $this->getByKeyProfile("profile.user_id", $id);
    }

    public function getByKeyProfile($key, $id){
        $profiles = DB::select(DB::raw("
        SELECT *, profile.id FROM tbl_profiles profile
        INNER JOIN users u ON profile.user_id = u.id
        WHERE " . $key . " = " . $id));

        foreach ($profiles as $profile) {
            $profile->usertype_str = UserType::getUserTypeStr($profile->user_type);
            $profile->verified_str = VerificationStatus::getVerificationState($profile->verified);
        }

        try {
            return response()->json($profiles[0], 200);
        } catch (\Exception $exception) {
            return $this->returnEmpty();
        }
    }

    public function createProfile(Request $request)
    {
        $newProfile = Profile::create($request->all());
        return response()->json($newProfile, 200);
    }

    public function updateProfile(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->update($request->all());
        return response()->json($profile, 200);
    }

    public function getAccountProfileByName(Request $request)
    {
        $fname = $request->header("fname");
        $lname = $request->header("lname");
        $filterUserTypeId = $request->header("usertype");

        $profileQuery = DB::select(DB::raw(
            "SELECT profile.*
            FROM tbl_profiles profile
            INNER JOIN users u ON profile.user_id = u.id 
            WHERE profile.last_name LIKE \"%" . $lname . "%\"
            AND profile.first_name LIKE \"%" . $fname . "%\"
            AND u.user_type = " . $filterUserTypeId));

        return response()->json($profileQuery, 200);
    }
}