@if( $errors->any() )
    @if ( !empty($only) )

        @php
            $data = $errors->get($only);
        @endphp

        @if ($data)
            <div class="alert alert-{{ $only }}">
                @foreach ( (is_array($data) ? $data : [$data]) as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
        
    @else

        @foreach ($errors->getMessages() as $key => $messages)
            <div class="alert alert-{{ in_array($key, ['success', 'info', 'warning']) ? $key : 'danger' }}">
                @foreach ($messages as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endforeach
        
    @endif
@endif