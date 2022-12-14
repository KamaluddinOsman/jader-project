<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\RequestLog;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = Product::with('store', 'spacialCategory')->where('status', '=', 1)->get();
        return view('dashboard.pages.product.index')->with(compact('records'));

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

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::with('store', 'spacialCategory')->where('id', $id)->first();
        return view('dashboard.pages.product.show')->with(compact('product'));

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
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (File::exists($product->image1)){
            @unlink(public_path().'/'.$product->image1);
        }
        if (File::exists($product->image2)){
            @unlink(public_path().'/'.$product->image2);
        }
        if (File::exists($product->image3)){
            @unlink(public_path().'/'.$product->image3);
        }
        if (File::exists($product->image4)){
            @unlink(public_path().'/'.$product->image4);
        }

        $product->delete();
        flash()->success(__('product.productDeletedSuccessfully'));
        return back();

    }

    public function active($id)
    {
        RequestLog::create(['content' => $id, 'service' => 'active Product']);

        $store = Product::findOrFail($id);
        $store->status = 1;
        $store->save();
        flash()->success(__('product.productActivatedSuccessfully'));
        return back();
    }

    public function pend()
    {
        $records = Product::where(['status' => 0])->paginate(20);
        return view('dashboard.pages.product.pending')->with(compact('records'));
    }

    public function cancel(Request $request)
    {
        RequestLog::create(['content' => $request->store_id, 'service' => 'cancel Store']);

        $product =Product::findOrFail($request->product_id);

        $product->status = 2;
        $product->save();
        
        $store = Store::where('id', $product->store_id)->first();

        $client = \App\Client::where('id', $store->client_id)->first();
        $notification =  $client->notifications()->create([
            'id'       => Uuid::uuid4(),
            'title'    => $product->name .'?????????? ?????? ???????? ',
            'body'     => $request->body ,
        ]);


        $tokens = $client->tokens()->where('token','!=','')->pluck('token')->toArray();
        if (count($tokens)){
            $title = $notification->title;
            $body = $notification->body;
            $data = [
                'test' => '1'
            ];
            $send = notifyByFirebase($title,$body,$tokens, $data);
        };


        flash()->success(__('product.productCanceledSuccessfully'));
        return back();
    }

    public function rejected()
    {
        $records = Product::where(['status' => 2])->paginate(20);
        return view('dashboard.pages.product.rejected')->with(compact('records'));
    }
}

?>
