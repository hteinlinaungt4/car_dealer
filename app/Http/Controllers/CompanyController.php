<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.company.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.create');
    }

    public function ssd(){
        $company=Company::query();
        return DataTables::of($company)
        ->addColumn('image', function($each){
            $imageUrl = $each->image ? asset('storage/company/' . $each->image) : "null";
            return '<img src="'.$imageUrl.'" alt="Image" style="width:100px;height:100px;border-radius:50%;">';
        })
        ->addColumn('actions',function($each){
            $edit = '<a href="'.route('company.edit',$each->id).'" class="text-primary shadow p-2"><i class="fa-regular fa-pen-to-square p-1 fw-bold"></i></a>';
            $delete='<a href="#" class=" delete_btn text-danger shadow  p-2" data-id="'.$each->id.'" ><i class="fa-solid fa-trash p-1 fw-bold"></i></a>';
            return '<div class="d-flex justify-content-center">'.
                    $edit.$delete
                    .'</div>';
        })
        ->rawColumns(['actions','image'])
        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validation=[
            'name' => 'required|unique:companies,name',
            'image' => 'required|mimes:jpg,jpeg,png|file',
        ];
        Validator::make($request->all(),$validation)->validate();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/company', $filename);
                $image['image'] = $filename;
            }
            $company = new Company();
            $company->name = $request->name;
            $company->image = $image['image'];
            $company->save();

            return redirect()->route('company.index')->with(['successmsg' => 'You are Created Successfully!']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company=Company::findorFail($id);
        return view('admin.company.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $company = Company::findOrFail($id);
        $validation=[
            'name' => 'required|unique:companies,name,' . $company->id,
            'image' => 'nullable|mimes:jpg,jpeg,png|file',
        ];
        Validator::make($request->all(),$validation)->validate();


        if ($request->hasFile('image')) {
            if ($company->image) {
                Storage::delete('public/company/' . $company->image);
            }

            $file = $request->file('image');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/company', $filename);

            $company->image = $filename;
        }

        $company->name = $request->name;
        $company->save();

        return redirect()->route('company.index')->with(['successmsg' => 'Company updated successfully!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);

        // Delete the associated image files
            if ($company->image) {
                Storage::delete('public/company/' . $company->image);
            }


        // Delete the vehicle record from the database
        $company->delete();

        $data=[
            'msg' => 'success',
        ];
        return response()->json($data, 200);
    }

    public function search(Request $request){
        $query = $request->key;
        $companies = Company::where('name', 'LIKE', "%{$query}%")->get();

        return response()->json($companies);
    }
}
