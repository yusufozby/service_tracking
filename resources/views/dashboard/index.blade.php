
@extends('layouts.app')

@section('title', 'Servis Yönetimi')

@section('content')

@php
    $statusLabels = [
        'pending'   => 'Bekliyor',
        'continues' => 'Devam Ediyor',
        'ready'     => 'Teslime Hazır',
        'delivered' => 'Teslim Edildi',
    ];

    $statusClasses = [
        'pending'   => 'status-waiting',
        'continues' => 'status-info',
        'ready'     => 'status-ready',
        'delivered' => 'status-success',
    ];

    $serviceRows = method_exists($services, 'getCollection')
        ? $services->getCollection()
        : $services;

    $statusCounts = [];

    foreach ($statusLabels as $status => $label) {
        $statusCounts[$status] = $serviceRows
            ->where('status', $status)
            ->count();
    }

    $totalServices = array_sum($statusCounts);
    $totalRevenue = $serviceRows->sum('price');
@endphp

{{-- ================= STAT KARTLARI ================= --}}

<div class="row my-3">

    <div class="col-md-3 pb-2">
        <div class="stat-card">
            <div class="stat-icon stat-icon-warning">
                <span>◷</span>
            </div>
            <div class="stat-content">
                <span class="stat-value">{{ $statusCounts['pending'] }}</span>
                <span class="stat-label">Bekleyen Servis</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 pb-2">
        <div class="stat-card">
            <div class="stat-icon stat-icon-info">
                <span>⚙</span>
            </div>
            <div class="stat-content">
                <span class="stat-value">{{ $statusCounts['continues'] }}</span>
                <span class="stat-label">Devam Eden</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 pb-2">
        <div class="stat-card">
            <div class="stat-icon stat-icon-success">
                <span>✓</span>
            </div>
            <div class="stat-content">
                <span class="stat-value">{{ $statusCounts['ready'] }}</span>
                <span class="stat-label">Teslime Hazır</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 pb-2">
        <div class="stat-card">
            <div class="stat-icon stat-icon-primary">
                <span>₺</span>
            </div>
            <div class="stat-content">
                <span class="stat-value">
                    ₺{{ number_format($totalRevenue, 2, ',', '.') }}
                </span>
                <span class="stat-label">Toplam Gelir</span>
            </div>
        </div>
    </div>

</div>


{{-- ================= ARAMA ================= --}}

<x-input
    name="search"
    hintText="Ara..."
/>


{{-- ================= TOOLBAR ================= --}}

<div class="table-toolbar">

    <div class="filter-tabs">

        <button type="button" class="filter-tab active" data-status="all">
            Tümü
            <span>{{ $totalServices }}</span>
        </button>

        @foreach ($statusLabels as $status => $label)
            <button
                type="button"
                class="filter-tab"
                data-status="{{ $status }}"
            >
                {{ $label }}
                <span>{{ $statusCounts[$status] }}</span>
            </button>
        @endforeach

    </div>

    <div class="toolbar-right">
        <a href="{{ route('dashboard.create') }}" class="btn-add">
            + Yeni Servis
        </a>
    </div>

</div>


{{-- ================= SERVİS TABLOSU ================= --}}

<div class="table-wrapper">

    <table class="custom-table service-table">

        <thead>
            <tr>
                <th>Servis No</th>
                <th>Müşteri</th>
                <th>Cihaz</th>
                <th>Arıza</th>
                <th>Teknisyen</th>
                <th>Giriş Tarihi</th>
                <th>Tutar</th>
                <th>Durum</th>
                <th class="text-right">İşlemler</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($services as $service)

                <tr data-status="{{ $service->status }}">

                    <td>
                        <span class="code">
                            {{ $service->service_no }}
                        </span>
                    </td>

                    <td>
                        <div class="product-cell">

                            <div class="product-icon">
                                {{ substr($service->customer_name ?? 'M', 0, 2) }}
                            </div>

                            <div>
                                <strong>
                                    {{ $service->customer_name ?? '-' }}
                                </strong>

                                <span>
                                    {{ $service->customer_contact ?? '-' }}
                                </span>
                            </div>

                        </div>
                    </td>

                    <td>
                        <strong class="cell-title">
                            {{ $service->device->name ?? '-' }}
                        </strong>
                    </td>

                    <td>
                        {{ $service->fault->title ?? '-' }}
                    </td>

                    <td>
                        {{ $service->personel->fullname ?? '-' }}
                    </td>

                    <td>
                        {{ $service->date_of_entry
                            ? \Carbon\Carbon::parse($service->date_of_entry)->format('d.m.Y')
                            : '-' }}
                    </td>

                    <td>
                        <strong>
                            ₺{{ number_format($service->price ?? 0, 2, ',', '.') }}
                        </strong>
                    </td>

                    <td>
                        <span class="status {{ $statusClasses[$service->status] ?? 'status-waiting' }}">
                            {{ $statusLabels[$service->status] ?? $service->status }}
                        </span>
                    </td>

                    <td class="text-right">

                        <div class="table-actions">

                            <a
                                href="#"
                                class="action-btn edit"
                            >
                                Detay
                            </a>

                            <a
                                href="{{ route('dashboard.edit',$service) }}"
                                class="action-btn edit"
                            >
                                Düzenle
                            </a>

                            <form
                                 action="{{ route('dashboard.destroy', $service->id) }}"
                                method="POST"
                                onsubmit="return confirm('Bu servis kaydını silmek istediğinize emin misiniz?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="action-btn delete">
                                    Sil
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="9" class="text-center">
                        Henüz servis kaydı bulunmuyor.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>


{{-- ================= SAYFALAMA ================= --}}

<div class="table-footer">

    <span>
        @if (method_exists($services, 'firstItem') && $services->total() > 0)
            {{ $services->total() }} kayıttan
            {{ $services->firstItem() }}-{{ $services->lastItem() }}
            arası gösteriliyor
        @else
            {{ $serviceRows->count() }} kayıt gösteriliyor
        @endif
    </span>

    @if (method_exists($services, 'links'))
        <div class="pagination">
            {{ $services->links() }}
        </div>
    @endif

</div>


{{-- ================= GRAFİKLER ================= --}}

<div class="row pb-4">

    <div class="col-md-6 mb-3">

        <div class="chart-card">

            <h3 class="chart-title">Aylık Servisler</h3>

            <div class="bar-canvas">
                <canvas id="myChart"></canvas>
            </div>

        </div>

    </div>


    <div class="col-md-6 mb-3">

        <div class="chart-card">

            <h3 class="chart-title">Servis Durumu Dağılımı</h3>

            <div class="doughnut-wrap">

                <div class="doughnut-canvas">

                    <canvas id="statusChart"></canvas>

                    <div class="doughnut-center">
                        <strong id="statusTotal">0</strong>
                        <span>Toplam Servis</span>
                    </div>

                </div>

                <ul class="doughnut-legend" id="statusLegend"></ul>

            </div>

        </div>

    </div>

</div>


{{-- ================= GECİKMİŞ SERVİSLER ================= --}}

@php
    $overdueServices = $serviceRows->filter(function ($service) {
        return $service->status !== 'delivered'
            && \Carbon\Carbon::parse($service->date_of_entry)->diffInDays(now()) >= 7;
    });

    $oldestService = $overdueServices
        ->sortBy('date_of_entry')
        ->first();
@endphp

@if ($overdueServices->count() > 0)

    <div class="svc-alert mb-4" role="alert">

        <div class="svc-alert-icon">!</div>

        <div class="svc-alert-text">

            <strong>
                7 günü aşan {{ $overdueServices->count() }} servis kaydı var
            </strong>

            <span>
                En eski kayıt
                {{ \Carbon\Carbon::parse($oldestService->date_of_entry)->diffInDays(now()) }}
                gündür bekliyor
                ({{ $oldestService->service_no }}).
                Müşterileri bilgilendirmeniz önerilir.
            </span>

        </div>

        <button
            type="button"
            class="svc-alert-btn"
            id="showOverdue"
        >
            Kayıtları gör
        </button>

    </div>

@endif


{{-- ================= SON AKTİVİTELER + HIZLI İŞLEMLER ================= --}}

<div class="row pb-4">

    <div class="col-md-6 mb-3 mb-md-0">

        <div class="chart-card">

            <h3 class="chart-title">Son Aktiviteler</h3>

            <ul class="svc-timeline">

                @forelse ($serviceRows->sortByDesc('created_at')->take(5) as $service)

                    <li>

                        <span class="svc-dot
                            {{ $service->status === 'delivered' ? 'svc-dot-success' :
                                ($service->status === 'ready' ? 'svc-dot-primary' :
                                ($service->status === 'continues' ? 'svc-dot-warning' : 'svc-dot-danger')) }}">
                        </span>

                        <div>

                            <div class="svc-tl-title">
                                <b>{{ $service->service_no }}</b>
                                {{ $statusLabels[$service->status] ?? $service->status }}
                            </div>

                            <div class="svc-tl-meta">
                                {{ $service->created_at?->format('d.m.Y H:i') ?? '-' }}
                            </div>

                        </div>

                    </li>

                @empty

                    <li>Henüz aktivite bulunmuyor.</li>

                @endforelse

            </ul>

        </div>

    </div>


    <div class="col-md-6">

        <div class="chart-card">

            <h3 class="chart-title">Hızlı İşlemler</h3>

            <div class="svc-actions">

                <a
                    href="{{ route('dashboard.create') }}"
                    class="svc-action svc-action-main"
                >
                    <b>Yeni servis kaydı</b>
                    <span>Cihaz ve müşteri bilgilerini girerek kayıt aç</span>
                </a>

                <a href="{{ route('dashboard.index') }}" class="svc-action">
                    <b>Servis kayıtları</b>
                    <span>Tüm servisleri görüntüle</span>
                </a>

                <a href="{{ route('dashboard.index') }}" class="svc-action">
                    <b>Servis sorgula</b>
                    <span>Servis kayıtlarını incele</span>
                </a>

                <a href="{{ route('dashboard.index') }}" class="svc-action">
                    <b>Raporlar</b>
                    <span>Servis kayıtlarını görüntüle</span>
                </a>

            </div>

        </div>

    </div>

</div>


{{-- ================= FOOTER ================= --}}

<footer class="svc-footer">

    <span>Servis Takip v1.0.0</span>

    <span class="svc-footer-status">
        <span class="svc-dot svc-dot-success" style="margin-top:0"></span>
        Sistem aktif
    </span>

    <a href="mailto:destek@ornek.com">Destek</a>

</footer>


{{-- ================= EK STİLLER ================= --}}

<style>

    .svc-alert {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        padding: 16px 20px;
        background: #fff7ed;
        border: 1px solid var(--warning, #d97706);
        border-radius: 16px;
    }

    .svc-alert-icon {
        flex: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background: var(--warning, #d97706);
        color: #fff;
        font-weight: 700;
    }

    .svc-alert-text {
        flex: 1;
        min-width: 220px;
    }

    .svc-alert-text strong {
        display: block;
        font-size: 15px;
    }

    .svc-alert-text span {
        font-size: 13px;
        color: #6b7280;
    }

    .svc-alert-btn {
        padding: 8px 16px;
        font: inherit;
        font-size: 13px;
        font-weight: 500;
        color: #fff;
        background: var(--warning, #d97706);
        border: 0;
        border-radius: 8px;
        cursor: pointer;
    }

    .svc-timeline {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .svc-timeline li {
        position: relative;
        display: flex;
        gap: 14px;
        padding-bottom: 18px;
    }

    .svc-timeline li:last-child {
        padding-bottom: 0;
    }

    .svc-timeline li::before {
        content: "";
        position: absolute;
        left: 5px;
        top: 16px;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }

    .svc-timeline li:last-child::before {
        display: none;
    }

    .svc-dot {
        flex: none;
        width: 12px;
        height: 12px;
        margin-top: 4px;
        border-radius: 50%;
    }

    .svc-dot-primary { background: var(--primary, #2563eb); }
    .svc-dot-success { background: var(--success, #059669); }
    .svc-dot-warning { background: var(--warning, #d97706); }
    .svc-dot-danger { background: var(--danger, #dc2626); }

    .svc-tl-title {
        font-size: 14px;
    }

    .svc-tl-meta {
        margin-top: 2px;
        font-size: 12px;
        color: #6b7280;
    }

    .svc-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .svc-action {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 16px;
        text-align: left;
        font: inherit;
        color: inherit;
        text-decoration: none;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        cursor: pointer;
        transition: border-color .15s, background .15s;
    }

    .svc-action:hover {
        border-color: #353535;
        background: #f9fafb;
    }

    .svc-action b {
        font-size: 14px;
        font-weight: 600;
    }

    .svc-action span {
        font-size: 12px;
        color: #6b7280;
    }

    .svc-action-main {
        grid-column: 1 / -1;
        color: #fff;
        background: #353535;
        border-color: #353535;
    }

    .svc-action-main span {
        color: inherit;
        opacity: .75;
    }

    .svc-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px 24px;
        flex-wrap: wrap;
        margin-top: 8px;
        padding: 16px 0 24px;
        border-top: 1px solid #e5e7eb;
        font-size: 13px;
        color: #6b7280;
    }

    .svc-footer-status {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .svc-footer a {
        color: inherit;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .table-actions form {
        display: inline-block;
    }

    .pagination {
        display: flex;
        justify-content: flex-end;
    }

    @media (max-width: 480px) {
        .svc-actions {
            grid-template-columns: 1fr;
        }
    }

</style>


{{-- ================= JAVASCRIPT ================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    // ================= ARAMA =================

    const searchInput = document.querySelector('input[name="search"]');

    const tableRows = document.querySelectorAll('.service-table tbody tr[data-status]');

    let activeStatus = 'all';

    function filterServices() {

        const searchValue = searchInput
            ? searchInput.value.toLocaleLowerCase('tr')
            : '';

        tableRows.forEach(row => {

            const rowStatus = row.dataset.status;

            const matchesStatus =
                activeStatus === 'all' || rowStatus === activeStatus;

            const matchesSearch =
                row.textContent.toLocaleLowerCase('tr').includes(searchValue);

            row.style.display =
                matchesStatus && matchesSearch ? '' : 'none';

        });

    }

    if (searchInput) {
        searchInput.addEventListener('input', filterServices);
    }


    // ================= DURUM FİLTRESİ =================

    document.querySelectorAll('.filter-tab').forEach(tab => {

        tab.addEventListener('click', function () {

            document.querySelectorAll('.filter-tab').forEach(item => {
                item.classList.remove('active');
            });

            this.classList.add('active');

            activeStatus = this.dataset.status;

            filterServices();

        });

    });


    // ================= GECİKMİŞ SERVİSLER =================

    const overdueButton = document.getElementById('showOverdue');

    if (overdueButton) {

        overdueButton.addEventListener('click', function () {

            document.querySelectorAll('.filter-tab').forEach(item => {
                item.classList.remove('active');
            });

            activeStatus = 'all';

            if (searchInput) {
                searchInput.value = '';
            }

            tableRows.forEach(row => {

                const dateCell = row.querySelector('td:nth-child(6)');

                if (!dateCell) return;

                const parts = dateCell.textContent.trim().split('.');

                if (parts.length !== 3) return;

                const entryDate = new Date(
                    Number(parts[2]),
                    Number(parts[1]) - 1,
                    Number(parts[0])
                );

                const days = Math.floor(
                    (new Date() - entryDate) / (1000 * 60 * 60 * 24)
                );

                row.style.display =
                    row.dataset.status !== 'delivered' && days >= 7
                        ? ''
                        : 'none';

            });

        });

    }


    // ================= CHART.JS =================

    if (typeof Chart === 'undefined') return;

    Chart.defaults.font.family = "'Inter', sans-serif";

    const css = getComputedStyle(document.documentElement);

    const color = name => css.getPropertyValue(name).trim();


    // Aylık servis grafiği

    const monthlyCanvas = document.getElementById('myChart');

    if (monthlyCanvas) {

        new Chart(monthlyCanvas, {

            type: 'bar',

            data: {
                labels: [
                    'Ocak', 'Şubat', 'Mart', 'Nisan',
                    'Mayıs', 'Haziran', 'Temmuz', 'Ağustos',
                    'Eylül', 'Ekim', 'Kasım', 'Aralık'
                ],

                datasets: [{
                    label: 'Servisler',

                    data: @json(
                        collect(range(1, 12))->map(function ($month) use ($serviceRows) {
                            return $serviceRows->filter(function ($service) use ($month) {
                                return $service->date_of_entry
                                    && \Carbon\Carbon::parse($service->date_of_entry)->month == $month;
                            })->count();
                        })->values()
                    ),

                    backgroundColor: '#353535',
                    hoverBackgroundColor: '#555',
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        grid: {
                            color: '#F1F5F9'
                        },
                        border: {
                            display: false
                        }
                    },

                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }

        });

    }


    // Durum dağılımı grafiği

    const statusData = [
        {
            label: 'Bekliyor',
            value: @json($statusCounts['pending']),
            color: color('--warning')
        },
        {
            label: 'Devam Ediyor',
            value: @json($statusCounts['continues']),
            color: color('--info')
        },
        {
            label: 'Teslime Hazır',
            value: @json($statusCounts['ready']),
            color: color('--primary')
        },
        {
            label: 'Teslim Edildi',
            value: @json($statusCounts['delivered']),
            color: color('--success')
        }
    ];

    const total = statusData.reduce((sum, item) => sum + item.value, 0);

    const statusTotal = document.getElementById('statusTotal');

    if (statusTotal) {
        statusTotal.textContent = total;
    }


    const statusCanvas = document.getElementById('statusChart');

    if (statusCanvas) {

        new Chart(statusCanvas, {

            type: 'doughnut',

            data: {
                labels: statusData.map(item => item.label),

                datasets: [{
                    data: statusData.map(item => item.value),

                    backgroundColor: statusData.map(item => item.color),

                    borderColor: '#fff',
                    borderWidth: 3,
                    hoverOffset: 6
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        callbacks: {
                            label: context => {

                                const percentage = total > 0
                                    ? Math.round(context.parsed / total * 100)
                                    : 0;

                                return ` ${context.label}: ${context.parsed} (%${percentage})`;
                            }
                        }
                    }
                }

            }

        });

    }


    // Özel grafik açıklamaları

    const statusLegend = document.getElementById('statusLegend');

    if (statusLegend) {

        statusLegend.innerHTML = statusData.map(item => {

            const percentage = total > 0
                ? Math.round(item.value / total * 100)
                : 0;

            return `
                <li>
                    <span class="legend-dot" style="background:${item.color}"></span>
                    <span class="legend-name">${item.label}</span>
                    <span class="legend-count">${item.value}</span>
                    <span class="legend-percent">%${percentage}</span>
                </li>
            `;

        }).join('');

    }

});

</script>

@endsection
