<div class="layout">
    <div class="form-group">
        @if($editorTitle)
            <label for="editor-{{ sha1($inputName) }}"
                   class="form-label">{{ $editorTitle }}
            </label>
        @endif
        <div data-controller="layout--editor"
             data-layout--editor-localization="{{ $localization }}"
             data-layout--editor-placeholder="{{ $placeholder }}"
             data-layout--editor-autofocus="{{ $autofocus ? 'true' : 'false' }}"
             data-layout--editor-tools="{{ $tools }}"
             data-layout--editor-log-level="{{ $logLevel }}"
             data-layout--editor-min-height="{{ $minHeight }}"
             @error($target) data-layout--editor-validation-error @enderror
             style="max-width: {{ $maxWidth }}"
             class="editor-layout"
        >
            <input
                name="{{ $inputName }}"
                value="{{ old($target, $data) }}"
                data-target="layout--editor.input"
                hidden
            />
        </div>
        @error($target)
            <div class="invalid-feedback d-block">
                <small>{{ $message }}</small>
            </div>
        @else
            @if($editorTitle)
                <small class="form-text text-muted">
                    {{ $editorTitle }}
                </small>
            @endif
        @enderror
    </div>
</div>





