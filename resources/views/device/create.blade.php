@extends('layouts.app')

@section('content')
<div class="devices-page">

    <a href="{{ route('device.index') }}"  class="detail-back">← Cihazlara dön</a>

    <div class="page-header">
        <div class="page-title">
            <h1>Yeni cihaz ekle</h1>
            <p>Yeni bir cihazın bilgilerini gir.</p>
        </div>
    </div>

    <div class="chart-card edit-card">

        @if(session('success'))
            <div class="auth-alert auth-alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="auth-alert auth-alert-danger">Formda hatalar var, lütfen kontrol et.</div>
        @endif

        <form
              method="POST"
              action="{{ route('device.createForm') }}"
              enctype="multipart/form-data"
              class="auth-form">
            @csrf

            <div class="edit-row">
                <div class="auth-form-group">
                    <label class="auth-form-label" for="name">Cihaz adı</label>
                    <input class="auth-input" type="text" id="name" name="name"
                           value="{{ old('name') }}">
                    @error('name') <span class="auth-error">{{ $message }}</span> @enderror
                </div>

                <div class="auth-form-group">
                    <label class="auth-form-label" for="serial_no">Seri no</label>
                    <input class="auth-input" type="text" id="serial_no" name="serial_no"
                           value="{{ old('serial_no') }}">
                    @error('serial_no') <span class="auth-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="edit-row">
                <div class="auth-form-group">
                    <label class="auth-form-label" for="model">Model</label>
                    <input class="auth-input" type="text" id="model" name="model"
                           value="{{ old('model') }}">
                    @error('model') <span class="auth-error">{{ $message }}</span> @enderror
                </div>

                <div class="auth-form-group">
                    <label class="auth-form-label" for="type">Cihaz türü</label>
                    <input class="auth-input" type="text" id="type" name="type"
                           value="{{ old('type') }}">
                    @error('type') <span class="auth-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="edit-row">
                <div class="auth-form-group">
                    <label class="auth-form-label" for="status">Durum</label>
                    <select class="auth-input" id="status" name="status">
                        @foreach(['active' => 'Aktif', 'service' => 'Serviste', 'passive' => 'Pasif'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', 'active') === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status') <span class="auth-error">{{ $message }}</span> @enderror
                </div>

                <div class="auth-form-group">
                    <label class="auth-form-label" for="personel_id">Sorumlu personel</label>
                    <select class="auth-input" id="personel_id" name="personel_id">
                        <option value="">Personel seç</option>
                        @foreach ($personels as $personel)
                            <option value="{{ $personel->id }}" @selected(old('personel_id') == $personel->id)>
                                {{ $personel->fullname }}
                            </option>
                        @endforeach
                    </select>
                    @error('personel_id') <span class="auth-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="auth-form-group">
                <label class="auth-form-label">Cihaz Resmi</label>

                <div class="dropzone" id="dropzone">
                    <input type="file" id="image" name="image" accept="image/*" hidden>

                    <div id="dropzoneContent">
                        <div class="dropzone-icon">↑</div>
                        <p class="dropzone-title">Resmi buraya sürükle ve bırak</p>
                        <p class="dropzone-text">veya <span>dosya seç</span></p>
                        <small>PNG, JPG, WEBP · Maksimum 2 MB</small>
                    </div>

                    <div id="imagePreviewContainer" hidden>
                        <img id="imagePreview" alt="Seçilen resmin önizlemesi">
                        <p id="imageName"></p>
                        <button type="button" id="removeImage" class="dropzone-remove">
                            Resmi kaldır
                        </button>
                    </div>
                </div>

                @error('image')
                    <span class="auth-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="edit-actions">
                <a href="{{ route('device.index') }}" class="action-btn edit detail-btn">Vazgeç</a>
                <button type="submit" class="btn-primary">Cihazı kaydet</button>
            </div>
        </form>
    </div>

</div>

<script>
    const dropzone   = document.getElementById('dropzone');
    const input      = document.getElementById('image');
    const content    = document.getElementById('dropzoneContent');
    const previewBox = document.getElementById('imagePreviewContainer');
    const preview    = document.getElementById('imagePreview');
    const imageName  = document.getElementById('imageName');
    const removeBtn  = document.getElementById('removeImage');

    dropzone.addEventListener('click', () => input.click());
    input.addEventListener('click', e => e.stopPropagation());

    function showPreview(file) {
        if (!file) return;
        preview.src = URL.createObjectURL(file);
        imageName.textContent = file.name;
        content.hidden = true;
        previewBox.hidden = false;
    }

    input.addEventListener('change', () => showPreview(input.files[0]));

    removeBtn.addEventListener('click', e => {
        e.stopPropagation();
        input.value = '';
        previewBox.hidden = true;
        content.hidden = false;
    });

    dropzone.addEventListener('dragover', e => e.preventDefault());
    dropzone.addEventListener('drop', e => {
        e.preventDefault();
        input.files = e.dataTransfer.files; // input'a atamazsan form dosyayı göndermez
        showPreview(input.files[0]);
    });
</script>
@endsection
