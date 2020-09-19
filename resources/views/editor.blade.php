<div data-controller="layout--editor"
     data-layout--editor-localization="{{ $localization }}"
     data-layout--editor-placeholder="{{ $placeholder }}"
     data-layout--editor-autofocus="{{ $autofocus ? 'true' : 'false' }}"
     data-layout--editor-tools="{{ $tools }}"
     data-layout--editor-log-level="{{ $logLevel }}"
     data-layout--editor-min-height="{{ $minHeight }}"
    @error($target) data-layout--editor-validation-error @enderror
    style="max-width: {{ $maxWidth }}"
>
    <input name="{{ $inputName }}" value="{{ old($target, $data) }}" data-target="layout--editor.input" hidden />

</div>

@error($target)
    <div class="invalid-feedback d-block">
        <small>{{ $message }}</small>
    </div>
@enderror
