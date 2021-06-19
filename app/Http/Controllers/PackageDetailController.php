<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;
use App\PackageDetail;


class PackageDetailController extends Controller
{
    public function show_all_packages()
    {
        $package_details = PackageDetail::all();
        return response()->json($package_details);
    }

    public function create(Request $request)
    {
        try{
            $request->validate([
                'price' => 'required', 
                'time_span' => 'required'    
            ]);
            $package_detail = PackageDetail::create($request->all());
        }
        catch(\Exception $e){
            echo "Error".$e->getMessage();
            return response()->json([
                'message' => 'faulty connection, try again !',
                'error' => $e->getMessage(),
            ]);
            echo $e->getMessage();
        }
    return response()->json([
        'message' => ' Package Created Successfully',
        'error' => 'no',
        'Api_result' => $package_detail
        // Add the remaining code part
    ]);
    }

    public function update(Request $request, $id)
    {
        try{
            $request->validate( [
              'price' => 'required',
              'time_span' => 'required',
           ]);
           $package_detail = PackageDetail::findorfail($id);
           $data = $request->all();

           $package_detail->update($data);        
        } 
        catch(\Exception $e){
            echo "Error".$e->getMessage();
            return response()->json([
                'message' => 'unsuccessful',
                'error' => $e->getMessage(),
            ]);
        }
    return response()->json([
        'message' => 'User updated succesfully',
        'system_user' => $package_detail,
     ]);

    // return redirect('systemuser')->withType('success')->withMessage('User Updated');
    }

    public function destroy($id){
        $package = PackageDetail::findorfail($id);
        $package->destroy($id);
        // return response()->json([
        //     'message' => 'Company Deleted succesfully'
        // ]);
        return redirect('admin.package.index')->withType('danger')->withMessage('Company Deleted successfully');
    }

    public function package_info()
    {
        $package_details = PackageDetail::pluck('price', 'time-span');;
        return response()->json($package_details);
    }

    public function show_packages()
    {
        $package_details = PackageDetail::all();
        // return response()->json($package_details);
        return view('admin.package.index', compact('package_details'));
    }
}