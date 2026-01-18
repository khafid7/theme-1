<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $invitation->groom_name }} & {{ $invitation->bride_name }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Pinyon+Script&family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    @vite(['resources/css/rustic.css', 'resources/js/app.js'])

    <style>
        .no-scroll { overflow: hidden; }
        .glass-card { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
        .bg-texture { background-color: #F9F9F2; background-image: url("https://www.transparenttextures.com/patterns/cream-paper.png"); }
        .slide-up { animation: slideUp 1s ease-in-out forwards; }
        @keyframes slideUp { to { transform: translateY(-100%); opacity: 0; } }
        
        /* --- WAVE WRAPPER --- */
        .wave-wrapper {
            position: absolute;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            z-index: 20;
        }
        
        /* 1. EFEK BUKIT (Menghadap ATAS) */
        /* Ditaruh di BAWAH section */
        .wave-bukit { 
            bottom: -1px;
            transform: rotate(180deg); 
        }
        
        /* 2. EFEK TETESAN (Menghadap BAWAH) */
        /* Ditaruh di ATAS section & DIBALIK */
        .wave-tetesan { 
            top: -1px; 
            
        }

        /* WARNA WAVE */
        .text-sage-dark { color: #4A5D46; } /* Hijau */
        .text-charcoal { color: #2F3E32; } /* Abu Gelap */

        /* SVG Shape */
        .wave-svg { display: block; width: calc(100% + 1.3px); height: 70px; }
        
        /* Divider */
        .section-divider { display: flex; justify-content: center; align-items: center; margin: 4rem auto; width: 80%; opacity: 0.6; color: #4A5D46; }
    </style>
</head>
<body class="bg-texture text-charcoal font-sans antialiased overflow-x-hidden no-scroll" id="mainBody">

    <div id="gate" class="fixed inset-0 z-[999] bg-texture flex flex-col items-center justify-center text-center p-6 transition-all duration-1000 bg-cover bg-center" style="background-image: url('{{ $invitation->cover_image }}');">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px]"></div>
        <div class="relative z-10 text-white animate-float">
            <p class="uppercase tracking-[0.3em] text-xs mb-4">The Wedding Of</p>
            <div class="flex justify-center -space-x-4 mb-6">
                <img src="{{ $invitation->groom_photo }}" class="w-20 h-20 rounded-full border-2 border-cream object-cover">
                <img src="{{ $invitation->bride_photo }}" class="w-20 h-20 rounded-full border-2 border-cream object-cover">
            </div>
            <h1 class="font-rustic-script text-6xl mb-2">{{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</h1>
            <p class="font-serif italic mb-8 border-y border-white/50 py-2 inline-block">{{ $invitation->akad_datetime->translatedFormat('l, d F Y') }}</p>
            <div class="glass-card text-charcoal px-6 py-4 rounded-xl mb-8 mx-auto max-w-xs">
                <p class="text-xs uppercase mb-1">Kepada Yth:</p>
                <h3 class="font-bold text-lg">{{ request('to', 'Tamu Undangan') }}</h3>
            </div>
            <button onclick="bukaUndangan()" class="bg-sage text-white px-8 py-3 rounded-full uppercase tracking-widest text-sm font-bold hover:bg-sage-dark transition shadow-lg flex items-center gap-2 mx-auto animate-pulse">
                <i class="ph-fill ph-envelope-open"></i> Buka Undangan
            </button>
        </div>
    </div>

    <button onclick="toggleMusic()" id="musicBtn" class="fixed bottom-4 right-4 z-50 bg-sage-dark text-white w-10 h-10 rounded-full shadow-xl flex items-center justify-center animate-spin-slow border-2 border-cream hidden">
        <i class="ph-fill ph-music-notes text-lg"></i>
    </button>
    <audio id="bg-music" loop><source src="{{ asset($invitation->music_file) }}" type="audio/mp3"></audio>

    <section class="relative min-h-screen w-full overflow-hidden flex flex-col items-center justify-center text-center px-4 pt-20">
        <div class="absolute inset-0 bg-cover bg-center opacity-100" style="background-image: url('{{ $invitation->hero_image }}');"></div>
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="relative z-10 mt-10 text-cream">
            <p class="font-sans tracking-[0.5em] text-xs uppercase mb-4 drop-shadow-md">Save The Date</p>
            <h1 class="font-rustic-script text-7xl md:text-9xl mb-2 text-cream drop-shadow-lg">
                {{ $invitation->groom_nickname }} <span class="text-terracotta">&</span> {{ $invitation->bride_nickname }}
            </h1>
            <div id="countdown" class="flex flex-wrap justify-center gap-4 mt-8 font-serif text-cream drop-shadow-md"></div>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-[#F9F9F2] to-transparent z-20"></div>
    </section>

    <section class="pt-12 pb-0 px-6 relative bg-texture">
        <div class="max-w-5xl mx-auto text-center relative z-10">
            <p class="text-[#C87964] font-bold tracking-widest text-xs uppercase mb-2">The Happy Couple</p>
            <h2 class="font-rustic-serif text-5xl text-gray-800 mb-16">Groom & Bride</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div class="group relative flex flex-col items-center">
                    <div class="relative w-full max-w-sm aspect-[3/4] mb-6"><div class="absolute inset-0 bg-[#4A5D46] rounded-t-[10rem] rounded-b-[2rem] transform rotate-3 transition duration-500"></div><img src="{{ $invitation->groom_photo }}" class="relative w-full h-full object-cover rounded-t-[10rem] rounded-b-[2rem] border-4 border-white shadow-xl transform -rotate-3 z-10"></div>
                    <div class="relative z-20 text-center"><h3 class="font-rustic-script text-5xl text-[#2F3E32] mb-1">{{ $invitation->groom_name }}</h3><p class="text-xs font-bold text-[#8DA399] uppercase tracking-widest mb-3">Putra Bpk. {{ $invitation->groom_father }}</p>@if($invitation->groom_instagram)<a href="{{ $invitation->groom_instagram }}" target="_blank" class="inline-flex items-center gap-1 text-xs bg-white border border-sage px-3 py-1 rounded-full hover:bg-sage hover:text-white transition cursor-pointer z-30 relative text-sage-dark"><i class="ph-fill ph-instagram-logo"></i> <span>Instagram</span></a>@endif</div>
                </div>
                <div class="group relative flex flex-col items-center">
                    <div class="relative w-full max-w-sm aspect-[3/4] mb-6"><div class="absolute inset-0 bg-[#C87964]/80 rounded-t-[10rem] rounded-b-[2rem] transform -rotate-3 transition duration-500"></div><img src="{{ $invitation->bride_photo }}" class="relative w-full h-full object-cover rounded-t-[10rem] rounded-b-[2rem] border-4 border-white shadow-xl transform rotate-3 z-10"></div>
                    <div class="relative z-20 text-center"><h3 class="font-rustic-script text-5xl text-[#2F3E32] mb-1">{{ $invitation->bride_name }}</h3><p class="text-xs font-bold text-[#8DA399] uppercase tracking-widest mb-3">Putri Bpk. {{ $invitation->bride_father }}</p>@if($invitation->bride_instagram)<a href="{{ $invitation->bride_instagram }}" target="_blank" class="inline-flex items-center gap-1 text-xs bg-white border border-sage px-3 py-1 rounded-full hover:bg-sage hover:text-white transition cursor-pointer z-30 relative text-sage-dark"><i class="ph-fill ph-instagram-logo"></i> <span>Instagram</span></a>@endif</div>
                </div>
            </div>
        </div>
    </section>

    <div class="bg-texture py-2"><div class="section-divider"><svg width="100%" height="20" viewBox="0 0 500 20" preserveAspectRatio="none"><path d="M0,10 Q250,20 500,10" fill="none" stroke="currentColor" stroke-width="2" stroke-dasharray="5,5" /><circle cx="250" cy="15" r="4" fill="currentColor" /></svg></div><div class="flex justify-center -mt-8"><i class="ph-fill ph-flower-lotus text-2xl bg-texture px-2 relative z-10 text-[#8DA399]"></i></div></div>

    @if(count($invitation->love_stories) > 0)
    <section class="relative bg-texture pt-0 pb-32 px-6">
        <div class="max-w-3xl mx-auto relative z-10">
            <h2 class="font-rustic-script text-5xl text-center text-sage-dark mb-12">Our Love Story</h2>
            <div class="relative border-l-2 border-sage ml-6 md:ml-1/2 space-y-12 pl-8 md:pl-0">
                @foreach($invitation->love_stories as $index => $story)
                <div class="relative md:flex items-center justify-between group">
                    <div class="absolute -left-[39px] md:left-1/2 md:-ml-[9px] w-5 h-5 bg-terracotta rounded-full border-4 border-white z-10"></div>
                    <div class="md:w-[45%] {{ $index % 2 == 0 ? 'md:ml-auto md:text-left' : 'md:mr-auto md:text-right' }} bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition border-t-4 border-sage">
                        <span class="text-terracotta font-bold text-sm">{{ $story['year'] }}</span>
                        <h3 class="font-serif text-xl font-bold mb-2">{{ $story['title'] }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $story['story'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="wave-wrapper wave-bukit text-sage-dark">
            <svg class="wave-svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="currentColor"></path>
            </svg>
        </div>
    </section>
    @endif

    <section class="relative bg-sage-dark text-cream pt-12 pb-12 px-6">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
            <div class="bg-white/5 p-8 border border-white/10 rounded-tr-[3rem] rounded-bl-[3rem] text-center transform hover:-translate-y-2 transition duration-300"><i class="ph-fill ph-hands-praying text-4xl mb-4 text-terracotta"></i><h3 class="font-serif text-2xl mb-2">{{ $invitation->akad_title }}</h3><p class="text-3xl font-bold my-4 text-white">{{ $invitation->akad_datetime->format('H:i') }} WIB</p><p class="opacity-80 mb-6">{{ $invitation->akad_location }}</p><a href="{{ $invitation->akad_map_link }}" class="inline-block border border-cream px-6 py-2 text-xs uppercase hover:bg-cream hover:text-sage-dark transition rounded-full">Google Maps</a></div>
            <div class="bg-white/5 p-8 border border-white/10 rounded-tl-[3rem] rounded-br-[3rem] text-center transform hover:-translate-y-2 transition duration-300"><i class="ph-fill ph-wine text-4xl mb-4 text-terracotta"></i><h3 class="font-serif text-2xl mb-2">{{ $invitation->resepsi_title }}</h3><p class="text-3xl font-bold my-4 text-white">{{ $invitation->resepsi_datetime->format('H:i') }} WIB</p><p class="opacity-80 mb-6">{{ $invitation->resepsi_location }}</p><a href="{{ $invitation->resepsi_map_link }}" class="inline-block border border-cream px-6 py-2 text-xs uppercase hover:bg-cream hover:text-sage-dark transition rounded-full">Google Maps</a></div>
        </div>
    </section>

    <section class="relative bg-texture pt-32 pb-32 px-6">
        
        <div class="wave-wrapper wave-tetesan text-sage-dark">
            <svg class="wave-svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="currentColor"></path>
            </svg>
        </div>

        <h2 class="font-rustic-script text-6xl text-center text-sage-dark mb-12">Gallery</h2>
        <div class="max-w-6xl mx-auto columns-2 md:columns-3 gap-6 space-y-6">
            @foreach($invitation->gallery_photos as $index => $photo)
                <div class="break-inside-avoid p-2 bg-white shadow-lg {{ $index % 2 == 0 ? 'rotate-1' : '-rotate-1' }} hover:rotate-0 transition duration-500">
                     <img src="{{ $photo }}" class="w-full grayscale hover:grayscale-0 transition duration-700">
                </div>
            @endforeach
        </div>

        <div class="wave-wrapper wave-bukit text-sage-dark">
            <svg class="wave-svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="currentColor"></path>
            </svg>
        </div>
    </section>

    <section class="relative bg-sage-dark text-cream pt-12 pb-12 px-6">
        <div class="max-w-2xl mx-auto text-center relative z-10">
            <h2 class="font-rustic-serif text-3xl mb-4">Wedding Gift</h2><p class="text-sm opacity-80 mb-8">Doa restu Anda merupakan karunia yang sangat berarti bagi kami. Namun jika memberi adalah ungkapan tanda kasih Anda, kami menerima kado secara cashless.</p>
            <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl shadow-lg border border-white/20 relative overflow-hidden"><div class="absolute top-0 left-0 w-full h-2 bg-terracotta"></div><p class="text-sm uppercase tracking-widest opacity-70 mb-2">{{ $invitation->bank_name }}</p><h3 class="font-mono text-3xl mb-2 tracking-wider" id="noRek">{{ $invitation->bank_number }}</h3><p class="text-sm font-bold mb-6">a.n {{ $invitation->bank_holder }}</p><button onclick="copyToClipboard('noRek')" class="bg-terracotta text-white px-6 py-2 rounded-full text-xs font-bold uppercase hover:bg-[#b0604b] transition flex items-center gap-2 mx-auto"><i class="ph-bold ph-copy"></i> Salin Rekening</button></div>
            <div class="mt-8 bg-white/10 backdrop-blur-sm p-6 rounded-xl shadow border border-white/20"><i class="ph-fill ph-gift text-3xl text-terracotta mb-2"></i><p class="text-sm font-bold mb-1">Alamat Kirim Kado:</p><p class="text-sm opacity-80 mb-4">{{ $invitation->gift_address }}</p></div>
        </div>
    </section>

    <section class="relative bg-texture pt-32 pb-32 px-6">
        
        <div class="wave-wrapper wave-tetesan text-sage-dark">
            <svg class="wave-svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="currentColor"></path>
            </svg>
        </div>

        <h2 class="font-rustic-serif text-3xl mb-8 relative z-10 text-center text-sage-dark">Kirim Ucapan</h2>
        <form action="{{ route('kirim.ucapan') }}" method="POST" class="max-w-lg mx-auto space-y-4 mb-10 relative z-10">@csrf<input type="hidden" name="invitation_slug" value="{{ $invitation->slug }}"><input type="text" name="nama" placeholder="Nama Anda" class="w-full bg-white border border-sage p-3 rounded text-sage-dark placeholder-gray-400 focus:outline-none focus:border-terracotta"><textarea name="ucapan" placeholder="Ucapan..." rows="3" class="w-full bg-white border border-sage p-3 rounded text-sage-dark placeholder-gray-400 focus:outline-none focus:border-terracotta"></textarea><select name="kehadiran" class="w-full bg-white border border-sage p-3 rounded text-sage-dark"><option value="Hadir">Saya Hadir</option><option value="Tidak Hadir">Berhalangan</option></select><button type="submit" class="w-full bg-sage-dark text-white font-bold py-3 rounded hover:bg-terracotta transition">KIRIM</button></form>
        <div class="max-w-lg mx-auto text-left space-y-3 max-h-60 overflow-y-auto relative z-10">
            @foreach($invitation->comments as $comment)
                <div class="bg-white p-3 rounded border border-sage shadow-sm"><h4 class="font-bold text-sm text-sage-dark">{{ $comment->nama }}</h4><p class="text-xs italic text-gray-600">"{{ $comment->ucapan }}"</p></div>
            @endforeach
        </div>

        <div class="wave-wrapper wave-bukit text-charcoal">
            <svg class="wave-svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="currentColor"></path>
            </svg>
        </div>
    </section>

    <footer class="bg-charcoal text-sand py-6 text-center text-xs tracking-widest uppercase relative z-10">
        {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }} 2026
    </footer>

    <script>
        function bukaUndangan() { const gate = document.getElementById('gate'); const body = document.getElementById('mainBody'); const musicBtn = document.getElementById('musicBtn'); gate.classList.add('slide-up'); body.classList.remove('no-scroll'); setTimeout(() => { musicBtn.classList.remove('hidden'); }, 1000); toggleMusic(); }
        function toggleMusic() { const audio = document.getElementById('bg-music'); const btn = document.getElementById('musicBtn'); if (audio.paused) { audio.play(); btn.classList.add('animate-spin-slow'); } else { audio.pause(); btn.classList.remove('animate-spin-slow'); } }
        const akadDate = new Date("{{ $invitation->akad_datetime }}").getTime();
        const timer = setInterval(function() { const now = new Date().getTime(); const distance = akadDate - now; if (distance < 0) { document.getElementById("countdown").innerHTML = "Acara Telah Selesai"; clearInterval(timer); return; } const days = Math.floor(distance / (1000 * 60 * 60 * 24)); const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)); const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)); const seconds = Math.floor((distance % (1000 * 60)) / 1000); const boxClass = "bg-white/10 backdrop-blur-md border border-white/30 px-4 py-2 rounded text-center min-w-[70px]"; const numClass = "text-2xl font-bold block"; const labelClass = "text-[10px] uppercase tracking-widest opacity-80"; document.getElementById("countdown").innerHTML = `<div class="${boxClass}"><span class="${numClass}">${days}</span><span class="${labelClass}">Hari</span></div><div class="${boxClass}"><span class="${numClass}">${hours}</span><span class="${labelClass}">Jam</span></div><div class="${boxClass}"><span class="${numClass}">${minutes}</span><span class="${labelClass}">Menit</span></div><div class="${boxClass}"><span class="${numClass}">${seconds}</span><span class="${labelClass}">Detik</span></div>`; }, 1000);
        function copyToClipboard(elementId) { const text = document.getElementById(elementId).innerText; navigator.clipboard.writeText(text).then(() => { alert("Nomor Rekening Berhasil Disalin!"); }); }
    </script>
</body>
</html>