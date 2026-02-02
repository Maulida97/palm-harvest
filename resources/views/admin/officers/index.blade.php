@extends('layouts.palm')

@section('title', 'Kelola Petugas')

@php $pageTitle = 'Kelola Petugas'; @endphp

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-text-main">Daftar Petugas</h2>
            <p class="text-text-secondary text-sm">Kelola akun petugas lapangan</p>
        </div>
        <a href="{{ route('admin.officers.create') }}" 
           class="flex items-center gap-2 h-10 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors">
            <span class="material-symbols-outlined text-[18px]">person_add</span>
            Tambah Petugas
        </a>
    </div>

    <div class="overflow-hidden rounded-xl border border-surface-border bg-white shadow-sm">
        <div class="overflow-x-auto">
        <table class="w-full text-left text-sm min-w-[650px]">
            <thead class="bg-surface-light border-b border-surface-border">
                <tr>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Nama</th>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Email</th>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Telepon</th>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Total Panen</th>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse($officers as $officer)
                    <tr class="hover:bg-[#fafcf8] transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary text-[16px]">person</span>
                                </div>
                                <span class="text-text-main font-medium">{{ $officer->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-text-secondary">{{ $officer->email }}</td>
                        <td class="px-6 py-4 text-text-main">{{ $officer->phone ?? '-' }}</td>
                        <td class="px-6 py-4 text-text-main font-semibold">{{ number_format($officer->harvests_sum_weight_kg ?? 0) }} Kg</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.officers.show', $officer) }}" class="p-1.5 text-text-secondary hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.officers.edit', $officer) }}" class="p-1.5 text-text-secondary hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.officers.destroy', $officer) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus petugas ini?')">
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
                        <td colspan="5" class="px-6 py-8 text-center text-text-secondary">Belum ada data petugas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <div class="mt-4">{{ $officers->links() }}</div>
@endsection
