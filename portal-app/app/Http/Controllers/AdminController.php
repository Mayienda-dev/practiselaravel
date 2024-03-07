<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    // Admin Login
    public function login(Request $request){
        if($request ->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:40'

            ];

            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid email is required',
                'password.required' => 'Password is required'
            ];

            $this->validate($request, $rules, $customMessages);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password']])){

                // Setting up cookies for remember me
                if(isset($data['remember'])&&!empty($data['remember'])){

                    setcookie("email", $data["email"], time()+3600);
                    setcookie("password", $data["password"], time()+3600);

                }else{
                    setcookie("email", "");
                    setcookie("password", "");
                }

                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }

        return view('admin.login');
    }

    // Admin Dashboard
    public function dashboard(){
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }

    // Admin update password
    public function updatePassword(Request $request){
        Session::put('page', 'update-password');
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'current_pwd' => 'required|max:40',
                'new_pwd' => 'required|max:40',
                'confirm_pwd' => 'required|max:40'
            ];

            $customMessages = [
                'current_pwd.required' => 'Current Password is required',
                'new_pwd' => 'New password is required',
                'confirm_pwd' => 'Confirm password is required'
            ];

            $this->validate($request, $rules, $customMessages);

            if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
                if($data['new_pwd']==$data['confirm_pwd']){

                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);

                    return redirect()->back()->with('success_message', 'password updated succesfully');
                }else{
                    return redirect()->back()->with('error_message', 'Your new and confirm password do not match');
                }
            }
        }

        return view('admin.settings.update_password');
    }

    // Admin check current password
    public function checkCurrentPwd(Request $request){
        $data = $request->all();

        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){

            return "true";

        }else{
            
            return "false";
        }
    }
    
    // Admin update Details
    public function updateDetails(Request $request){
        Session::put('page', 'update-details');
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            
            $rules= [
                'admin_name' => 'required',
                'admin_mobile' => 'required|digits:10'
            ];

            $customMessages = [
                'admin_name.required' => 'Name is required',
                'admin_name.alpha' => 'Valid name is required',
                'admin_mobile.required' => 'Mobile number is required',
                'admin_mobile.digits' => 'Valid phone number is required'

            ];

            $this->validate($request, $rules, $customMessages);

            // Updating Admin Image
            if($request->hasFile('admin_image')){
                $manager = new ImageManager(new Driver());

                if($request->hasFile('admin_image')){
                    $image_tmp = $request->file('admin_image');

                    if($image_tmp->isValid()){

                        $extension = $image_tmp->getClientOriginalExtension();
                        
                        $imageName = rand(111, 99999).'.'.$extension;

                        $imagePath = 'admin/dist/img/photos/'.$imageName;

                        $image = $manager->read($image_tmp);
                        $image->scaleDown(width:250);
                        $image->scaleDown(height:300);
                        $image->toPng()->save($imagePath);
                    }

                }

            
            }elseif(!empty($data['current_image'])){
                $imageName = $data['current_image'];
            }else{
                $imageName = " ";
            }
           

            Admin::where('email', Auth::guard('admin')->user()->email)->update(['name'=>$data['admin_name'], 'mobile'=>$data['admin_mobile'],'image'=>$imageName]);

            return redirect()->back()->with('success_message', 'Admin details succesfully updated');
        }

        return view('admin.settings.update_details');
    }

    // Sub admins methods
    public function subadmin(){
        $subadmins = Admin::where('type', 'subadmin')->get();

        return view('admin.subadmins.subadmins')->with(compact('subadmins'));
    }
    // Admin Logout
    public function logout(){
        Auth::guard('admin')->logout();

    return redirect()->back();
    }
}
