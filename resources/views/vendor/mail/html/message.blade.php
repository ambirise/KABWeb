@component('mail::layout')
    {{-- Header --}}

    {{ $slot }}

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }}.@lang('Annapurna Dental'). @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent