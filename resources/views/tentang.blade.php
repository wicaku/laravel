@extends('master')
@section('title')
Tentang
@endsection 
@section('body')
<div class="ui container">
	<h1>About Us</h1>
	<p>
		E-Gov Benchmarking merupakan produk riset dari Nur Aini Rakhmawati. S.Kom, M.Sc.Eng, PhD yang dikembangkan di Laboratorium
		Akuisisi Data dan Diseminasi Informasi Jurusan Sistem Informasi Institut Teknologi Sepuluh Nopember Surabaya yang berfokus
		pada data dan informasi. Produk ini dikembangkan bersama mahasiswa berikut Biondi Hasbi Handoko, Aditya Mayapada, Muhammad
		Zuhri, Abi Nubli, Mochammad Rizki dan Fajara.
		<br>
		<br> Data dan Informasi merupakan salah satu elemen vital dalam aspek kehidupan bermasyarakat. Oleh karena itu, penguasaan
		teknologi untuk data dan informasi sangat penting bagi kesejahteraan dan kedaulatan bangsa. Terdapat tiga elemen penting
		yang menjadi topik utama penelitian , antara lain:
		<br>
		<ul>
			<li>Akuisisi Data
				<br>
			</li>
			Data yang saat ini ada di sekitar kita heterogen, baik dari sisi struktur (terstruktur dan tidak terstruktur), lokasi (terdistribusi
			atau terpusat), dari berbagai sumber/resource (contoh: data dari website, pesan teks/sms, dan lain-lain), serta volume
			(contoh: data masif atau big data).
			<br>
			<li>Paradigma Pengolahan
				<br>
			</li>
			Seiring dengan perkembangan sumber dan volume data, berkembang pula berbagai teknologi untuk mengolah data tersebut. Masing-masing
			dari teknologi tersebut merupakan implementasi dari paradigma yang berbeda mengenai data, dan diwujudkan dalam inovasi
			pada teknik-teknik pra-proses dan pengolahan data.
			<br>
			<li>Diseminasi Informasi
				<br>
			</li>
			Proses dan metode pengolahan data menjadi informasi yang lebih bernilai.
			<br> Laboratorium ADDI yang terdiri dari lima orang dosen dan 16 mahasiswa, mempunyai kerjasama dengan pemerintah Kota Surabaya.
			Selain itu kami juga mempunyai kerjasama internasional seperti Pyxera Global US dalam membuat aplikasi monitoring pelaksanaan
			pembangunan di kota Surabaya pada tahun 2015.
		</ul>
	</p>
</div>
@endsection 
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#about").addClass("active");
    });

</script>
@endsection