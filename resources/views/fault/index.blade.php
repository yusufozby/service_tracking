@extends('layouts.app')

@section('title', 'Arızalar')

@section('content')

@php
    $faultRows = method_exists($faults, 'getCollection')
        ? $faults->getCollection()
        : $faults;

    $totalCount = $faultRows->count();

    $pendingCount = $faultRows->where('status', 'pending')->count();
    $resolvedCount = $faultRows->where('status', 'resolved')->count();
    $otherCount = $totalCount - $pendingCount - $resolvedCount;

    $statusLabels = [
        'pending' => 'Beklemede',
        'in_progress' => 'İşlemde',
        'resolved' => 'Çözüldü',
        'cancelled' => 'İptal Edildi',
    ];

    $priorityLabels = [
        'low' => 'Düşük',
        'medium' => 'Orta',
        'high' => 'Yüksek',
        'critical' => 'Kritik',
    ];
@endphp

<style>
.fl{max-width:1240px;margin:0 auto;padding:24px;color:#1f2420}
.fl svg.ic{width:1em;height:1em;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex:none}
.fl .fl-icon svg{width:20px;height:20px}
.fl .fl-date svg{width:14px;height:14px;vertical-align:-2px;margin-right:4px}
.fl .fl-clear svg{width:12px;height:12px}

/* Başlık */
.fl .fl-head{display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:20px}
.fl .fl-head h1{margin:0;font-size:26px}
.fl .fl-head p{margin:4px 0 0;color:#6b7280;font-size:14px}
.fl .fl-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 16px;border-radius:10px;
  background:#1f2937;color:#fff;font-size:14px;font-weight:600;text-decoration:none}
.fl .fl-btn:hover{background:#111827}

/* Özet */
.fl .fl-summary{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:20px}
.fl .fl-sum-item{background:#fff;border:1px solid #e5e5e0;border-radius:12px;padding:14px 18px;
  display:flex;flex-direction:column;gap:2px}
.fl .fl-sum-item strong{font-size:24px}
.fl .fl-sum-item span{font-size:13px;color:#6b7280}
.fl .fl-sum-item.is-on strong{color:#b45309}
.fl .fl-sum-item.is-off strong{color:#15803d}

/* Araç çubuğu */
.fl .fl-toolbar{display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:16px;flex-wrap:wrap}

/* Arama kutusu */
.fl .fl-search{
  display:flex;
  align-items:center;
  gap:10px;
  flex:1;
  max-width:380px;
  height:42px;
  padding:0 12px;
  margin:0;
  background:#fff;
  border:1px solid #e0e0da;
  border-radius:10px;
  box-sizing:border-box;
  transition:border-color .15s, box-shadow .15s;
}
.fl .fl-search:focus-within{
  border-color:#6b7280;
  box-shadow:0 0 0 3px rgba(107,114,128,.15);
}
.fl .fl-search > svg{
  flex:none;
  color:#9ca3af;
  width:16px;
  height:16px;
}
.fl .fl-search input[type="text"]{
  flex:1;
  min-width:0;
  width:auto;
  height:100%;
  padding:0;
  margin:0;
  border:0;
  border-radius:0;
  background:transparent;
  box-shadow:none;
  outline:none;
  appearance:none;
  -webkit-appearance:none;
  font-size:14px;
  color:#1f2420;
}
.fl .fl-search input[type="text"]::placeholder{color:#9ca3af}
.fl .fl-search .fl-clear{
  flex:none;
  display:grid;
  place-items:center;
  width:22px;
  height:22px;
  border-radius:50%;
  color:#9ca3af;
  text-decoration:none;
  font-size:12px;
}
.fl .fl-search .fl-clear:hover{background:#f3f2ee;color:#4b5563}

/* Sekmeler */
.fl .fl-tabs{display:inline-flex;gap:4px;padding:4px;background:#ebe9e3;border-radius:10px}
.fl .fl-tabs button{border:0;background:transparent;padding:7px 14px;border-radius:7px;
  font-size:13px;color:#6b7280;cursor:pointer}
.fl .fl-tabs button.is-current{background:#fff;color:#111827;font-weight:600;box-shadow:0 1px 2px rgba(0,0,0,.08)}

/* Liste */
.fl .fl-list{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:10px}
.fl .fl-row{display:grid;grid-template-columns:minmax(0,1fr) auto 90px auto;align-items:center;gap:24px;
  padding:14px 20px;background:#fff;border:1px solid #e5e5e0;border-left:4px solid #9ca3af;border-radius:12px}
.fl .fl-row[hidden]{display:none}
.fl .fl-row[data-status="pending"]{border-left-color:#d97706}
.fl .fl-row[data-status="in_progress"]{border-left-color:#2563eb}
.fl .fl-row[data-status="resolved"]{border-left-color:#16a34a}
.fl .fl-row[data-status="cancelled"]{border-left-color:#9ca3af}

.fl .fl-main{display:flex;align-items:center;gap:14px;min-width:0}
.fl .fl-icon{flex:none;width:42px;height:42px;border-radius:50%;background:#f3f2ee;
  display:grid;place-items:center;color:#6b7280}
.fl .fl-text{min-width:0}
.fl .fl-text h3{margin:0;font-size:15px;font-weight:600}
.fl .fl-text p{margin:2px 0 0;font-size:13px;color:#6b7280;
  white-space:nowrap;overflow:hidden;text-overflow:ellipsis}

.fl .fl-meta{display:flex;align-items:center;gap:16px;font-size:13px;color:#6b7280;white-space:nowrap}
.fl .fl-status{padding:4px 10px;border-radius:6px;background:#eef0f2;font-weight:600;font-size:12px}
.fl .fl-row[data-status="pending"] .fl-status{background:#fef3c7;color:#b45309}
.fl .fl-row[data-status="in_progress"] .fl-status{background:#dbeafe;color:#1d4ed8}
.fl .fl-row[data-status="resolved"] .fl-status{background:#dcfce7;color:#15803d}

.fl .fl-priority{font-size:13px;font-weight:600;text-align:center}

.fl .fl-actions{display:flex;gap:6px}
.fl .fl-actions form{margin:0}
.fl .fl-act{width:36px;height:36px;padding:0;display:grid;place-items:center;border:1px solid #e0e0da;border-radius:8px;
  background:#fff;color:#4b5563;cursor:pointer;text-decoration:none;font-size:16px}
.fl .fl-act:hover{background:#f5f5f2}
.fl .fl-act.is-danger:hover{background:#fef2f2;color:#dc2626;border-color:#fecaca}

/* Boş durum */
.fl .fl-empty{text-align:center;padding:48px 16px;color:#6b7280;background:#fff;border:1px dashed #d8d8d2;border-radius:12px}
.fl .fl-empty[hidden]{display:none}
.fl .fl-empty svg{width:32px;height:32px;margin-bottom:8px}
.fl .fl-empty h3{margin:8px 0 4px;color:#1f2420}

.fl .fl-pagination{margin-top:20px}

@media (max-width:900px){
  .fl .fl-summary{grid-template-columns:repeat(2,1fr)}
  .fl .fl-row{grid-template-columns:1fr auto;gap:12px}
  .fl .fl-meta{grid-column:1 / -1;order:3;flex-wrap:wrap}
  .fl .fl-priority{text-align:right}
}
</style>

<div class="fl">

    {{-- BAŞLIK --}}
    <header class="fl-head">
        <div>
            <h1>Arızalar</h1>
            <p>Araçlarda meydana gelen arıza kayıtlarını yönetin.</p>
        </div>

        <a href="{{ route('fault.create') }}" class="fl-btn">
            <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
            Yeni arıza kaydı
        </a>
    </header>

    {{-- ÖZET ŞERİDİ --}}
    <section class="fl-summary">

        <div class="fl-sum-item">
            <strong>{{ $totalCount }}</strong>
            <span>Toplam</span>
        </div>

        <div class="fl-sum-item is-on">
            <strong>{{ $pendingCount }}</strong>
            <span>Beklemede</span>
        </div>

        <div class="fl-sum-item is-off">
            <strong>{{ $resolvedCount }}</strong>
            <span>Çözüldü</span>
        </div>

        <div class="fl-sum-item">
            <strong>{{ $otherCount }}</strong>
            <span>Diğer</span>
        </div>

    </section>

    {{-- ARAÇ ÇUBUĞU --}}
    <div class="fl-toolbar">

        <form action="{{ route('fault.index') }}" method="GET" class="fl-search">

            <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Arıza başlığı veya açıklama ara"
                autocomplete="off"
            >

            @if(request('search'))
                <a href="{{ route('fault.index') }}" class="fl-clear">
                    <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </a>
            @endif

        </form>

        <div class="fl-tabs" role="tablist">

            <button type="button" class="is-current" data-filter="all">
                Tümü
            </button>

            @foreach($faultRows->pluck('status')->unique() as $status)
                <button type="button" data-filter="{{ $status }}">
                    {{ $statusLabels[$status] ?? ucfirst(str_replace('_', ' ', $status)) }}
                </button>
            @endforeach

        </div>

    </div>

    {{-- ARIZA LİSTESİ --}}
    <ul class="fl-list" id="faultList">

        @forelse($faults as $fault)

            <li
                class="fl-row"
                data-status="{{ $fault->status }}"
            >

                {{-- ARIZA BİLGİLERİ --}}
                <div class="fl-main">

                    <span class="fl-icon" >
                        <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </span>

                    <div class="fl-text">

                        <h3>{{ $fault->title }}</h3>

                        <p>
                            {{ $fault->description ?: 'Açıklama bulunmuyor.' }}
                        </p>

                    </div>

                </div>

                {{-- META BİLGİLER --}}
                <div class="fl-meta">

                    <span class="fl-status">
                        {{ $statusLabels[$fault->status] ?? $fault->status }}
                    </span>

                    <span class="fl-date">
                        <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>

                        {{ $fault->fault_date
                            ? \Carbon\Carbon::parse($fault->fault_date)->format('d.m.Y')
                            : '-' }}
                    </span>

                    <span class="fl-id">
                        #{{ $fault->id }}
                    </span>

                </div>

                {{-- ÖNCELİK --}}
                <div class="fl-priority">
                    <span>
                        {{ $priorityLabels[$fault->priority] ?? $fault->priority }}
                    </span>
                </div>

                {{-- İŞLEMLER --}}
                <div class="fl-actions">

                    <a
                        href="{{ route('fault.show', $fault) }}"
                        class="fl-act"
                        title="Detay"
                        aria-label="Detay"
                    >
                        <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                    </a>

                    <a
                        href="{{ route('fault.edit', $fault->id) }}"
                        class="fl-act"
                        title="Düzenle"
                        aria-label="Düzenle"
                    >
                        <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                    </a>

            <form
    action="{{ route('fault.destroy', $fault) }}"
    method="POST"
    onsubmit="return confirm('Bu arıza kaydını silmek istediğinize emin misiniz?')"
>
    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="fl-act is-danger"
        title="Sil"
        aria-label="Sil"
    >
        <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
            <path d="M10 11v6M14 11v6"/>
        </svg>
    </button>
</form>

                </div>

            </li>

        @empty

            <li class="fl-empty">

                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>

                <h3>Arıza kaydı bulunamadı</h3>

                <p>
                    Henüz kayıt yok ya da aramanızla eşleşen sonuç çıkmadı.
                </p>

                <a href="{{ route('fault.create') }}" class="fl-btn">
                    <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
                    Arıza kaydı ekle
                </a>

            </li>

        @endforelse

        <li class="fl-empty fl-empty-filter" hidden>

            <h3>Bu durumda kayıt yok</h3>

            <p>Başka bir filtre seçmeyi deneyin.</p>

        </li>

    </ul>

    {{-- SAYFALAMA --}}
    @if(method_exists($faults, 'hasPages') && $faults->hasPages())
        <div class="fl-pagination">
            {{ $faults->withQueryString()->links() }}
        </div>
    @endif

</div>

<script>

        const searchInput = document.querySelector('.fl-search input[name="search"]');
        const rows = document.querySelectorAll('#faultList .fl-row');
        const emptyMsg = document.querySelector('.fl-empty-filter');
        let currentFilter = 'all';

        function applyFilters() {
            const term = searchInput.value.trim().toLowerCase();
            let shown = 0;

            rows.forEach(function (row) {
                const title = row.querySelector('.fl-text h3').textContent.toLowerCase();
                const desc = row.querySelector('.fl-text p').textContent.toLowerCase();

                const matchSearch = !term || title.includes(term) || desc.includes(term);
                const matchStatus = currentFilter === 'all' || row.dataset.status === currentFilter;
                const show = matchSearch && matchStatus;

                row.hidden = !show;
                if (show) shown++;
            });

            if (emptyMsg) emptyMsg.hidden = shown !== 0 || rows.length === 0;
        }

        searchInput.addEventListener('input', applyFilters);
        searchInput.closest('form').addEventListener('submit', function (e) {
            e.preventDefault();
        });

        document.querySelectorAll('.fl-tabs button').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.fl-tabs button').forEach(function (b) {
                    b.classList.remove('is-current');
                });
                btn.classList.add('is-current');
                currentFilter = btn.dataset.filter;
                applyFilters();
            });
        });

        applyFilters();

</script>

@endsection
