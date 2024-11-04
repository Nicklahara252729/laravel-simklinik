@extends('themes.theme-panel')
@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
   <div class="d-flex flex-column flex-column-fluid">
      <div id="kt_app_content" class="app-content flex-column-fluid">
         <div id="kt_app_content_container" class="app-container container-fluid">
            <!-- Accordion -->
            @include(components('dashboard', 'card', 'card'))
            @include(components('dashboard', 'accordion', 'accordion'))
         </div>
      </div>
   </div>
</div>
@stop