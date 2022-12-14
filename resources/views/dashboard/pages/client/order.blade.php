<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

    body {
        background-color: #eeeeee;
        font-family: 'Open Sans', serif
    }

    .container {
        margin-top: 50px;
        margin-bottom: 50px
    }

    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem
    }

    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #FF5722
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #ee5435;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px
    }

    ul.row,
    ul.row-sm {
        list-style: none;
        padding: 0
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }

    .btn-warning {
        color: #ffffff;
        background-color: #ee5435;
        border-color: #ee5435;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #ff2b00;
        border-color: #ff2b00;
        border-radius: 1px
    }
</style>

<div class="container">
    <article class="card">
        <header class="card-header" style="height: 49px; line-height: 2"> My Orders / Tracking </header>
        <div class="card-body">
            <h6>Order ID: {{$order->id}}</h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Name Buyer :</strong> <br> {{$order->name_buyer}} , | <i class="fa fa-user"></i> {{$order->billing_phone}}  </div>
                    <div class="col"> <strong>Shipping BY:</strong> <br> {{$order->car->client->full_name}} , | <i class="fa fa-phone"></i> {{$order->car->client->phone}}  </div>
                    <div class="col"> <strong>Status:</strong> <br> {{$order->status}} </div>
                    <div class="col"> <strong>Tracking #:</strong> <br> BD045903594059 </div>
                </div>
            </article>
            <div class="track">
                @if( $order->status  == "Paid")
                    <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Paid and awaiting approval</span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Received from customer</span> </div>
                @elseif($order->status  == "Received")
                    <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Paid and awaiting approval</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Received from customer</span> </div>
                @elseif($order->status  == "Delivered")
                    <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Paid and awaiting approval</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Received from customer</span> </div>
                @endif

            </div>
            <hr>
            <ul class="row">
                @foreach($order->products as $item)
                    <li class="col-md-4">
                        <figure class="itemside mb-3">
                            <div class="aside"><img src="{{asset($item->image1)}}" class="img-sm border"></div>
                            <figcaption class="info align-self-center">
                                <p class="title">{{$item->name}} <br> <span style="text-decoration: line-through" class="text-muted">{{$item->pivot->original_price}} ??.?? </span>  <br><span class="text-muted">{{$item->pivot->price}} ??.?? </span>
                            </figcaption>
                        </figure>
                    </li>
                @endforeach
            </ul>
            <hr>
            <p class="text-success text-center" > <i class="fa fa-copyright"></i> jadeer Application</p>
        </div>
    </article>
</div>
