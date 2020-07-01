<div class="modal fade" id="AddExpenseCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('expenses_category.store')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group" app-field-wrapper="name"><label for="name" class="control-label"> <small
                                class="req text-danger">* </small>Category Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>

                    <div class="form-group" app-field-wrapper="description"><label for="description"
                            class="control-label">Category Description</label>
                        <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
    </div>
    </form>
</div>