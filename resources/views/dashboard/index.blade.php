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

{{-- ===== GECİKMİŞ SERVİSLER UYARI BANDI ===== --}}
<div class="svc-alert mb-4" role="alert">
    <div class="svc-alert-icon" aria-hidden="true">!</div>
    <div class="svc-alert-text">
        <strong>7 günü aşan 12 servis kaydı var</strong>
        <span>En eski kayıt 16 gündür bekliyor (SRV-0987). Müşterileri bilgilendirmeniz önerilir.</span>
    </div>
    <button type="button" class="svc-alert-btn">Kayıtları gör</button>
</div>

{{-- ===== SON AKTİVİTELER + HIZLI İŞLEMLER ===== --}}
<div class="row pb-4">
    <div class="col-md-6 mb-3 mb-md-0">
        <div class="chart-card">
            <h3 class="chart-title">Son Aktiviteler</h3>
            <ul class="svc-timeline">
                <li>
                    <span class="svc-dot svc-dot-success"></span>
                    <div>
                        <div class="svc-tl-title"><b>SRV-1043</b> teslime hazır yapıldı</div>
                        <div class="svc-tl-meta">14:20 · Mehmet K.</div>
                    </div>
                </li>
                <li>
                    <span class="svc-dot svc-dot-primary"></span>
                    <div>
                        <div class="svc-tl-title"><b>SRV-1044</b> yeni kayıt açıldı</div>
                        <div class="svc-tl-meta">13:05 · Can D.</div>
                    </div>
                </li>
                <li>
                    <span class="svc-dot svc-dot-warning"></span>
                    <div>
                        <div class="svc-tl-title"><b>SRV-1041</b> için parça bekleniyor</div>
                        <div class="svc-tl-meta">11:42 · Mehmet K.</div>
                    </div>
                </li>
                <li>
                    <span class="svc-dot svc-dot-success"></span>
                    <div>
                        <div class="svc-tl-title"><b>SRV-1040</b> müşteriye teslim edildi</div>
                        <div class="svc-tl-meta">Dün 17:30 · Can D.</div>
                    </div>
                </li>
                <li>
                    <span class="svc-dot svc-dot-danger"></span>
                    <div>
                        <div class="svc-tl-title"><b>SRV-1038</b> iptal edildi</div>
                        <div class="svc-tl-meta">Dün 15:10 · Mehmet K.</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-6">
        <div class="chart-card">
            <h3 class="chart-title">Hızlı İşlemler</h3>
            <div class="svc-actions">
                <button type="button" class="svc-action svc-action-main">
                    <b>Yeni servis kaydı</b>
                    <span>Cihaz ve müşteri bilgilerini girerek kayıt aç</span>
                </button>
                <button type="button" class="svc-action">
                    <b>SMS gönder</b>
                    <span>Müşteriyi bilgilendir</span>
                </button>
                <button type="button" class="svc-action">
                    <b>Fiyat teklifi</b>
                    <span>Teklif oluştur</span>
                </button>
                <button type="button" class="svc-action">
                    <b>Servis sorgula</b>
                    <span>IMEI veya seri no ile ara</span>
                </button>
                <button type="button" class="svc-action">
                    <b>Rapor indir</b>
                    <span>Aylık özet (PDF)</span>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ===== FOOTER ===== --}}
<footer class="svc-footer">
    <span>Servis Takip v1.0.0</span>
    <span class="svc-footer-status">
        <span class="svc-dot svc-dot-success" style="margin-top:0"></span>
        Son yedekleme: 30.09.2026 03:00
    </span>
    <a href="mailto:destek@ornek.com">Destek</a>
</footer>

{{-- Yeni bölümlerin stilleri. İsterseniz ana CSS dosyanıza taşıyabilirsiniz. --}}
<style>
    /* Uyarı bandı */
    .svc-alert {
        display: flex; align-items: center; gap: 16px; flex-wrap: wrap;
        padding: 16px 20px;
        background: #fff7ed;
        border: 1px solid var(--warning, #d97706);
        border-radius: 16px;
    }
    .svc-alert-icon {
        flex: none; width: 36px; height: 36px; border-radius: 50%;
        display: grid; place-items: center;
        background: var(--warning, #d97706); color: #fff; font-weight: 700;
    }
    .svc-alert-text { flex: 1; min-width: 220px; }
    .svc-alert-text strong { display: block; font-size: 15px; }
    .svc-alert-text span { font-size: 13px; color: #6b7280; }
    .svc-alert-btn {
        padding: 8px 16px; font: inherit; font-size: 13px; font-weight: 500;
        color: #fff; background: var(--warning, #d97706);
        border: 0; border-radius: 8px; cursor: pointer;
    }
    .svc-alert-btn:hover { opacity: .9; }

    /* Zaman çizgisi */
    .svc-timeline { list-style: none; margin: 0; padding: 0; }
    .svc-timeline li { position: relative; display: flex; gap: 14px; padding-bottom: 18px; }
    .svc-timeline li:last-child { padding-bottom: 0; }
    .svc-timeline li::before {
        content: ""; position: absolute; left: 5px; top: 16px; bottom: 0;
        width: 2px; background: #e5e7eb;
    }
    .svc-timeline li:last-child::before { display: none; }
    .svc-dot { flex: none; width: 12px; height: 12px; margin-top: 4px; border-radius: 50%; }
    .svc-dot-primary { background: var(--primary, #2563eb); }
    .svc-dot-success { background: var(--success, #059669); }
    .svc-dot-warning { background: var(--warning, #d97706); }
    .svc-dot-danger  { background: var(--danger, #dc2626); }
    .svc-tl-title { font-size: 14px; }
    .svc-tl-title b { font-weight: 600; }
    .svc-tl-meta { margin-top: 2px; font-size: 12px; color: #6b7280; }

    /* Hızlı işlemler */
    .svc-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .svc-action {
        display: flex; flex-direction: column; gap: 4px;
        padding: 16px; text-align: left; font: inherit; color: inherit;
        background: #fff; border: 1px solid #e5e7eb; border-radius: 12px;
        cursor: pointer; transition: border-color .15s, background .15s;
    }
    .svc-action:hover { border-color: #353535; background: #f9fafb; }
    .svc-action b { font-size: 14px; font-weight: 600; }
    .svc-action span { font-size: 12px; color: #6b7280; }
    .svc-action-main { grid-column: 1 / -1; color: #fff; background: #353535; border-color: #353535; }
    .svc-action-main span { color: inherit; opacity: .75; }
    .svc-action-main:hover { background: #353535; opacity: .9; }
    @@media (max-width: 480px) { .svc-actions { grid-template-columns: 1fr; } }

    /* Footer */
    .svc-footer {
        display: flex; align-items: center; justify-content: space-between;
        gap: 12px 24px; flex-wrap: wrap;
        margin-top: 8px; padding: 16px 0 24px;
        border-top: 1px solid #e5e7eb;
        font-size: 13px; color: #6b7280;
    }
    .svc-footer-status { display: inline-flex; align-items: center; gap: 8px; }
    .svc-footer a { color: inherit; text-decoration: underline; text-underline-offset: 3px; }
    .svc-footer a:hover { color: #353535; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    Chart.defaults.font.family = "'Inter', sans-serif";

    const css = getComputedStyle(document.documentElement);
    const color = (name) => css.getPropertyValue(name).trim();
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

    const statusData = [
        { label: 'Bekliyor',      value: 56, color: color('--warning') },
        { label: 'Devam Ediyor',  value: 8,  color: color('--info') },
        { label: 'Teslime Hazır', value: 5,  color: color('--primary') },
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
