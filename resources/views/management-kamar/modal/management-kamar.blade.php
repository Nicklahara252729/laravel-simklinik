<div class="modal modal-xl fade" id="modal-manage-kamar" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content rounded">
         <div class="modal-header pb-0 border-0">
            <h3 class="modal-title" id="title-spesialis"></h3>
            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" id="close-modal">
               <i class="ki-outline ki-cross fs-1"></i>
            </div>
         </div>
         <div class="modal-body scroll-y">
            @include(components('management-kamar', 'bed', 'bed'))
         </div>
      </div>
   </div>
</div>