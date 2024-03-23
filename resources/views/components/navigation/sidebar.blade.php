<div class="navbar bg-base-200">
    <div class="flex-1">
        <label for="sidebar" class="btn btn-ghost drawer-button lg:hidden"><i class="icon-menu text-lg"></i></label>
        <img src="{{ asset('img/Logo.svg') }}" class="size-12" alt="Logo">
        <a class="btn btn-ghost text-xl md:flex hidden" href="{{ route('home') }}"
           wire:navigate>{{ config('app.name') }}</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn m-1"><i class="icon-palette"></i> <span
                        class="sm:flex hidden">{{ __('messages.theme') }}</span></div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="{{ route('theme.dark') }}">{{ __('messages.themes.dark') }}</a>
                    </li>
                    <li><a href="{{ route('theme.light') }}">{{ __('messages.themes.light') }}</a>
                    </li>
                </ul>
            </div>

            @if(!config('app.disable_language_switcher'))
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn m-1"><i class="icon-languages"></i> <span
                            class="sm:flex hidden">{{ __('messages.language') }}</span></div>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="{{ route('lang.de') }}">{{ __('messages.languages.de') }}</a>
                        </li>
                        <li><a href="{{ route('lang.en') }}">{{ __('messages.languages.en') }}</a>
                        </li>
                    </ul>
                </div>
            @endif
        </ul>
    </div>
</div>
<div class="drawer lg:drawer-open">
    <input id="sidebar" type="checkbox" class="drawer-toggle"/>
    <div class="drawer-content">
        {{ $content }}
    </div>
    <div class="drawer-side">
        <label for="sidebar" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content">
            {!! markdown_parser()->parseMarkdown('pages/' . request()->cookie('language') . '/_sidebar.md')['content'] !!}
        </ul>

    </div>
</div>
