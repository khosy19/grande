@section('sidebar')
<div class="sidebar" data-active-color="rose" data-background-color="black"
    data-image="{{ url('/assets/img/sidebar-1.jpg') }}">
    <!--
    Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
    Tip 2: you can also add an image using data-image tag
    Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
    <div class="logo">
        <a href="#" class="simple-text">
            Grande Garden Cafe
        </a>
    </div>
    <div class="logo logo-mini">
        <a href="#" class="simple-text">
            Aplikasi Pemesanan Menu
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ url('/assets/img/grande-logo.png') }}" />
            </div>
            <div class="info">
                <a>
                    {{ Auth::user()->room }}
                </a>
                <a>
                    {{ Auth::user()->name }}
                </a>
            </div>
        </div>
        <ul class="nav">
            <li
                class="{{ (request()->is(Auth::user()->level.'/dashboard')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if(Auth::user()->level == 'admin')
            <li
                class="{{ (request()->is(Auth::user()->level.'/management/user*')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/management/user') }}">
                    <i class="material-icons">manage_accounts</i>
                    <p>Data User</p>
                </a>
            </li>
            <li
                class="{{ (request()->is(Auth::user()->level.'/management/room*')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/management/room') }}">
                    <i class="material-icons">meeting_room</i>
                    <p>Data Meja</p>
                </a>
            </li>
            <li
                class="{{ (request()->is(Auth::user()->level.'/management/food*')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/management/food') }}">
                    <i class="material-icons">menu_book</i>
                    <p>Data Menu</p>
                </a>
            </li>
            <li
                class="{{ (request()->is(Auth::user()->level.'/management/station*')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/management/station') }}">
                    <i class="material-icons">manage_account</i>
                    <p>Data Station</p>
                </a>
            </li>
            <li
                class="{{ (request()->is(Auth::user()->level.'/management/transaksi*')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/management/transaksi') }}">
                    <i class="material-icons">receipt_long</i>
                    <p>Transaksi</p>
                </a>
            </li>
            @endif
            @if(Auth::user()->level == 'guest')
            <li
                class="{{ (request()->is(Auth::user()->level.'/history')) ? 'active' : '' }}">
                <a href="{{ url(Auth::user()->level.'/history') }}">
                    <i class="material-icons">manage_search</i>
                    <p>History</p>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('logout') }}" class="btn btn-danger">logout</a>
            </li>
        </ul>
    </div>
</div>
@show
