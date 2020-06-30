<div class="modal fade d-print-none" id="add_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('reservation.room.store')}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12" data-children-count="1">
                            <label><strong data-children-count="0">Booking ID</strong></label>
                            <input class="form-control" readonly="" value="{{$reservation->uid}}">
                        </div>
                    </div>

                    <input type="hidden" name="reservation_id" value="{{$reservation->id}}" type="number">
                    <input type="hidden" name="check_in" value="{{$reservation->check_in}}" type="number">
                    <input type="hidden" name="check_out" value="{{$reservation->check_out}}" type="number">

                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12" data-children-count="1">
                            <label><strong data-children-count="0">Tax</strong></label>
                            <select class="custom-select custom-select-lg mb-3" name="room_id">
                                <option selected>Select Room</option>
                                @foreach ($rooms as $room)
                                <option value="{{$room->id}}">{{$room->number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Allot</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>