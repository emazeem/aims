<style>
    .line-through{
        -webkit-text-decoration-line: line-through; /* Safari */
        text-decoration-line: line-through;
    }
</style>
<div class="modal fade" id="add_delivery_note" tabindex="-1" role="dialog" aria-labelledby="titleDeliveryNote" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 border-bottom mb-3 pb-2">
                        <h5 class="modal-title font-weight-light float-left" id="titleDeliveryNote"><i class="feather icon-plus-circle"></i> Add Delivery Note</h5>
                        <button type="button" class="close close-btn float-right" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
                        </button>
                    </div>

                    <form id="add_delivery_note_form">
                        @csrf
                        <input type="hidden" name="job_id" value="{{$job->id}}">
                        <input type="hidden" name="delivery_item_id" id="delivery_item_id"  value="">
                        {{--<div class="row">
                            <div class='checkbox text-right checkbox-fill checkbox-danger d-inline'>
                                <input type='checkbox' class="text-right" id='check-all'>
                                <label class='cr text-right font-weight-bold text-danger' for='check-all' style="text-decoration: underline">Mark All</label>
                            </div>

                        </div>
                        --}}
                        @if(count($job->jobitems)>0)
                            <div class="col-12 p-0 m-0">
                                <div class='checkbox text-right checkbox-fill checkbox-danger d-inline'>
                                    <input type='checkbox' class="text-right" id='check-all'>
                                    <label class='cr text-right font-weight-bold text-danger' for='check-all' style="text-decoration: underline">Mark All</label>
                                </div>
                            </div>
                        @endif
                        @foreach($job->jobitems as $item)
                            <div class='checkbox col-md-3 checkbox-fill d-inline'>
                                <input type='checkbox' data-id='{{$item->id}}' name='delivery_items' class='delivery_items' id='delivery_items{{$item->id}}'
                                        {{(in_array($item->id,$delivered_id)?'selected disabled':'')}}>
                                <label class='cr {{(in_array($item->id,$delivered_id)?'line-through':'')}}' for='delivery_items{{$item->id}}' >{{$item->item->capabilities->name}}</label>
                            </div>
                        @endforeach
                        <button class="btn btn-primary btn-sm rounded float-right delivery-note-add-btn" type="submit"><i class="feather icon-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '#check-all', function () {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    });
</script>