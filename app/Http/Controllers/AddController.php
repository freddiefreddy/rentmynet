<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use DB;
use App\Add;


class AddController extends Controller
{
    public function all()
    {
        $adds = Add::all();
        // return response()->json($adds);
        return view('admin.add.index', compact('adds'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'path' => 'required',
            'company_name' => 'required',
            'display_iteration' => 'required',
            'display' => 'required',
            'cost' => 'required', 
        ]);
        $data = $request->all();
        if(!empty($data)){
            $file = $_FILES['file'];
            $fileName = $_FILEs['file']['name'];
            $fileTempoName = $_FILEs['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FiLES['file']['error'];
            $fileType = $_FiLES['file']['type'];

            $fileExt = explode('.',$fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allow = array('mp4','png','jpg','wmv', 'jpeg', 'flv', '3gp','avi');

            if(in_array($fileActualExt, $allow)){
                if($fileError === 0){
                    if($fileSize<50000000){
                        $fileDestination ='public\uploads/'.$fileName;
                        move_uploaded_file($fileTempoName, $fileDestination);
                        $filePath = 'public/uploads/'.$fileName;
                    }
                    else{
                       echo "you cannot upload file that is > 50mb";
                    }
                }
                else{
                    echo "Your file has an error";
                }
            }
        else{
            "You cannot upload file of this type";
        }
        try{
            $add = new Add($data);        
            $add->save();
        }
        catch(\Exception $e){
            echo "Error".$e->getMessage();
            return response()->json([
                'message' => 'An error in adding the file',
                'error' => $e->getMessage(),
            ]);
            echo $e->getMessage();
        }
       }
       return response()->json([
        'message' => 'New file Added successfully',
        'error' => 'no',
        'Api_result' => $add

        // Add the remaining code part
    ]);
    }

    public function destroy($id){
        $add = Add::findorfail($id);
        $add->destroy($id);
        // return response()->json([
        //     'message' => 'Company Deleted succesfully'
        // ]);
        return redirect('admin.add.index')->withType('danger')->withMessage('Company Deleted successfully');

    }
}



//     public function create(Request $request)
//     {

//         $data = $request->input();
//         if(!empty($data)){
//             $file = $_FILES['file'];
//             $fileName = $_FILEs['file']['name'];
//             $fileTempoName = $_FILEs['file']['tmp_name'];
//             $fileSize = $_FILES['file']['size'];
//             $fileError = $_FiLES['file']['error'];
//             $fileType = $_FiLES['file']['type'];

//             $fileExt = explode('.',$fileName);
//             $fileActualExt = strtolower(end($fileExt));

//             $allow = array('mp4','png','jpg','wmv', 'jpeg', 'flv', '3gp','avi');

//             if(in_array($fileActualExt, $allow)){
//                 if($fileError === 0){
//                     if($fileSize<50000000){
//                         $fileDestination ='public\uploads/'.$fileName;
//                         move_uploaded_file($fileTempoName, $fileDestination);
//                         $filePath = 'public/uploads/'.$fileName;
//                     }
//                     else{
//                        echo "you cannot upload file that is > 50mb";
//                     }
//                 }
//                 else{
//                     echo "Your file has an error";
//                 }
//             }
//         else{
//             "You cannot upload file of this type";
//         }
//         try{
//             $newadd = new add();
//             // $newadd =
//         //    Add remaining part of the code.
//         }
//         catch(\Exception $e){
//             echo "Error".$e->getMessage();
//             return response()->json([
//                 'message' => 'An error in adding the file',
//                 'error' => $e->getMessage(),
//             ]);
//             echo $e->getMessage();
//         }
//     return response()->json([
//         'message' => 'New file Added successfully',
//         'error' => 'no',
//         // 'Api_result' => $wifi_info

//         // Add the remaining code part
//     ]);
//     }
// }
