<!-- === START:: Header === -->
<div class="header">
   <div class="container">
      <div class="header_logo">
         <a href="/" class="logo">
            <!-- Background Image -->
            @if(Route::current()->getName()==='home.index')
               <h1 style="display:none;">Trang chủ Chuyến tàu Văn học</h1>
            @endif
         </a>
      </div>
      @php
          $dataMenu   = \App\Models\Category::getAllCategoryByTree();
      @endphp
      <!-- Menu Desktop -->
      @include('main.snippets.menuDesktop', compact('dataMenu'))
      <!-- Menu Mobile -->
      @include('main.snippets.menuMobile')

      
   </div>
</div>
<div style="width:100%;height:50px;"></div>
<!-- === END:: Header === -->
@push('scripts-custom')
   <script type="text/javascript">
      function submitForm(idForm){
         $('#'+idForm).submit();
      }
   </script>
@endpush