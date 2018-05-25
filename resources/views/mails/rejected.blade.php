Halo <i>{{ $verified->receiver }}</i>,
<p>Akun Egovbench anda belum berhasil dibuat.</p>

<p>Hal ini disebabkan karena berkas yang anda kirimkan tidak valid.</p>

<p>Mohon mendaftar ulang kembali dengan menggunakan berkas yang valid pada tautan berikut:</p>

<div>
<a href="{{ $verified->link}}"> {{$verified->link}} </a>
</div>

<br/>

Terima Kasih,
<br/>
<i>{{ $verified->sender }}</i>
