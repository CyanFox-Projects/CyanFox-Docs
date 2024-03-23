<footer class="w-full bg-base-200 lg:p-4 py-6 flex items-center justify-between footer mt-auto z-0">
    <div class="flex-grow"></div>

    <div class="absolute left-0 right-0 mx-auto text-center text-sm block">
        @if(config('legal.impress') !== null)
            <a class="link link-hover" href="{{ route('impress') }}"><i
                    class="icon-badge-info"></i> {{ __('navigation.footer.impress') }}</a>
        @endif
        @if(config('legal.impress') !== null && config('legal.privacy') !== null)
            <span class="px-2">|</span>
        @endif
        @if(config('legal.privacy') !== null)
            <a class="link link-hover" href="{{ route('privacy') }}"><i
                    class="icon-badge-info"></i> {{ __('navigation.footer.privacy') }}</a>
        @endif
    </div>


    <div class="text-right items-center pr-5 grid-flow-col lg:flex hidden">
        <img src="{{ asset('img/Logo.svg') }}" alt="Logo" class="size-12">
        <p class="text-sm z-10">{!! __('navigation.footer.made_with_love') !!}</p>
    </div>
</footer>
