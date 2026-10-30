@extends('layouts.app')

@section('content')

<div class="sales-page">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="page-title">
            <h1>Satışlar</h1>
            <p>Satışları, ödemeleri ve satış durumlarını yönetin.</p>
        </div>

        <div class="page-header-actions">

            <button type="button" class="btn-primary">
                + Yeni Satış
            </button>

        </div>

    </div>


    {{-- STATS --}}
    <div class="stats-grid sales-stats">

        <div class="stat-card">

            <div class="stat-icon stat-icon-primary">
                ₺
            </div>

            <div class="stat-content">

                <span class="stat-value">
                    ₺486.250
                </span>

                <span class="stat-label">
                    Toplam Satış
                </span>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon stat-icon-success">
                ↗
            </div>

            <div class="stat-content">

                <span class="stat-value">
                    ₺128.450
                </span>

                <span class="stat-label">
                    Bu Ay
                </span>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon stat-icon-warning">
                ₺
            </div>

            <div class="stat-content">

                <span class="stat-value">
                    ₺42.800
                </span>

                <span class="stat-label">
                    Bekleyen Ödeme
                </span>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon stat-icon-success">
                ✓
            </div>

            <div class="stat-content">

                <span class="stat-value">
                    86
                </span>

                <span class="stat-label">
                    Tamamlanan Satış
                </span>

            </div>

        </div>

    </div>


    {{-- SALES SUMMARY --}}
    <div class="sales-summary-grid">

        <div class="sales-summary-card">

            <div class="sales-summary-header">

                <div>
                    <span class="sales-summary-label">
                        Bu Ay
                    </span>

                    <strong>
                        ₺128.450
                    </strong>
                </div>

                <span class="sales-growth positive">
                    +18.4%
                </span>

            </div>

            <div class="sales-progress">

                <div
                    class="sales-progress-bar"
                    style="width: 72%;"
                ></div>

            </div>

            <span class="sales-summary-footer">
                Geçen aya göre satış performansı
            </span>

        </div>


        <div class="sales-summary-card">

            <div class="sales-summary-header">

                <div>
                    <span class="sales-summary-label">
                        Ortalama Satış
                    </span>

                    <strong>
                        ₺5.633
                    </strong>
                </div>

                <span class="sales-growth positive">
                    +7.2%
                </span>

            </div>

            <div class="sales-mini-stats">

                <div>
                    <span>Satış</span>
                    <strong>128</strong>
                </div>

                <div>
                    <span>Ürün</span>
                    <strong>214</strong>
                </div>

            </div>

        </div>

    </div>


    {{-- TOOLBAR --}}
    <div class="table-toolbar sales-toolbar">

        <div class="search-box">

            <span class="search-icon">
                ⌕
            </span>

            <input
                type="text"
                placeholder="Satış no, müşteri veya ürün ara..."
            >

        </div>


        <div class="sales-toolbar-actions">

            <select class="filter-select">

                <option>Tüm Tarihler</option>
                <option>Bugün</option>
                <option>Bu Hafta</option>
                <option>Bu Ay</option>
                <option>Bu Yıl</option>

            </select>


            <select class="filter-select">

                <option>Tüm Durumlar</option>
                <option>Tamamlandı</option>
                <option>Bekliyor</option>
                <option>İptal</option>

            </select>

        </div>

    </div>


    {{-- FILTER TABS --}}
    <div class="sales-filter-tabs">

        <button class="filter-tab active">
            Tümü
            <span>128</span>
        </button>

        <button class="filter-tab">
            Tamamlandı
            <span>86</span>
        </button>

        <button class="filter-tab">
            Bekliyor
            <span>29</span>
        </button>

        <button class="filter-tab">
            Ödeme Bekliyor
            <span>9</span>
        </button>

        <button class="filter-tab">
            İptal
            <span>4</span>
        </button>

    </div>


    {{-- TABLE --}}
    <div class="table-wrapper">

        <table class="custom-table sales-table">

            <thead>

                <tr>
                    <th>Satış</th>
                    <th>Müşteri</th>
                    <th>Ürün / Hizmet</th>
                    <th>Tutar</th>
                    <th>Ödeme</th>
                    <th>Tarih</th>
                    <th>Durum</th>
                    <th class="text-right">İşlemler</th>
                </tr>

            </thead>


            <tbody>

                <tr>

                    <td>

                        <span class="cell-title">
                            SAT-2026-00128
                        </span>

                        <span class="cell-sub">
                            #00128
                        </span>

                    </td>


                    <td>

                        <span class="cell-title">
                            ABC Tekstil
                        </span>

                        <span class="cell-sub">
                            Ahmet Yılmaz
                        </span>

                    </td>


                    <td>

                        <div class="product-cell">

                            <div class="product-icon">
                                ⚙
                            </div>

                            <div>

                                <strong>
                                    Kompresör Bakım Paketi
                                </strong>

                                <span>
                                    1 adet
                                </span>

                            </div>

                        </div>

                    </td>


                    <td>

                        <strong class="price">
                            ₺18.500
                        </strong>

                    </td>


                    <td>

                        <span class="payment-status payment-paid">
                            Ödendi
                        </span>

                    </td>


                    <td>
                        08.10.2026
                    </td>


                    <td>

                        <span class="status status-done">
                            Tamamlandı
                        </span>

                    </td>


                    <td>

                        <div class="table-actions">

                            <button class="action-btn edit">
                                Görüntüle
                            </button>

                            <button class="action-btn">
                                PDF
                            </button>

                        </div>

                    </td>

                </tr>


                <tr>

                    <td>

                        <span class="cell-title">
                            SAT-2026-00127
                        </span>

                        <span class="cell-sub">
                            #00127
                        </span>

                    </td>


                    <td>

                        <span class="cell-title">
                            Yıldız Makina
                        </span>

                        <span class="cell-sub">
                            Mustafa Demir
                        </span>

                    </td>


                    <td>

                        <div class="product-cell">

                            <div class="product-icon">
                                🔧
                            </div>

                            <div>

                                <strong>
                                    Periyodik Bakım
                                </strong>

                                <span>
                                    2 adet
                                </span>

                            </div>

                        </div>

                    </td>


                    <td>

                        <strong class="price">
                            ₺9.750
                        </strong>

                    </td>


                    <td>

                        <span class="payment-status payment-pending">
                            Bekliyor
                        </span>

                    </td>


                    <td>
                        07.10.2026
                    </td>


                    <td>

                        <span class="status status-waiting">
                            Bekliyor
                        </span>

                    </td>


                    <td>

                        <div class="table-actions">

                            <button class="action-btn edit">
                                Görüntüle
                            </button>

                            <button class="action-btn">
                                PDF
                            </button>

                        </div>

                    </td>

                </tr>


                <tr>

                    <td>

                        <span class="cell-title">
                            SAT-2026-00126
                        </span>

                        <span class="cell-sub">
                            #00126
                        </span>

                    </td>


                    <td>

                        <span class="cell-title">
                            Özkan Plastik
                        </span>

                        <span class="cell-sub">
                            Burak Şahin
                        </span>

                    </td>


                    <td>

                        <div class="product-cell">

                            <div class="product-icon">
                                ⚙
                            </div>

                            <div>

                                <strong>
                                    Soğutma Sistemi Bakımı
                                </strong>

                                <span>
                                    1 adet
                                </span>

                            </div>

                        </div>

                    </td>


                    <td>

                        <strong class="price">
                            ₺14.250
                        </strong>

                    </td>


                    <td>

                        <span class="payment-status payment-paid">
                            Ödendi
                        </span>

                    </td>


                    <td>
                        06.10.2026
                    </td>


                    <td>

                        <span class="status status-done">
                            Tamamlandı
                        </span>

                    </td>


                    <td>

                        <div class="table-actions">

                            <button class="action-btn edit">
                                Görüntüle
                            </button>

                            <button class="action-btn">
                                PDF
                            </button>

                        </div>

                    </td>

                </tr>


                <tr>

                    <td>

                        <span class="cell-title">
                            SAT-2026-00125
                        </span>

                        <span class="cell-sub">
                            #00125
                        </span>

                    </td>


                    <td>

                        <span class="cell-title">
                            Demir Sanayi
                        </span>

                        <span class="cell-sub">
                            Hasan Yıldız
                        </span>

                    </td>


                    <td>

                        <div class="product-cell">

                            <div class="product-icon">
                                🔩
                            </div>

                            <div>

                                <strong>
                                    Hidrolik Sistem Onarımı
                                </strong>

                                <span>
                                    1 adet
                                </span>

                            </div>

                        </div>

                    </td>


                    <td>

                        <strong class="price">
                            ₺24.800
                        </strong>

                    </td>


                    <td>

                        <span class="payment-status payment-partial">
                            Kısmi
                        </span>

                    </td>


                    <td>
                        05.10.2026
                    </td>


                    <td>

                        <span class="status status-progress">
                            Devam Ediyor
                        </span>

                    </td>


                    <td>

                        <div class="table-actions">

                            <button class="action-btn edit">
                                Görüntüle
                            </button>

                            <button class="action-btn">
                                PDF
                            </button>

                        </div>

                    </td>

                </tr>


                <tr>

                    <td>

                        <span class="cell-title">
                            SAT-2026-00124
                        </span>

                        <span class="cell-sub">
                            #00124
                        </span>

                    </td>


                    <td>

                        <span class="cell-title">
                            Mavi Otomotiv
                        </span>

                        <span class="cell-sub">
                            Mehmet Kaya
                        </span>

                    </td>


                    <td>

                        <div class="product-cell">

                            <div class="product-icon">
                                🚗
                            </div>

                            <div>

                                <strong>
                                    Araç Servis Paketi
                                </strong>

                                <span>
                                    1 adet
                                </span>

                            </div>

                        </div>

                    </td>


                    <td>

                        <strong class="price">
                            ₺7.450
                        </strong>

                    </td>


                    <td>

                        <span class="payment-status payment-paid">
                            Ödendi
                        </span>

                    </td>


                    <td>
                        04.10.2026
                    </td>


                    <td>

                        <span class="status status-done">
                            Tamamlandı
                        </span>

                    </td>


                    <td>

                        <div class="table-actions">

                            <button class="action-btn edit">
                                Görüntüle
                            </button>

                            <button class="action-btn">
                                PDF
                            </button>

                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>


    {{-- FOOTER --}}
    <div class="table-footer">

        <span>
            128 satıştan 1-5 arası gösteriliyor
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
                4
            </button>

            <button class="page-btn">
                ›
            </button>

        </div>

    </div>

</div>

@endsection
