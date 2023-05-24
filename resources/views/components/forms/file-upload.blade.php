<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">
            <label class="custom-file-label" for="{{ $name }}">Choose file</label>
        </div>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Upload</button>
        </div>
    </div>
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.custom-file-input').on('change', function (event) {
                var inputFile = event.currentTarget;
                $(inputFile).parent()
                    .find('.custom-file-label')
                    .html(inputFile.files[0].name);
            });

            $('#inputGroupFileAddon04').on('click', function () {
                var fileInput = $('#{{ $name }}');
                var formData = new FormData();
                formData.append('file', fileInput[0].files[0]);

                $.ajax({
                    url: '{{ route('employees.store') }}',
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endpush
