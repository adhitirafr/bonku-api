@component('mail::message')

<h1 class="medium">Konfirmasi </h1>

Hai {{ $name }}, registrasimu sudah hampir selesai. Silakan klik tombol dibawah ini untuk melengkapi aktivasi akun.

@component('mail::button', ['url' => $url, 'color' => 'green'])
Aktifkan Akun
@endcomponent

Regards,<br>
Bonku

@component('mail::subcopy')
Email ini dikirim secara otomatis oleh sistem. Tidak perlu dibalas.*
@endcomponent

@endcomponent
