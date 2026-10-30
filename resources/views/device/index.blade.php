@extends('layouts.app')

@section('content')

<div class="devices-page">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-title">
            <h1>Cihazlar</h1>
            <p>Sistemde kayıtlı cihazları ve servis durumlarını yönetin.</p>
        </div>

        <div class="page-header-actions">
            <a href="{{ route('device.create') }}" style="text-decoration: none" class="btn-primary">
                + Yeni Cihaz
            </a>
        </div>
    </div>


    {{-- STAT CARDS --}}
    <div class="stats-grid devices-stats">

        <div class="stat-card">
            <div class="stat-icon stat-icon-primary">
                ⚙
            </div>

            <div class="stat-content">
                <span class="stat-value">{{$fullDevices->count()}}</span>
                <span class="stat-label">Toplam Cihaz</span>
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-icon stat-icon-success">
                ✓
            </div>

            <div class="stat-content">
                <span class="stat-value">{{$fullDevices->where('status','active')->count()}}</span>
                <span class="stat-label">Aktif Cihaz</span>
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-icon stat-icon-warning">
                🔧
            </div>

            <div class="stat-content">
                <span class="stat-value">{{$fullDevices->where('status','onService')->count()}}</span>
                <span class="stat-label">Serviste</span>
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-icon stat-icon-secondary">
                ◉
            </div>

            <div class="stat-content">
                <span class="stat-value">{{$fullDevices->where('status','passive')->count()}}</span>
                <span class="stat-label">Pasif</span>
            </div>
        </div>

    </div>


    {{-- TOOLBAR --}}
    <div class="table-toolbar devices-toolbar">
<form method="GET" onsubmit="
    if (!this.search.value.trim()) {
        this.search.disabled = true;
    }
">
<div class="d-flex ">
        <div class="search-box">
            <span class="search-icon">⌕</span>

            <input
            name="search"
            value="{{ request('search') }}"
                type="text"
                placeholder="Cihaz, seri no veya müşteri ara..."
            >

        </div>
   <button  class="btn-primary">
            Ara
        </button>
        </form>
        </div>


        <div class="toolbar-right">

            <div class="filter-tabs">

              <button onclick="onStatusChange('full')" class="filter-tab {{ request('status') == '' ? 'active' : '' }}">
                    Tümü
                    <span>{{$devices->count()}}</span>
                </button>

         <button onclick="onStatusChange('active')" class="filter-tab {{ request('status') == 'active' ? 'active' : '' }}">
                    Aktif
                    <span>{{$devices->where('status','active')->count()}}</span>
                </button>

                <button  onclick="onStatusChange('onService')" class="filter-tab {{ request('status') == 'onService' ? 'active' : '' }}">
                    Serviste
                  <span>{{$devices->where('status','onService')->count()}}</span>
                </button>

                <button  onclick="onStatusChange('passive')" class="filter-tab {{ request('status') == 'passive' ? 'active' : '' }}">
                    Pasif
                    <span>{{$devices->where('status','passive')->count()}}</span>
                </button>

            </div>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="table-wrapper">

        <table class="custom-table device-table">

            <thead>
                <tr>
                    <th>Cihaz</th>
                    <th>Seri No</th>
                    <th>Cihaz Türü</th>
                    <th>Son Servis</th>
                    <th>Durum</th>
                    <th>Resim</th>
                    <th class="text-right">İşlemler</th>
                </tr>
            </thead>

            <tbody>
    @foreach($devices as $device )
                 <tr>

                    <td>

                        <div class="product-cell">

                            <div class="product-icon">
                                ⚙
                            </div>

                            <div>
                                <strong>{{$device->name}}</strong>
                                <span>{{$device->model}}</span>
                            </div>

                        </div>
                    </td>

                    <td>
                        <span class="code">
                  {{ $device->serial_no }}
                        </span>
                    </td>



                    <td>
                        {{ $device->type }}
                    </td>

                    <td>
                        <span class="cell-title">
                            05.10.2026
                        </span>

                        <span class="cell-sub">
                            Periyodik bakım
                        </span>
                    </td>

                    <td>
                        @php
                            $statusMap = [
                                'onService' =>
                                [
                                    'state' => 'Serviste','color' => 'status-progress'
                                ],
                                'passive' => [
                                    'state' => 'Pasif', 'color' => 'status-cancel'
                                ],
                                'active' => [
                                    'state' => 'Aktif','color' => 'status-done'
                                ]
                            ];
                        @endphp
                        <span class="{{ 'status '.$statusMap[$device->status]['color'] }}">
                     {{ $statusMap[$device->status]['state'] }}
                        </span>
                    </td>
<td class="px-4 py-2">
    @if($device->image)
        <!-- Dıştaki kutuya ve içteki resme kesin boyutlar (w-12 h-12 / 48x48px) verdik -->

            <img src="{{ asset('storage/'.$device->image) }}"
            width="60"
            height="60"
            style="border-radius: 5px"
                 alt="Cihaz Resmi"
                 class="w-full h-full object-cover">

    @else
        <div class="w-6 h-6 rounded-md bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
    @endif
</td>
                    <td>
                        <div class="table-actions">
<a href="{{ route('device.detail', $device) }}" class="action-btn edit" title="Görüntüle">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
</svg>
</a>

<a href="{{ route('device.edit', $device) }}" class="action-btn" title="Düzenle">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg>
</a>

<form method="POST" action="{{ route('device.delete',$device) }}" style="display:inline;">
    @csrf
    @method('DELETE')

    <button  type="submit" class="action-btn delete" title="Sil">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg>
    </button>
</form>


                        </div>
                    </td>

                </tr>
                    @endforeach





            </tbody>

        </table>

    </div>


    {{-- FOOTER --}}
    <div class="table-footer">

        <span>
            124 cihazdan 1-4 arası gösteriliyor
        </span>

        <div class="pagination">
@php
    $paging = [];
@endphp

       @foreach ($devices as $index => $device )
       <button class="page-btn">
        {{ $index }}
       </button>


       @endforeach

        </div>

    </div>

</div>
<script>

function onStatusChange(status) {



    const url = new URL(window.location.href);

    if (status === 'full') {
        url.searchParams.delete('status');
    } else {
        url.searchParams.set('status', status);
    }

    url.searchParams.delete('page');

    window.location.href = url.toString();
}

    </script>

@endsection
