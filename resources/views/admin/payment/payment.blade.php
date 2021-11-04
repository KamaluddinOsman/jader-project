<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

<body oncontextmenu="return false;"  onmousedown="return true;">

<div class="container">
    <div class="row">
        <aside class="col-sm-6">
            <article class="card">
                <div class="panel-heading" style="color: #333; background-color: #f5f5f5; border-color: #ddd; padding: 9px">
                    <h3 class="panel-title" style="margin-top: 0; margin-bottom: 0; font-size: 16px;display: inline; font-weight: bold; color: #0b93d5">
                        Payment Details
                    </h3>
                    <div class="checkbox pull-right" style="float: right!important;">
                        <label>
                            <input type="checkbox" />
                            Remember
                        </label>
                    </div>
                </div>

                <div class="card-body p-5">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-tab-card">

                            <div id="error">

                            </div>

                            <form id="form_id" accept-charset="UTF-8" action="https://api.moyasar.com/v1/payments.html" method="POST" role="form">

                                <input type="hidden" name="callback_url" value="https://jadeeer.com/devs/api/v1/BackPaymentCheckout/{{$clientID}}?client_id={{$clientID}}&car_type={{$car_type}}&address_id={{$address_id}}&order_id={{$order_id}}" />
                                <input type="hidden" name="publishable_api_key" value="pk_test_fX8dusebEXTozrAf3rtanHP2sWh9Qo42HqhcSCUs" />
                                <input type="hidden" name="amount" value="{{(int)$sumTotal}}" />
                                <input type="hidden" name="source[type]" value="creditcard" />
                                {{--                                <input type="hidden" name="source[3ds]" value="false" />--}}

                                <div class="form-group">
                                    <label for="username">Full name (on the card)</label>
                                    <input type="text" class="form-control" value="{{$bankAccount->nameCard}}" name="source[name]" placeholder="" required="">
                                </div> <!-- form-group.// -->

                                <div class="form-group">
                                    <label for="cardNumber">Card number</label>
                                    <div class="input-group">
                                        <input type="text" value="{{$bankAccount->credit_card_num}}" class="form-control" name="source[number]" placeholder="">
                                        <div class="input-group-append">
                                                <span class="input-group-text text-muted">
                                                    <i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>  
                                                    <i class="fab fa-cc-mastercard"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div> <!-- form-group.// -->

                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label><span class="hidden-xs">Expiration</span> </label>
                                            <div class="input-group">
                                                <input type="number" value="{{$bankAccount->month}}" class="form-control" placeholder="MM" name="source[month]">
                                                <input type="number" value="{{$bankAccount->year}}" class="form-control" placeholder="YY" name="source[year]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVC <i class="fa fa-question-circle"></i></label>
                                            <input type="number" name="source[cvc]" class="form-control" required="">
                                        </div> <!-- form-group.// -->
                                    </div>
                                </div> <!-- row.// -->

                                <div class='form-row'>
                                    <div class='col-md-12'>
                                        <div class='form-control total btn btn-info'>
                                            Total:
                                            <span class='amount'> SR {{$sumTotal}}</span>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <button id="submit_button_id" class="subscribe btn btn-success btn-block" type="submit"> Confirm  </button>
                            </form>
                        </div> <!-- tab-pane.// -->
                    </div> <!-- tab-content .// -->
                </div> <!-- card-body.// -->
            </article> <!-- card.// -->


        </aside> <!-- col.// -->
    </div> <!-- row.// -->
</div>

<script>

    // Capture the form submit button
    $("#submit_button_id").click(function(event){
        event.preventDefault();
        // Get form data
        var form_data = $("#form_id").serialize();
        // Sending a POST request to Moyasar API using AJAX
        $.ajax({
            url: "https://api.moyasar.com/v1/payments",
            type: "POST",
            data: form_data,
            dataType: "json",

            error: function(XMLHttpRequest, textStatus, errorThrown){
                var keys = Object.keys(XMLHttpRequest.responseJSON.errors);
                keys.forEach(function (key){
                    var values= XMLHttpRequest.responseJSON.errors[key]

                    var msg = '<p id="msg" class="alert alert-danger">' + key + ' ' + values + '</p>'

                    document.getElementById('error').innerHTML += msg

                })

            }
        })
            // uses `.done` callback to handle a successful AJAX request
            .done(function(data){
// Save the payment id in your System
                var payment_id = data.id;
// Redirect the user to transaction_url
                var url = data.source.transaction_url;
                window.location.href=url;
            })

    });

</script>
</body>




