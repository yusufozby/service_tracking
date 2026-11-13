@extends('layouts.app')

@section('content')

@php
    use Carbon\Carbon;

    // Controller'dan gelen $services koleksiyonunu takvim formatına dönüştür.
    $calendarServices = collect($services)->map(function ($service) {
        $dateValue = $service->scheduled_at ?? $service->date_of_entry ?? null;

        if (!$dateValue) {
            return null;
        }

        try {
            $date = Carbon::parse($dateValue);
        } catch (\Throwable $e) {
            return null;
        }

        $rawStatus = strtolower((string) $service->status);

        $statusMap = [
            'waiting' => ['label' => 'Bekliyor', 'class' => 'waiting'],
            'pending' => ['label' => 'Bekliyor', 'class' => 'waiting'],
            'progress' => ['label' => 'Devam Ediyor', 'class' => 'progress'],
            'in_progress' => ['label' => 'Devam Ediyor', 'class' => 'progress'],
            'ready' => ['label' => 'Hazır', 'class' => 'ready'],
            'done' => ['label' => 'Tamamlandı', 'class' => 'done'],
            'completed' => ['label' => 'Tamamlandı', 'class' => 'done'],
            'cancel' => ['label' => 'İptal Edildi', 'class' => 'cancel'],
            'cancelled' => ['label' => 'İptal Edildi', 'class' => 'cancel'],
        ];

        $status = $statusMap[$rawStatus] ?? ['label' => ucfirst($rawStatus ?: 'Bekliyor'), 'class' => 'waiting'];

        return [
            'id' => $service->id,
            'date' => $date->format('Y-m-d'),
            'time' => $date->format('H:i') === '00:00' ? null : $date->format('H:i'),
            'title' => $service->fault->name ?? $service->fault->title ?? 'Servis Kaydı',
            'device' => $service->device->name ?? $service->device->model ?? 'Cihaz belirtilmemiş',
            'personel' => $service->personel->fullname ?? 'Atanmamış',
            'service_no' => $service->service_no ?? ('#' . $service->id),
            'status' => $status['label'],
            'status_class' => $status['class'],
        ];
    })->filter()->values();

    $todayKey = now()->format('Y-m-d');
    $todayServices = $calendarServices->where('date', $todayKey);
@endphp

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



    .empty-schedule {
        padding: 28px 18px;
        color: #64748b;
        text-align: center;
        font-size: 13px;
    }

    .week-cell { min-width: 0; }
    .week-cell .mini-service + .mini-service { margin-top: 5px; }
    .month-cell { min-width: 0; }
    .month-service { cursor: default; }
    .service-item { flex-wrap: wrap; }

    @media (max-width: 700px) {
        .schedule-page { padding: 14px; }
        .day-header, .schedule-row { grid-template-columns: 65px 1fr; }
        .service-main { gap: 10px; }
        .service-icon { width: 40px; height: 40px; }
        .month-cell { min-height: 95px; padding: 5px; }
        .month-day-name { font-size: 9px; }
        .month-service { font-size: 9px; padding: 4px; }
    }

</style>

<div class="schedule-page">
    <div class="schedule-container">

        <div class="schedule-header">
            <div class="schedule-title">
                <h1>Servis Takvimi</h1>
                <p>Planlanan servisleri ve günlük iş akışını yönetin.</p>
            </div>

            <a
            href="{{ route('dashboard.create') }}"
            class="add-schedule-btn">
                <span>+</span> Yeni Servis Planla
            </a>
        </div>

        <div class="schedule-stats">
            <div class="stat-card">
                <div class="stat-label">Bugünkü Servisler</div>
                <div class="stat-value">{{ $todayServices->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Bekleyen</div>
                <div class="stat-value">{{ $todayServices->where('status_class', 'waiting')->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Devam Eden</div>
                <div class="stat-value">{{ $todayServices->where('status_class', 'progress')->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Tamamlanan</div>
                <div class="stat-value">{{ $todayServices->where('status_class', 'done')->count() }}</div>
            </div>
        </div>

        <div class="schedule-card">
            <div class="schedule-toolbar">
                <div class="toolbar-left">
                    <div class="date-navigation">
                        <button type="button" class="nav-arrow" id="previousDate" aria-label="Önceki">‹</button>
                        <button type="button" class="today-btn" id="todayButton">Bugün</button>
                        <button type="button" class="nav-arrow" id="nextDate" aria-label="Sonraki">›</button>
                    </div>
                    <div class="current-date" id="currentDate"></div>
                </div>

                <div class="view-buttons">
                    <button type="button" class="view-btn active" data-view="day">Gün</button>
                    <button type="button" class="view-btn" data-view="week">Hafta</button>
                    <button type="button" class="view-btn" data-view="month">Ay</button>
                </div>
            </div>

            <div id="dayView" class="day-view calendar-view"></div>
            <div id="weekView" class="week-view calendar-view"></div>
            <div id="monthView" class="month-view calendar-view"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const services = @json($calendarServices);

    const dayView = document.getElementById('dayView');
    const weekView = document.getElementById('weekView');
    const monthView = document.getElementById('monthView');
    const currentDateElement = document.getElementById('currentDate');
    const todayButton = document.getElementById('todayButton');
    const previousButton = document.getElementById('previousDate');
    const nextButton = document.getElementById('nextDate');
    const viewButtons = document.querySelectorAll('.view-btn');

    let selectedDate = new Date();
    let currentView = 'day';

    const monthNames = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
    const dayNames = ['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'];

    function dateKey(date) {
        const y = date.getFullYear();
        const m = String(date.getMonth() + 1).padStart(2, '0');
        const d = String(date.getDate()).padStart(2, '0');
        return `${y}-${m}-${d}`;
    }

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, char => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'
        })[char]);
    }

    function getServicesForDate(date) {
        return services
            .filter(service => service.date === dateKey(date))
            .sort((a, b) => (a.time || '99:99').localeCompare(b.time || '99:99'));
    }

    function sameDate(a, b) {
        return dateKey(a) === dateKey(b);
    }

    function dayIndex(date) {
        return (date.getDay() + 6) % 7;
    }

    function statusClass(status) {
        return {
            waiting: 'status-waiting', progress: 'status-progress',
            ready: 'status-ready', done: 'status-done', cancel: 'status-cancel'
        }[status] || 'status-waiting';
    }

    function miniStatusClass(status) {
        return {
            waiting: 'warning', progress: '', ready: 'purple',
            done: 'success', cancel: 'warning'
        }[status] || '';
    }

    function serviceCard(service) {
        return `
            <div class="service-item">
                <div class="service-main">
                    <div class="service-icon">🔧</div>
                    <div class="service-info">
                        <h3>${escapeHtml(service.title)}</h3>
                        <p>${escapeHtml(service.device)} · ${escapeHtml(service.service_no)}</p>
                    </div>
                </div>
                <div class="service-details">
                    <div class="detail">
                        <span class="detail-label">Personel</span>
                        <span class="detail-value">${escapeHtml(service.personel)}</span>
                    </div>
                    <div class="detail">
                        <span class="detail-label">Saat</span>
                        <span class="detail-value">${escapeHtml(service.time || 'Belirtilmedi')}</span>
                    </div>
                    <span class="status ${statusClass(service.status_class)}">${escapeHtml(service.status)}</span>
                </div>
            </div>`;
    }

    function renderDay() {
        const list = getServicesForDate(selectedDate);
        let html = `
            <div class="day-header">
                <div class="day-time-header"></div>
                <div class="day-info">
                    <div class="day-name">${dayNames[dayIndex(selectedDate)].toUpperCase()}</div>
                    <div class="day-date">${selectedDate.getDate()} ${monthNames[selectedDate.getMonth()]}</div>
                </div>
            </div>`;

        if (!list.length) {
            html += `<div class="empty-schedule">Bu tarihte kayıtlı servis bulunmuyor.</div>`;
        } else {
            list.forEach(service => {
                html += `
                    <div class="schedule-row">
                        <div class="time">${escapeHtml(service.time || '—')}</div>
                        <div class="schedule-content">${serviceCard(service)}</div>
                    </div>`;
            });
        }
        dayView.innerHTML = html;
    }

    function renderWeek() {
        const start = new Date(selectedDate);
        start.setDate(start.getDate() - dayIndex(start));
        let html = `<div class="week-header"><div class="week-time-column"></div>`;
        const weekDates = [];

        for (let i = 0; i < 7; i++) {
            const date = new Date(start);
            date.setDate(start.getDate() + i);
            weekDates.push(date);
            html += `
                <div class="week-day ${sameDate(date, selectedDate) ? 'active' : ''}">
                    <span>${dayNames[i].toUpperCase()}</span>
                    <strong>${date.getDate()} ${monthNames[date.getMonth()].substring(0, 3)}</strong>
                </div>`;
        }
        html += `</div><div class="week-row"><div class="week-time">Servisler</div>`;

        weekDates.forEach(date => {
            const list = getServicesForDate(date);
            html += `<div class="week-cell">`;
            if (!list.length) {
                html += `<span style="color:#cbd5e1;font-size:11px;">—</span>`;
            } else {
                list.forEach(service => {
                    html += `
                        <div class="mini-service ${miniStatusClass(service.status_class)}">
                            ${escapeHtml(service.time || '')} ${escapeHtml(service.title)}
                        </div>`;
                });
            }
            html += `</div>`;
        });

        html += `</div>`;
        weekView.innerHTML = html;
    }

    function renderMonth() {
        const year = selectedDate.getFullYear();
        const month = selectedDate.getMonth();
        const firstDay = new Date(year, month, 1);
        const offset = dayIndex(firstDay);
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const cellCount = Math.ceil((offset + daysInMonth) / 7) * 7;

        let html = `<div class="month-header">${dayNames.map(day => `<div class="month-day-name">${day.toUpperCase()}</div>`).join('')}</div><div class="month-grid">`;
        const today = new Date();

        for (let i = 0; i < cellCount; i++) {
            const date = new Date(year, month, i - offset + 1);
            const inMonth = date.getMonth() === month;
            const list = getServicesForDate(date);
            html += `
                <div class="month-cell ${inMonth ? '' : 'muted'} ${sameDate(date, today) ? 'today' : ''}">
                    <div class="month-number">${date.getDate()}</div>`;

            list.slice(0, 3).forEach(service => {
                html += `<div class="month-service ${miniStatusClass(service.status_class)}" title="${escapeHtml(service.title)}">${escapeHtml(service.title)}</div>`;
            });

            if (list.length > 3) {
                html += `<div class="more-services">+${list.length - 3} servis daha</div>`;
            }
            html += `</div>`;
        }

        html += `</div>`;
        monthView.innerHTML = html;
    }

    function updateDateLabel() {
        if (currentView === 'week') {
            const start = new Date(selectedDate);
            start.setDate(start.getDate() - dayIndex(start));
            const end = new Date(start);
            end.setDate(start.getDate() + 6);
            currentDateElement.textContent = `${start.getDate()} ${monthNames[start.getMonth()]} - ${end.getDate()} ${monthNames[end.getMonth()]} ${end.getFullYear()}`;
        } else if (currentView === 'month') {
            currentDateElement.textContent = `${monthNames[selectedDate.getMonth()]} ${selectedDate.getFullYear()}`;
        } else {
            currentDateElement.textContent = `${selectedDate.getDate()} ${monthNames[selectedDate.getMonth()]} ${selectedDate.getFullYear()}`;
        }
    }

    function renderCalendar() {
        dayView.style.display = 'none';
        weekView.style.display = 'none';
        monthView.style.display = 'none';

        viewButtons.forEach(button => button.classList.toggle('active', button.dataset.view === currentView));

        if (currentView === 'day') {
            dayView.style.display = 'block';
            renderDay();
        } else if (currentView === 'week') {
            weekView.style.display = 'block';
            renderWeek();
        } else {
            monthView.style.display = 'block';
            renderMonth();
        }
        updateDateLabel();
    }

    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            currentView = this.dataset.view;
            renderCalendar();
        });
    });

    todayButton.addEventListener('click', function () {
        selectedDate = new Date();
        renderCalendar();
    });

    previousButton.addEventListener('click', function () {
        if (currentView === 'day') {
            selectedDate.setDate(selectedDate.getDate() - 1);
        } else if (currentView === 'week') {
            selectedDate.setDate(selectedDate.getDate() - 7);
        } else {
            selectedDate.setDate(1);
            selectedDate.setMonth(selectedDate.getMonth() - 1);
        }
        renderCalendar();
    });

    nextButton.addEventListener('click', function () {
        if (currentView === 'day') {
            selectedDate.setDate(selectedDate.getDate() + 1);
        } else if (currentView === 'week') {
            selectedDate.setDate(selectedDate.getDate() + 7);
        } else {
            selectedDate.setDate(1);
            selectedDate.setMonth(selectedDate.getMonth() + 1);
        }
        renderCalendar();
    });

    renderCalendar();
});
</script>

@endsection
