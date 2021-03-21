<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\companies\Company;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Mail;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the listing of companies.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companies = Company::where("status", "=", "1")->get();
        $data['companies'] = $companies;
        return view('companies.list', $data);
    }

     /**
     * Show the listing of companies.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fetch(Request $request)
    {
        $companies = Company::select("id", "name")->where('name', 'LIKE', $request->search . '%')->get();
        return response()->json($companies);
    }

    /**
     * Show the listing of companies.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(Request $request)
    {
        if(!empty($request->all())){
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:company',
                'photo' => 'required|mimes:jpeg,jpg,png|dimensions:min_width=100,min_height=100|max:512',
                'website' => 'required|max:255|unique:company',
            ]);
            $filename = 'companies/'. str_replace(' ', '_', $request->name) . '/'.$request->file('photo')->getClientOriginalName();
            Storage::disk('s3')->put($filename, file_get_contents($request->file('photo')));
            $request->photo = Storage::disk('s3')->url($filename);
    
            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->logo = $request->photo;
            $company->website = $request->website;
            $company->save();
            
            try{
                /*
                * Using snd box environment will not work in live mail sending
                */
                Mail::send('emails.companies.companyCreated', $company->toArray(), function($message) use ($company) {
                    $message->to($company->email);
                    $message->subject('Mailgun Testing');
                });
            }catch(\Exception $e){
                return redirect('companies')->withErrors(['Unable to send mail']);
            }

            return redirect('companies');
        }

        return view('companies.add');
    }

    /**
     * Show the edit company.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Request $request)
    {   
        $segments = request()->segments();
        $id = $segments[2];
        $company = Company::findOrFail($id);
        
        if(!empty($request->all())){
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'photo' => 'mimes:jpeg,jpg,png|dimensions:min_width=100,min_height=100|max:512',
                'website' => 'required|max:255',
            ]);

            if(!empty($request->file('photo'))){
                $filename = 'companies/'. str_replace(' ', '_', $request->name) . '/'.$request->file('photo')->getClientOriginalName();
                Storage::disk('s3')->put($filename, file_get_contents($request->file('photo')));
                $request->photo = Storage::disk('s3')->url($filename);
                $company->logo = $request->photo;
            }


            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;
            $company->save();
            return redirect('companies');
            
        }

        $data['company_data'] = $company;
        return view('companies.edit', $data);
    }

    /**
     * Show the delete company.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        if(!empty($request->toDelete) && $request->toDelete == 1){
            $record = Company::findOrFail($id);
            $record->delete();
            $record->status = 0;
            $record->save();
        }
        return redirect('companies');
    }

}
