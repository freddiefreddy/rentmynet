<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\RedeemCard;



class RedeemCardController extends Controller
{
 
    public function all()
    {
        $redeem_cards =RedeemCard::all();
        return response()->json($reedem_cards);
    }

    public function add_redeemcard(Request $request)
    {
        try{
            $request->validate([
                'code' => 'required',
                'pid' => 'required',
                'used' => 'required',   
            ]);
            $redeem_card = RedeemCard::create($request->all());
        }
        catch(\Exception $e){
            echo "Error".$e->getMessage();
            return response()->json([
                'message' => 'An error in adding router',
                'error' => $e->getMessage(),
            ]);
            echo $e->getMessage();
        }
    return response()->json([
        'message' => 'New Router Added successfully',
        'error' => 'no',
        'Api_result' => $redeem_card

        // Add the remaining code part
    ]);
    }

    public function show_cards_all()
    {
        $redeem_cards = RedeemCard::all();
        return view('admin.redeemcard.index', compact('redeem_cards'));     
    }


    public function show_used_cards()
    {   
        $redeem_cards = RedeemCard::where('used','yes')->orderBy('id')->paginate(10);
        return view('admin.redeemcard.index', compact('redeem_cards'));     
    }
    // public function show_connected(){

    // }

    public function destroy($id){
        $redeem_card = RedeemCard::findorfail($id);
        $redeem_card->destroy($id);
        // return response()->json([
        //     'message' => 'Router Deleted succesfully'
        // ]);
        return redirect('admin.redeemcard.index')->withType('danger')->withMessage('Reedem card deleted successfully');

    }
}
