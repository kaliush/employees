@props(['route', 'id'])

<form id="delete-form-{{ $id }}" action="{{ $route }}" method="POST">
    @csrf
    @method('DELETE')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $id }}">
        <i class="fa fa-trash fa-fw"></i>
    </button>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalCenterTitle">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this employee?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
