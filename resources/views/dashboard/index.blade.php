@extends('layouts.app')

@section('content')

{{-- ===== STAT KARTLARI ===== --}}
<div class="row my-3">
    <div class="col-md-3 pb-2">
        <div class="stat-card">
            <div class="stat-icon stat-icon-warning">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="stat-content">
                <span class="stat-value">56</span>
                <span class="stat-label">Bekleyen Servis</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 pb-2">
        <div class="stat-card ">
            <div class="stat-icon stat-icon-info">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-6.16c-.395-.414-.605-.976-.595-1.552a6 6 0 00-7.478-6.375c-.29.077-.371.416-.157.63l4.65 4.65a1.5 1.5 0 01-2.122 2.121l-4.65-4.65c-.213-.214-.552-.133-.63.157a6 6 0 006.375 7.478c.576-.01 1.14.2 1.552.595z" />
                </svg>
            </div>
            <div class="stat-content">
                <span class="stat-value">8</span>
                <span class="stat-label">Devam Eden</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 pb-2">
        <div class="stat-card">
            <div class="stat-icon stat-icon-success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </div>
            <div class="stat-content">
                <span class="stat-value">5</span>
                <span class="stat-label">Bugün Teslim</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 pb-2">
        <div class="stat-card">
            <div class="stat-icon stat-icon-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="stat-content">
                <span class="stat-value">₺24.500</span>
                <span class="stat-label">Toplam Gelir</span>
            </div>
        </div>
    </div>
</div>

{{-- ===== ARAMA ===== --}}
<x-input
    name="search"
    hintText="Ara..."
/>

{{-- ===== TOOLBAR (filtre sekmeleri + yeni servis) ===== --}}
<div class="table-toolbar">
    <div class="filter-tabs">
        <button class="filter-tab active">Tümü <span>69</span></button>
        <button class="filter-tab">Bekleyen <span>56</span></button>
        <button class="filter-tab">Devam Eden <span>8</span></button>
        <button class="filter-tab">Teslime Hazır <span>5</span></button>
        <button class="filter-tab">Teslim Edildi</button>
    </div>
    <div class="toolbar-right">
        <button class="btn-add">+ Yeni Servis</button>
    </div>
</div>

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
            <tr>
                <td><span class="code">SRV-1045</span></td>
                <td>
                    <div class="product-cell">
                        <div class="product-icon">AY</div>
                        <div>
                            <strong>Ahmet Yılmaz</strong>
                            <span>0532 000 00 00</span>
                        </div>
                    </div>
                </td>
                <td>
                    <strong class="cell-title">iPhone 13</strong>
                    <span class="cell-sub">IMEI: 35•••••4821</span>
                </td>
                <td>Ekran kırık</td>
                <td>Mehmet K.</td>
                <td>28.09.2026</td>
                <td><strong>₺1.850,00</strong></td>
                <td><span class="status status-waiting">Bekliyor</span></td>
                <td class="text-right">
                    <div class="table-actions">
                        <button class="action-btn edit">Detay</button>
                        <button class="action-btn edit">Düzenle</button>
                        <button class="action-btn delete">Sil</button>
                    </div>
                </td>
            </tr>

            <tr>
                <td><span class="code">SRV-1044</span></td>
                <td>
                    <div class="product-cell">
                        <div class="product-icon">EK</div>
                        <div>
                            <strong>Elif Kaya</strong>
                            <span>0533 000 00 00</span>
                        </div>
                    </div>
                </td>
                <td>
                    <strong class="cell-title">Lenovo ThinkPad E14</strong>
                    <span class="cell-sub">SN: PF3•••92</span>
                </td>
                <td>Açılmıyor</td>
                <td>Can D.</td>
                <td>27.09.2026</td>
                <td><strong>₺2.400,00</strong></td>
                <td><span class="status status-progress">Devam Ediyor</span></td>
                <td class="text-right">
                    <div class="table-actions">
                        <button class="action-btn edit">Detay</button>
                        <button class="action-btn edit">Düzenle</button>
                        <button class="action-btn delete">Sil</button>
                    </div>
                </td>
            </tr>

            <tr>
                <td><span class="code">SRV-1043</span></td>
                <td>
                    <div class="product-cell">
                        <div class="product-icon">MD</div>
                        <div>
                            <strong>Mustafa Demir</strong>
                            <span>0534 000 00 00</span>
                        </div>
                    </div>
                </td>
                <td>
                    <strong class="cell-title">Samsung Galaxy S22</strong>
                    <span class="cell-sub">IMEI: 35•••••7710</span>
                </td>
                <td>Batarya değişimi</td>
                <td>Mehmet K.</td>
                <td>26.09.2026</td>
                <td><strong>₺950,00</strong></td>
                <td><span class="status status-ready">Teslime Hazır</span></td>
                <td class="text-right">
                    <div class="table-actions">
                        <button class="action-btn edit">Detay</button>
                        <button class="action-btn edit">Düzenle</button>
                        <button class="action-btn delete">Sil</button>
                    </div>
                </td>
            </tr>

            <tr>
                <td><span class="code">SRV-1040</span></td>
                <td>
                    <div class="product-cell">
                        <div class="product-icon">ZA</div>
                        <div>
                            <strong>Zeynep Aslan</strong>
                            <span>0535 000 00 00</span>
                        </div>
                    </div>
                </td>
                <td>
                    <strong class="cell-title">HP LaserJet Pro</strong>
                    <span class="cell-sub">SN: VNB•••15</span>
                </td>
                <td>Kağıt sıkışması</td>
                <td>Can D.</td>
                <td>24.09.2026</td>
                <td><strong>₺600,00</strong></td>
                <td><span class="status status-done">Teslim Edildi</span></td>
                <td class="text-right">
                    <div class="table-actions">
                        <button class="action-btn edit">Detay</button>
                        <button class="action-btn edit">Düzenle</button>
                        <button class="action-btn delete">Sil</button>
                    </div>
                </td>
            </tr>

            <tr>
                <td><span class="code">SRV-1038</span></td>
                <td>
                    <div class="product-cell">
                        <div class="product-icon">BÇ</div>
                        <div>
                            <strong>Burak Çelik</strong>
                            <span>0536 000 00 00</span>
                        </div>
                    </div>
                </td>
                <td>
                    <strong class="cell-title">Xiaomi Redmi Note 11</strong>
                    <span class="cell-sub">IMEI: 86•••••3302</span>
                </td>
                <td>Onarım ekonomik değil</td>
                <td>Mehmet K.</td>
                <td>22.09.2026</td>
                <td><strong>₺0,00</strong></td>
                <td><span class="status status-cancel">İptal</span></td>
                <td class="text-right">
                    <div class="table-actions">
                        <button class="action-btn edit">Detay</button>
                        <button class="action-btn edit">Düzenle</button>
                        <button class="action-btn delete">Sil</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="table-footer">
    <span>5 kayıttan 1-5 arası gösteriliyor</span>
    <nav class="pagination">
        <button class="page-btn" disabled>‹</button>
        <button class="page-btn active">1</button>
        <button class="page-btn">2</button>
        <button class="page-btn">3</button>
        <button class="page-btn">›</button>
    </nav>
</div>

<div class="row pb-4">
    <div class="col-md-6">
        <div class="chart-card">
            <h3 class="chart-title">Aylık Arızalar</h3>
            <div class="bar-canvas">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
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
<h3 class="my-2">Cihazlar</h3>
<hr/>
<div class="table-wrapper">
        <table class="custom-table service-table">
        <thead>
            <tr>
                <th>Cihaz no</th>
                <th>Marka</th>
                <th>Model</th>
                <th>Seri no</th>

                <th>Giriş Tarihi</th>
                <th>Fiyat</th>

                <th class="text-right">İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>321</td>
                    <td>321</td>
                        <td>321</td>
                            <td>321</td>
                                <td>321</td>
                                    <td>321</td>
                                         <td class="text-right">
                    <div class="table-actions">
                        <button class="action-btn edit">Detay</button>
                        <button class="action-btn edit">Düzenle</button>
                        <button class="action-btn delete">Sil</button>
                    </div>
                </td>

            </tr>
        </tbody>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    Chart.defaults.font.family = "'Inter', sans-serif";

    const css = getComputedStyle(document.documentElement);
    const color = (name) => css.getPropertyValue(name).trim();

    /* ---------- Bar grafik: Aylık arızalar ---------- */
    new Chart(document.getElementById('myChart'), {
        type: 'bar',
        data: {
            labels: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
            datasets: [{
                label: 'Arızalar',
                data: [12, 19, 3, 5, 2, 3, 13, 9, 10, 5, 9, 11],
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
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#F1F5F9' },
                    border: { display: false }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    /* ---------- Doughnut grafik: Servis durumu ---------- */
    const statusData = [
        { label: 'Bekliyor',      value: 56, color: color('--warning') },
        { label: 'Devam Ediyor',  value: 8,  color: color('--info') },
        { label: 'Teslime Hazır', value: 5,  color: color('--primary') },
        // { label: 'Teslim Edildi', value: 0, color: color('--success') },
        // { label: 'İptal',         value: 0, color: color('--danger') },
    ];

    const total = statusData.reduce((sum, s) => sum + s.value, 0);
    document.getElementById('statusTotal').textContent = total;

    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: statusData.map(s => s.label),
            datasets: [{
                data: statusData.map(s => s.value),
                backgroundColor: statusData.map(s => s.color),
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
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) => {
                            const pct = Math.round(ctx.parsed / total * 100);
                            return ` ${ctx.label}: ${ctx.parsed} (%${pct})`;
                        }
                    }
                }
            }
        }
    });

    // Özel legend listesi
    document.getElementById('statusLegend').innerHTML = statusData.map(s => `
        <li>
            <span class="legend-dot" style="background:${s.color}"></span>
            <span class="legend-name">${s.label}</span>
            <span class="legend-count">${s.value}</span>
            <span class="legend-percent">%${Math.round(s.value / total * 100)}</span>
        </li>
    `).join('');
</script>

@endsection
