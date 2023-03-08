<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    public function index(){
        $users = User::all();
        return view('client.index',['users'=>$users]);
    }

    public function create(){
        return view('client.create');
    }

    public function store(Request $request){
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'birthday' => ['required','date'],
            'phonenumber' => ['required','digits:10','unique:users'],
            'cin' => ['nullable','string', 'max:255','unique:users'],
            'email' => ['nullable','string', 'email', 'max:255', 'unique:users'],
            'numero_securite_sociale' => ['nullable','string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthday' => $request->birthday,
            'phonenumber' => $request->phonenumber,
            'cin' => $request->cin,
            'email' => $request->email,
            'numero_securite_sociale'=>$request->numero_securite_sociale,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('client.create')->with('success','client created successfully');
    }

    public function show($id){

        $client = User::find($id);
        return view('client.show',['client'=>$client]);

    }

    public function edit($id){

        $client = User::find($id);
        return view('client.edit',['client'=>$client]);

    }

    public function update(Request $request, $id){
        $request->validate([
            '_token' => ['required'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'birthday' => ['required','date'],
            'phonenumber' => ['required','digits:10',Rule::unique('users')->ignore($id)],
            'cin' => ['nullable','string', 'max:255',Rule::unique('users')->ignore($id)],
            'email' => ['nullable','string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'numero_securite_sociale' => ['nullable','string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::find($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->birthday = $request->birthday;
        $user->phonenumber = $request->phonenumber;
        $user->numero_securite_sociale = $request->numero_securite_sociale;
        $user->cin = $request->cin;
        $user->password =Hash::make( $request->password);

        $user->save();
        return back()->with('success','client updated successfully');
    }

    
    // function to get user info
    public function clientprofile(){
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    public function index2(){
        $user = Auth::user();
        return view('client/usertraitement', compact('user'));
    }

    public function clientupdate(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('dashboard');
    }
    
    // to get user's treatements
    public function getUserTraitements(Request $request, User $user){
        $traitements = $user->treatements;
    return view('client/usertraitement', compact('traitements'));
    }
}
