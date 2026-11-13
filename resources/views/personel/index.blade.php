
@extends('layouts.app')

@section('title', 'Personeller')

@section('content')

<div class="services-page">

    <div class="page-header">
        <div class="page-title">
            <h1>Personeller</h1>
            <p>Sistemde kayıtlı personelleri görüntüleyin ve yönetin.</p>
        </div>

        <div class="page-header-actions">
            <a href="{{ route('personel.create') }}" class="btn-primary">
                + Yeni Personel
            </a>
        </div>
    </div>

    <div class="services-table-wrapper">
        <table class="services-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ad Soyad</th>
                    <th>Telefon</th>
                    <th>Vergi Numarası</th>
                    <th>Vergi Dairesi</th>
                    <th>İşe Başlama Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>

            <tbody>
                @forelse($personels as $personel)
                    <tr>
                        <td><strong>#{{ $personel->id }}</strong></td>

                        <td>{{ $personel->fullname }}</td>

                        <td>{{ $personel->phone_number ?? '-' }}</td>

                        <td>{{ $personel->tax_number ?? '-' }}</td>

                        <td>{{ $personel->tax_office ?? '-' }}</td>

                        <td>
                            {{ $personel->date_of_joining
                                ? \Carbon\Carbon::parse($personel->date_of_joining)->format('d.m.Y')
                                : '-' }}
                        </td>

                        <td>
                            <div style="display:flex; align-items:center; gap:8px;">

                                <a href="{{ route('personel.edit', $personel->id) }}"
                                   style="color:var(--primary); text-decoration:none; font-weight:600;">
                                    Düzenle
                                </a>

                                <form action="{{ route('personel.destroy', $personel) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            style="border:0; background:none; color:var(--danger); cursor:pointer; font-family:inherit; font-weight:600;">
                                        Sil
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty-message">
                            Henüz personel kaydı bulunmuyor.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
   3
    </div>

</div>

@endsection
