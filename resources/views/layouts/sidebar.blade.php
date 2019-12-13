<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
    </a>
</li>

<li class="nav-item has-treeview {{ (request()->is('penginapan') || request()->is('penginapan/*')) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ (request()->is('penginapan') || request()->is('penginapan/*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-hotel"></i>
        <p>Penginapan<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="{{ route('penginapan.index') }}" class="nav-link {{ (request()->is('penginapan')) ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i><p>Lihat Penginapan</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('penginapan.create') }}" class="nav-link {{ (request()->is('penginapan/create')) ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i><p>Tambah Penginapan</p>
        </a>
        </li>
    </ul>
</li>

<li class="nav-item has-treeview {{ (request()->is('kamar/*')) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ (request()->is('kamar/*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-bed"></i>
        <p>Kamar<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        <a href="/kamar/lihat" class="nav-link {{ (request()->is('kamar/lihat')) ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i><p>Lihat Kamar</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="/kamar/tambah" class="nav-link {{ (request()->is('kamar/tambah')) ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i><p>Tambah Kamar</p>
        </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link {{ (request()->is('transaksi')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-cash-register"></i><p>Transaksi</p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link {{ (request()->is('ulasan')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-medal"></i><p>Ulasan</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p>
    </a>
</li>