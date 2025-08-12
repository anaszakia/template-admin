@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
{{-- ===================================================================== --}}
{{--  Semuanya dibungkus satu komponen Alpine dengan state openCreate       --}}
{{-- ===================================================================== --}}
<div x-data="{ 
    openCreate: false,
    editModals: {},
    detailModals: {},
    closeCreate() { 
        this.openCreate = false; 
    },
    openEdit(userId) { 
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
        this.editModals[userId] = true; 
    },
    closeEdit(userId) { 
        document.body.style.overflow = ''; // Restore scrolling
        this.editModals[userId] = false; 
    },
    openDetail(userId) { 
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
        this.detailModals[userId] = true; 
    },
    closeDetail(userId) { 
        document.body.style.overflow = ''; // Restore scrolling
        this.detailModals[userId] = false; 
    }
}" class="space-y-6">

    {{-- =============================== HEADER =========================== --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    @if(auth()->user()->role === 'admin')
                    Manajemen User
                    @else
                    Daftar User
                    @endif
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    @if(auth()->user()->role === 'admin')
                    Kelola akun pengguna sistem
                    @else
                    Informasi pengguna sistem
                    @endif
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                {{-- Form pencarian --}}
                <form method="GET" action="{{ auth()->user()->role === 'admin' ? route('admin.users.index') : route('user.users.index') }}" class="flex gap-2">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') ?? '' }}"
                               placeholder="Cari nama, email..."
                               class="border-gray-300 rounded-lg px-4 py-2.5 text-sm w-64 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <button type="submit"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-4 py-2.5 rounded-lg transition-colors font-medium">
                        Cari
                    </button>
                </form>

                {{-- Tombol Tambah (hanya untuk admin) --}}
                @if(auth()->user()->role === 'admin')
                <button @click="openCreate = true"
                        class="bg-blue-600 text-white px-4 py-2.5 rounded-lg hover:bg-blue-700 transition-colors font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah User
                </button>
                @endif
            </div>
        </div>
    </div>

    {{-- =============================== TABEL =========================== --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-600">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $color = match($user->role) {
                                    'admin' => 'bg-purple-100 text-purple-800 border-purple-200',
                                    'user'  => 'bg-blue-100 text-blue-800 border-blue-200',
                                    default => 'bg-gray-100 text-gray-800 border-gray-200'
                                };
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $color }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                            {{-- Tombol Detail --}}
                            <button
                                @click="openDetail({{ $user->id }})"
                                title="Detail"
                                class="inline-flex items-center p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>

                            {{-- Tombol Edit (hanya admin) --}}
                            @if(auth()->user()->role === 'admin')
                            <button
                                @click="openEdit({{ $user->id }})"
                                title="Edit"
                                class="inline-flex items-center p-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </button>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                  class="inline delete-form">
                                @csrf @method('DELETE')
                                <button type="button"
                                        title="Hapus"
                                        onclick="confirmDelete(this.closest('form'), '{{ $user->name }}')"
                                        class="inline-flex items-center p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>

                  {{-- MODAL DETAIL (per user) --}}
                    <div
                        x-show="detailModals[{{ $user->id }}]"
                        x-cloak
                        x-transition:enter="backdrop-transition"
                        x-transition:enter-start="backdrop-enter-start"
                        x-transition:enter-end="backdrop-enter-end"
                        x-transition:leave="backdrop-transition"
                        x-transition:leave-start="backdrop-leave-start"
                        x-transition:leave-end="backdrop-leave-end"
                        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4 overflow-y-auto">
                        <div @click.away="closeDetail({{ $user->id }})"
                             x-transition:enter="modal-transition"
                             x-transition:enter-start="modal-enter-start"
                             x-transition:enter-end="modal-enter-end"
                             x-transition:leave="modal-transition"
                             x-transition:leave-start="modal-leave-start"
                             x-transition:leave-end="modal-leave-end"
                             class="bg-white rounded-xl shadow-xl w-full max-w-lg my-8 mx-auto modal-container">
                            
                            {{-- Header --}}
                            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900">Detail User</h2>
                                    <p class="text-sm text-gray-500 mt-1">Informasi lengkap pengguna</p>
                                </div>
                                <button @click="closeDetail({{ $user->id }})" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>

                            {{-- Body --}}
                            <div class="px-6 py-6 max-h-[70vh] overflow-y-auto modal-scroll modal-body">
                                <div class="space-y-6">
                                    {{-- Avatar dan Nama --}}
                                    <div class="text-center">
                                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full mx-auto flex items-center justify-center text-white text-2xl font-bold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <h3 class="mt-4 text-xl font-semibold text-gray-900">{{ $user->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                    </div>

                                    {{-- Informasi Detail --}}
                                    <div class="grid grid-cols-1 gap-4">
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500">Role</dt>
                                                    <dd class="mt-1">
                                                        @php
                                                            $roleColor = match($user->role) {
                                                                'admin' => 'bg-purple-100 text-purple-800 border-purple-200',
                                                                'user'  => 'bg-blue-100 text-blue-800 border-blue-200',
                                                                default => 'bg-gray-100 text-gray-800 border-gray-200'
                                                            };
                                                        @endphp
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $roleColor }}">
                                                            {{ ucfirst($user->role) }}
                                                        </span>
                                                    </dd>
                                                </div>
                                                <div class="text-right">
                                                    <dt class="text-sm font-medium text-gray-500">User ID</dt>
                                                    <dd class="mt-1 text-sm font-mono text-gray-900">#{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</dd>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <dt class="text-sm font-medium text-gray-500">Terdaftar</dt>
                                                <dd class="mt-1 text-sm text-gray-900">
                                                    {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                                                </dd>
                                                <dd class="text-xs text-gray-500">
                                                    {{ $user->created_at ? $user->created_at->format('H:i') : '' }}
                                                </dd>
                                            </div>
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <dt class="text-sm font-medium text-gray-500">Terakhir Update</dt>
                                                <dd class="mt-1 text-sm text-gray-900">
                                                    {{ $user->updated_at ? $user->updated_at->format('d M Y') : '-' }}
                                                </dd>
                                                <dd class="text-xs text-gray-500">
                                                    {{ $user->updated_at ? $user->updated_at->format('H:i') : '' }}
                                                </dd>
                                            </div>
                                        </div>

                                        {{-- Status Akun --}}
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <dt class="text-sm font-medium text-gray-500 mb-2">Status Akun</dt>
                                            <div class="flex items-center gap-4">
                                                <div class="flex items-center">
                                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                                    <span class="text-sm text-gray-700">Aktif</span>
                                                </div>
                                                @if($user->email_verified_at)
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span class="text-sm text-gray-700">Email Terverifikasi</span>
                                                </div>
                                                @else
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-yellow-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L5.268 15.5c-.77.833.192 2.5 1.732 2.5z"/>
                                                    </svg>
                                                    <span class="text-sm text-gray-700">Email Belum Terverifikasi</span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
                                <button type="button" @click="closeDetail({{ $user->id }})"
                                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- ============= MODAL EDIT (per user) ============= --}}
                    @if(auth()->user()->role === 'admin')
                    <div
                        x-show="editModals[{{ $user->id }}]"
                        x-cloak
                        x-transition:enter="backdrop-transition"
                        x-transition:enter-start="backdrop-enter-start"
                        x-transition:enter-end="backdrop-enter-end"
                        x-transition:leave="backdrop-transition"
                        x-transition:leave-start="backdrop-leave-start"
                        x-transition:leave-end="backdrop-leave-end"
                        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4 overflow-y-auto">
                        <div @click.away="closeEdit({{ $user->id }})"
                             x-transition:enter="modal-transition"
                             x-transition:enter-start="modal-enter-start"
                             x-transition:enter-end="modal-enter-end"
                             x-transition:leave="modal-transition"
                             x-transition:leave-start="modal-leave-start"
                             x-transition:leave-end="modal-leave-end"
                             class="bg-white rounded-xl shadow-xl w-full max-w-lg my-8 mx-auto modal-container">
                            
                            {{-- Header --}}
                            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900">Edit User</h2>
                                    <p class="text-sm text-gray-500 mt-1">Ubah informasi pengguna</p>
                                </div>
                                <button @click="closeEdit({{ $user->id }})" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>

                            {{-- Body --}}
                            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto modal-scroll modal-body">
                                <form method="POST"
                                      action="{{ route('admin.users.update', $user) }}"
                                      class="space-y-4">
                                    @csrf @method('PUT')

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                                            <input type="text" name="name" value="{{ $user->name }}"
                                                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                   required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                            <input type="email" name="email" value="{{ $user->email }}"
                                                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                                            <select name="role"
                                                    class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                    required>
                                                <option value="admin" @selected($user->role==='admin')>Admin</option>
                                                <option value="user" @selected($user->role==='user')>User</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Password
                                                <span class="text-xs text-gray-500 font-normal">(kosongkan jika tidak diubah)</span>
                                            </label>
                                            <input type="password" name="password"
                                                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation"
                                                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        </div>
                                    </div>

                                    <div class="flex justify-end space-x-3 pt-4">
                                        <button type="button" @click="closeEdit({{ $user->id }})"
                                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                                            Batal
                                        </button>
                                        <button type="submit"
                                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                                <p class="text-lg font-medium">Tidak ada data user</p>
                                <p class="text-sm">Belum ada user yang terdaftar dalam sistem</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ============================ PAGINATION ========================== --}}
    @if(isset($users) && method_exists($users, 'links'))
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
        {{ $users->links() }}
    </div>
    @endif

    {{-- ========================= MODAL CREATE =========================== --}}
    @if(auth()->user()->role === 'admin')
    <div
        x-show="openCreate"
        x-cloak
        x-transition:enter="backdrop-transition"
        x-transition:enter-start="backdrop-enter-start"
        x-transition:enter-end="backdrop-enter-end"
        x-transition:leave="backdrop-transition"
        x-transition:leave-start="backdrop-leave-start"
        x-transition:leave-end="backdrop-leave-end"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4 overflow-y-auto">
        <div @click.away="openCreate=false"
             x-transition:enter="modal-transition"
             x-transition:enter-start="modal-enter-start"
             x-transition:enter-end="modal-enter-end"
             x-transition:leave="modal-transition"
             x-transition:leave-start="modal-leave-start"
             x-transition:leave-end="modal-leave-end"
             class="bg-white rounded-xl shadow-xl w-full max-w-lg my-8 mx-auto modal-container">

            {{-- Header --}}
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Tambah User</h2>
                <p class="text-sm text-gray-500 mt-1">Buat akun pengguna baru</p>
            </div>

            {{-- Body --}}
            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto modal-scroll modal-body">
                <form method="POST" action="{{ route('admin.users.store') }}" id="userCreateForm" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Masukkan email" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                            <select name="role"
                                    class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    required>
                                <option value="" selected disabled>Pilih Role</option>
                                <option value="admin" @selected(old('role')==='admin')>Admin</option>
                                <option value="user" @selected(old('role')==='user')>User</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password" name="password"
                                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Masukkan password" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                   class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Ulangi password" required>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button" @click="closeCreate()"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                    Batal
                </button>
                <button type="submit" form="userCreateForm"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Simpan
                </button>
            </div>
        </div>
    </div>
    @endif
    {{-- ===================== END MODAL CREATE ========================= --}}
</div>

{{-- Custom Scrollbar Styles --}}
<style>
/* Custom scrollbar for modal content */
.modal-scroll {
    scroll-behavior: smooth;
}

.modal-scroll::-webkit-scrollbar {
    width: 6px;
}

.modal-scroll::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.modal-scroll::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
    transition: background-color 0.2s ease;
}

.modal-scroll::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Firefox */
.modal-scroll {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f1f5f9;
}

/* Responsive modal height */
@media (max-height: 640px) {
    .modal-body {
        max-height: 60vh !important;
    }
}

@media (max-height: 480px) {
    .modal-body {
        max-height: 50vh !important;
    }
}

/* Ensure modal content doesn't get cut off on small screens */
.modal-container {
    max-height: calc(100vh - 2rem);
    overflow: visible;
}
</style>

@endsection