@extends('layouts.app')

@section('content')

<style>
    * {
        box-sizing: border-box;
    }

    .schedule-page {
        background: #f8fafc;
        min-height: calc(100vh - 70px);
        padding: 28px;
    }

    .schedule-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* =========================
       HEADER
    ========================= */

    .schedule-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .schedule-title h1 {
        margin: 0;
        color: #0f172a;
        font-size: 28px;
        font-weight: 700;
    }

    .schedule-title p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .add-schedule-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        height: 48px;
        padding: 0 18px;

        border: 0;
        border-radius: 10px;

        background: #2563eb;
        color: #fff;

        font-size: 14px;
        font-weight: 600;

        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    .add-schedule-btn:hover {
        background: #1d4ed8;
        color: #fff;
    }

    /* =========================
       STATS
    ========================= */

    .schedule-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 26px;
    }

    .stat-card {
        height: 88px;

        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 13px;

        padding: 0 28px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        box-shadow: 0 1px 3px rgba(15, 23, 42, .08);
    }

    .stat-label {
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
    }

    .stat-value {
        color: #0f172a;
        font-size: 27px;
        font-weight: 700;
        line-height: 1;
    }

    /* =========================
       CALENDAR CARD
    ========================= */

    .schedule-card {
        background: #fff;
        border: 1px solid #dbe3ee;
        border-radius: 15px;
        overflow: hidden;
    }

    /* =========================
       TOOLBAR
    ========================= */

    .schedule-toolbar {
        height: 88px;

        padding: 0 22px;

        border-bottom: 1px solid #e2e8f0;

        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .toolbar-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    /* Date navigation */

    .date-navigation {
        height: 46px;

        display: flex;
        align-items: stretch;

        border: 1px solid #dbe3ee;
        border-radius: 9px;

        overflow: hidden;
        background: #fff;
    }

    .nav-arrow {
        width: 42px;
        height: 46px;

        padding: 0;
        border: 0;

        background: #fff;

        display: flex;
        align-items: center;
        justify-content: center;

        color: #2563eb;
        font-size: 17px;

        cursor: pointer;
    }

    .nav-arrow:hover {
        background: #f8fafc;
    }

    .today-btn {
        min-width: 74px;
        height: 46px;

        padding: 0 12px;

        border: 0;
        border-left: 1px solid #dbe3ee;
        border-right: 1px solid #dbe3ee;

        background: #fff;

        display: flex;
        align-items: center;
        justify-content: center;

        color: #0f172a;
        font-size: 14px;
        font-weight: 600;

        cursor: pointer;
    }

    .today-btn:hover {
        background: #f8fafc;
    }

    .current-date {
        height: 46px;

        display: flex;
        align-items: center;

        color: #0f172a;
        font-size: 15px;
        font-weight: 600;
    }

    /* View buttons */

    .view-buttons {
        height: 46px;

        display: flex;
        align-items: center;
        gap: 3px;

        padding: 4px;

        background: #f1f5f9;
        border-radius: 9px;
    }

    .view-btn {
        height: 38px;
        min-width: 58px;

        padding: 0 14px;

        border: 0;
        border-radius: 7px;

        background: transparent;

        display: flex;
        align-items: center;
        justify-content: center;

        color: #64748b;
        font-size: 13px;

        cursor: pointer;
        transition: .15s;
    }

    .view-btn:hover {
        color: #2563eb;
    }

    .view-btn.active {
        background: #fff;
        color: #2563eb;
        font-weight: 600;

        box-shadow: 0 1px 3px rgba(15, 23, 42, .08);
    }

    /* =========================
       DAY VIEW
    ========================= */

    .day-header {
        display: grid;
        grid-template-columns: 100px 1fr;

        border-bottom: 1px solid #e2e8f0;
    }

    .day-time-header {
        border-right: 1px solid #e2e8f0;
    }

    .day-info {
        height: 84px;

        padding: 14px 20px;

        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .day-name {
        color: #64748b;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .day-date {
        margin-top: 5px;

        color: #0f172a;
        font-size: 18px;
        font-weight: 700;
    }

    .schedule-row {
        display: grid;
        grid-template-columns: 100px 1fr;

        min-height: 118px;

        border-bottom: 1px solid #f1f5f9;
    }

    .schedule-row:last-child {
        border-bottom: 0;
    }

    .time {
        padding: 22px 12px;

        text-align: center;

        color: #64748b;
        font-size: 12px;

        border-right: 1px solid #e2e8f0;
    }

    .schedule-content {
        padding: 12px 16px;
    }

    /* Service */

    .service-item {
        min-height: 94px;

        padding: 15px 16px;

        border-radius: 10px;

        background: #eff6ff;
        border: 1px solid #dbeafe;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;
    }

    .service-main {
        min-width: 0;

        display: flex;
        align-items: center;
        gap: 15px;
    }

    .service-icon {
        width: 48px;
        height: 48px;

        border-radius: 10px;

        background: #dbeafe;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 21px;

        flex-shrink: 0;
    }

    .service-info {
        min-width: 0;
    }

    .service-info h3 {
        margin: 0 0 5px;

        color: #0f172a;

        font-size: 14px;
        font-weight: 700;
    }

    .service-info p {
        margin: 0;

        color: #64748b;

        font-size: 12px;
    }

    .service-details {
        display: flex;
        align-items: center;
        gap: 24px;

        flex-shrink: 0;
    }

    .detail {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .detail-label {
        color: #94a3b8;
        font-size: 11px;
    }

    .detail-value {
        color: #334155;
        font-size: 12px;
        font-weight: 600;
    }

    /* Status */

    .status {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 7px 11px;

        border-radius: 999px;

        font-size: 11px;
        font-weight: 600;

        white-space: nowrap;
    }

    .status::before {
        content: "";

        width: 6px;
        height: 6px;

        border-radius: 50%;
    }

    .status-waiting {
        background: #fef3c7;
        color: #b45309;
    }

    .status-waiting::before {
        background: #f59e0b;
    }

    .status-progress {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-progress::before {
        background: #2563eb;
    }

    .status-ready {
        background: #ede9fe;
        color: #6d28d9;
    }

    .status-ready::before {
        background: #6366f1;
    }

    .status-done {
        background: #dcfce7;
        color: #15803d;
    }

    .status-done::before {
        background: #22c55e;
    }

    .status-cancel {
        background: #fee2e2;
        color: #dc2626;
    }

    .status-cancel::before {
        background: #ef4444;
    }

    /* =========================
       WEEK VIEW
    ========================= */

    .week-view {
        display: none;
        overflow-x: auto;
    }

    .week-header,
    .week-row {
        display: grid;
        grid-template-columns: 75px repeat(7, minmax(120px, 1fr));
        min-width: 950px;
    }

    .week-header {
        border-bottom: 1px solid #e2e8f0;
    }

    .week-time-column {
        border-right: 1px solid #e2e8f0;
    }

    .week-day {
        min-height: 82px;

        padding: 14px 8px;

        border-right: 1px solid #e2e8f0;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .week-day span {
        color: #64748b;

        font-size: 10px;
        font-weight: 600;
    }

    .week-day strong {
        margin-top: 5px;

        color: #0f172a;

        font-size: 14px;
        font-weight: 700;
    }

    .week-day.active {
        background: #eff6ff;
    }

    .week-day.active strong {
        color: #2563eb;
    }

    .week-row {
        min-height: 95px;

        border-bottom: 1px solid #f1f5f9;
    }

    .week-row:last-child {
        border-bottom: 0;
    }

    .week-time {
        padding: 14px 8px;

        text-align: center;

        color: #64748b;
        font-size: 11px;

        border-right: 1px solid #e2e8f0;
    }

    .week-cell {
        padding: 7px;

        border-right: 1px solid #f1f5f9;
    }

    .mini-service {
        padding: 9px;

        border-radius: 7px;

        background: #eff6ff;
        border: 1px solid #dbeafe;

        color: #1d4ed8;

        font-size: 11px;
        font-weight: 600;

        line-height: 1.4;
    }

    .mini-service.warning {
        background: #fffbeb;
        border-color: #fde68a;
        color: #b45309;
    }

    .mini-service.success {
        background: #f0fdf4;
        border-color: #bbf7d0;
        color: #15803d;
    }

    .mini-service.purple {
        background: #f5f3ff;
        border-color: #ddd6fe;
        color: #6d28d9;
    }

    /* =========================
       MONTH VIEW
    ========================= */

    .month-view {
        display: none;
    }

    .month-header,
    .month-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
    }

    .month-day-name {
        height: 44px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-right: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;

        color: #64748b;

        font-size: 11px;
        font-weight: 600;
    }

    .month-cell {
        min-height: 135px;

        padding: 10px;

        border-right: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;

        background: #fff;
    }

    .month-cell:nth-child(7n) {
        border-right: 0;
    }

    .month-cell.muted {
        background: #f8fafc;
    }

    .month-cell.today {
        background: #eff6ff;
    }

    .month-number {
        width: 28px;
        height: 28px;

        margin-bottom: 7px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        color: #334155;

        font-size: 12px;
        font-weight: 600;
    }

    .month-cell.today .month-number {
        background: #2563eb;
        color: #fff;
    }

    .month-service {
        padding: 5px 7px;

        margin-bottom: 4px;

        border-radius: 5px;

        background: #eff6ff;
        color: #1d4ed8;

        font-size: 10px;
        font-weight: 600;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .month-service.warning {
        background: #fef3c7;
        color: #b45309;
    }

    .month-service.success {
        background: #dcfce7;
        color: #15803d;
    }

    .more-services {
        color: #64748b;
        font-size: 10px;
        font-weight: 600;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1000px) {

        .schedule-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .service-details {
            gap: 12px;
        }
    }

    @media (max-width: 700px) {

        .schedule-page {
            padding: 18px;
        }

        .schedule-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 15px;
        }

        .schedule-title h1 {
            font-size: 23px;
        }

        .add-schedule-btn {
            width: 100%;
        }

        .schedule-stats {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .stat-card {
            height: 75px;
            padding: 0 16px;
        }

        .stat-label {
            font-size: 12px;
        }

        .stat-value {
            font-size: 22px;
        }

        .schedule-toolbar {
            height: auto;
            min-height: 88px;

            padding: 15px;

            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }

        .toolbar-left {
            justify-content: space-between;
        }

        .current-date {
            font-size: 13px;
        }

        .view-buttons {
            width: 100%;
        }

        .view-btn {
            flex: 1;
        }

        .service-details {
            display: none;
        }

        .service-item {
            padding: 12px;
        }

        .day-header,
        .schedule-row {
            grid-template-columns: 70px 1fr;
        }
    }
</style>


<div class="schedule-page">

    <div class="schedule-container">

        {{-- =========================
             HEADER
        ========================== --}}

        <div class="schedule-header">

            <div class="schedule-title">

                <h1>
                    Servis Takvimi
                </h1>

                <p>
                    Planlanan servisleri ve günlük iş akışını yönetin.
                </p>

            </div>

            <a href="#" class="add-schedule-btn">
                <span>+</span>
                Yeni Servis Planla
            </a>

        </div>


        {{-- =========================
             STATISTICS
        ========================== --}}

        <div class="schedule-stats">

            <div class="stat-card">

                <div class="stat-label">
                    Bugünkü Servisler
                </div>

                <div class="stat-value">
                    18
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-label">
                    Bekleyen
                </div>

                <div class="stat-value">
                    5
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-label">
                    Devam Eden
                </div>

                <div class="stat-value">
                    7
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-label">
                    Tamamlanan
                </div>

                <div class="stat-value">
                    6
                </div>

            </div>

        </div>


        {{-- =========================
             CALENDAR
        ========================== --}}

        <div class="schedule-card">


            {{-- TOOLBAR --}}

            <div class="schedule-toolbar">

                <div class="toolbar-left">

                    <div class="date-navigation">

                        <button
                            type="button"
                            class="nav-arrow"
                            id="previousDate"
                        >
                            ‹
                        </button>

                        <button
                            type="button"
                            class="today-btn"
                            id="todayButton"
                        >
                            Bugün
                        </button>

                        <button
                            type="button"
                            class="nav-arrow"
                            id="nextDate"
                        >
                            ›
                        </button>

                    </div>


                    <div class="current-date" id="currentDate">
                        8 Ekim 2026
                    </div>

                </div>


                <div class="view-buttons">

                    <button
                        type="button"
                        class="view-btn active"
                        data-view="day"
                    >
                        Gün
                    </button>

                    <button
                        type="button"
                        class="view-btn"
                        data-view="week"
                    >
                        Hafta
                    </button>

                    <button
                        type="button"
                        class="view-btn"
                        data-view="month"
                    >
                        Ay
                    </button>

                </div>

            </div>


            {{-- =================================================
                 DAY VIEW
            ================================================== --}}

            <div
                id="dayView"
                class="day-view calendar-view"
            >

                <div class="day-header">

                    <div class="day-time-header"></div>

                    <div class="day-info">

                        <div class="day-name">
                            PERŞEMBE
                        </div>

                        <div class="day-date">
                            8 Ekim
                        </div>

                    </div>

                </div>


                {{-- 09:00 --}}

                <div class="schedule-row">

                    <div class="time">
                        09:00
                    </div>

                    <div class="schedule-content">

                        <div class="service-item">

                            <div class="service-main">

                                <div class="service-icon">
                                    🔧
                                </div>

                                <div class="service-info">

                                    <h3>
                                        Periyodik Bakım
                                    </h3>

                                    <p>
                                        Ahmet Yılmaz · BMW 320i
                                    </p>

                                </div>

                            </div>


                            <div class="service-details">

                                <div class="detail">

                                    <span class="detail-label">
                                        Personel
                                    </span>

                                    <span class="detail-value">
                                        Mehmet Kaya
                                    </span>

                                </div>


                                <div class="detail">

                                    <span class="detail-label">
                                        Süre
                                    </span>

                                    <span class="detail-value">
                                        1 saat
                                    </span>

                                </div>


                                <span class="status status-progress">
                                    Devam Ediyor
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- 10:30 --}}

                <div class="schedule-row">

                    <div class="time">
                        10:30
                    </div>

                    <div class="schedule-content">

                        <div class="service-item">

                            <div class="service-main">

                                <div class="service-icon">
                                    🚗
                                </div>

                                <div class="service-info">

                                    <h3>
                                        Fren Sistemi Kontrolü
                                    </h3>

                                    <p>
                                        Mustafa Demir · Renault Clio
                                    </p>

                                </div>

                            </div>


                            <div class="service-details">

                                <div class="detail">

                                    <span class="detail-label">
                                        Personel
                                    </span>

                                    <span class="detail-value">
                                        Ali Çelik
                                    </span>

                                </div>


                                <div class="detail">

                                    <span class="detail-label">
                                        Süre
                                    </span>

                                    <span class="detail-value">
                                        45 dk
                                    </span>

                                </div>


                                <span class="status status-waiting">
                                    Bekliyor
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- 13:00 --}}

                <div class="schedule-row">

                    <div class="time">
                        13:00
                    </div>

                    <div class="schedule-content">

                        <div class="service-item">

                            <div class="service-main">

                                <div class="service-icon">
                                    🛠️
                                </div>

                                <div class="service-info">

                                    <h3>
                                        Yağ ve Filtre Değişimi
                                    </h3>

                                    <p>
                                        Burak Şahin · Fiat Egea
                                    </p>

                                </div>

                            </div>


                            <div class="service-details">

                                <div class="detail">

                                    <span class="detail-label">
                                        Personel
                                    </span>

                                    <span class="detail-value">
                                        Hasan Yıldız
                                    </span>

                                </div>


                                <div class="detail">

                                    <span class="detail-label">
                                        Süre
                                    </span>

                                    <span class="detail-value">
                                        30 dk
                                    </span>

                                </div>


                                <span class="status status-ready">
                                    Hazır
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- 15:00 --}}

                <div class="schedule-row">

                    <div class="time">
                        15:00
                    </div>

                    <div class="schedule-content">

                        <div class="service-item">

                            <div class="service-main">

                                <div class="service-icon">
                                    ⚙️
                                </div>

                                <div class="service-info">

                                    <h3>
                                        Motor Arıza Tespiti
                                    </h3>

                                    <p>
                                        Mehmet Öz · Volkswagen Golf
                                    </p>

                                </div>

                            </div>


                            <div class="service-details">

                                <div class="detail">

                                    <span class="detail-label">
                                        Personel
                                    </span>

                                    <span class="detail-value">
                                        Ahmet Kaya
                                    </span>

                                </div>


                                <div class="detail">

                                    <span class="detail-label">
                                        Süre
                                    </span>

                                    <span class="detail-value">
                                        1.5 saat
                                    </span>

                                </div>


                                <span class="status status-waiting">
                                    Bekliyor
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- 17:00 --}}

                <div class="schedule-row">

                    <div class="time">
                        17:00
                    </div>

                    <div class="schedule-content">

                        <div class="service-item">

                            <div class="service-main">

                                <div class="service-icon">
                                    ✓
                                </div>

                                <div class="service-info">

                                    <h3>
                                        Klima Bakımı
                                    </h3>

                                    <p>
                                        Can Aydın · Toyota Corolla
                                    </p>

                                </div>

                            </div>


                            <div class="service-details">

                                <div class="detail">

                                    <span class="detail-label">
                                        Personel
                                    </span>

                                    <span class="detail-value">
                                        Mehmet Kaya
                                    </span>

                                </div>


                                <div class="detail">

                                    <span class="detail-label">
                                        Süre
                                    </span>

                                    <span class="detail-value">
                                        1 saat
                                    </span>

                                </div>


                                <span class="status status-done">
                                    Tamamlandı
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 WEEK VIEW
            ================================================== --}}

            <div
                id="weekView"
                class="week-view calendar-view"
            >

                <div class="week-header">

                    <div class="week-time-column"></div>

                    <div class="week-day">
                        <span>PAZARTESİ</span>
                        <strong>5 Ekim</strong>
                    </div>

                    <div class="week-day">
                        <span>SALI</span>
                        <strong>6 Ekim</strong>
                    </div>

                    <div class="week-day">
                        <span>ÇARŞAMBA</span>
                        <strong>7 Ekim</strong>
                    </div>

                    <div class="week-day active">
                        <span>PERŞEMBE</span>
                        <strong>8 Ekim</strong>
                    </div>

                    <div class="week-day">
                        <span>CUMA</span>
                        <strong>9 Ekim</strong>
                    </div>

                    <div class="week-day">
                        <span>CUMARTESİ</span>
                        <strong>10 Ekim</strong>
                    </div>

                    <div class="week-day">
                        <span>PAZAR</span>
                        <strong>11 Ekim</strong>
                    </div>

                </div>


                {{-- 09:00 --}}

                <div class="week-row">

                    <div class="week-time">
                        09:00
                    </div>

                    <div class="week-cell">

                        <div class="mini-service">
                            Periyodik Bakım
                        </div>

                    </div>

                    <div class="week-cell"></div>

                    <div class="week-cell">

                        <div class="mini-service success">
                            Yağ Değişimi
                        </div>

                    </div>

                    <div class="week-cell">

                        <div class="mini-service">
                            Periyodik Bakım
                        </div>

                    </div>

                    <div class="week-cell"></div>

                    <div class="week-cell"></div>

                    <div class="week-cell"></div>

                </div>


                {{-- 10:30 --}}

                <div class="week-row">

                    <div class="week-time">
                        10:30
                    </div>

                    <div class="week-cell"></div>

                    <div class="week-cell">

                        <div class="mini-service warning">
                            Fren Kontrolü
                        </div>

                    </div>

                    <div class="week-cell"></div>

                    <div class="week-cell"></div>

                    <div class="week-cell">

                        <div class="mini-service">
                            Motor Kontrolü
                        </div>

                    </div>

                    <div class="week-cell"></div>

                    <div class="week-cell"></div>

                </div>


                {{-- 13:00 --}}

                <div class="week-row">

                    <div class="week-time">
                        13:00
                    </div>

                    <div class="week-cell"></div>

                    <div class="week-cell"></div>

                    <div class="week-cell">

                        <div class="mini-service purple">
                            Klima Bakımı
                        </div>

                    </div>

                    <div class="week-cell">

                        <div class="mini-service">
                            Yağ ve Filtre
                        </div>

                    </div>

                    <div class="week-cell"></div>

                    <div class="week-cell">

                        <div class="mini-service success">
                            Periyodik Bakım
                        </div>

                    </div>

                    <div class="week-cell"></div>

                </div>


                {{-- 15:00 --}}

                <div class="week-row">

                    <div class="week-time">
                        15:00
                    </div>

                    <div class="week-cell">

                        <div class="mini-service warning">
                            Fren Sistemi
                        </div>

                    </div>

                    <div class="week-cell"></div>

                    <div class="week-cell"></div>

                    <div class="week-cell">

                        <div class="mini-service warning">
                            Motor Arıza
                        </div>

                    </div>

                    <div class="week-cell"></div>

                    <div class="week-cell"></div>

                    <div class="week-cell"></div>

                </div>


                {{-- 17:00 --}}

                <div class="week-row">

                    <div class="week-time">
                        17:00
                    </div>

                    <div class="week-cell"></div>

                    <div class="week-cell">

                        <div class="mini-service success">
                            Klima Bakımı
                        </div>

                    </div>

                    <div class="week-cell"></div>

                    <div class="week-cell"></div>

                    <div class="week-cell">

                        <div class="mini-service success">
                            Bakım
                        </div>

                    </div>

                    <div class="week-cell"></div>

                    <div class="week-cell"></div>

                </div>

            </div>


            {{-- =================================================
                 MONTH VIEW
            ================================================== --}}

            <div
                id="monthView"
                class="month-view calendar-view"
            >

                <div class="month-header">

                    <div class="month-day-name">
                        PAZARTESİ
                    </div>

                    <div class="month-day-name">
                        SALI
                    </div>

                    <div class="month-day-name">
                        ÇARŞAMBA
                    </div>

                    <div class="month-day-name">
                        PERŞEMBE
                    </div>

                    <div class="month-day-name">
                        CUMA
                    </div>

                    <div class="month-day-name">
                        CUMARTESİ
                    </div>

                    <div class="month-day-name">
                        PAZAR
                    </div>

                </div>


                <div class="month-grid">

                    {{-- 28 Eylül --}}
                    <div class="month-cell muted">
                        <div class="month-number">28</div>
                    </div>

                    {{-- 29 Eylül --}}
                    <div class="month-cell muted">
                        <div class="month-number">29</div>
                    </div>

                    {{-- 30 Eylül --}}
                    <div class="month-cell muted">
                        <div class="month-number">30</div>
                    </div>


                    {{-- 1 Ekim --}}
                    <div class="month-cell">

                        <div class="month-number">
                            1
                        </div>

                        <div class="month-service">
                            Periyodik Bakım
                        </div>

                    </div>


                    {{-- 2 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            2
                        </div>

                        <div class="month-service success">
                            Yağ Değişimi
                        </div>

                    </div>


                    {{-- 3 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            3
                        </div>

                    </div>


                    {{-- 4 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            4
                        </div>

                    </div>


                    {{-- 5 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            5
                        </div>

                        <div class="month-service">
                            Fren Kontrolü
                        </div>

                    </div>


                    {{-- 6 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            6
                        </div>

                        <div class="month-service warning">
                            Motor Arıza
                        </div>

                    </div>


                    {{-- 7 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            7
                        </div>

                    </div>


                    {{-- 8 TODAY --}}
                    <div class="month-cell today">

                        <div class="month-number">
                            8
                        </div>

                        <div class="month-service">
                            Periyodik Bakım
                        </div>

                        <div class="month-service warning">
                            Fren Kontrolü
                        </div>

                        <div class="month-service success">
                            Yağ Değişimi
                        </div>

                    </div>


                    {{-- 9 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            9
                        </div>

                        <div class="month-service">
                            Motor Kontrolü
                        </div>

                    </div>


                    {{-- 10 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            10
                        </div>

                    </div>


                    {{-- 11 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            11
                        </div>

                    </div>


                    {{-- 12 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            12
                        </div>

                        <div class="month-service">
                            Klima Bakımı
                        </div>

                    </div>


                    {{-- 13 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            13
                        </div>

                    </div>


                    {{-- 14 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            14
                        </div>

                    </div>


                    {{-- 15 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            15
                        </div>

                        <div class="month-service warning">
                            Fren Sistemi
                        </div>

                    </div>


                    {{-- 16 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            16
                        </div>

                    </div>


                    {{-- 17 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            17
                        </div>

                    </div>


                    {{-- 18 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            18
                        </div>

                    </div>


                    {{-- 19 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            19
                        </div>

                        <div class="month-service success">
                            Periyodik Bakım
                        </div>

                    </div>


                    {{-- 20 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            20
                        </div>

                    </div>


                    {{-- 21 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            21
                        </div>

                    </div>


                    {{-- 22 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            22
                        </div>

                    </div>


                    {{-- 23 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            23
                        </div>

                        <div class="month-service">
                            Yağ Değişimi
                        </div>

                    </div>


                    {{-- 24 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            24
                        </div>

                    </div>


                    {{-- 25 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            25
                        </div>

                    </div>


                    {{-- 26 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            26
                        </div>

                    </div>


                    {{-- 27 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            27
                        </div>

                    </div>


                    {{-- 28 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            28
                        </div>

                        <div class="month-service warning">
                            Motor Arıza
                        </div>

                    </div>


                    {{-- 29 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            29
                        </div>

                    </div>


                    {{-- 30 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            30
                        </div>

                    </div>


                    {{-- 31 --}}
                    <div class="month-cell">

                        <div class="month-number">
                            31
                        </div>

                        <div class="month-service success">
                            Klima Bakımı
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const viewButtons = document.querySelectorAll('.view-btn');

        const dayView = document.getElementById('dayView');
        const weekView = document.getElementById('weekView');
        const monthView = document.getElementById('monthView');

        const currentDate = document.getElementById('currentDate');

        const todayButton = document.getElementById('todayButton');
        const previousDate = document.getElementById('previousDate');
        const nextDate = document.getElementById('nextDate');


        /*
        |--------------------------------------------------------------------------
        | VIEW CHANGE
        |--------------------------------------------------------------------------
        */

        function changeView(view) {

            dayView.style.display = 'none';
            weekView.style.display = 'none';
            monthView.style.display = 'none';

            viewButtons.forEach(function (button) {
                button.classList.remove('active');
            });


            if (view === 'day') {

                dayView.style.display = 'block';

            }

            if (view === 'week') {

                weekView.style.display = 'block';

            }

            if (view === 'month') {

                monthView.style.display = 'block';

            }


            const activeButton = document.querySelector(
                '.view-btn[data-view="' + view + '"]'
            );

            if (activeButton) {
                activeButton.classList.add('active');
            }
        }


        viewButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                const view = this.dataset.view;

                changeView(view);

            });

        });


        /*
        |--------------------------------------------------------------------------
        | TODAY
        |--------------------------------------------------------------------------
        */

        todayButton.addEventListener('click', function () {

            currentDate.textContent = '8 Ekim 2026';

        });


        /*
        |--------------------------------------------------------------------------
        | PREVIOUS / NEXT
        |--------------------------------------------------------------------------
        */

        previousDate.addEventListener('click', function () {

            console.log('Önceki tarih');

        });


        nextDate.addEventListener('click', function () {

            console.log('Sonraki tarih');

        });


        /*
        |--------------------------------------------------------------------------
        | DEFAULT VIEW
        |--------------------------------------------------------------------------
        */

        changeView('day');

    });
</script>

@endsection
