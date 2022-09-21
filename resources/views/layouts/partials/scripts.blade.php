<!-- Form Error message  -->
<script type="text/javascript" src="{{ asset('/js/form-error-message.js') }}"></script>
<script type="text/javascript">
    var urlBase = '{{ url('') }}/';
    var _token = '{{csrf_token()}}';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // para adicionar a classe active para o sideNav
    var url = document.location.toString();
    var urlorigin = window.location.origin;

    if( url === urlorigin + "/"){
        $('ul li a[href="' + urlorigin + '"]').parent().addClass('active');
    }
    else{
        $('ul li a[href="' + url + '"]').parent().addClass('active');
        $('ul a').filter(function () {
            return this.href == url;
        }).parent().addClass('active').parent().parent().addClass('active');
    }

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip({trigger: "hover"});
    });

    @if(Session::has('message'))
    toastr.{{ Session::get('type') }}('{{ Session::get("message") }}', '', {showDuration: 300, hideDuration: 1000, timeOut: 5000, closeButton: true, progressBar: true})
    @endif

</script>
<script type="text/javascript" src="{{ asset('js/tebela-responsiva.js') }}"></script>
