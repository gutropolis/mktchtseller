

@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
          CharityFba
        @endcomponent
    @endslot

    {{-- Body --}}
# Hello

We have received a new contact mail.<br />
**Name :** {{ $data->contact_name }}<br />
**Email :** {{ $data->contact_email }}<br />
**Company : ** {{ $data->contact_company}}<br />
**Subject : ** {{ $data->contact_subject}}<br />
**Message :** {{ $data->contact_msg }}


Thanks,

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
           &copy; 2018 All Copy right received
        @endcomponent
    @endslot
@endcomponent
