@if(Session::has('flash_message'))

    <script>
        swal({ title:" {{Session::get('flash_message')}}",
            text:"هذه الرساله سوف تختفى بعد 4 ثوانى",
            showConfirmButton: false,
            timer: 4000,
        });
    </script>

@endif
