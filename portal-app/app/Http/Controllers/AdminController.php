<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\AdminsRole;
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
        Session::put('page', 'update_password');
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
        Session::put('page', 'update_details');
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

    // Sub admin Display method
    public function subadmin(){
        Session::put('page', 'subadmins');
        $subadmins = Admin::where('type', 'subadmin')->get();

        return view('admin.subadmins.subadmins')->with(compact('subadmins'));
    }

    // Update Sub Admin Status
    public function updateSubAdminStatus(Request $request){

        if($request->ajax()){

            $data = $request->all();

            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }

            Admin::where('id', $data['subadmin_id'])->update(['status'=>$status]);

            return response()->json(['status'=> $status, 'subadmin_id' => $data['subadmin_id']]);

        }

       

    }

    // Add/edit sub admin
    public function addEditSubAdmin(Request $request, $id=null){
        if($id==""){
            $title = "Add Sub Admin";
            $subadmindata = new Admin;
            $message = "Sub admin added succesfully";
        }else{
            $title = "Edit Sub Admin Details";
            $subadmindata = Admin::find($id);
            $message = "Sub admin data updated succesfully";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if($id==""){

                $subAdminCount = Admin::where('email', $data['email'])->count();

                if($subAdminCount>0){

                    return redirect()->back()->with('error_message', 'Sub admin email already exists');
                }
            }

            $rules = [
                'name' => 'required',
                'mobile' => 'required|numeric',
                'email' => 'email|required',
                'password' => 'required',
                'image' => 'image'

            ];

            $customMessages = [
                'name.required' => 'Name is required',
                'mobile.required' => 'Mobile number is required',
                'mobile.numeric' => 'Valid phone number is required',
                'email.email' => 'Valid email is required',
                'email.required' => 'Email is required',
                'image.image' => 'Valid image is required'

            ];

            $this->validate($request, $rules, $customMessages);

            // Image set up code
            if($request->hasFile('image')){
                $manager = new ImageManager(new Driver());
    
                $imageTemp = $request->file('image');
    
                if($imageTemp->isValid()){
    
                    $extension = $imageTemp->getClientOriginalExtension();
    
                    $imagename = rand(111, 99999).'.'.$extension;
    
                    $imagePath = 'admin/dist/img/photos/'.$imagename;
    
                    $image = $manager->read($imageTemp);
    

                    $image->toPng()->save($imagePath);
    
    
                }
            }else if(!empty($data['current_image'])){
                $imagename = $data['current_image'];
            }else{
                $imagename = "";
            }
    
            $subadmindata->image = $imagename;
            $subadmindata->name = $data['name'];
            $subadmindata->mobile = $data['mobile'];
            if ($id == ""){
                $subadmindata->email = $data['email'];
                $subadmindata->type = 'subadmin';
            }
            if($data['password'] != " "){
                $subadmindata->password = bcrypt($data['password']);
            }
            $subadmindata->staff_id = 0;
           
            $subadmindata->status = 1;
            $subadmindata->save();

            return redirect('admin/subadmins')->with('success_message', $message);
        }
        return view('admin.subadmins.add_edit_subadmins')->with(compact('title', 'subadmindata'));
    }

    // Update Roles
    public function updateSubadminRoles(Request $request, $id){
        $title = "Update Roles and Permissons for Sub admins";

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            // Delete the roles set before updating
            AdminsRole::where('admin_id', $id)->delete();

            foreach ($data as $key => $value) {
                if(isset($value['view'])){
                    $view = $value['view'];
                }else{
                    $view = 0;
                }
                if(isset($value['edit'])){
                    $edit = $value['edit'];
                }else{
                    $edit = 0;
                }
                if(isset($value['full'])){
                    $full = $value['full'];
                }else{
                    $full = 0;
                }
                
                
            }

            

            // Save the roles accepted to the database
                $role = new AdminsRole;
                $role->admin_id = $id;
                $role->module = $key;
                
                $role->view_access = $view;
                $role->edit_access = $edit;
                $role->full_access = $full;
                $role->save();
            
           

            $message = "Roles succesfully updated";

            return redirect()->back()->with('success_message', $message);

        }

        $subadminRoles = AdminsRole::where('admin_id', $id)->get()->toArray();
        return view('admin.subadmins.update_roles')->with(compact('title', 'id', 'subadminRoles'));
    }

    // Update Instructors Details
    public function updateInstructors(Request $request, $slug){
        if($slug=="personal"){

        }else if($slug=="course"){

        }else if($slug=="payment"){

        }
        return view('admin.instructors.update_instructors')->with(compact('slug'));
    }

    // Delete Sub admin
    public function deleteSubadmin($id){
        Admin::where('id', $id)->delete();

        return redirect()->back()->with('success_message', 'subadmin deleted succesfully');
    }
    // Admin Logout
    public function logout(){
        Auth::guard('admin')->logout();

    return redirect()->back();
    }
}
