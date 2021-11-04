
{{--<li><a href="{{url('order')}}"><i class="fa fa-first-order"></i><span> {{__('lang.order')}} </span></a></li>--}}
{{--<li><a href="{{url('role')}}"><i class="fa fa-adjust"></i><span> {{__('lang.Specialties')}} </span></a></li>--}}
{{--<li><a href="{{url('connect')}}"><i class="fa fa-mail-reply-all"></i><span> {{__('lang.messages')}} </span></a></li>--}}
{{--<li><a href="{{url('edit/password')}}"><i class="fa fa-key"></i><span> تعديل كلمة السر </span></a></li>--}}
{{--<li ><a href=""><i class="fa fa-gears"></i><span> الإعدادات</span></a></li>--}}


<!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

<?php
 $countPending = \App\Store::where('active' , 0)->count();
 $countPendingCar = \App\Car::where('activated' , 0)->count();
?>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-list"></i>
        <p>
            {{__('lang.category')}}
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{url('/category')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.category')}} </p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{{url('/city')}}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            {{__('lang.district')}}
            <span class="right badge badge-danger">New</span>
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            {{__('lang.store')}}
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">{{$countPending}}</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{url('/store')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.store')}} </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/store/pending')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.pending')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/store/rejected')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.rejected')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/store/create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.addR')}} </p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>
            {{__('lang.product')}}
            <i class="fas fa-angle-left right"></i>
{{--            <span class="badge badge-info right">{{$countPending}}</span>--}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{url('/product')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.product')}} </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/product/pending')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.pending')}} </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/product/rejected')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.rejected')}} </p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-money-bill-alt"></i>
        <p>
            {{__('lang.offer')}}
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{url('/offer')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.offer')}} </p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-car"></i>
        <p>
            {{__('lang.car')}}
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">{{$countPendingCar}}</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{url('/car')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.car')}} </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/car/pending')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.pending')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/car/rejected')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.rejected')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/car/create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.addCar')}} </p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            {{__('lang.client')}}
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{url('client')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.client')}} </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('client/create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.addClient')}}</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tree"></i>
        <p>
            {{__('lang.user')}}
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{url('user')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.user')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('user/create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.userAdd')}}</p>
            </a>
        </li>
    </ul>
</li>


<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-bell"></i>
        <p>
            {{__('lang.notification')}}
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{url('notification/create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.notificationSend')}}</p>
            </a>
        </li>

    </ul>
</li>


<li class="nav-item">
    <a href="{{url('/role')}}" class="nav-link">
        <i class="nav-icon fa fa-robot"></i>
        <p>
            {{__('lang.roles')}}
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-dollar-sign"></i>
        <p>
            {{__('lang.accounts')}}
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{url('money/transactions')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.moneyTransactions')}}</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('money/create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.moneyCreate')}}</p>
            </a>
        </li>

    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-unity"></i>
        <p>
            {{__('lang.setting')}}
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{url('/color')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.color')}} </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/delivery-cost')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.delivers_costs')}} </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/unit')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.unit')}} </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('/brand')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.brand')}} </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('/coupons')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.coupons')}} </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('/log')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.log')}} </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('/banner')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.banner')}} </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url('/setting')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('lang.setting')}} </p>
            </a>
        </li>
    </ul>
</li>



