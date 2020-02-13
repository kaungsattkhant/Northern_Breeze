@php $route= Route::currentRouteName() @endphp
{{--@php dd($route); @endphp--}}

<div class="sidebar-nb-mount shadow mr-0"  style="height: inherit;min-height: 100vh">


    <ul class="nav flex-column mr-0 pt-3 sidebar-mount" id="myDIV" style="height: 100%;min-height: 100vh">
        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
{{--            <li class="nav-item dropdown btn-mount mx-auto mb-0" id="pos" data-toggle="collapse" href="#pos1">--}}
{{--                <a class="nav-link p-0  sidebar-box-mount img-pos text-center" href="#" role="button" aria-haspopup="true" aria-expanded="false">--}}
{{--                    <div class=" mt-0 px-auto "><p class="sb-text">POS &nbsp; <i class="fas fa-chevron-down"></i></p></div>--}}

{{--                </a>--}}
{{--            </li>--}}

{{--            <div class="rounded-0 collapse border-0 mt-1" id="pos1" style="width: 100%">--}}

{{--                <div class="rounded-0 border-0 collap-menu-mount">--}}
{{--                    <a class="dropdown-item text-center pl-4 pt-3 pb-1 text-color-mount3 collap-mount fontsize-mount" href="{{url('pos/non_member')}}" style="border-bottom: 1px solid #dddddd">Non-Member</a>--}}
{{--                    <a class="dropdown-item text-center  pl-4 pt-1 pb-3 text-color-mount3 collap-mount fontsize-mount" href="{{url('pos/member')}}" >Member</a>--}}
{{--                </div>--}}
{{--            </div>--}}

            <li class="nav-item btn-mount mx-auto mt-2 {{ in_array($route, ['member.index']) ? 'active2': ''}}"  id="member">
                <a class="nav-link p-0  sidebar-box-mount  text-center img-member
                    {{ in_array($route, ['member.index']) ? 'active-m': ''}}"
                   href="{{url('member')}}">
                    <div class=" mt-0 px-auto "><p class="sb-text">Member</p></div>
                </a>
            </li>

{{--            active-m--}}
{{--        pos=active-pos--}}

            {{----}}
            <li class="nav-item btn-mount mx-auto {{ in_array($route, ['sale.index']) ? 'active2': ''}} " id="sr">
                <a class="nav-link p-0  sidebar-box-mount img-sale-record text-center {{ in_array($route, ['sale.index']) ? 'active-sr': ''}}" href="{{url('sale')}}">
                    <div class=" mt-0 px-auto "><p class="sb-text">Sale Record</p></div></a>
            </li>

{{--        active-sr--}}
            <li class="nav-item btn-mount mx-auto {{ in_array($route, ['stock.index','stock.create','stock.transfer']) ? 'active2': ''}}" id="stock">
                <a class="nav-link p-0  sidebar-box-mount img-stock-inventory text-center {{ in_array($route, ['stock.index','stock.create','stock.transfer']) ? 'active-si': ''}}" href="{{url('stock')}}">
                    <div class=" mt-0 px-auto "><p class="sb-text">Stock Inventory</p></div></a>
            </li>
{{--        active-si--}}
            <li class="nav-item btn-mount mx-auto {{ in_array($route, ['currency_group.index']) ? 'active2': ''}}" id="group">
                <a class="nav-link p-0  sidebar-box-mount img-group text-center {{ in_array($route, ['currency_group.index']) ? 'active-group': ''}}" href="{{url('currency_group')}}">
                    <div class=" mt-0 px-auto "><p class="sb-text">Currency Group</p></div></a>
            </li>
{{--        active-group--}}
            <li class="nav-item btn-mount mx-auto
                {{ in_array($route, [
                    'daily_currency.index.admin',
                    'daily_currency.create.admin',
                    'daily_currency.index.manager',
                    'daily_currency.create.manager',
                    'daily_currency.index.front',
                    'daily_currency.create.front']) ? 'active2': ''}}" id="daily">
                <a class="nav-link p-0  sidebar-box-mount img-daily text-center 
                {{ in_array($route, [
                    'daily_currency.index.admin',
                    'daily_currency.create.admin',
                    'daily_currency.index.manager',
                    'daily_currency.create.manager',
                    'daily_currency.index.front',
                    'daily_currency.create.front']) ? 'active-daily': ''}}" href="{{url('daily_currency')}}">
                    <div class=" mt-0 px-auto "><p class="sb-text">Daily Currency</p></div></a>
            </li>

{{--        active-daily--}}
            <li class="nav-item btn-mount mx-auto {{ in_array($route, ['staff.index']) ? 'active2': ''}}" id="staff">
                <a class="nav-link p-0  sidebar-box-mount img-staff text-center {{ in_array($route, ['staff.index']) ? 'active-staff': ''}}" href="{{url('staff')}}">
                    <div class=" mt-0 px-auto "><p class="sb-text">Staff</p></div></a>
            </li>
            <li class="nav-item btn-mount mx-auto" id="branch">
                <a class="nav-link p-0  sidebar-box-mount img-branch text-center " href="{{url('branch')}}">
                    <div class=" mt-0 px-auto "><p class="sb-text">Branch</p></div></a>
            </li>
{{--        active-branch--}}
{{--            *********************************************Start Manager************************************************--}}
            @elseif(\Illuminate\Support\Facades\Auth::user()->isManager())

            <li class="nav-item btn-mount mx-auto" id="stock">
                <a class="nav-link p-0  sidebar-box-mount img-stock-inventory text-center" href="{{url('stock')}}">
                    <div class=" mt-0 px-auto "><p class="sb-text">Stock Inventory</p></div></a>
            </li>
{{--        active-si--}}
            <li class="nav-item btn-mount mx-auto " id="sr">
                <a class="nav-link p-0  sidebar-box-mount img-sale-record text-center" href="{{url('sale/manager')}}">
                    <div class=" mt-0 px-auto "><p class="sb-text">Sale Record</p></div></a>
            </li>
{{--        active-sr--}}
            <li class="nav-item btn-mount mx-auto" id="daily">
                <a class="nav-link p-0  sidebar-box-mount img-daily text-center " href="{{url('daily_currency/manager')}}">
                    <div class=" mt-0 px-auto "><p class="sb-text">Daily Currency</p></div></a>
            </li>
{{--active-daily--}}
            {{-- ***************************************Staft Front_Man**********************************************--}}

            @elseif(\Illuminate\Support\Facades\Auth::user()->isFrontMan())
            <li class="nav-item dropdown btn-mount mx-auto mb-0" id="pos" data-toggle="collapse" href="#pos1">
                <a class="nav-link p-0  sidebar-box-mount img-pos text-center" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class=" mt-0 px-auto "><p class="sb-text">POS &nbsp; <i class="fas fa-chevron-down"></i></p></div>

                </a>
            </li>

{{--            active-pos--}}

            <div class="rounded-0 collapse border-0 mt-1" id="pos1" style="width: 100%">

                <div class="rounded-0 border-0 collap-menu-mount">
                    <a class="dropdown-item text-center pl-4 pt-3 pb-1 text-color-mount3 collap-mount fontsize-mount" href="{{url('pos/non_member')}}" style="border-bottom: 1px solid #dddddd">Non-Member</a>
                    <a class="dropdown-item text-center  pl-4 pt-1 pb-3 text-color-mount3 collap-mount fontsize-mount" href="{{url('pos/member')}}" >Member</a>
                </div>
            </div>
{{--        acitve-pos in pos--}}
            <li class="nav-item btn-mount mx-auto " id="sr">
                <a class="nav-link p-0  sidebar-box-mount img-sale-record text-center" href="{{url('sale')}}">
                    <div class=" mt-0 px-auto "><p class="sb-text">Sale Record</p></div></a>
            </li>
{{--        active-sr--}}
            <li class="nav-item btn-mount mx-auto" id="daily">
                <a class="nav-link p-0  sidebar-box-mount img-daily text-center " href="{{url('daily_currency')}}">
                    <div class=" mt-0 px-auto "><p class="sb-text">Daily Currency</p></div></a>
            </li>
{{--            active-daily--}}

            @endif
{{--        ***************************************End Front_Man**********************************************--}}
    </ul>
</div>
