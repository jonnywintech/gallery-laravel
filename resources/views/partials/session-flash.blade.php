@if (session('status_message'))
    <div class="alert alert-info" style="position:absolute; width:100%; top:0; left:0; height:4rem;">
        {{ session('status_message') }}
        <button type="button" onclick=" this.parentElement.style.display = 'none'" class="btn-close float-end"
            aria-label="Close"></button>
    </div>
@endif
