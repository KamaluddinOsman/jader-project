<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>

        <li>
            <a href="{{ route('dashboard.index') }}" class="waves-effect">
                <i class="mdi mdi-airplay"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('category.index') }}" class=" waves-effect">
                <i class="mdi mdi-file-tree"></i>
                <span>{{__('lang.category')}}</span>
            </a>
        </li>

        <li>
            <a href="{{ route('city.index') }}" class=" waves-effect">
                <i class="mdi mdi-map-marker-outline"></i>
                <span>{{__('lang.district')}}</span>
            </a>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-store"></i>
                <span>{{__('lang.store')}}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{url('/store')}}" class="waves-effect">
                        <span>{{__('lang.store')}} </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/store/pending')}}" class="waves-effect">
                        <span>{{__('lang.pending')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/store/rejected')}}" class="waves-effect">
                        <span>{{__('lang.rejected')}}</span>
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
                <span>{{__('lang.product')}}</span>
            </a>
                
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{url('/product')}}" class="waves-effect">
                        <span>{{__('lang.product')}} </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/product/pending')}}" class="waves-effect">
                        <span>{{__('lang.pending')}} </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/product/rejected')}}" class="waves-effect">
                        <span>{{__('lang.rejected')}} </span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{url('/offer')}}" class=" waves-effect">
                <i class="mdi mdi-coin"></i>
                <span>{{__('lang.offer')}}</span>
            </a>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-car"></i>
                <span>{{__('lang.car')}}</span>
            </a>
                
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{url('/car')}}" class="nav-link">
                        <span>{{__('lang.car')}} </span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/car/pending')}}" class="nav-link">
                        <span>{{__('lang.pending')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/car/rejected')}}" class="nav-link">
                        <span>{{__('lang.rejected')}}</span>
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
                <span>{{__('lang.client')}} </span>
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
                <span>{{__('lang.user')}} </span>
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
                <span>{{__('lang.notification')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('/role')}}" class="waves-effect">
                <i class="mdi mdi-account-key"></i>
                <span>{{__('lang.roles')}}</span>
            </a>
        </li>

        <li>
            <a href="{{url('money/transactions')}}" class="waves-effect">
                <i class="mdi mdi-account-switch"></i>
                <span>{{__('lang.accounts')}}</span>
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
                <span>{{__('lang.setting')}}</span>
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