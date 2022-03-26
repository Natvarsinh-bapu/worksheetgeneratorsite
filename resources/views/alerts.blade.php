@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-info-circle"></i>
        <span style="margin-left:10px;">{{ Session::get('info') }}</span>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-check-circle"></i>
        <span style="margin-left:10px;">{{ Session::get('success') }}</span>
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-warning"></i>
        <span style="margin-left:10px;">{{ Session::get('warning') }}</span>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-times-circle"></i>
        <span style="margin-left:10px;">{{ Session::get('error') }}</span>
    </div>
@endif

<div id="custom_alerts">
    
</div>