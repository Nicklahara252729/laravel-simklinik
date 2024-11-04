@extends('themes.theme-panel')
@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
   <div id="kt_app_content_container" class="app-container container-fluid">
      <div class="card">
         <div class="card-body">
            @include(components('management-kamar', 'kamar', 'kamar'))
         </div>
      </div>
      @include(modal())
   </div>
</div>
@stop