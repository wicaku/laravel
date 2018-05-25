Halo <i>{{ $verified->receiver }}</i>,
<p>Akun Egovbench anda telah berhasil dibuat!</p>

<p>Klik link di bawah untuk melakukan login ke dalam situs Egovbench:</p>

<div>
<a href="{{ $verified->link}}"> {{$verified->link}} </a>
</div>

<br/>

Terima Kasih,
<br/>
<i>{{ $verified->sender }}</i>
