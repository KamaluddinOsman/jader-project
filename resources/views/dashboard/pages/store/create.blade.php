@extends('dashboard.layouts.main')
@inject('model','App\Store')
@section('head')
    @section('page-title')
            {{__('institution.institutions')}} | {{ __('auth.bageTitle') }}
    @endsection

    <!-- DataTables -->
    <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('institution.addInstitution') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.main') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('institution.addInstitution') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        @include('dashboard.layouts.flash-message')
        @include('flash::message')
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {!! Form::model($model,['action' => 'Dashboard\StoreController@store','enctype' => 'multipart/form-data']) !!}
                            @include('/dashboard/pages/store/form')
                                                
                            <div class="row">
                                <div class="form-group text-center">
                                    <button class="btn btn-primary submit-btn col-sm-2" disabled type="submit">{{__('lang.save')}}</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.modal -->
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">terms of service</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        {{-- <span aria-hidden="true">&times;</span> --}}
                    </button>
                </div>
                <div class="modal-body">
                <p>
                    (1) مقدمة :

                    أهلاً بكم مع   كل شئ دوت كوم ، فيما يلي البنود والشروط التي تخص إستخدامك و دخولك لصفحات موقع "  كل شئ دوت كوم"  وكافة الصفحات و الروابط والأدوات والخواص المتفرعة عنها. إن إستخدامك لموقع   كل شئ دوت كوم هو موافقة منك على القبول ببنود وشروط هذه الإتفاقية والذي يتضمن كافة التفاصيل أدناه وهو تأكيد لإلتزامك بالاستجابة لمضمون هذه الإتفاقية الخاصة بشركة "  كل شئ دوت كوم" والمشار إليه فيما يلي بإسم "نحن" والمشار إليه إيضا بـ"  كل شئ دوت كوم"، فيما يتعلق باستخدامك للموقع، والمشار إليه فيما يلي بـ "اتفاقية الإستخدام " وتعتبر هذه الإتفاقية سارية المفعول حال قبولك بخيار الموافقة
                </p>
                    <p>
                        (2) التأهل للعضوية :

                        1.تمنح عضوية الموقع فقط لمن تجازوت أعمارهم 18 عام . و لموقع   كل شئ دوت كوم الحق بإلغاءحساب أي عضو لم يبلغ الـ 18 عام مع الإلتزام بتصفية حساباته المالية فور إغلاق الحساب
                    </p>
                    <p>
                        2.لا يحق لأي شخص إستخدام الموقع إذا ألغيت عضويته من   كل شئ دوت كوم.
                    </p>
                    <p>
                        3.في حال قيام أي مستخدم بالتسجيل كمؤسسة تجارية، فإن مؤسسته التجارية تكون ملزمة بكافة والشروط الواردة في هذه الإتفاقية.
                    </p>
                    <p>
                        4.ينبغي عليك الإلتزام بكافة القوانين المعمول بها لتنظيم التجارة عبر الانترنت.
                    </p>
                    <p>
                        5.لا يحق لأي عضو أو مؤسسة أن تقوم بفتح حسابين بآن واحد لأي سبب كان، ولإدارة الموقع الحق بتجميد الحسابين أو إلغاء أحدهما مع الإلتزام بتصفية كافة العمليات المالية المتعلقة بالحساب قبل إغلاقه.
                    </p>
                    <p>
                        6.على المستخدمي أفراد و مؤسسات الإلتزام بالعقود التجارية المبرمة مع الأعضاء.
                    </p>
                    <p>
                        7.لا يحق لأي عضو بالموقع شراء معروضات ممنوعة أو مشبوهة أو مسروقة أو تخالف القوانين المعمول بها بوزارات و هيئات مؤسسات التجارة المحلية الحكومية، وفي حال ثبوت ذلك فهو يضع نفسه ضمن طائلة المسؤولية الشخصية بدون أدنى مسؤولية على   كل شئ دوت كوم
                    </p>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection



@section('scripts')
    <script>
        $('.check').on('click', function() {
            if($('.submit-btn').attr('disabled')) {
                $('.submit-btn').removeAttr('disabled');
            }else {
                $('.submit-btn').attr('disabled', true);

            }
        })

        // Select all
        $('#select_all').click(function () {
            $('input[type=checkbox]').prop('checked', $(this).prop('checked'));
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // $('#logo').attr('src', e.target.result);

                    $(input).next('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#logoInp").change(function() {
            $('#logoNoImage').css('display','none');
            $('#logo_old').css('display','none');
            $('#logo').css('display','block');
            readURL(this);
        });

        $("#coverInp").change(function() {
            $('#coverNoImage').css('display','none');
            $('#cover_old').css('display','none');
            $('#cover').css('display','block');
            readURL(this);
        });

        $("#contractInp").change(function() {
            $('#contractNoImage').css('display','none');
            $('#contract_old').css('display','none');
            $('#contract').css('display','block');
            readURL(this);
        });

        $("#pac-input").focusin(function() {
            $(this).val('');
        });
        $('#latitude').val('');
        $('#longitude').val('');
        // This example adds a search box to a map, using the Google Place Autocomplete
        // feature. People can enter geographical searches. The search box will return a
        // pick list containing a mix of places and predicted search terms.
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        function initAutocomplete() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 24.740691, lng: 46.6528521 },
                zoom: 13,
                mapTypeId: 'roadmap',
            });
            // move pin and current location
            infoWindow = new google.maps.InfoWindow;
            geocoder = new google.maps.Geocoder();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(pos);
                    const svgMarker = {
                        path:
                            "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
                        fillColor: "blue",
                        fillOpacity: 0.6,
                        strokeWeight: 0,
                        rotation: 0,
                        scale: 2,
                        anchor: new google.maps.Point(15, 30),
                    };

                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(pos),
                        map: map,
                        // icon: 'http://localhost/94/everything/public/storage/images/store.svg',
                        title: 'موقعك الحالي',
                        width: '10px'
                    });
                    markers.push(marker);
                    marker.addListener('click', function() {
                        geocodeLatLng(geocoder, map, infoWindow,marker);
                    });
                    // to get current position address on load
                    google.maps.event.trigger(marker, 'click');
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                console.log('dsdsdsdsddsd');
                handleLocationError(false, infoWindow, map.getCenter());
            }
            var geocoder = new google.maps.Geocoder();
            google.maps.event.addListener(map, 'click', function(event) {
                SelectedLatLng = event.latLng;
                geocoder.geocode({
                    'latLng': event.latLng
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            deleteMarkers();
                            addMarkerRunTime(event.latLng);
                            SelectedLocation = results[0].formatted_address;
                            console.log( results[0].formatted_address);
                            splitLatLng(String(event.latLng));
                            $("#pac-input").val(results[0].formatted_address);
                        }
                    }
                });
            });
            function geocodeLatLng(geocoder, map, infowindow,markerCurrent) {
                var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};
                /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
                $('#latitude').val(markerCurrent.position.lat());
                $('#longitude').val(markerCurrent.position.lng());
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            map.setZoom(8);
                            var marker = new google.maps.Marker({
                                position: latlng,
                                map: map
                            });
                            markers.push(marker);
                            infowindow.setContent(results[0].formatted_address);
                            SelectedLocation = results[0].formatted_address;
                            $("#pac-input").val(results[0].formatted_address);
                            infowindow.open(map, marker);
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
                SelectedLatLng =(markerCurrent.position.lat(),markerCurrent.position.lng());
            }
            function addMarkerRunTime(location) {
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
                markers.push(marker);
            }
            function setMapOnAll(map) {
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            }
            function clearMarkers() {
                setMapOnAll(null);
            }
            function deleteMarkers() {
                clearMarkers();
                markers = [];
            }
            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            $("#pac-input").val("أبحث هنا ");
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });
            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(100, 100),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };
                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));
                    $('#latitude').val(place.geometry.location.lat());
                    $('#longitude').val(place.geometry.location.lng());
                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }
        function splitLatLng(latLng){
            var newString = latLng.substring(0, latLng.length-1);
            var newString2 = newString.substring(1);
            var trainindIdArray = newString2.split(',');
            var lat = trainindIdArray[0];
            var Lng  = trainindIdArray[1];
            $("#latitude").val(lat);
            $("#longitude").val(Lng);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvt4xYX0QycPedzqGKJ7_1sg6KH_iztDA&libraries=places&callback=initAutocomplete&language=ar&region=EGasync defer"></script>


    <script>
        $("#category").change(function(){
            $.ajax({
                url: "{{ url('/store/getcategory') }}"+"/"+$(this).val(),
                method: 'GET',

                success: function(data) {
                    $('#childCategory').html(data.output);
                    select.append('<option value=' + value.id + '>' + value.name + '</option>');
                }
            });
        });
    </script>
@stop
