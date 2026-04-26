<nav x-data="{ open: false }" style="background: rgba(255,255,255,0.72); border-bottom: 1px solid rgba(255,255,255,0.78); backdrop-filter: blur(18px);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <span style="display:grid; place-items:center; width:40px; height:40px; border-radius:15px; color:white; font-weight:800; background:linear-gradient(135deg,#ec7fad,#6aa9df); box-shadow:0 12px 26px rgba(106,169,223,.28);">
                        TMB
                    </span>
                    <span style="font-weight:800; color:#263247;">Galatama TMB</span>
                </a>

                <div class="hidden sm:flex sm:items-center sm:gap-2">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl text-sm font-bold {{ request()->routeIs('dashboard') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-600 hover:bg-white/70' }}">
                        Dashboard
                    </a>
                    <a href="{{ url('/barang') }}" class="px-4 py-2 rounded-xl text-sm font-bold {{ request()->is('barang*') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-600 hover:bg-white/70' }}">
                        Barang
                    </a>
                    <a href="{{ url('/transaksi') }}" class="px-4 py-2 rounded-xl text-sm font-bold {{ request()->is('transaksi*') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-600 hover:bg-white/70' }}">
                        Transaksi
                    </a>
                    <a href="{{ url('/laporan') }}" class="px-4 py-2 rounded-xl text-sm font-bold {{ request()->is('laporan*') ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-600 hover:bg-white/70' }}">
                        Laporan
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-3">
                <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-xl text-sm font-bold text-slate-600 hover:bg-white/70">
                    {{ Auth::user()->name }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-xl text-sm font-bold text-white" style="background:linear-gradient(135deg,#ec7fad,#6aa9df);">
                        Log Out
                    </button>
                </form>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:bg-white/70 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="space-y-1 px-4 pb-4">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-bold text-slate-700 hover:bg-white/70">Dashboard</a>
            <a href="{{ url('/barang') }}" class="block px-4 py-3 rounded-xl text-sm font-bold text-slate-700 hover:bg-white/70">Barang</a>
            <a href="{{ url('/transaksi') }}" class="block px-4 py-3 rounded-xl text-sm font-bold text-slate-700 hover:bg-white/70">Transaksi</a>
            <a href="{{ url('/laporan') }}" class="block px-4 py-3 rounded-xl text-sm font-bold text-slate-700 hover:bg-white/70">Laporan</a>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-xl text-sm font-bold text-slate-700 hover:bg-white/70">Profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-sm font-bold text-white" style="background:linear-gradient(135deg,#ec7fad,#6aa9df);">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</nav>
