@extends('layouts.palm')

@section('title', 'Kelola Anggota QC')

@php $pageTitle = 'Kelola Anggota QC'; @endphp

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-text-main">Daftar Anggota QC</h2>
            <p class="text-text-secondary text-sm">Kelola akun anggota QC</p>
        </div>
        <a href="{{ route('admin.officers.create') }}" 
           class="flex items-center gap-2 h-10 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors">
            <span class="material-symbols-outlined text-[18px]">person_add</span>
            Tambah Anggota QC
        </a>
    </div>

    <div class="overflow-hidden rounded-xl border border-surface-border bg-white shadow-sm">
        <div class="overflow-x-auto">
        <table class="w-full text-left text-sm min-w-[500px]">
            <thead class="bg-surface-light border-b border-surface-border">
                <tr>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Anggota</th>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Username</th>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Jabatan</th>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse($officers as $officer)
                    <tr class="hover:bg-[#fafcf8] transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($officer->profile_photo)
                                    <img src="{{ asset('storage/' . $officer->profile_photo) }}" 
                                         alt="{{ $officer->name }}" 
                                         class="w-9 h-9 rounded-full object-cover border border-surface-border">
                                @else
                                    <div class="w-9 h-9 rounded-full bg-primary/20 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-primary text-[16px]">person</span>
                                    </div>
                                @endif
                                <span class="text-text-main font-medium">{{ $officer->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 text-text-secondary">
                                <span class="material-symbols-outlined text-[14px]">alternate_email</span>
                                {{ $officer->username ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-text-main">{{ $officer->jabatan ?? '-' }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.officers.show', $officer) }}" class="p-1.5 text-text-secondary hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.officers.edit', $officer) }}" class="p-1.5 text-text-secondary hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.officers.destroy', $officer) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus anggota QC ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-text-secondary hover:text-red-500 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-text-secondary">Belum ada data anggota QC.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <div class="mt-4">{{ $officers->links() }}</div>
@endsection
