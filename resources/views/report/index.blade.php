@extends('layouts.app')

@section('content')
<style>

.reports-page {
    --r-bg: #f4f6fa;
    --r-surface: #ffffff;
    --r-border: #e4e8f0;
    --r-border-strong: #cfd6e3;
    --r-text: #1b2333;
    --r-muted: #6b7690;

    --r-primary: #2f5bea;
    --r-primary-dark: #2448c4;
    --r-primary-soft: #e8eefe;

    --r-success: #16a34a;
    --r-success-soft: #e3f6ea;
    --r-warning: #d98a0b;
    --r-warning-soft: #fdf1da;
    --r-info: #0e8fb3;
    --r-info-soft: #def3f9;
    --r-danger: #dc3545;
    --r-danger-soft: #fde6e8;

    --r-radius: 12px;
    --r-radius-sm: 8px;
    --r-shadow: 0 1px 2px rgba(27, 35, 51, .05), 0 4px 14px rgba(27, 35, 51, .04);

    max-width: 1400px;
    margin: 0 auto;
    padding: 28px 24px 48px;
    color: var(--r-text);
    font-size: 14px;
    line-height: 1.5;
    box-sizing: border-box;
}

.reports-page *,
.reports-page *::before,
.reports-page *::after {
    box-sizing: border-box;
}

.reports-page h1,
.reports-page h2,
.reports-page p {
    margin: 0;
}

.reports-page button {
    font-family: inherit;
    cursor: pointer;
}

.reports-page :focus-visible {
    outline: 2px solid var(--r-primary);
    outline-offset: 2px;
}

/* ---------- HEADER ---------- */

.reports-page .reports-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 24px;
}

.reports-page .reports-title h1 {
    font-size: 26px;
    font-weight: 700;
    letter-spacing: -.01em;
}

.reports-page .reports-title p {
    margin-top: 4px;
    color: var(--r-muted);
}

.reports-page .reports-header-actions {
    display: flex;
    gap: 10px;
}

/* ---------- BUTTONS ---------- */

.reports-page .btn-report-primary,
.reports-page .btn-report-secondary,
.reports-page .btn-report-clear {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 40px;
    padding: 0 18px;
    border-radius: var(--r-radius-sm);
    border: 1px solid transparent;
    font-size: 14px;
    font-weight: 600;
    transition: background-color .15s, border-color .15s, color .15s;
}

.reports-page .btn-report-primary {
    background: var(--r-primary);
    color: #fff;
}

.reports-page .btn-report-primary:hover {
    background: var(--r-primary-dark);
}

.reports-page .btn-report-secondary,
.reports-page .btn-report-clear {
    background: var(--r-surface);
    border-color: var(--r-border-strong);
    color: var(--r-text);
}

.reports-page .btn-report-secondary:hover,
.reports-page .btn-report-clear:hover {
    background: var(--r-bg);
    border-color: var(--r-muted);
}

/* ---------- STAT CARDS ---------- */

.reports-page .reports-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}

.reports-page .report-stat-card {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 18px 20px;
    background: var(--r-surface);
    border: 1px solid var(--r-border);
    border-radius: var(--r-radius);
    box-shadow: var(--r-shadow);
}

.reports-page .report-stat-icon {
    flex: 0 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 12px;
}

.reports-page .report-stat-icon-primary { background: var(--r-primary-soft); color: var(--r-primary); }
.reports-page .report-stat-icon-success { background: var(--r-success-soft); color: var(--r-success); }
.reports-page .report-stat-icon-warning { background: var(--r-warning-soft); color: var(--r-warning); }
.reports-page .report-stat-icon-info    { background: var(--r-info-soft);    color: var(--r-info); }

.reports-page .report-stat-content {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.reports-page .report-stat-value {
    font-size: 26px;
    font-weight: 700;
    line-height: 1.15;
    font-variant-numeric: tabular-nums;
}

.reports-page .report-stat-label {
    color: var(--r-muted);
    font-size: 13px;
}

/* ---------- FILTER CARD ---------- */

.reports-page .report-filter-card,
.reports-page .report-result-card,
.reports-page .quick-reports {
    background: var(--r-surface);
    border: 1px solid var(--r-border);
    border-radius: var(--r-radius);
    box-shadow: var(--r-shadow);
    margin-bottom: 24px;
}

.reports-page .report-filter-card {
    padding: 22px 24px;
}

.reports-page .report-filter-header {
    margin-bottom: 18px;
}

.reports-page .report-filter-header h2,
.reports-page .quick-reports-header h2,
.reports-page .report-result-title h2 {
    font-size: 17px;
    font-weight: 700;
}

.reports-page .report-filter-header p,
.reports-page .quick-reports-header p,
.reports-page .report-result-title p {
    margin-top: 2px;
    color: var(--r-muted);
    font-size: 13px;
}

.reports-page .report-filter-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px 20px;
}

.reports-page .report-form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.reports-page .report-form-group label {
    font-size: 13px;
    font-weight: 600;
    color: var(--r-text);
}

.reports-page .report-form-control {
    width: 100%;
    height: 42px;
    padding: 0 12px;
    background: var(--r-surface);
    border: 1px solid var(--r-border-strong);
    border-radius: var(--r-radius-sm);
    color: var(--r-text);
    font-family: inherit;
    font-size: 14px;
    transition: border-color .15s, box-shadow .15s;
}

.reports-page select.report-form-control {
    appearance: none;
    -webkit-appearance: none;
    padding-right: 36px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='%236b7690' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
}

.reports-page .report-form-control:hover {
    border-color: var(--r-muted);
}

.reports-page .report-form-control:focus {
    outline: none;
    border-color: var(--r-primary);
    box-shadow: 0 0 0 3px rgba(47, 91, 234, .18);
}

.reports-page .report-filter-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 22px;
    padding-top: 18px;
    border-top: 1px solid var(--r-border);
}

/* ---------- RESULT CARD ---------- */

.reports-page .report-result-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    padding: 20px 24px;
    border-bottom: 1px solid var(--r-border);
}

.reports-page .report-result-actions {
    display: flex;
    gap: 8px;
}

.reports-page .report-export-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    height: 36px;
    padding: 0 14px;
    border-radius: var(--r-radius-sm);
    border: 1px solid;
    font-size: 13px;
    font-weight: 600;
    transition: background-color .15s, color .15s;
}

.reports-page .report-export-pdf {
    color: var(--r-danger);
    border-color: #f3c3c8;
    background: var(--r-danger-soft);
}

.reports-page .report-export-pdf:hover {
    background: var(--r-danger);
    border-color: var(--r-danger);
    color: #fff;
}

.reports-page .report-export-excel {
    color: var(--r-success);
    border-color: #b7e3c6;
    background: var(--r-success-soft);
}

.reports-page .report-export-excel:hover {
    background: var(--r-success);
    border-color: var(--r-success);
    color: #fff;
}

/* ---------- SUMMARY ---------- */

.reports-page .report-summary {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    border-bottom: 1px solid var(--r-border);
}

.reports-page .report-summary-item {
    display: flex;
    flex-direction: column;
    gap: 2px;
    padding: 16px 24px;
    border-right: 1px solid var(--r-border);
}

.reports-page .report-summary-item:last-child {
    border-right: 0;
}

.reports-page .report-summary-item span {
    color: var(--r-muted);
    font-size: 13px;
}

.reports-page .report-summary-item strong {
    font-size: 22px;
    font-weight: 700;
    font-variant-numeric: tabular-nums;
}

.reports-page .summary-success { color: var(--r-success); }
.reports-page .summary-info    { color: var(--r-info); }
.reports-page .summary-warning { color: var(--r-warning); }
.reports-page .summary-danger  { color: var(--r-danger); }

/* ---------- TABLE ---------- */

.reports-page .report-table-wrapper {
    overflow-x: auto;
}

.reports-page .report-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 900px;
}

.reports-page .report-table th {
    padding: 12px 16px;
    background: var(--r-bg);
    border-bottom: 1px solid var(--r-border);
    color: var(--r-muted);
    font-size: 12.5px;
    font-weight: 600;
    text-align: left;
    white-space: nowrap;
}

.reports-page .report-table td {
    padding: 14px 16px;
    border-bottom: 1px solid var(--r-border);
    vertical-align: middle;
    white-space: nowrap;
}

.reports-page .report-table tbody tr:last-child td {
    border-bottom: 0;
}

.reports-page .report-table tbody tr:hover {
    background: #f9fafd;
}

.reports-page .report-table .text-right {
    text-align: right;
    font-variant-numeric: tabular-nums;
    font-weight: 600;
}

.reports-page .report-table th:first-child,
.reports-page .report-table td:first-child {
    padding-left: 24px;
}

.reports-page .report-table th:last-child,
.reports-page .report-table td:last-child {
    padding-right: 24px;
}

.reports-page .code {
    display: inline-block;
    padding: 3px 8px;
    background: var(--r-primary-soft);
    border-radius: 6px;
    color: var(--r-primary);
    font-size: 12.5px;
    font-weight: 600;
}

.reports-page .cell-title {
    display: block;
    font-weight: 600;
}

.reports-page .cell-sub {
    display: block;
    margin-top: 1px;
    color: var(--r-muted);
    font-size: 12px;
}

/* ---------- STATUS BADGES ---------- */

.reports-page .status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 11px;
    border-radius: 999px;
    font-size: 12.5px;
    font-weight: 600;
}

.reports-page .status::before {
    content: "";
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}

.reports-page .status-progress { background: var(--r-info-soft);    color: var(--r-info); }
.reports-page .status-waiting  { background: var(--r-warning-soft); color: var(--r-warning); }
.reports-page .status-ready    { background: var(--r-primary-soft); color: var(--r-primary); }
.reports-page .status-done     { background: var(--r-success-soft); color: var(--r-success); }
.reports-page .status-cancel   { background: var(--r-danger-soft);  color: var(--r-danger); }

/* ---------- FOOTER / PAGINATION ---------- */

.reports-page .report-result-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
    padding: 16px 24px;
    border-top: 1px solid var(--r-border);
    color: var(--r-muted);
    font-size: 13px;
}

.reports-page .pagination {
    display: flex;
    align-items: center;
    gap: 6px;
    margin: 0;
    padding: 0;
}

.reports-page .page-btn {
    min-width: 34px;
    height: 34px;
    padding: 0 8px;
    background: var(--r-surface);
    border: 1px solid var(--r-border-strong);
    border-radius: 8px;
    color: var(--r-text);
    font-size: 13px;
    font-weight: 600;
    transition: background-color .15s, border-color .15s;
}

.reports-page .page-btn:hover:not(:disabled):not(.active) {
    background: var(--r-bg);
}

.reports-page .page-btn.active {
    background: var(--r-primary);
    border-color: var(--r-primary);
    color: #fff;
}

.reports-page .page-btn:disabled {
    opacity: .45;
    cursor: not-allowed;
}

/* ---------- QUICK REPORTS ---------- */

.reports-page .quick-reports {
    padding: 22px 24px;
    margin-bottom: 0;
}

.reports-page .quick-reports-header {
    margin-bottom: 18px;
}

.reports-page .quick-reports-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
}

.reports-page .quick-report-card {
    display: flex;
    align-items: center;
    gap: 14px;
    width: 100%;
    padding: 16px;
    background: var(--r-surface);
    border: 1px solid var(--r-border);
    border-radius: var(--r-radius);
    color: var(--r-text);
    text-align: left;
    transition: border-color .15s, box-shadow .15s, transform .15s;
}

.reports-page .quick-report-card:hover {
    border-color: var(--r-primary);
    box-shadow: 0 4px 16px rgba(47, 91, 234, .12);
}

.reports-page .quick-report-icon {
    flex: 0 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 12px;
    font-size: 20px;
    font-weight: 700;
}

.reports-page .quick-report-icon-primary { background: var(--r-primary-soft); color: var(--r-primary); }
.reports-page .quick-report-icon-success { background: var(--r-success-soft); color: var(--r-success); }
.reports-page .quick-report-icon-warning { background: var(--r-warning-soft); color: var(--r-warning); }
.reports-page .quick-report-icon-info    { background: var(--r-info-soft);    color: var(--r-info); }

.reports-page .quick-report-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
    min-width: 0;
}

.reports-page .quick-report-content strong {
    font-size: 14px;
    font-weight: 700;
}

.reports-page .quick-report-content span {
    color: var(--r-muted);
    font-size: 12.5px;
    line-height: 1.4;
}

.reports-page .quick-report-arrow {
    flex: 0 0 auto;
    color: var(--r-muted);
    font-size: 18px;
    transition: transform .15s, color .15s;
}

.reports-page .quick-report-card:hover .quick-report-arrow {
    color: var(--r-primary);
    transform: translateX(3px);
}

/* ---------- RESPONSIVE ---------- */

@media (max-width: 1200px) {
    .reports-page .quick-reports-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 992px) {
    .reports-page .reports-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .reports-page .report-filter-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .reports-page .report-summary {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .reports-page .report-summary-item {
        border-bottom: 1px solid var(--r-border);
    }
}

@media (max-width: 640px) {
    .reports-page {
        padding: 18px 14px 36px;
    }

    .reports-page .reports-stats,
    .reports-page .report-filter-grid,
    .reports-page .quick-reports-grid {
        grid-template-columns: 1fr;
    }

    .reports-page .report-summary {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .reports-page .report-filter-actions {
        flex-direction: column-reverse;
    }

    .reports-page .report-filter-actions button {
        width: 100%;
    }

    .reports-page .report-result-footer {
        justify-content: center;
    }
}

/* ---------- YAZDIRMA ---------- */

@media print {
    .reports-page {
        padding: 0;
        max-width: none;
    }

    .reports-page .reports-header-actions,
    .reports-page .report-filter-card,
    .reports-page .report-result-actions,
    .reports-page .pagination,
    .reports-page .quick-reports {
        display: none !important;
    }

    .reports-page .report-stat-card,
    .reports-page .report-result-card {
        box-shadow: none;
    }

    .reports-page .report-table {
        min-width: 0;
    }
}
</style>
<div class="reports-page">

    {{-- =========================
         HEADER
         ========================= --}}
    <div class="reports-header">

        <div class="reports-title">
            <h1>Raporlar</h1>
            <p>Servis işlemlerinizi inceleyin, analiz edin ve raporlarınızı oluşturun.</p>
        </div>

        <div class="reports-header-actions">
            <button type="button" class="btn-report-secondary">
                Yazdır
            </button>

            <button type="button" class="btn-report-primary">
                PDF Oluştur
            </button>
        </div>

    </div>
    <div class="reports-stats">

        <div class="report-stat-card">

            <div class="report-stat-icon report-stat-icon-primary">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M4 19V5C4 4.44772 4.44772 4 5 4H19C19.5523 4 20 4.44772 20 5V19C20 19.5523 19.5523 20 19 20H5C4.44772 20 4 19.5523 4 19Z"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />
                    <path
                        d="M8 16V11"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />
                    <path
                        d="M12 16V8"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />
                    <path
                        d="M16 16V13"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />
                </svg>
            </div>

            <div class="report-stat-content">
                <span class="report-stat-value">248</span>
                <span class="report-stat-label">Toplam Servis</span>
            </div>

        </div>


        <div class="report-stat-card">

            <div class="report-stat-icon report-stat-icon-success">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M20 6L9 17L4 12"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </div>

            <div class="report-stat-content">
                <span class="report-stat-value">192</span>
                <span class="report-stat-label">Tamamlanan</span>
            </div>

        </div>


        <div class="report-stat-card">

            <div class="report-stat-icon report-stat-icon-warning">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M12 8V12"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />
                    <path
                        d="M12 16H12.01"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />
                    <path
                        d="M10.29 3.86L1.82 18C1.12 19.17 1.96 20.67 3.33 20.67H20.67C22.04 20.67 22.88 19.17 22.18 18L13.71 3.86C13 2.68 11 2.68 10.29 3.86Z"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linejoin="round"
                    />
                </svg>
            </div>

            <div class="report-stat-content">
                <span class="report-stat-value">31</span>
                <span class="report-stat-label">Bekleyen</span>
            </div>

        </div>


        <div class="report-stat-card">

            <div class="report-stat-icon report-stat-icon-info">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M3 3V21"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />
                    <path
                        d="M3 17H21"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />
                    <path
                        d="M7 13L10 10L13 12L19 6"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </div>

            <div class="report-stat-content">
                <span class="report-stat-value">77%</span>
                <span class="report-stat-label">Tamamlanma Oranı</span>
            </div>

        </div>

    </div>


    {{-- =========================
         FILTER CARD
         ========================= --}}
    <div class="report-filter-card">

        <div class="report-filter-header">

            <div>
                <h2>Rapor Filtreleri</h2>
                <p>Raporlamak istediğiniz servisleri filtreleyin.</p>
            </div>

        </div>


        <div class="report-filter-grid">

            <div class="report-form-group">

                <label for="report-type">
                    Rapor Türü
                </label>

                <select id="report-type" class="report-form-control">
                    <option value="service">Servis Raporu</option>
                    <option value="personnel">Personel Raporu</option>
                    <option value="customer">Müşteri Raporu</option>
                    <option value="vehicle">Araç Raporu</option>
                    <option value="income">Gelir Raporu</option>
                </select>

            </div>


            <div class="report-form-group">

                <label for="start-date">
                    Başlangıç Tarihi
                </label>

                <input
                    type="date"
                    id="start-date"
                    class="report-form-control"
                    value="2026-10-01"
                >

            </div>


            <div class="report-form-group">

                <label for="end-date">
                    Bitiş Tarihi
                </label>

                <input
                    type="date"
                    id="end-date"
                    class="report-form-control"
                    value="2026-10-08"
                >

            </div>


            <div class="report-form-group">

                <label for="report-status">
                    Servis Durumu
                </label>

                <select id="report-status" class="report-form-control">

                    <option value="all">
                        Tüm Durumlar
                    </option>

                    <option value="waiting">
                        Bekliyor
                    </option>

                    <option value="progress">
                        Devam Ediyor
                    </option>

                    <option value="ready">
                        Hazır
                    </option>

                    <option value="done">
                        Tamamlandı
                    </option>

                    <option value="cancel">
                        İptal
                    </option>

                </select>

            </div>


            <div class="report-form-group">

                <label for="personnel">
                    Personel
                </label>

                <select id="personnel" class="report-form-control">

                    <option value="all">
                        Tüm Personel
                    </option>

                    <option>
                        Mehmet Kaya
                    </option>

                    <option>
                        Ali Çelik
                    </option>

                    <option>
                        Hasan Yıldız
                    </option>

                </select>

            </div>


            <div class="report-form-group">

                <label for="customer">
                    Müşteri
                </label>

                <select id="customer" class="report-form-control">

                    <option value="all">
                        Tüm Müşteriler
                    </option>

                    <option>
                        Ahmet Yılmaz
                    </option>

                    <option>
                        Mustafa Demir
                    </option>

                    <option>
                        Burak Şahin
                    </option>

                </select>

            </div>

        </div>


        <div class="report-filter-actions">

            <button type="button" class="btn-report-clear">
                Filtreleri Temizle
            </button>

            <button type="button" class="btn-report-primary">
                Raporu Getir
            </button>

        </div>

    </div>


    {{-- =========================
         REPORT CONTENT
         ========================= --}}
    <div class="report-result-card">

        <div class="report-result-header">

            <div class="report-result-title">

                <h2>Servis Raporu</h2>

                <p>
                    01 Ekim 2026 - 08 Ekim 2026
                </p>

            </div>


            <div class="report-result-actions">

                <button type="button" class="report-export-btn report-export-pdf">

                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2Z"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M14 2V8H20"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M8 13H16"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />
                        <path
                            d="M8 17H13"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />
                    </svg>

                    PDF

                </button>


                <button type="button" class="report-export-btn report-export-excel">

                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M4 4C4 2.9 4.9 2 6 2H14L20 8V20C20 21.1 19.1 22 18 22H6C4.9 22 4 21.1 4 20V4Z"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M14 2V8H20"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M8 13L12 17"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />
                        <path
                            d="M12 13L8 17"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />
                    </svg>

                    Excel

                </button>

            </div>

        </div>


        {{-- =========================
             REPORT SUMMARY
             ========================= --}}
        <div class="report-summary">

            <div class="report-summary-item">

                <span>Toplam Servis</span>
                <strong>248</strong>

            </div>

            <div class="report-summary-item">

                <span>Tamamlanan</span>
                <strong class="summary-success">192</strong>

            </div>

            <div class="report-summary-item">

                <span>Devam Eden</span>
                <strong class="summary-info">25</strong>

            </div>

            <div class="report-summary-item">

                <span>Bekleyen</span>
                <strong class="summary-warning">31</strong>

            </div>

            <div class="report-summary-item">

                <span>İptal</span>
                <strong class="summary-danger">0</strong>

            </div>

        </div>


        {{-- =========================
             TABLE
             ========================= --}}
        <div class="report-table-wrapper">

            <table class="custom-table report-table">

                <thead>

                    <tr>

                        <th>Servis No</th>
                        <th>Tarih</th>
                        <th>Müşteri</th>
                        <th>Araç</th>
                        <th>Servis</th>
                        <th>Personel</th>
                        <th>Süre</th>
                        <th>Durum</th>
                        <th class="text-right">Tutar</th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td>
                            <span class="code">
                                SRV-26001
                            </span>
                        </td>

                        <td>
                            08.10.2026
                        </td>

                        <td>
                            <span class="cell-title">
                                Ahmet Yılmaz
                            </span>
                        </td>

                        <td>
                            <span class="cell-title">
                                BMW 320i
                            </span>

                            <span class="cell-sub">
                                34 ABC 123
                            </span>
                        </td>

                        <td>
                            Periyodik Bakım
                        </td>

                        <td>
                            Mehmet Kaya
                        </td>

                        <td>
                            1 saat
                        </td>

                        <td>
                            <span class="status status-progress">
                                Devam Ediyor
                            </span>
                        </td>

                        <td class="text-right">
                            ₺4.500
                        </td>

                    </tr>


                    <tr>

                        <td>
                            <span class="code">
                                SRV-26002
                            </span>
                        </td>

                        <td>
                            08.10.2026
                        </td>

                        <td>
                            Mustafa Demir
                        </td>

                        <td>

                            <span class="cell-title">
                                Renault Clio
                            </span>

                            <span class="cell-sub">
                                34 XYZ 456
                            </span>

                        </td>

                        <td>
                            Fren Sistemi Kontrolü
                        </td>

                        <td>
                            Ali Çelik
                        </td>

                        <td>
                            45 dk
                        </td>

                        <td>

                            <span class="status status-waiting">
                                Bekliyor
                            </span>

                        </td>

                        <td class="text-right">
                            ₺2.750
                        </td>

                    </tr>


                    <tr>

                        <td>

                            <span class="code">
                                SRV-26003
                            </span>

                        </td>

                        <td>
                            08.10.2026
                        </td>

                        <td>
                            Burak Şahin
                        </td>

                        <td>

                            <span class="cell-title">
                                Fiat Egea
                            </span>

                            <span class="cell-sub">
                                06 DEF 789
                            </span>

                        </td>

                        <td>
                            Yağ ve Filtre Değişimi
                        </td>

                        <td>
                            Hasan Yıldız
                        </td>

                        <td>
                            30 dk
                        </td>

                        <td>

                            <span class="status status-ready">
                                Hazır
                            </span>

                        </td>

                        <td class="text-right">
                            ₺1.850
                        </td>

                    </tr>


                    <tr>

                        <td>

                            <span class="code">
                                SRV-25998
                            </span>

                        </td>

                        <td>
                            07.10.2026
                        </td>

                        <td>
                            Mehmet Kaya
                        </td>

                        <td>

                            <span class="cell-title">
                                Volkswagen Golf
                            </span>

                            <span class="cell-sub">
                                34 KLM 321
                            </span>

                        </td>

                        <td>
                            Motor Bakımı
                        </td>

                        <td>
                            Mehmet Kaya
                        </td>

                        <td>
                            2 saat
                        </td>

                        <td>

                            <span class="status status-done">
                                Tamamlandı
                            </span>

                        </td>

                        <td class="text-right">
                            ₺6.250
                        </td>

                    </tr>


                    <tr>

                        <td>

                            <span class="code">
                                SRV-25997
                            </span>

                        </td>

                        <td>
                            07.10.2026
                        </td>

                        <td>
                            Ayşe Demir
                        </td>

                        <td>

                            <span class="cell-title">
                                Ford Focus
                            </span>

                            <span class="cell-sub">
                                34 MNO 654
                            </span>

                        </td>

                        <td>
                            Klima Bakımı
                        </td>

                        <td>
                            Ali Çelik
                        </td>

                        <td>
                            1 saat
                        </td>

                        <td>

                            <span class="status status-done">
                                Tamamlandı
                            </span>

                        </td>

                        <td class="text-right">
                            ₺3.200
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>


        {{-- =========================
             FOOTER
             ========================= --}}
        <div class="report-result-footer">

            <span>
                248 servisten 5 tanesi gösteriliyor
            </span>

            <div class="pagination">

                <button class="page-btn" disabled>
                    ‹
                </button>

                <button class="page-btn active">
                    1
                </button>

                <button class="page-btn">
                    2
                </button>

                <button class="page-btn">
                    3
                </button>

                <button class="page-btn">
                    ...
                </button>

                <button class="page-btn">
                    50
                </button>

                <button class="page-btn">
                    ›
                </button>

            </div>

        </div>

    </div>
    <div class="quick-reports">
         <div class="quick-reports-header">
            <div>
                <h2>Hızlı Raporlar</h2>
                <p>Sık kullanılan raporlara hızlıca ulaşın.</p>
            </div>

        </div>


        <div class="quick-reports-grid">

            <button class="quick-report-card">

                <div class="quick-report-icon quick-report-icon-primary">
                    📊
                </div>

                <div class="quick-report-content">
                    <strong>Aylık Servis Raporu</strong>
                    <span>Aylık servis performansını görüntüle</span>
                </div>

                <span class="quick-report-arrow">
                    →
                </span>

            </button>


            <button class="quick-report-card">

                <div class="quick-report-icon quick-report-icon-success">
                    ✓
                </div>

                <div class="quick-report-content">
                    <strong>Personel Performansı</strong>
                    <span>Personel bazlı servis performansı</span>
                </div>

                <span class="quick-report-arrow">
                    →
                </span>

            </button>


            <button class="quick-report-card">

                <div class="quick-report-icon quick-report-icon-warning">
                    ₺
                </div>

                <div class="quick-report-content">
                    <strong>Gelir Raporu</strong>
                    <span>Servis gelirlerini incele</span>
                </div>

                <span class="quick-report-arrow">
                    →
                </span>

            </button>


            <button class="quick-report-card">

                <div class="quick-report-icon quick-report-icon-info">
                    🚗
                </div>

                <div class="quick-report-content">
                    <strong>Araç Servis Geçmişi</strong>
                    <span>Araç bazlı servis geçmişini görüntüle</span>
                </div>

                <span class="quick-report-arrow">
                    →
                </span>

            </button>

        </div>

    </div>

</div>

@endsection
