<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('client.activityTitle') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="datatable"
                class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>{{ __('client.activityImageColumn') }}</th>
                        <th>{{ __('client.activityNameColumn') }}</th>
                        <th>{{ __('client.activityQuantityColumn') }}</th>
                        <th>{{ __('client.activityPriceColumn') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($carts)
                        @foreach($carts as $cart)
                                <tr>
                                    <td><img style="width: 50px; height: 50px" src="{{asset($cart->product->image)}}"></td>
                                    <td>{{$cart->product->name}}</td>
                                    <td>{{$cart->quantity}}</td>
                                    <td>{{$cart->total_price}}</td>
                                </tr>
                        @endforeach            
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
