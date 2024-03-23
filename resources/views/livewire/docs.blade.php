<div class="md:m-20 m-10">
    <div class="prose">
        {!! $content !!}
    </div>

    <div class="flex justify-between">
        @if($previous)
            @if(!str_starts_with('http', $next))
                <div class="mt-5">
                    <a href="{{ $previous }}" class="btn btn-primary" wire:navigate><i class="icon-arrow-left"></i> {{ $previousTitle }}</a>
                </div>
            @else
                <div class="mt-5">
                    <a href="{{ $previous }}" class="btn btn-primary"><i class="icon-arrow-left"></i> {{ $previousTitle }}</a>
                </div>
            @endif
        @else
            <div class="mt-5"></div>
        @endif

        @if($next)
            @if(!str_starts_with('http', $next))
                <div class="mt-5">
                    <a href="{{ $next }}" class="btn btn-success" wire:navigate>{{ $nextTitle }} <i class="icon-arrow-right"></i></a>
                </div>
            @else
                <div class="mt-5">
                    <a href="{{ $next }}" class="btn btn-success">{{ $nextTitle ?? __('messages.next') }} <i class="icon-arrow-right"></i></a>
                </div>
            @endif
        @endif
    </div>

    @script
    <script>
        hljs.highlightAll();
    </script>
    @endscript
</div>
