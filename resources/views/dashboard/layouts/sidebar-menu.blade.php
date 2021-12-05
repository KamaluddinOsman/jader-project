<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">{{ __('dashboard.menu') }}</li>

        <li>
            <a href="{{ route('dashboard.index') }}" class="waves-effect">
                <i class="mdi mdi-airplay"></i>
                <span>{{ __('dashboard.dashboard') }}</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('category.index') }}" class=" waves-effect">
                <i class="mdi mdi-file-tree"></i>
                <span>{{__('dashboard.menuItemCategory')}}</span>
            </a>
        </li>

        <li>
            <a href="{{ route('city.index') }}" class=" waves-effect">
                <i class="mdi mdi-map-marker-outline"></i>
                <span>{{__('dashboard.menuItemCity')}}</span>
            </a>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-store"></i>
                <span>{{__('dashboard.menuItemInstitution')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{url('/store')}}" class="waves-effect">
                        <span>{{__('dashboard.menuItemInstitutionSub1')}} </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/store/pending')}}" class="waves-effect">
                        <span>{{__('dashboard.menuItemInstitutionSub2')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/store/rejected')}}" class="waves-effect">
                        <span>{{__('dashboard.menuItemInstitutionSub3')}}</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{url('/store/create')}}" class="waves-effect">
                        <span>{{__('lang.addR')}} </span>
                    </a>
                </li> --}}
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-basket-fill"></i>
                <span>{{__('dashboard.menuItemProduct')}}</span>
            </a>
                
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{url('/product')}}" class="waves-effect">
                        <span>{{__('dashboard.menuItemProductSub1')}} </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/product/pending')}}" class="waves-effect">
                        <span>{{__('dashboard.menuItemProductSub2')}} </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/product/rejected')}}" class="waves-effect">
                        <span>{{__('dashboard.menuItemProductSub3')}} </span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{url('/orders')}}" class=" waves-effect">
                <i class="mdi mdi-shopify"></i>
                <span>{{__('dashboard.menuItemOrders')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('/offer')}}" class=" waves-effect">
                <i class="mdi mdi-coin"></i>
                <span>{{__('dashboard.menuItemOffer')}}</span>
            </a>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-car"></i>
                <span>{{__('dashboard.menuItemCar')}}</span>
            </a>
                
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{url('/car')}}" class="nav-link">
                        <span>{{__('dashboard.menuItemCarSub1')}} </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/car/pending')}}" class="nav-link">
                        <span>{{__('dashboard.menuItemCarSub2')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/car/rejected')}}" class="nav-link">
                        <span>{{__('dashboard.menuItemCarSub3')}}</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{url('/car/create')}}" class="nav-link">
                        <span>{{__('lang.addCar')}} </span>
                    </a>
                </li> --}}
            </ul>
        </li>

        <li>
            <a href="{{url('client')}}" class="waves-effect">
                <i class="mdi mdi-human"></i>
                <span>{{__('dashboard.menuItemClient')}} </span>
            </a>
            {{-- <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{url('client')}}" class="nav-link">
                        <span>{{__('lang.client')}} </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('client/create')}}" class="nav-link">
                        <span>{{__('lang.addClient')}}</span>
                    </a>
                </li>
            </ul> --}}
        </li>

        <li>
            <a href="{{url('user')}}" class="waves-effect">
                <i class="mdi mdi-account"></i>
                <span>{{__('dashboard.menuItemUser')}} </span>
            </a>
            {{-- <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{url('user')}}" class="nav-link">
                        <p>{{__('lang.user')}}</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('user/create')}}" class="nav-link">
                        <p>{{__('lang.userAdd')}}</p>
                    </a>
                </li>
            </ul> --}}
        </li>

        <li>
            <a href="{{url('notification/create')}}" class="waves-effect">
                <i class="mdi mdi-bell"></i>
                <span>{{__('dashboard.menuItemNotification')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('/role')}}" class="waves-effect">
                <i class="mdi mdi-account-key"></i>
                <span>{{__('dashboard.menuItemRole')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('money/transactions')}}" class="waves-effect">
                <i class="mdi mdi-account-switch"></i>
                <span>{{__('dashboard.menuItemTransaction')}}</span>
            </a>
            {{-- <ul class="sub-menu" aria-expanded="false">
        
                <li>
                    <a href="{{url('money/transactions')}}" class="nav-link">
                        <p>{{__('lang.moneyTransactions')}}</p>
                    </a>
                </li>
        
                <li>
                    <a href="{{url('money/create')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('lang.moneyCreate')}}</p>
                    </a>
                </li>
        
            </ul> --}}
        </li>
        
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-settings"></i>
                <span>{{__('dashboard.menuItemSetting')}}</span>
            </a>
            {{-- <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{url('/color')}}" class="nav-link">
                        <p>{{__('lang.color')}} </p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/delivery-cost')}}" class="nav-link">
                        <p>{{__('lang.delivers_costs')}} </p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/unit')}}" class="nav-link">
                        <p>{{__('lang.unit')}} </p>
                    </a>
                </li>
        
                <li>
                    <a href="{{url('/brand')}}" class="nav-link">
                        <p>{{__('lang.brand')}} </p>
                    </a>
                </li>
        
                <li>
                    <a href="{{url('/coupons')}}" class="nav-link">
                        <p>{{__('lang.coupons')}} </p>
                    </a>
                </li>
        
                <li>
                    <a href="{{url('/log')}}" class="nav-link">
                        <p>{{__('lang.log')}} </p>
                    </a>
                </li>
        
                <li>
                    <a href="{{url('/banner')}}" class="nav-link">
                        <p>{{__('lang.banner')}} </p>
                    </a>
                </li>
        
                <li>
                    <a href="{{url('/setting')}}" class="nav-link">
                        <p>{{__('lang.setting')}} </p>
                    </a>
                </li>
            </ul> --}}
        </li>

    </ul>
</div>