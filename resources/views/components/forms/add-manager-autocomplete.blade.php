@props(['managers'])
<style>
    span.twitter-typeahead {
        display: block !important;
        width: 100%;
    }
    .tt-menu {
        background-color: #ffffff;
        width:100%;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .tt-suggestion {
        padding: 5px 4px;
        cursor: pointer;
    }
</style>

<x-adminlte-input name="manager_id" label="Manager" type="text" placeholder="Enter manager name"
                  :value="''" class="m-autocomplete"/>
<input id="manager_id_autocomplete" type="hidden" name="manager_id">
@error('manager_id')
<div class="text-danger">{{ $message }}</div>
@enderror

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/typeahead.js"></script>
    <script>
        $(document).ready(function () {
            var managers = @json($managers);

            var managerNames = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: managers
            });

            var managerInput = $('.m-autocomplete');

            managerInput.typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'managers',
                source: managerNames,
                display: 'name',
                templates: {
                    suggestion: function (data) {
                        return '<div>' + data.name + '</div>';
                    }
                }
            }).on('typeahead:select', function (event, suggestion) {
                $('#manager_id_autocomplete').val(suggestion.id);
                managerInput.val(suggestion.name);
            });

            managerInput.on('input', function () {
                $('#manager_id_autocomplete').val('');
            });
        });
    </script>

@stop
