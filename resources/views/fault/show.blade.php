@extends('layouts.app')

@section('title', 'Arıza Detayı')

@section('content')

@php
    $priorityLabels = [
        'low'      => 'Düşük',
        'medium'   => 'Orta',
        'high'     => 'Yüksek',
        'critical' => 'Kritik',
    ];

    $statusLabels = [
        'pending'     => 'Beklemede',
        'in_progress' => 'Devam Ediyor',
        'resolved'    => 'Çözüldü',
        'closed'      => 'Kapatıldı',
    ];
@endphp

<div class="fault-show-page">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-title">
            <h1>Arıza Detayı</h1>
            <p>#{{ $fault->id }} numaralı arıza kaydı.</p>
        </div>

        <div class="page-header-actions">
            <a href="{{ route('fault.index') }}" class="fault-back-button">
                <i class="fa-solid fa-arrow-left"></i>
                Geri Dön
            </a>

            <a href="{{ route('fault.edit', $fault) }}" class="fault-edit-button">
                <i class="fa-solid fa-pen-to-square"></i>
                Düzenle
            </a>
        </div>
    </div>

    {{-- DETAIL CARD --}}
    <div class="fault-show-card">

        <div class="fault-show-header">
            <div class="fault-show-header-icon">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>

            <div class="fault-show-header-text">
                <h3>{{ $fault->title }}</h3>
                <p>{{ $fault->device->name ?? 'Cihaz bilgisi yok' }}</p>
            </div>

            <div class="fault-show-badges">
                <span class="fault-badge priority-{{ $fault->priority }}">
                    {{ $priorityLabels[$fault->priority] ?? $fault->priority }}
                </span>

                <span class="fault-badge status-{{ $fault->status }}">
                    {{ $statusLabels[$fault->status] ?? $fault->status }}
                </span>
            </div>
        </div>

        <div class="fault-show-body">

            {{-- DEVICE --}}
            <div class="fault-show-item">
                <span class="fault-show-label">Cihaz</span>
                <span class="fault-show-value">{{ $fault->device->name ?? '-' }}</span>
            </div>

            {{-- REPORTED_BY --}}
            <div class="fault-show-item">
                <span class="fault-show-label">Bildiren Kişi</span>
                <span class="fault-show-value">{{ $fault->reporter->name ?? '-' }}</span>
            </div>

            {{-- TITLE --}}
            <div class="fault-show-item">
                <span class="fault-show-label">Başlık</span>
                <span class="fault-show-value">{{ $fault->title }}</span>
            </div>

            {{-- DESCRIPTION --}}
            <div class="fault-show-item">
                <span class="fault-show-label">Açıklama</span>
                <span class="fault-show-value fault-show-text">{{ $fault->description }}</span>
            </div>

            {{-- FAULT_DATE --}}
            <div class="fault-show-item">
                <span class="fault-show-label">Arıza Tarihi</span>
                <span class="fault-show-value">
                    {{ optional($fault->fault_date)->format('d.m.Y') ?? '-' }}
                </span>
            </div>

            {{-- PRIORITY --}}
            <div class="fault-show-item">
                <span class="fault-show-label">Öncelik</span>
                <span class="fault-show-value">
                    {{ $priorityLabels[$fault->priority] ?? $fault->priority }}
                </span>
            </div>

            {{-- STATUS --}}
            <div class="fault-show-item">
                <span class="fault-show-label">Durum</span>
                <span class="fault-show-value">
                    {{ $statusLabels[$fault->status] ?? $fault->status }}
                </span>
            </div>

            {{-- DIAGNOSIS --}}
            <div class="fault-show-item">
                <span class="fault-show-label">Teşhis</span>
                <span class="fault-show-value fault-show-text">{{ $fault->diagnosis ?: '-' }}</span>
            </div>

            {{-- SOLUTION --}}
            <div class="fault-show-item">
                <span class="fault-show-label">Çözüm</span>
                <span class="fault-show-value fault-show-text">{{ $fault->solution ?: '-' }}</span>
            </div>

            {{-- RESOLVED_AT --}}
            <div class="fault-show-item">
                <span class="fault-show-label">Çözüm Tarihi</span>
                <span class="fault-show-value">
                    {{ optional($fault->resolved_at)->format('d.m.Y H:i') ?? '-' }}
                </span>
            </div>

            {{-- CREATED_AT --}}
            <div class="fault-show-item">
                <span class="fault-show-label">Oluşturulma</span>
                <span class="fault-show-value">
                    {{ optional($fault->created_at)->format('d.m.Y H:i') ?? '-' }}
                </span>
            </div>

            {{-- UPDATED_AT --}}
            <div class="fault-show-item">
                <span class="fault-show-label">Son Güncelleme</span>
                <span class="fault-show-value">
                    {{ optional($fault->updated_at)->format('d.m.Y H:i') ?? '-' }}
                </span>
            </div>

        </div>

        {{-- FOOTER --}}
        <div class="fault-show-footer">

            <form method="POST"
                  action="{{ route('fault.destroy', $fault) }}"
                  onsubmit="return confirm('Bu arıza silinsin mi?')">
                @csrf
                @method('DELETE')

                <button type="submit" class="fault-delete-button">
                    <i class="fa-solid fa-trash"></i>
                    Sil
                </button>
            </form>

        </div>

    </div>

</div>

<style>

/* ========================================
   GENERAL
======================================== */

.fault-show-page {
    width: 90%;
    margin: 30px auto;
}

.page-header-actions {
    display: flex;
    gap: 10px;
}

/* ========================================
   CARD
======================================== */

.fault-show-card {
    background: #fff;
    border: 1px solid var(--gray-200);
    border-radius: 14px;
    overflow: hidden;
}

.fault-show-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 22px 24px;
    border-bottom: 1px solid var(--gray-200);
}

.fault-show-header-icon {
    width: 46px;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: var(--primary-light);
    color: var(--primary);
    font-size: 18px;
    flex-shrink: 0;
}

.fault-show-header-text {
    flex: 1;
    min-width: 0;
}

.fault-show-header h3 {
    font-size: 16px;
    font-weight: 600;
    color: var(--gray-900);
}

.fault-show-header p {
    margin-top: 5px;
    font-size: 12px;
    color: var(--text-secondary);
}

.fault-show-badges {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

/* ========================================
   BADGES
======================================== */

.fault-badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    background: var(--gray-100);
    color: var(--gray-600);
}

.priority-low      { background: #E0F2FE; color: #0369A1; }
.priority-medium   { background: #FEF9C3; color: #A16207; }
.priority-high     { background: #FFEDD5; color: #C2410C; }
.priority-critical { background: #FEE2E2; color: #B91C1C; }

.status-pending     { background: #F3F4F6; color: #4B5563; }
.status-in_progress { background: #DBEAFE; color: #1D4ED8; }
.status-resolved    { background: #DCFCE7; color: #15803D; }
.status-closed      { background: #E5E7EB; color: #374151; }

/* ========================================
   BODY
======================================== */

.fault-show-body {
    padding: 10px 24px;
    display: flex;
    flex-direction: column;
}

.fault-show-item {
    display: grid;
    grid-template-columns: 180px 1fr;
    gap: 16px;
    padding: 16px 0;
    border-bottom: 1px solid var(--gray-200);
}

.fault-show-item:last-child {
    border-bottom: none;
}

.fault-show-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--gray-800);
}

.fault-show-value {
    font-size: 13px;
    color: var(--text);
    word-break: break-word;
}

.fault-show-text {
    white-space: pre-line;
    line-height: 1.6;
}

/* ========================================
   FOOTER BUTTONS
======================================== */

.fault-show-footer {
    padding: 18px 24px;
    border-top: 1px solid var(--gray-200);
    display: flex;
    justify-content: flex-end;
}

.fault-back-button,
.fault-edit-button,
.fault-delete-button {
    height: 42px;
    padding: 0 18px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border-radius: 8px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: .2s;
}

.fault-back-button {
    border: 1px solid var(--gray-200);
    background: #fff;
    color: var(--gray-600);
}

.fault-back-button:hover {
    background: var(--gray-100);
}

.fault-edit-button {
    border: 1px solid var(--primary);
    background: var(--primary);
    color: #fff;
}

.fault-edit-button:hover {
    background: var(--primary-hover);
}

.fault-delete-button {
    border: 1px solid var(--danger);
    background: #fff;
    color: var(--danger);
}

.fault-delete-button:hover {
    background: var(--danger);
    color: #fff;
}

/* ========================================
   RESPONSIVE
======================================== */

@media(max-width: 768px) {

    .fault-show-page {
        width: 94%;
        margin: 20px auto;
    }

    .fault-show-header {
        padding: 18px;
        flex-wrap: wrap;
    }

    .fault-show-body {
        padding: 6px 18px;
    }

    .fault-show-item {
        grid-template-columns: 1fr;
        gap: 6px;
    }

    .fault-show-footer {
        padding: 16px 18px;
    }

}

</style>

@endsection
