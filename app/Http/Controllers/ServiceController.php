<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{

    public function index()
    {
        return view("service.index",['services'=>Service::all()]);
    }

    public function create()
    {
        return view("service.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:10','unique:services'],
            'Designation' =>['required','string', 'max:255'],
            'Description' =>['required','string']
        ]);
        $service = new Service();
        $service->code = $request->code;
        $service->Designation = $request->Designation;
        $service->Description = $request->Description;

        $service->save();
        return back()->with('success','service Added successfully');
    }

    public function show($id)
    {
        return view("service.show",['service'=>Service::find($id)]);
    }

    public function edit($id)
    {
        return view("service.edit",['service'=>Service::find($id)]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:10',Rule::unique('services')->ignore($id)],
            'Designation' =>['required','string', 'max:255'],
            'Description' =>['required','string']
        ]);
        $service = Service::find($id);
        $service->code = $request->code;
        $service->Designation = $request->Designation;
        $service->Description = $request->Description;

        $service->save();
        return back()->with('success','service Updated successfully');
    }

    public function destroy($id)
    {
        return back();
    }
}
