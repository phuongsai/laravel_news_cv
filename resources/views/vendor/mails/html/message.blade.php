@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot



{{-- Body --}}
{{-- {{ $slot }} --}}
@if (isset($posts))

    <h4>
        Here is the top post of the week!
    </h4>
    <table>
    @foreach ($posts as $key => $post)
        <tr>
            <td>
                <h5>{{ $key+1 }}. <strong>{{ $post->title }}</strong></h5>
            </td>
            <td>
                <a class="btn btn-info" href="{{ url(route('post.details', $post)) }}"></a>
            </td>
        </tr>
        @endforeach
    </table>

@endif



{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
