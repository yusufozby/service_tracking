@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => '',
    'prefixIcon' => null,
    'hintText' => null,
])

<style>
   .input-field-container {
    position: relative;
    width: 100%;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 0;
    box-sizing: border-box;

    display: flex;
    align-items: center;

    transition: border-color 0.15s ease, box-shadow 0.15s ease;
}

.input-field-container:hover {
    border-color: var(--border-hover);
}

.input-field-container:focus-within {
    border-color: var(--border-focus);
    box-shadow: 0 0 0 1px var(--border-focus);
}

    .input-prefix-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 20px;
        height: 20px;
        margin-left: 14px;
        color: var(--text-secondary);
        pointer-events: none;
    }

    .input-prefix-icon svg {
        width: 100%;
        height: 100%;
    }

    .input-field {
        width: 100%;
        height: 44px;
        padding: 0 14px;

        border: none;
        outline: none;
        background: transparent;

        border-radius: var(--radius-lg);
        box-sizing: border-box;

        font-family: 'Inter', sans-serif;
        font-size: 14px;
        color: var(--text);
    }

    .input-field-container.has-prefix-icon .input-field {
        padding-left: 8px;
    }

    .input-label {
        position: absolute;
        left: 14px;
        top: 50%;

        transform: translateY(-52%);
        background: #fff;
        color: var(--text-secondary);

        pointer-events: none;

        padding: 0 4px;

        transition: all 0.1s ease;
    }

    .input-field-container.has-prefix-icon .input-label {
        left: 42px;
    }

    /* Label varsa placeholder'ı gizle (floating label animasyonu için) */
    .input-field-container.has-label .input-field::placeholder {
        color: transparent;
    }

    /* Label yoksa placeholder normal görünür */
    .input-field-container:not(.has-label) .input-field::placeholder {
        color: var(--text-secondary);
    }

    .input-field-container.has-label:focus-within .input-label,
    .input-field-container.has-label .input-field:not(:placeholder-shown) + .input-label {
        top: 0;
        left: 14px !important;
        transform: translateY(-50%);

        font-size: 12px;
        color: var(--primary);
    }

    .input-hint {
        display: block;
        margin-top: 4px;

        color: var(--text-secondary);
        font-size: 12px;
    }

    .input-error {
        display: block;
        margin-top: 4px;

        color: var(--primary);
        font-size: 12px;
    }
</style>

<div  class="px-2">

    <div class="input-field-container
        {{ $prefixIcon ? 'has-prefix-icon' : '' }}
        {{ $label ? 'has-label' : '' }}">

        @if($prefixIcon)
            <span class="input-prefix-icon">
                {!! $prefixIcon !!}
            </span>
        @endif

        <input
            class="input-field"
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $label ? ' ' : $hintText }}"
        >

        @if($label)
            <label
                class="input-label"
                for="{{ $name }}"
            >
                {{ $label }}
            </label>
        @endif

    </div>

    @error($name)
        <span class="input-error">
            {{ $message }}
        </span>
    @else
        @if($hintText && $label)
            <span class="input-hint">
                {{ $hintText }}
            </span>
        @endif
    @enderror

</div>
