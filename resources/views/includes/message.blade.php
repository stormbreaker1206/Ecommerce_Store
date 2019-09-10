<div class="grid-container">
    <div class="grid-x grid-margin-x">
    <div class="cell small-12 medium-11">
    @if(isset($errors) && count($errors) || \App\classes\Session::has('errors'))

            <div class="callout alert" data-closable>

                @if( \App\classes\Session::has('errors')) <!-- check for session errors -->
                {{\App\classes\Session::flash('errors')}}

                    @else <!-- check for validation errors -->

        @foreach((array) $errors as $error_array) <!-- loops errors and display each -->

                @foreach((array) $error_array as $error_item)
                    {{ $error_item }} <br />

                    @endforeach

            @endforeach

                @endif

        <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
        <span arial-hidden="true">&times;</span>
        </button>
    </div>

    @endif
    </div>
    </div>

<div class="grid-x grid-margin-x">
    <div class="cell small-12 medium-11">
    @if(isset($success) || \App\classes\Session::has('success'))
    <div class="callout success" data-closable>

        @if(isset($success))

     {{$success}}

        @elseif(\App\classes\Session::has('success'))
            {{\App\classes\Session::flash('success')}}

            @endif

        <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
            <span arial-hidden="true">&times;</span>
        </button>
    </div>


    @endif
    </div>
</div>
</div>