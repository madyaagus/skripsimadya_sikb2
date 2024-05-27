<script>
    .menu a.clicked {
    background-color: #ff0000; /* Ganti dengan warna latar belakang yang Anda inginkan ketika diklik */
    }
</script>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                {{-- Welcome --}}
                @guest
                    <li class="menu-title">
                        <span>Welcome</span>
                    </li>
                @endguest

                @if(auth()->check() && Auth::user()->role == 'stafbb')
                    <li class="menu-title">
                        <span>Welcome, Staf BB</span>
                    </li>
                @endif
                @if(auth()->check() && Auth::user()->role == 'kasibb')
                    <li class="menu-title">
                        <span>Welcome, Kasi BB</span>
                    </li>
                @endif
                @if(auth()->check() && Auth::user()->role == 'kajari')
                    <li class="menu-title">
                        <span>Welcome, Kajari</span>
                    </li>
                @endif
                @if(auth()->check() && Auth::user()->role == 'jaksa')
                    <li class="menu-title">
                        <span>Welcome, Jaksa</span>
                    </li>
                @endif
                
                {{-- Guest --}}
                @guest
                <li class="menu" class="{{ set_active('/') }}">
                    <a href="{{ route('dashboard/page') }}"><i class="las la-home"></i> <span> Beranda </span></a>
                </li>

                <li class="submenu">
                    <a class="{{ set_active(['/tentang/struktur-organisasi']) }}" href="{{ route('/tentang/struktur-organisasi') }}"><i class="las la-bookmark"></i> <span> Tentang  </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ set_active(['/tentang/struktur-organisasi']) }}" href="{{ route('/tentang/struktur-organisasi') }}">Struktur Organisasi</a></li>
                        <li><a class="{{ set_active(['/tentang/sop']) }}" href="{{ route('/tentang/sop') }}">SOP</a></li>
                    </ul>
                </li>
                <li class="menu">
                    <a href="{{ url('kontak') }}"><i class="las la-phone"></i> <span> Kontak </span></a> 
                </li>
                @endguest
                
                @if(auth()->check() && Auth::user()->role == 'stafbb')
                    <li class="menu" class="{{ set_active('dashboard/stafbb') }}">
                        <a href="{{ route('dashboard.stafbb') }}"><span> Beranda </span></a>
                    </li>
                @endif

                @if(auth()->check() && Auth::user()->role == 'kasibb')
                    <li class="menu" class="{{ set_active('dashboard/kasibb') }}">
                        <a href="{{ route('dashboard.kasibb') }}"><span> Beranda </span></a>
                    </li>
                @endif

                @if(auth()->check() && Auth::user()->role == 'kajari')
                    <li class="menu" class="{{ set_active('dashboard/kajari') }}">
                        <a href="{{ route('dashboard.kajari') }}"><span> Beranda </span></a>
                    </li>
                @endif

                @if(auth()->check() && Auth::user()->role == 'jaksa')
                    <li class="menu" class="{{ set_active('dashboard/jaksa') }}">
                        <a href="{{ route('dashboard.jaksa') }}"><span> Beranda </span></a>
                    </li>
                @endif

                @if(auth()->check() && in_array(Auth::user()->role, ['stafbb', 'kasibb', 'kajari','jaksa']))
                    <li class="menu">
                        <a href="{{ route('terdakwa.index') }}" class="{{ set_active(['terdakwa.index']) }}"> <span> Terdakwa </span> </a>
                    </li>
                    <li class="menu">
                        <a href="{{ route('peminjaman_bb.index') }}" class="{{ set_active(['peminjaman_bb.index']) }}"> <span> Pinjaman </span> </a>
                    </li>
                @endif

                {{-- Menu selain jaksa --}}
                @if(auth()->check() && in_array(Auth::user()->role, ['stafbb', 'kasibb', 'kajari']))
                    {{-- <li class="menu">
                        <a href="{{ route('login') }}" class="{{ set_active(['login']) }}"> <span> Barang Bukti </span> </a>
                    </li> --}}
                    <li class="menu">
                        <a href="{{ route('papan-kontrol') }}" class="{{ set_active('papan-kontrol') }}"> <span> Papan Kontrol </span> </a>
                    </li>
                    <li class="submenu">
                        <a class="{{ ('beritaacara/ba20') }}"><span> Berita Acara </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ set_active('beritaacara/ba20') }}" href="{{ route('ba20.index') }}">Pengembalian (BA20)</a></li>
                            <li><a class="{{ set_active('beritaacara/ba23') }}" href="{{ route('ba23.index') }}">Pemusnahan (BA23)</a></li>
                            <li><a class="{{ set_active('beritaacara/bensus') }}" href="{{ route('bensus.index') }}">Penyerahan Uang Rampasan</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a class="{{ set_active('rekapan-data-pemusnahan') }}"><span> Rekapan  </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ set_active(['rekapan-data-pemusnahan']) }}" href="{{ route('rekapan-data-pemusnahan') }}">Data Pemusnahan</a></li>
                            <li><a class="{{ set_active(['rekapan-data-pinjamb']) }}" href="{{ route('rekapan-data-pinjambb') }}">Data Pinjam Pakai BB untuk Kebutuhan Sidang</a></li>
                            <li><a class="{{ set_active(['rekapan-data-dikembalikan']) }}" href="{{ route('rekapan-data-dikembalikan') }}">Data yang Dikembalikan</a></li>
                            <li><a class="{{ set_active(['rekapan-data-bensus']) }}" href="{{ route('rekapan-data-bensus') }}">Data Bensus</a></li>
                            {{-- <li><a class="{{ set_active(['/tentang/sop']) }}" href="{{ route('/tentang/sop') }}">Data yang Bernilai Ekonomis Tinggi</a></li> --}}
                        </ul>
                    </li>
                @endif


                @if(auth()->check() && Auth::user()->role == 'stafbb')
                <li class="menu">
                    <a href="{{ route('pegawai.index') }}" class="{{ set_active(['login']) }}"> <span> Pegawai </span> </a>
                </li>
                <li class="menu">
                    <a href="{{ route('pangkat.index') }}" class="{{ set_active(['login']) }}"> <span> Pangkat </span> </a>
                </li>
                <li class="menu">
                    <a href="{{ route('user.index') }}" class="{{ set_active(['user.index']) }}"> <span> User </span> </a>
                </li>
                @endif

                {{-- Menu Jaksa --}}
                {{-- @if(auth()->check() && Auth::user()->role == 'jaksa')
                    <li class="menu">
                        <a href="{{ route('dashboard/page') }}"><span> Beranda </span></a>
                    </li>
                    <li class="menu">
                        <a href="{{ route('terdakwa.index') }}" class="{{ set_active(['terdakwa.index']) }}"> <span> Terdakwa </span> </a>
                    </li>
                    <li class="menu">
                        <a href="{{ route('peminjaman_bb.index') }}" class="{{ set_active(['peminjaman_bb.index']) }}"> <span> Pinjaman </span> </a>
                    </li>
                @endif --}}
                
                {{-- Login & Logout --}}
                @guest
                    <li class="menu">
                        <a href="{{ route('login') }}" class="{{ set_active(['login']) }}"> <span> Login </span> </a>
                    </li>
                @endguest
                @if(auth()->check() && in_array(Auth::user()->role, ['stafbb', 'kasibb', 'kajari', 'jaksa']))
                    <li class="menu">
                        <a href="#" onclick="confirmLogout()"> <span> Logout </span> </a>
                    </li>
            
                <script>
                    function confirmLogout() {
                        var isConfirmed = window.confirm("Apakah Anda yakin ingin logout?");
                        if (isConfirmed) {
                            window.location.href = "{{ route('logout') }}";
                        }
                    }
                </script>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        // Menangani klik pada elemen <a>
        $('.menu a').click(function(){
            // Menghapus kelas 'clicked' dari semua elemen <a>
            $('.menu a').removeClass('clicked');
            
            // Menambahkan kelas 'clicked' hanya pada elemen yang diklik
            $(this).addClass('clicked');
        });
    });
</script>