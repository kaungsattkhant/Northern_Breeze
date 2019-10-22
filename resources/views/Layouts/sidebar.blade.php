<div class="sidebar-nb-mount shadow mr-0">
    <ul class="nav flex-column mr-0 pt-3" id="myDIV" style="position: relative;">
        <li class="nav-item dropdown btn-mount mx-auto " id="pos">
            <a class="nav-link dropdown-toggle p-0  sidebar-box-mount img-pos text-center" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <div class=" mt-0 px-auto "><p class="sb-text">POS &nbsp; <i class="fas fa-chevron-down"></i></p></div>

            </a>
            <div class="dropdown-menu dp-mount">
                <a class="dropdown-item" href="{{url('non_member')}}">Non-Member</a>
                <a class="dropdown-item" href="{{url('pos_member')}}">Member</a>

            </div>

        </li>

        <li class="nav-item btn-mount mx-auto " id="member">
            <a class="nav-link p-0  sidebar-box-mount img-member text-center " href="{{url('member')}}">
                <div class=" mt-0 px-auto "><p class="sb-text">Member</p></div>
            </a>
        </li>

        <li class="nav-item btn-mount mx-auto " id="sr">
            <a class="nav-link p-0  sidebar-box-mount img-sale-record text-center" href="{{url('sale')}}">
                <div class=" mt-0 px-auto "><p class="sb-text">Sale Record</p></div></a>
        </li>
        <li class="nav-item btn-mount mx-auto" id="stock">
            <a class="nav-link p-0  sidebar-box-mount img-stock-inventory text-center" href="{{url('stock')}}">
                <div class=" mt-0 px-auto "><p class="sb-text">Stock Inventory</p></div></a>
        </li>
        <li class="nav-item btn-mount mx-auto" id="staff">
            <a class="nav-link p-0  sidebar-box-mount img-staff text-center " href="{{url('staff')}}">
                <div class=" mt-0 px-auto "><p class="sb-text">Staff</p></div></a>
        </li>

    </ul>

</div>
