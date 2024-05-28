<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Http\Requests\Business\UpdateRequest;

class BusinessController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:business.index')->only(['index']);
        $this->middleware('can:business.edit')->only(['update']);
    
    
    }

    public function index(){
        $business=Business::where('id',1)->firstOrFail();
        return view('admin.business.index',compact('business'));

    }

    public function update(UpdateRequest $request, Business $business)
    {

        $image_name = $business->logo;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path("/image"), $image_name);
        }


        
        $data = $request->all();
       
        $data['logo'] = $image_name;
       
    
        $business->update($data);

    
        return redirect()->route('business.index');
    }
    
}

