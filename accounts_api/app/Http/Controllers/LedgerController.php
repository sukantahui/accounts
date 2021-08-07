<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function create_ledger(Request $request)
    {
        $input=(object)($request->json()->all());
        $ledger= new Ledger();
        $ledger->ledger_type_id=$input->ledger_type_id;
        $ledger->ledger_name=$input->ledger_name;
        $ledger->save();
        return response()->json(['success'=>1,'data'=>$ledger], 200,[],JSON_NUMERIC_CHECK);
    }
}
