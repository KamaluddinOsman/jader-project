<?php

namespace App\Http\Controllers\Api\client;

use App\BankAccount;
use App\Http\Controllers\Controller;
use App\RequestLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $bankAccount = BankAccount::where('client_id', Auth::id())->get();

        if ($bankAccount) {
            return ResponseJson('200', 'ارقام حساباتك البنكيه', $bankAccount);
        } else {
            return ResponseJson('0', 'لا يوجد اي حسابات بنكيه لك');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        RequestLog::create(['content' => $request->all(), 'service' => 'CreateAccountBank']);

        $validator = validator()->make($request->all(), [
            "credit_card_num" => 'required|unique:bank_accounts,credit_card_num',
            "ipan" => 'numeric|not_in:0',
            "year" => 'required|date_format:y',
            "month" => 'required|date_format:m',
            "nameCard" => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $bankAccount = new BankAccount();

        $bankAccount->client_id = Auth::id();
        $bankAccount->credit_card_num = $request->credit_card_num;
        $bankAccount->ipan = $request->ipan;
        $bankAccount->year = $request->year;
        $bankAccount->month = $request->month;
        $bankAccount->nameCard = $request->nameCard;

        $bankAccount->save();

        return ResponseJson('200', 'تم الحفظ بنجاح', $bankAccount);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $validator = validator()->make($request->all(), [
            "credit_card_num" => 'required|unique:bank_accounts,credit_card_num'. $request->user()->id,
            "ipan" => 'required|numeric|not_in:0',
            "year" => 'required|date_format:y',
            "month" => 'required|date_format:m',
            "nameCard" => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(),  null);
        }

        $bankAccount = BankAccount::find($id);
        $bankAccount->credit_card_num = $request->credit_card_num;
        $bankAccount->ipan = $request->ipan;
        $bankAccount->year = $request->year;
        $bankAccount->month = $request->month;
        $bankAccount->nameCard = $request->nameCard;

        $bankAccount->save();

        return ResponseJson('200', 'تم التعديل بنجاح', $bankAccount);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request,$id)
    {
        $bankAccount = BankAccount::where('id',$id)->first();

        if ($bankAccount){
            $bankAccount->delete();
            return ResponseJson('200','تم حذف المنتج ');
        }else{
            return ResponseJson('0','تم الحذف مسبقاً');
        }

    }
}

?>
