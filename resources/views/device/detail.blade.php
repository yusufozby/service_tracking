@extends('layouts.app')

@section('content')
@php
    $statusMap = [
        'active'     => ['status-done',     'Aktif'],
        'service'    => ['status-progress', 'Serviste'],
        'in_service' => ['status-progress', 'Serviste'],
        'passive'    => ['status-waiting',  'Pasif'],
        'inactive'   => ['status-waiting',  'Pasif'],
    ];
    [$statusClass, $statusLabel] = $statusMap[$device->status] ?? ['status-ready', $device->status];
    $personelName = optional($device->personel)->name ?? ('#' . $device->personel_id);
@endphp

<div class="devices-page">

    <a href="{{ route('device.index') }}" class="detail-back">← Cihazlara dön</a>

    {{-- Hero --}}
    <div class="chart-card detail-hero">
        <div class="detail-hero-media">
            @if($device->image)
                <a href="{{ asset('storage/'.$device->image)}}" target="_blank" rel="noopener">
                    <img src="{{ asset('storage/'.$device->image)}}" alt="{{ $device->name }}" class="detail-hero-img"
                         onerror="this.parentElement.style.display='none'; this.parentElement.nextElementSibling.style.display='flex';">
                </a>
                <div class="detail-hero-empty" style="display:none;">Resim yüklenemedi</div>
            @else
                <div class="detail-hero-empty">Resim yok</div>
            @endif
        </div>

        <div class="detail-hero-body">
            <span class="status {{ $statusClass }}">{{ $statusLabel }}</span>
            <h1 class="detail-hero-title">{{ $device->name }}</h1>
            <p class="detail-hero-sub">{{ $device->model ?? '-' }}</p>

            <div class="detail-hero-meta">
                <span class="code">{{ $device->serial_no }}</span>
                <span class="detail-hero-dot">•</span>
                <span>Tür: {{ $device->type ?? '-' }}</span>
            </div>
        </div>
    </div>

    {{-- Özet kartları --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon stat-icon-primary">#</div>
            <div class="stat-content">
                <span class="stat-value detail-stat-value">{{ $device->serial_no }}</span>
                <span class="stat-label">Seri no</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-info">⚙</div>
            <div class="stat-content">
                <span class="stat-value detail-stat-value">{{ $device->type ?? '-' }}</span>
                <span class="stat-label">Cihaz türü</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-secondary">M</div>
            <div class="stat-content">
                <span class="stat-value detail-stat-value">{{ $device->model ?? '-' }}</span>
                <span class="stat-label">Model</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-success">P</div>
            <div class="stat-content">
                <span class="stat-value detail-stat-value">{{ $personelName }}</span>
                <span class="stat-label">Sorumlu personel</span>
            </div>
        </div>
    </div>

    {{-- Kayıt bilgileri --}}
    <div class="chart-card">
        <h2 class="chart-title">Kayıt bilgileri</h2>
        <div class="detail-record">
            <div>
                <span class="cell-sub">Cihaz ID</span>
                <span class="cell-title">#{{ $device->id }}</span>
            </div>
            <div>
                <span class="cell-sub">Oluşturulma</span>
                <span class="cell-title">{{ $device->created_at ? $device->created_at->format('d.m.Y H:i') : '-' }}</span>
            </div>
            <div>
                <span class="cell-sub">Son güncelleme</span>
                <span class="cell-title">{{ $device->updated_at ? $device->updated_at->format('d.m.Y H:i') : '-' }}</span>
            </div>
        </div>
    </div>

</div>
@endsection
