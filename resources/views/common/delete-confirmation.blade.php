 <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirmLabel" aria-hidden="true">
     <form action="" method="POST" style="display:inline;">
         @csrf
         <input type="hidden" name="_method" value="DELETE">
         <input type="hidden" name="id" value=""/>
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="confirmLabel">Confirmation</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true" onclick="$('#confirm').modal('hide');">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     Are you sure?
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-danger" id="delete">Delete</button>
                     <button type="button" class="btn btn-secondary" onclick="$('#confirm').modal('hide');"
                         data-dismiss="modal">Cancel</button>
                 </div>
             </div>
         </div>
     </form>
 </div>
