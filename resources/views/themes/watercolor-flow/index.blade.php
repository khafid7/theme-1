<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</title>
    
    @vite(['resources/css/watercolor.css', 'resources/js/app.js'])
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Nunito:wght@400;600;700&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased overflow-hidden">

    <div id="ornaments-container">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <div class="fixed inset-0 z-[5] pointer-events-none">
        <div class="absolute inset-4 border-2 border-[#8CA6DB]/30 rounded-[30px] z-10"></div>
        
        <img src="{{ asset('assets/themes/watercolor/flower-top-left.png') }}" class="absolute -top-10 -left-10 w-48 opacity-90 animate-float-slow" onerror="this.style.display='none'">
        <img src="{{ asset('assets/themes/watercolor/flower-bottom-right.png') }}" class="absolute -bottom-10 -right-10 w-48 opacity-90 animate-float-slow delay-1000" onerror="this.style.display='none'">
    </div>

    <div id="music-control" class="fixed top-6 right-6 z-[100] opacity-0 pointer-events-none transition-opacity duration-1000">
        <button onclick="toggleMusic()" id="musicBtn" class="w-10 h-10 rounded-full bg-white/80 shadow-lg text-[#5D8AA8] flex items-center justify-center animate-spin-slow border border-[#5D8AA8]/20">
            <i class="ph-fill ph-music-note text-lg"></i>
        </button>
    </div>
    
    <audio id="bg-music" loop>
        <source src="{{ asset($invitation->music_file) }}" type="audio/mp3">
    </audio>

    <div id="gate" class="gate-overlay flex-col text-center px-6 bg-cover bg-center" style="background-image: url('{{ $invitation->cover_image }}');">
        <div class="absolute inset-0 bg-white/40 backdrop-blur-[3px]"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-white/50"></div>

        <div class="relative z-10 space-y-6">
            <p class="font-serif text-sm tracking-[0.3em] text-[#5D8AA8] uppercase font-bold">The Wedding Of</p>
            
            <h1 class="font-script text-6xl md:text-8xl text-[#2C3E50] drop-shadow-sm leading-tight">
                {{ $invitation->groom_nickname }} <br> <span class="text-[#D65A78] text-4xl">&</span> <br> {{ $invitation->bride_nickname }}
            </h1>
            
            <div class="water-card px-8 py-6 inline-block">
                <p class="text-[10px] text-gray-500 tracking-widest uppercase mb-2">Kepada Yth.</p>
                <h3 class="font-serif text-xl md:text-2xl text-[#2C3E50] font-bold capitalize">
                    {{ request('to', 'Tamu Undangan') }}
                </h3>
            </div>

            <br>

            <button onclick="openInvitation()" class="px-8 py-3 rounded-full bg-[#5D8AA8] text-white shadow-lg hover:bg-[#4a6d85] transition duration-300 text-xs font-bold uppercase tracking-widest flex items-center gap-2 mx-auto transform hover:scale-105">
                <i class="ph-bold ph-envelope-open"></i> Buka Undangan
            </button>
        </div>
    </div>

    <section id="home" class="page-section active flex flex-col justify-center items-center text-center px-6 pt-20 pb-24">
        <div class="relative mb-8 w-64 h-80">
            <div class="absolute inset-0 bg-[#D65A78]/20 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] animate-morph"></div>
            <img src="{{ $invitation->hero_image }}" class="absolute inset-2 w-[calc(100%-16px)] h-[calc(100%-16px)] object-cover rounded-[40%_60%_70%_30%/40%_50%_60%_50%] shadow-xl">
        </div>
        
        <p class="font-serif text-lg text-[#5D8AA8] italic mb-2">Save The Date</p>
        <h1 class="font-script text-5xl md:text-6xl text-[#2C3E50] mb-4">
            {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}
        </h1>
        
        <div class="bg-white/60 backdrop-blur-sm px-6 py-2 rounded-full border border-white shadow-sm text-gray-600 text-xs tracking-[0.2em] uppercase mt-2">
            {{ $invitation->akad_datetime->translatedFormat('l, d F Y') }}
        </div>
    </section>

    <section id="mempelai" class="page-section scrollable px-6 pt-24 pb-24">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="section-title">Mempelai</h2>
            <p class="text-xs text-gray-500 mb-8 italic max-w-xs mx-auto">"Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri..."</p>
            
            <div class="water-card p-6 mb-6 relative overflow-hidden">
                <div class="absolute -right-5 -top-5 w-20 h-20 bg-[#5D8AA8]/10 rounded-full blur-xl"></div>
                <img src="{{ $invitation->groom_photo }}" class="w-32 h-32 mx-auto rounded-full border-4 border-white shadow-md mb-4 object-cover">
                <h3 class="font-script text-3xl text-[#2C3E50]">{{ $invitation->groom_name }}</h3>
                <p class="text-[10px] uppercase tracking-widest text-[#5D8AA8] font-bold mt-1">The Groom</p>
                <p class="text-sm text-gray-600 mt-3">Putra dari Bpk. {{ $invitation->groom_father }} <br>& Ibu {{ $invitation->groom_mother }}</p>
                @if($invitation->groom_instagram)
                <a href="https://instagram.com/{{ $invitation->groom_instagram }}" target="_blank" class="inline-block mt-3 text-[#5D8AA8]"><i class="ph-fill ph-instagram-logo text-xl"></i></a>
                @endif
            </div>
            
            <div class="text-4xl font-script text-[#D65A78] my-4">&</div>
            
            <div class="water-card p-6 relative overflow-hidden">
                <div class="absolute -left-5 -bottom-5 w-20 h-20 bg-[#D65A78]/10 rounded-full blur-xl"></div>
                <img src="{{ $invitation->bride_photo }}" class="w-32 h-32 mx-auto rounded-full border-4 border-white shadow-md mb-4 object-cover">
                <h3 class="font-script text-3xl text-[#2C3E50]">{{ $invitation->bride_name }}</h3>
                <p class="text-[10px] uppercase tracking-widest text-[#D65A78] font-bold mt-1">The Bride</p>
                <p class="text-sm text-gray-600 mt-3">Putri dari Bpk. {{ $invitation->bride_father }} <br>& Ibu {{ $invitation->bride_mother }}</p>
                @if($invitation->bride_instagram)
                <a href="https://instagram.com/{{ $invitation->bride_instagram }}" target="_blank" class="inline-block mt-3 text-[#D65A78]"><i class="ph-fill ph-instagram-logo text-xl"></i></a>
                @endif
            </div>
        </div>
    </section>

    <section id="story" class="page-section scrollable px-6 pt-24 pb-24">
        <div class="max-w-3xl mx-auto">
            <h2 class="section-title">Kisah Kami</h2>
            <div class="relative mt-8">
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[#5D8AA8] to-[#D65A78] opacity-30"></div>
                
                @if($invitation->love_stories)
                    @foreach($invitation->love_stories as $story)
                    <div class="relative pl-10 mb-8">
                        <div class="absolute left-[13px] top-1 w-3 h-3 bg-white border-2 border-[#5D8AA8] rounded-full z-10"></div>
                        
                        <div class="water-card p-4 text-left">
                            <span class="text-[#D65A78] font-bold text-xs">{{ $story['year'] }}</span>
                            <h3 class="font-serif text-lg font-bold text-[#2C3E50]">{{ $story['title'] }}</h3>
                            <p class="text-sm text-gray-600 mt-1 leading-relaxed">{{ $story['story'] }}</p>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section id="event" class="page-section scrollable px-6 pt-24 pb-24">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="section-title">Rangkaian Acara</h2>
            
            <div class="flex justify-center gap-3 mb-10 mt-4">
                <div class="water-card p-2 w-16"><span id="days" class="block text-xl font-bold text-[#5D8AA8]">00</span><span class="text-[9px]">Hari</span></div>
                <div class="water-card p-2 w-16"><span id="hours" class="block text-xl font-bold text-[#5D8AA8]">00</span><span class="text-[9px]">Jam</span></div>
                <div class="water-card p-2 w-16"><span id="minutes" class="block text-xl font-bold text-[#5D8AA8]">00</span><span class="text-[9px]">Menit</span></div>
                <div class="water-card p-2 w-16"><span id="seconds" class="block text-xl font-bold text-[#5D8AA8]">00</span><span class="text-[9px]">Detik</span></div>
            </div>

            <div class="space-y-6">
                <div class="water-card p-6 border-t-4 border-t-[#5D8AA8]">
                    <h3 class="font-serif text-xl font-bold text-[#2C3E50] mb-2">{{ $invitation->akad_title }}</h3>
                    <div class="text-[#5D8AA8] font-bold mb-4 bg-[#5D8AA8]/10 inline-block px-4 py-1 rounded-full text-xs">
                        {{ $invitation->akad_datetime->format('H:i') }} WIB - Selesai
                    </div>
                    <p class="text-sm font-bold text-gray-700">{{ $invitation->akad_location }}</p>
                    <p class="text-xs text-gray-500 mb-4">{{ $invitation->akad_address }}</p>
                    <a href="{{ $invitation->akad_map_link }}" target="_blank" class="text-xs bg-[#5D8AA8] text-white px-4 py-2 rounded-full font-bold hover:bg-[#4a6d85] transition">Google Maps</a>
                </div>
                
                <div class="water-card p-6 border-t-4 border-t-[#D65A78]">
                    <h3 class="font-serif text-xl font-bold text-[#2C3E50] mb-2">{{ $invitation->resepsi_title }}</h3>
                    <div class="text-[#D65A78] font-bold mb-4 bg-[#D65A78]/10 inline-block px-4 py-1 rounded-full text-xs">
                        {{ $invitation->resepsi_datetime->format('H:i') }} WIB - Selesai
                    </div>
                    <p class="text-sm font-bold text-gray-700">{{ $invitation->resepsi_location }}</p>
                    <p class="text-xs text-gray-500 mb-4">{{ $invitation->resepsi_address }}</p>
                    <a href="{{ $invitation->resepsi_map_link }}" target="_blank" class="text-xs bg-[#D65A78] text-white px-4 py-2 rounded-full font-bold hover:bg-[#b04a62] transition">Google Maps</a>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="page-section scrollable px-4 pt-24 pb-24">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="section-title">Galeri Foto</h2>
            
            <div class="columns-2 md:columns-3 gap-3 space-y-3 mt-6">
                @if($invitation->gallery_photos)
                    @foreach($invitation->gallery_photos as $photo)
                    <div class="water-card p-1 break-inside-avoid hover:scale-[1.02] transition duration-500">
                        <img src="{{ $photo }}" class="w-full rounded-lg" loading="lazy">
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section id="gift" class="page-section scrollable px-6 pt-24 pb-24">
        <div class="max-w-xl mx-auto text-center">
            <h2 class="section-title">Tanda Kasih</h2>
            
            <div class="water-card p-6 mt-6 bg-gradient-to-br from-white to-[#F0F8FF] border border-[#5D8AA8]/20">
                <i class="ph-duotone ph-credit-card text-3xl text-[#5D8AA8] mb-2"></i>
                <p class="text-xs uppercase tracking-widest text-gray-400 mb-1">Bank {{ $invitation->bank_name }}</p>
                <p id="rek1" class="font-serif text-2xl text-[#2C3E50] font-bold tracking-widest mb-1">{{ $invitation->bank_number }}</p>
                <p class="text-sm text-gray-600 mb-4">a.n {{ $invitation->bank_holder }}</p>
                
                <button onclick="copyText('rek1')" class="text-xs border border-[#5D8AA8] text-[#5D8AA8] px-4 py-1.5 rounded-full hover:bg-[#5D8AA8] hover:text-white transition">
                    <i class="ph-bold ph-copy inline mr-1"></i> Salin
                </button>
            </div>

            <div class="mt-6 water-card p-6 border-dashed border-2 border-gray-300">
                <i class="ph-duotone ph-gift text-3xl text-[#D65A78] mb-2"></i>
                <p class="text-sm font-bold text-gray-700">Kirim Kado Fisik</p>
                <p class="text-xs text-gray-500 mt-1">{{ $invitation->gift_address }}</p>
            </div>
        </div>
    </section>

    <section id="rsvp" class="page-section scrollable px-6 pt-24 pb-24">
        <div class="max-w-xl mx-auto">
            <h2 class="section-title">Ucapan & Doa</h2>
            
            <div class="water-card p-6 mt-6">
                @if(session('success'))
                    <div class="bg-green-50 text-green-700 px-4 py-2 rounded-lg mb-4 text-xs text-center border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('kirim.ucapan') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="invitation_slug" value="{{ $invitation->slug }}">
                    
                    <input type="text" name="nama" required placeholder="Nama Anda" class="w-full bg-[#F9F9F9] border border-gray-200 rounded-lg p-3 text-sm focus:border-[#5D8AA8] outline-none transition">
                    
                    <select name="kehadiran" class="w-full bg-[#F9F9F9] border border-gray-200 rounded-lg p-3 text-sm focus:border-[#5D8AA8] outline-none transition text-gray-600">
                        <option value="Hadir">Saya Akan Hadir</option>
                        <option value="Tidak Hadir">Maaf Tidak Bisa Hadir</option>
                    </select>
                    
                    <textarea name="ucapan" rows="3" required placeholder="Tulis doa & ucapan..." class="w-full bg-[#F9F9F9] border border-gray-200 rounded-lg p-3 text-sm focus:border-[#5D8AA8] outline-none transition"></textarea>
                    
                    <button type="submit" class="w-full bg-[#5D8AA8] text-white font-bold py-3 rounded-lg hover:bg-[#4a6d85] transition text-sm shadow-md">
                        KIRIM UCAPAN
                    </button>
                </form>
            </div>
            
            <div class="space-y-3 mt-6 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
                @if($invitation->comments->count() > 0)
                    @foreach($invitation->comments as $comment)
                    <div class="water-card p-3 flex gap-3 items-start">
                        <div class="w-8 h-8 rounded-full bg-gray-100 text-[#5D8AA8] flex items-center justify-center font-bold text-xs shrink-0 border border-gray-200">
                            {{ substr($comment->nama, 0, 1) }}
                        </div>
                        <div class="w-full">
                            <div class="flex justify-between items-start">
                                <h4 class="font-bold text-[#2C3E50] text-xs">{{ $comment->nama }}</h4>
                                <span class="text-[9px] text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <span class="text-[9px] px-2 py-0.5 rounded-full inline-block mb-1 {{ $comment->kehadiran == 'Hadir' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $comment->kehadiran }}
                            </span>
                            <p class="text-xs text-gray-600 italic">"{{ $comment->ucapan }}"</p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-4 opacity-50">
                        <p class="text-xs">Belum ada ucapan.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <div class="nav-wrapper opacity-0 pointer-events-none transition-opacity duration-1000" id="navWrapper">
        <div class="nav-items">
            <button class="nav-btn active" onclick="switchPage('home')" data-label="Home"><i class="ph ph-house-line"></i></button>
            <button class="nav-btn" onclick="switchPage('mempelai')" data-label="Couple"><i class="ph ph-heart"></i></button>
            <button class="nav-btn" onclick="switchPage('story')" data-label="Story"><i class="ph ph-book-open-text"></i></button>
            <button class="nav-btn" onclick="switchPage('event')" data-label="Event"><i class="ph ph-calendar-heart"></i></button>
            <button class="nav-btn" onclick="switchPage('gallery')" data-label="Gallery"><i class="ph ph-image"></i></button>
            <button class="nav-btn" onclick="switchPage('gift')" data-label="Gift"><i class="ph ph-gift"></i></button>
            <button class="nav-btn" onclick="switchPage('rsvp')" data-label="Wishes"><i class="ph ph-chat-circle-text"></i></button>
        </div>
        <button class="nav-trigger" onclick="toggleNav()">
            <i class="ph ph-list font-bold"></i>
        </button>
    </div>

    <script>
        function openInvitation() {
            document.getElementById('gate').classList.add('open');
            document.getElementById('bg-music').play().catch(e => console.log("Audio play failed"));
            setTimeout(() => {
                document.getElementById('music-control').classList.remove('opacity-0', 'pointer-events-none');
                document.getElementById('navWrapper').classList.remove('opacity-0', 'pointer-events-none');
            }, 500); // Delay dikit 0.5 detik biar smooth
        }

        function toggleMusic() {
            const audio = document.getElementById('bg-music');
            const btn = document.getElementById('musicBtn');
            if (audio.paused) {
                audio.play();
                btn.classList.add('animate-spin-slow');
            } else {
                audio.pause();
                btn.classList.remove('animate-spin-slow');
            }
        }

        function copyText(id) {
            navigator.clipboard.writeText(document.getElementById(id).innerText).then(() => alert('Disalin!'));
        }

        function toggleNav() {
            const wrapper = document.getElementById('navWrapper');
            const icon = wrapper.querySelector('.nav-trigger i');
            wrapper.classList.toggle('open');
            icon.classList.toggle('ph-list', !wrapper.classList.contains('open'));
            icon.classList.toggle('ph-x', wrapper.classList.contains('open'));
        }

        function switchPage(pageId) {
            // Hilangkan active dari semua section
            document.querySelectorAll('.page-section').forEach(el => el.classList.remove('active'));
            // Tampilkan section target
            const target = document.getElementById(pageId);
            target.classList.add('active');
            
            // Reset scroll jika section scrollable
            if(target.classList.contains('scrollable')) target.scrollTop = 0;
            
            // Update tombol navbar
            document.querySelectorAll('.nav-btn').forEach(btn => btn.classList.remove('active'));
            const activeBtn = document.querySelector(`button[onclick="switchPage('${pageId}')"]`);
            if(activeBtn) activeBtn.classList.add('active');
            
            // Tutup navbar otomatis
            toggleNav();
        }

        // Countdown Logic
        const targetDate = new Date("{{ $invitation->akad_datetime }}").getTime();
        setInterval(() => {
            const now = new Date().getTime();
            const diff = targetDate - now;
            if(diff > 0) {
                document.getElementById('days').innerText = Math.floor(diff / (1000 * 60 * 60 * 24));
                document.getElementById('hours').innerText = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                document.getElementById('minutes').innerText = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                document.getElementById('seconds').innerText = Math.floor((diff % (1000 * 60)) / 1000);
            }
        }, 1000);
    </script>
</body>
</html>