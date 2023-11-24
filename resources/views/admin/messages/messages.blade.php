@if (session()->has('flash.error'))
<section class="content-header">
   <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('flash.error') }}
    </div>
 </section>

@elseif(session()->has('flash.success'))
<section class="content-header">
   <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('flash.success') }}
    </div>
 </section>
@endif