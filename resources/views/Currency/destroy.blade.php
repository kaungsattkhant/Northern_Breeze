<div class="modal fade" id="destroy" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document" style="width: 350px;">
        <div class="modal-content">
            <form action="{{url('currency_group/destroy')}}" method="post">
                @csrf
                <div class="modal-body mx-3">
                    <h5 class="mount-modal-title2 mb-3 text-dark" id="exampleModalLongTitle">Delete?</h5>
                    <button type="button" class="close x-button-mount" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p style="font-size: 15px;">Do you want to delete permanently?<br>
                        You cannot undo this.</p>
                    <input type="hidden" name="id" id="delete_id">

                    <div class="m-button">
                        <button type="button" class="btn  text-primary " data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn  text-primary px-0 del-mount">Delete</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
