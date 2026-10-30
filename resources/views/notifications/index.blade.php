@extends('layouts.app')

@section('title', 'Bildirimler')

@section('content')

<div class="notifications-page">

    {{-- =========================================
         HEADER
         ========================================= --}}
    <div class="notifications-header">

        <div class="notifications-title">

            <h1>Bildirimler</h1>

            <p>
                Servis sisteminizdeki son gelişmeler
            </p>

        </div>

        <div class="notifications-header-actions">

            <button
                type="button"
                class="notifications-read-all"
            >
                Tümünü okundu işaretle
            </button>

        </div>

    </div>


    {{-- =========================================
         FILTERS
         ========================================= --}}
    <div class="notifications-toolbar">

        <div class="notification-tabs">

            <button
                type="button"
                class="notification-tab active"
            >
                Tümü

                <span class="notification-tab-count">
                    18
                </span>
            </button>


            <button
                type="button"
                class="notification-tab"
            >
                Okunmamış

                <span class="notification-tab-count">
                    5
                </span>
            </button>


            <button
                type="button"
                class="notification-tab"
            >
                Servis
            </button>


            <button
                type="button"
                class="notification-tab"
            >
                Ödeme
            </button>


            <button
                type="button"
                class="notification-tab"
            >
                Stok
            </button>

        </div>

    </div>


    {{-- =========================================
         NOTIFICATIONS
         ========================================= --}}
    <div class="notifications-list">


        {{-- =====================================
             BUGÜN
             ===================================== --}}
        <div class="notification-group">

            <div class="notification-group-title">
                Bugün
            </div>


            {{-- Parça bekleniyor --}}
            <div class="notification-item unread">

                <div class="notification-icon notification-icon-danger">
                    !
                </div>


                <div class="notification-content">

                    <div class="notification-top">

                        <h3 class="notification-title">
                            Parça bekleniyor
                        </h3>

                        <span class="notification-time">
                            5 dk önce
                        </span>

                    </div>


                    <p class="notification-description">
                        34 ABC 123 plakalı araç için fren balatası
                        bekleniyor.
                    </p>


                    <div class="notification-service">

                        <span class="notification-service-code">
                            SRV-2026-00124
                        </span>

                        <span class="notification-service-separator">
                            •
                        </span>

                        <span class="notification-service-vehicle">
                            34 ABC 123
                        </span>

                    </div>


                    <span class="notification-type notification-type-danger">
                        Kritik
                    </span>

                </div>


                <span class="notification-unread-dot"></span>

            </div>


            {{-- Servis tamamlandı --}}
            <div class="notification-item unread">

                <div class="notification-icon notification-icon-success">
                    ✓
                </div>


                <div class="notification-content">

                    <div class="notification-top">

                        <h3 class="notification-title">
                            Servis tamamlandı
                        </h3>

                        <span class="notification-time">
                            18 dk önce
                        </span>

                    </div>


                    <p class="notification-description">
                        34 XYZ 456 plakalı aracın servisi tamamlandı
                        ve teslimata hazır.
                    </p>


                    <div class="notification-service">

                        <span class="notification-service-code">
                            SRV-2026-00123
                        </span>

                        <span class="notification-service-separator">
                            •
                        </span>

                        <span class="notification-service-vehicle">
                            34 XYZ 456
                        </span>

                    </div>


                    <span class="notification-type notification-type-success">
                        Servis
                    </span>

                </div>


                <span class="notification-unread-dot"></span>

            </div>


            {{-- Yeni iş emri --}}
            <div class="notification-item">

                <div class="notification-icon notification-icon-primary">
                    +
                </div>


                <div class="notification-content">

                    <div class="notification-top">

                        <h3 class="notification-title">
                            Yeni iş emri oluşturuldu
                        </h3>

                        <span class="notification-time">
                            32 dk önce
                        </span>

                    </div>


                    <p class="notification-description">
                        Ahmet Yılmaz adına yeni bir servis kaydı
                        oluşturuldu.
                    </p>


                    <div class="notification-service">

                        <span class="notification-service-code">
                            SRV-2026-00122
                        </span>

                        <span class="notification-service-separator">
                            •
                        </span>

                        <span class="notification-service-vehicle">
                            34 DEF 789
                        </span>

                    </div>


                    <span class="notification-type notification-type-primary">
                        İş Emri
                    </span>

                </div>

            </div>


            {{-- Ödeme --}}
            <div class="notification-item">

                <div class="notification-icon notification-icon-success">
                    ₺
                </div>


                <div class="notification-content">

                    <div class="notification-top">

                        <h3 class="notification-title">
                            Ödeme alındı
                        </h3>

                        <span class="notification-time">
                            1 saat önce
                        </span>

                    </div>


                    <p class="notification-description">
                        Servis ödemesi başarıyla alındı.
                    </p>


                    <div class="notification-service">

                        <span class="notification-service-code">
                            SRV-2026-00119
                        </span>

                        <span class="notification-service-separator">
                            •
                        </span>

                        <span class="notification-service-vehicle">
                            18.500 ₺
                        </span>

                    </div>


                    <span class="notification-type notification-type-success">
                        Ödeme
                    </span>

                </div>

            </div>


            {{-- Yeni randevu --}}
            <div class="notification-item unread">

                <div class="notification-icon notification-icon-info">
                    📅
                </div>


                <div class="notification-content">

                    <div class="notification-top">

                        <h3 class="notification-title">
                            Yeni servis randevusu
                        </h3>

                        <span class="notification-time">
                            2 saat önce
                        </span>

                    </div>


                    <p class="notification-description">
                        Mehmet Kaya yarın saat 10:30 için servis
                        randevusu oluşturdu.
                    </p>


                    <div class="notification-service">

                        <span class="notification-service-code">
                            RND-2026-00421
                        </span>

                        <span class="notification-service-separator">
                            •
                        </span>

                        <span class="notification-service-vehicle">
                            34 GHI 456
                        </span>

                    </div>


                    <span class="notification-type notification-type-info">
                        Randevu
                    </span>

                </div>


                <span class="notification-unread-dot"></span>

            </div>

        </div>


        {{-- =====================================
             DÜN
             ===================================== --}}
        <div class="notification-group">

            <div class="notification-group-title">
                Dün
            </div>


            {{-- Stok --}}
            <div class="notification-item">

                <div class="notification-icon notification-icon-warning">
                    !
                </div>


                <div class="notification-content">

                    <div class="notification-top">

                        <h3 class="notification-title">
                            Stok seviyesi kritik
                        </h3>

                        <span class="notification-time">
                            Dün 16:32
                        </span>

                    </div>


                    <p class="notification-description">
                        Fren balatası stok seviyesi kritik seviyeye
                        düştü.
                    </p>


                    <div class="notification-service">

                        <span class="notification-service-code">
                            STK-00042
                        </span>

                        <span class="notification-service-separator">
                            •
                        </span>

                        <span class="notification-service-vehicle">
                            Mevcut: 2 adet
                        </span>

                    </div>


                    <span class="notification-type notification-type-warning">
                        Stok
                    </span>

                </div>

            </div>


            {{-- Servis gecikmesi --}}
            <div class="notification-item">

                <div class="notification-icon notification-icon-warning">
                    !
                </div>


                <div class="notification-content">

                    <div class="notification-top">

                        <h3 class="notification-title">
                            Servis gecikmesi
                        </h3>

                        <span class="notification-time">
                            Dün 14:18
                        </span>

                    </div>


                    <p class="notification-description">
                        34 JKL 789 plakalı aracın servis süresi
                        planlanan zamanı aştı.
                    </p>


                    <div class="notification-service">

                        <span class="notification-service-code">
                            SRV-2026-00117
                        </span>

                        <span class="notification-service-separator">
                            •
                        </span>

                        <span class="notification-service-vehicle">
                            34 JKL 789
                        </span>

                    </div>


                    <span class="notification-type notification-type-warning">
                        Servis
                    </span>

                </div>

            </div>


            {{-- Ödeme --}}
            <div class="notification-item">

                <div class="notification-icon notification-icon-danger">
                    ₺
                </div>


                <div class="notification-content">

                    <div class="notification-top">

                        <h3 class="notification-title">
                            Ödeme bekleniyor
                        </h3>

                        <span class="notification-time">
                            Dün 11:45
                        </span>

                    </div>


                    <p class="notification-description">
                        Servis tamamlandı ancak ödeme işlemi
                        henüz gerçekleştirilmedi.
                    </p>


                    <div class="notification-service">

                        <span class="notification-service-code">
                            SRV-2026-00115
                        </span>

                        <span class="notification-service-separator">
                            •
                        </span>

                        <span class="notification-service-vehicle">
                            7.850 ₺
                        </span>

                    </div>


                    <span class="notification-type notification-type-danger">
                        Ödeme
                    </span>

                </div>

            </div>

        </div>


        {{-- =====================================
             DAHA ESKİ
             ===================================== --}}
        <div class="notification-group">

            <div class="notification-group-title">
                Daha Eski
            </div>


            <div class="notification-item">

                <div class="notification-icon notification-icon-success">
                    ✓
                </div>


                <div class="notification-content">

                    <div class="notification-top">

                        <h3 class="notification-title">
                            Araç teslim edildi
                        </h3>

                        <span class="notification-time">
                            28 Eylül
                        </span>

                    </div>


                    <p class="notification-description">
                        34 MNO 123 plakalı araç müşteriye teslim edildi.
                    </p>


                    <div class="notification-service">

                        <span class="notification-service-code">
                            SRV-2026-00102
                        </span>

                        <span class="notification-service-separator">
                            •
                        </span>

                        <span class="notification-service-vehicle">
                            34 MNO 123
                        </span>

                    </div>


                    <span class="notification-type notification-type-success">
                        Servis
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
