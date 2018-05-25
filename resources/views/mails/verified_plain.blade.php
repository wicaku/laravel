Hello {{ $verified->receiver }},
Akun Egovbench anda telah berhasil dibuat!

Klik link di bawah untuk melakukan login ke dalam situs Egovbench:


<a href="{{ $verified->link}}"> login </a>

Terima Kasih,
{{ $verified->sender }}
