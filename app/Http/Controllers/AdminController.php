<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\rdv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;


class AdminController extends Controller
{
    public function superadmin(){
        $admin = new Admin;
        $admin->name = 'superadmin';
        $admin->email = 'superadmin@gmail.com';
        $admin->password =Hash::make( 'azerty12345');
        $admin->is_superadmin = 1;

        $admin->save();
    }

    public function loginform(){

        return view('admin.loginform');

    }

    public function dashboard()
    {
        $times=array();
        $days=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
        $months=array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

        for($j=strtotime("9:00");$j<strtotime("18:00");$j+=30 * 60)
            array_push($times,date("H:i", $j));

        RdvController::MAJ();

        $rdvs=(rdv::all()->where('week','=',date("W"))
            ->where('day','=',getdate()['wday']-1))->sortBy('time');

        return view('admin.dashboard',['rdvs'=>$rdvs,'served'=>$rdvs
            ->where('etat','=','terminé')
            ,'missed'=>$rdvs->where('etat','=','raté')
            ,'times'=>$times,'days'=>$days,'months'=>$months]);
    }

    public function login(Request $request){

        if(Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            return redirect()->route('admin.dashboard')->with("success","you're logged in");
        }
        return back()->with('error','Invalid Email or Password');
    }

    public function logout(){

        Auth::guard('admin')->logout();

        return redirect()->route('admin.loginform')->with("success", "you're logged out successfully");

    }

    public function create(){

        return view('admin.create');

    }

    public function store(Request $request){
        $request->validate([
            '_token' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password =Hash::make( $request->password);

        $admin->save();

        return redirect()->route('admin.create')->with('success','admin created successfully');
    }

    public function index(){

        $admins = Admin::all()->where('is_superadmin',0);

        return view('admin.index',['admins'=>$admins]);

    }

    public function show($id){

        $admin = Admin::find($id);
        return view('admin.show',['admin'=>$admin]);

    }

    public function edit($id){

        $admin = Admin::find($id);
        return view('admin.edit',['admin'=>$admin]);

    }

    public function update(Request $request, $id){
        $request->validate([
            '_token' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($id)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password =Hash::make( $request->password);

        $admin->save();

        return back()->with('success','admin updated successfully');
    }
}
