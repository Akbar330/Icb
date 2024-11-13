@extends('layouts.main')

@section('title', 'Visi, Misi, dan Tujuan')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-blue-700 leading-tight mb-4">Visi, Misi, dan Tujuan SMK ICB Cinta Teknika Bandung</h1>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">Visi, Misi, dan Tujuan yang menjadi pedoman kami dalam menciptakan pendidikan berkualitas di bidang teknologi, guna menghasilkan lulusan yang siap bersaing dan berkontribusi di dunia industri.</p>
        </div>

        <!-- Visi Section -->
        <section id="visi" class="bg-gradient-to-r from-blue-100 to-blue-50 rounded-lg shadow-lg overflow-hidden mb-10 p-8">
            <div class="flex items-center space-x-8">
                <div class="w-1/2">
                    <h2 class="text-3xl font-semibold text-blue-600 mb-6">Visi</h2>
                    <p class="text-lg text-gray-700 leading-relaxed">"Terwujudnya tamatan yang menguasai ilmu pengetahuan dan keterampilan di bidang teknologi serta berkepribadian nasional juga bertakwa kepada Tuhan Yang Maha Esa".</p>
                </div>
                <div class="w-1/2">
                    <img src="{{ asset('visi.jpeg') }}" alt="Visi Image" class="w-full h-64 object-cover rounded-lg shadow-xl hover:scale-105 transform transition duration-300">
                </div>
            </div>
        </section>

        <!-- Misi Section -->
        <section id="misi" class="bg-gradient-to-r from-green-100 to-green-50 rounded-lg shadow-lg overflow-hidden mb-10 p-8">
            <div class="flex items-center space-x-8">
                <div class="w-1/2">
                    <h2 class="text-3xl font-semibold text-green-600 mb-6">Misi</h2>
                    <ul class="list-disc pl-6 text-lg text-gray-700 space-y-4">
                        <li>Mendidik dan melatih siswa SMK ICB Cinta Teknika agar menjadi tenaga kerja yang aktif, kreatif, produktif, terampil, mandiri, berbudi luhur dan bertakwa kepada Tuhan Yang Maha Esa.</li>
                        <li>Menyiapkan siswa SMK ICB Cinta Teknika untuk dapat mengisi dan atau menciptakan lapangan kerja yang sesuai dengan perkembangan industri dan teknologi agar dapat meningkatkan taraf hidup, kesejahteraan umum dalam kerangka pembangunan nasional.</li>
                    </ul>
                </div>
                <div class="w-1/2">
                    <img src="{{ asset('misi.jpeg') }}" alt="Misi Image" class="w-full h-64 object-cover rounded-lg shadow-xl hover:scale-105 transform transition duration-300">
                </div>
            </div>
        </section>

        <!-- Tujuan Section -->
        <section id="tujuan" class="bg-gradient-to-r from-purple-100 to-purple-50 rounded-lg shadow-lg overflow-hidden p-8">
            <div class="flex items-center space-x-8">
                <div class="w-1/2">
                    <h2 class="text-3xl font-semibold text-purple-600 mb-6">Tujuan</h2>
                    <ul class="list-disc pl-6 text-lg text-gray-700 space-y-4">
                        <li>Menjalani kehidupan secara layak.</li>
                        <li>Meningkatkan keimanan dan ketakwaan.</li>
                        <li>Menjadi warga negara yang produktif, kreatif, mandiri, dan bertanggung jawab.</li>
                        <li>Memahami dan menghargai keanekaragaman budaya bangsa Indonesia.</li>
                        <li>Menerapkan dan memelihara hidup sehat, memiliki wawasan lingkungan, pengetahuan dan seni.</li>
                        <li>Memasuki lapangan kerja serta dapat mengembangkan sikap profesional dalam lingkup keahlian Teknologi.</li>
                        <li>Mampu memilih karir, mampu berkompetensi, dan mampu mengembangkan diri dalam lingkup keahlian Teknologi.</li>
                    </ul>
                </div>
                <div class="w-1/2">
                    <img src="{{ asset('tujuan.jpeg') }}" alt="Tujuan Image" class="w-full h-64 object-cover rounded-lg shadow-xl hover:scale-105 transform transition duration-300">
                </div>
            </div>
        </section>
    </div>
@endsection
