<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</title>
    
    @vite(['resources/css/app.css', 'resources/css/emerald.css', 'resources/js/app.js'])
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="antialiased">

    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')]"></div>
        <div class="absolute top-[-20%] left-[-20%] w-[600px] h-[600px] bg-[#143d30] rounded-full blur-[100px] opacity-60"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[400px] h-[400px] bg-[#D4AF37] rounded-full blur-[150px] opacity-10"></div>
    </div>

    <div class="fixed top-6 right-6 z-[100]">
        <button onclick="toggleMusic()" id="musicBtn" class="w-10 h-10 rounded-full bg-[#0B201A]/80 border border-[#D4AF37]/50 text-[#D4AF37] flex items-center justify-center shadow-lg backdrop-blur-md transition hover:scale-110">
            <i class="ph-fill ph-music-note text-lg"></i>
        </button>
    </div>
    
    <audio id="bg-music" loop>
        <source src="{{ asset($invitation->music_file) }}" type="audio/mp3">
    </audio>

    <div id="gate" class="fixed inset-0 z-[999] flex items-center justify-center bg-[#0B201A]">
        <div class="absolute inset-0 z-0 opacity-40">
            <img src="{{ $invitation->cover_image }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0B201A] via-[#0B201A]/50 to-transparent"></div>
        </div>

        <div class="relative z-10 text-center px-8 w-full max-w-md">
            <div class="border border-[#D4AF37]/40 p-1 rounded-t-[150px] rounded-b-[20px] backdrop-blur-sm bg-[#0B201A]/30">
                <div class="border border-[#D4AF37] px-6 py-12 rounded-t-[146px] rounded-b-[16px]">
                    <p class="text-[10px] uppercase tracking-[0.4em] text-[#D4AF37] mb-6">The Wedding Of</p>
                    <h1 class="font-royal text-5xl md:text-6xl text-white leading-none mb-4 drop-shadow-lg">
                        {{ $invitation->groom_nickname }} <br> 
                        <span class="text-3xl font-light italic text-[#D4AF37]">&</span> <br> 
                        {{ $invitation->bride_nickname }}
                    </h1>
                    <div class="w-10 h-px bg-[#D4AF37] mx-auto my-8"></div>
                    <p class="text-[10px] uppercase tracking-widest text-gray-300 mb-2">Dear Guest</p>
                    <h3 class="font-royal text-xl text-white capitalize mb-10">{{ request('to', 'Tamu Undangan') }}</h3>
                    <button onclick="openInvitation()" class="group relative px-8 py-3 bg-[#D4AF37] text-[#0B201A] font-bold text-xs uppercase tracking-widest rounded-full overflow-hidden shadow-[0_0_20px_rgba(212,175,55,0.4)] hover:scale-105 transition">
                        Buka Undangan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="main-content" class="fixed inset-0 overflow-y-auto no-scrollbar scroll-smooth pb-28">
        
        <section id="home" class="min-h-screen flex flex-col justify-end items-center text-center px-6 pb-24 relative">
            <div class="absolute top-0 left-0 w-full h-[70vh] z-[-1]">
                <img src="{{ $invitation->hero_image }}" class="w-full h-full object-cover opacity-60">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#0B201A]"></div>
            </div>
            <div class="reveal-on-scroll">
                <p class="text-[#D4AF37] text-xs tracking-[0.3em] uppercase mb-4">Save The Date</p>
                <h2 class="font-royal text-4xl md:text-6xl text-white mb-6">
                    {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}
                </h2>
                <p class="text-gray-300 italic text-sm max-w-xs mx-auto mb-8">"{{ $invitation->quote }}"</p>
                <div id="countdown" class="flex justify-center gap-6 font-royal text-[#D4AF37] text-xl border-t border-[#D4AF37]/30 pt-6 max-w-xs mx-auto"></div>
            </div>
        </section>

        <section id="intro" class="pt-10 pb-10 px-6 relative">
            <div class="max-w-lg mx-auto text-center reveal-on-scroll">
                
                <div class="mb-5 flex justify-center opacity-70">
                    <i class="ph-fill ph-plant text-3xl text-[#D4AF37]"></i>
                </div>

                <p class="text-sm font-bold text-[#D4AF37] uppercase tracking-widest mb-4">Assalamualaikum Wr. Wb.</p>
                <p class="text-sm text-gray-300 mb-8 leading-relaxed">
                    Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud menyelenggarakan pernikahan putra-putri kami:
                </p>

                <div class="border-t border-b border-[#D4AF37]/30 py-8 relative">
                    <i class="ph-fill ph-quotes text-4xl text-[#D4AF37]/20 absolute top-4 left-1/2 transform -translate-x-1/2"></i>
                    <p class="font-royal text-xl text-white italic mb-4 relative z-10">
                        "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri..."
                    </p>
                    <p class="text-xs font-bold text-[#D4AF37] uppercase tracking-widest">
                        (QS. Ar-Rum: 21)
                    </p>
                </div>

            </div>
        </section>

        <section id="couple" class="pt-8 pb-20 px-6">
            <div class="max-w-lg mx-auto">
                <h2 class="font-royal text-4xl text-center text-[#D4AF37] mb-12 reveal-on-scroll">The Couple</h2>
                
                <div class="flex items-center gap-6 mb-12 reveal-on-scroll">
                    <div class="relative w-32 h-40 shrink-0">
                        <div class="absolute inset-0 border border-[#D4AF37] rounded-tl-[40px] rounded-br-[40px] translate-x-2 translate-y-2"></div>
                        <img src="{{ $invitation->groom_photo }}" class="w-full h-full object-cover rounded-tl-[40px] rounded-br-[40px] relative z-10 grayscale hover:grayscale-0 transition duration-700">
                    </div>
                    <div>
                        <h3 class="font-royal text-3xl text-white mb-1">{{ $invitation->groom_name }}</h3>
                        <p class="text-[10px] uppercase tracking-widest text-[#D4AF37] mb-2">The Groom</p>
                        <p class="text-xs text-gray-400">Putra Bpk {{ $invitation->groom_father }} <br>& Ibu {{ $invitation->groom_mother }}</p>
                        @if($invitation->groom_instagram)
                        <a href="#" class="inline-block mt-3 text-[#D4AF37] text-lg"><i class="ph-fill ph-instagram-logo"></i></a>
                        @endif
                    </div>
                </div>

                <div class="flex flex-row-reverse items-center gap-6 text-right reveal-on-scroll">
                    <div class="relative w-32 h-40 shrink-0">
                        <div class="absolute inset-0 border border-[#D4AF37] rounded-tr-[40px] rounded-bl-[40px] -translate-x-2 translate-y-2"></div>
                        <img src="{{ $invitation->bride_photo }}" class="w-full h-full object-cover rounded-tr-[40px] rounded-bl-[40px] relative z-10 grayscale hover:grayscale-0 transition duration-700">
                    </div>
                    <div>
                        <h3 class="font-royal text-3xl text-white mb-1">{{ $invitation->bride_name }}</h3>
                        <p class="text-[10px] uppercase tracking-widest text-[#D4AF37] mb-2">The Bride</p>
                        <p class="text-xs text-gray-400">Putri Bpk {{ $invitation->bride_father }} <br>& Ibu {{ $invitation->bride_mother }}</p>
                        @if($invitation->bride_instagram)
                        <a href="#" class="inline-block mt-3 text-[#D4AF37] text-lg"><i class="ph-fill ph-instagram-logo"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section id="story" class="py-20 px-6 bg-[#091a15]">
            <div class="max-w-lg mx-auto">
                <h2 class="font-royal text-4xl text-center text-[#D4AF37] mb-12 reveal-on-scroll">Our Journey</h2>
                @if(!empty($invitation->love_stories))
                <div class="relative pl-8 border-l border-[#D4AF37]/20 space-y-10">
                    @foreach($invitation->love_stories as $story)
                    <div class="relative reveal-on-scroll">
                        <div class="absolute -left-[37px] top-1 w-4 h-4 bg-[#0B201A] border border-[#D4AF37] rounded-full flex items-center justify-center">
                            <div class="w-1.5 h-1.5 bg-[#D4AF37] rounded-full"></div>
                        </div>
                        <span class="text-[#D4AF37] text-xs font-bold tracking-widest mb-1 block">{{ $story['year'] }}</span>
                        <h4 class="font-royal text-2xl text-white mb-2">{{ $story['title'] }}</h4>
                        <p class="text-sm text-gray-400 leading-relaxed">{{ $story['story'] }}</p>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </section>

        <section id="event" class="py-20 px-6">
            <div class="max-w-lg mx-auto text-center">
                <h2 class="font-royal text-4xl text-[#D4AF37] mb-12 reveal-on-scroll">Wedding Event</h2>
                <div class="grid gap-6">
                    <div class="glass-panel p-8 rounded-2xl reveal-on-scroll">
                        <i class="ph-duotone ph-rings-wedding text-4xl text-[#D4AF37] mb-4"></i>
                        <h3 class="font-royal text-2xl text-white mb-1">{{ $invitation->akad_title }}</h3>
                        <p class="text-[#D4AF37] text-xs font-bold uppercase tracking-wider mb-6">{{ $invitation->akad_datetime->translatedFormat('l, d F Y') }}</p>
                        <div class="space-y-2 text-sm text-gray-300 mb-6">
                            <p><i class="ph-fill ph-clock mr-2"></i> {{ $invitation->akad_datetime->format('H:i') }} WIB</p>
                            <p class="px-8 leading-relaxed">{{ $invitation->akad_location }}</p>
                        </div>
                        <a href="{{ $invitation->akad_map_link }}" class="inline-block border-b border-[#D4AF37] text-[#D4AF37] text-xs uppercase tracking-widest pb-1">Open Map</a>
                    </div>
                    <div class="glass-panel p-8 rounded-2xl reveal-on-scroll">
                        <i class="ph-duotone ph-wine text-4xl text-[#D4AF37] mb-4"></i>
                        <h3 class="font-royal text-2xl text-white mb-1">{{ $invitation->resepsi_title }}</h3>
                        <p class="text-[#D4AF37] text-xs font-bold uppercase tracking-wider mb-6">{{ $invitation->resepsi_datetime->translatedFormat('l, d F Y') }}</p>
                        <div class="space-y-2 text-sm text-gray-300 mb-6">
                            <p><i class="ph-fill ph-clock mr-2"></i> {{ $invitation->resepsi_datetime->format('H:i') }} WIB</p>
                            <p class="px-8 leading-relaxed">{{ $invitation->resepsi_location }}</p>
                        </div>
                        <a href="{{ $invitation->resepsi_map_link }}" class="inline-block border-b border-[#D4AF37] text-[#D4AF37] text-xs uppercase tracking-widest pb-1">Open Map</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="gallery" class="py-20 px-4">
            <h2 class="font-royal text-4xl text-center text-[#D4AF37] mb-8 reveal-on-scroll">Gallery</h2>
            <div class="columns-2 gap-3 space-y-3 max-w-2xl mx-auto">
                @foreach($invitation->gallery_photos as $photo)
                    <img src="{{ $photo }}" class="w-full rounded-lg opacity-80 hover:opacity-100 transition duration-500 reveal-on-scroll">
                @endforeach
            </div>
        </section>

        <section id="gift" class="py-20 px-6 bg-[#091a15]">
            <div class="max-w-lg mx-auto text-center">
                <h2 class="font-royal text-4xl text-[#D4AF37] mb-10 reveal-on-scroll">Wedding Gift</h2>
                
                <p class="text-sm text-gray-300 mb-8 reveal-on-scroll px-4">
                    Doa restu Anda merupakan karunia yang sangat berarti bagi kami. Namun jika memberi adalah ungkapan tanda kasih Anda, Anda dapat memberi kado secara cashless.
                </p>

                <div class="gift-card-emerald p-8 rounded-2xl text-center mb-10 reveal-on-scroll transform hover:scale-105 transition duration-500">
                    <p class="text-xs font-bold uppercase tracking-widest mb-1 opacity-70">Transfer Bank</p>
                    <h3 class="font-bold text-xl mb-6">Bank {{ $invitation->bank_name }}</h3>
                    <p class="font-royal text-4xl font-bold tracking-widest mb-2" id="rekNum">{{ $invitation->bank_number }}</p>
                    <p class="text-sm mb-6">a.n {{ $invitation->bank_holder }}</p>
                    
                    <button onclick="copyText('rekNum')" class="bg-[#0B201A] text-[#D4AF37] px-6 py-2 rounded-full text-xs font-bold uppercase hover:bg-white transition flex items-center gap-2 mx-auto">
                        <i class="ph-bold ph-copy"></i> Salin Nomor
                    </button>
                </div>

                @if($invitation->gift_address)
                <div class="glass-panel p-6 rounded-2xl reveal-on-scroll">
                    <i class="ph-duotone ph-package text-3xl text-[#D4AF37] mb-2"></i>
                    <h3 class="font-bold text-white mb-2 uppercase text-sm tracking-wide">Kirim Kado Fisik</h3>
                    <p class="text-sm text-gray-300 leading-relaxed">{{ $invitation->gift_address }}</p>
                </div>
                @endif
            </div>
        </section>

        <section id="wishes" class="py-20 px-6 pb-40">
            <div class="max-w-lg mx-auto">
                <h2 class="font-royal text-4xl text-center text-[#D4AF37] mb-8 reveal-on-scroll">Wishes</h2>

                <div class="glass-panel p-6 rounded-2xl reveal-on-scroll">
                    @if(session('success'))
                        <div class="bg-green-900/50 text-green-200 p-3 rounded mb-4 text-xs text-center border border-green-500/30">
                            <i class="ph-fill ph-check-circle inline mr-1"></i> {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('kirim.ucapan') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="invitation_slug" value="{{ $invitation->slug }}">
                        
                        <input type="text" name="nama" placeholder="Nama Lengkap" class="input-emerald" required>
                        
                        <select name="kehadiran" class="input-emerald cursor-pointer">
                            <option value="Hadir" class="bg-[#0B201A]">Saya Akan Hadir</option>
                            <option value="Tidak Hadir" class="bg-[#0B201A]">Maaf, Tidak Bisa Hadir</option>
                        </select>
                        
                        <textarea name="ucapan" rows="2" placeholder="Tuliskan doa & ucapan..." class="input-emerald resize-none" required></textarea>
                        
                        <button type="submit" class="w-full mt-4 bg-[#D4AF37] text-[#0B201A] py-3 rounded-lg font-bold text-xs uppercase hover:bg-white transition shadow-lg">
                            Kirim Ucapan
                        </button>
                    </form>
                </div>

                <div class="mt-10 space-y-6">
                    @foreach($invitation->comments->sortByDesc('created_at') as $comment)
                    <div class="border-b border-[#D4AF37]/10 pb-4 reveal-on-scroll flex gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#D4AF37] text-[#0B201A] flex items-center justify-center font-bold text-xs shrink-0">
                            {{ substr($comment->nama, 0, 1) }}
                        </div>
                        <div class="w-full">
                            <div class="flex justify-between items-baseline mb-1">
                                <strong class="text-[#D4AF37] text-sm">{{ $comment->nama }}</strong>
                                <span class="text-[10px] text-gray-600">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-gray-300 italic">"{{ $comment->ucapan }}"</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    <div id="navbar" class="nav-leaf-container">
        <button onclick="scrollToSection('home')" class="nav-leaf active" data-section="home">
            <i class="ph-fill ph-house"></i>
        </button>
        <button onclick="scrollToSection('couple')" class="nav-leaf" data-section="couple">
            <i class="ph-fill ph-heart"></i>
        </button>
        <button onclick="scrollToSection('story')" class="nav-leaf" data-section="story">
            <i class="ph-fill ph-book-open-text"></i>
        </button>
        <button onclick="scrollToSection('event')" class="nav-leaf" data-section="event">
            <i class="ph-fill ph-calendar-star"></i>
        </button>
        <button onclick="scrollToSection('gallery')" class="nav-leaf" data-section="gallery">
            <i class="ph-fill ph-image"></i>
        </button>
        <button onclick="scrollToSection('gift')" class="nav-leaf" data-section="gift">
            <i class="ph-fill ph-gift"></i>
        </button>
        <button onclick="scrollToSection('wishes')" class="nav-leaf" data-section="wishes">
            <i class="ph-fill ph-chat-circle-text"></i>
        </button>
    </div>

    <script>
        function openInvitation() {
            document.getElementById('gate').classList.add('open');
            setTimeout(() => { document.getElementById('navbar').classList.add('visible'); }, 600);
            
            const audio = document.getElementById('bg-music');
            if(audio) audio.play();
            
            // Start Scroll Spy
            initScrollSpy();
            triggerRevealAnimations();
        }

        function toggleMusic() {
            const audio = document.getElementById('bg-music');
            const icon = document.querySelector('#musicBtn i');
            if (audio.paused) {
                audio.play();
                icon.classList.remove('ph-play'); 
                icon.classList.add('ph-music-note');
            } else {
                audio.pause();
                icon.classList.remove('ph-music-note'); 
                icon.classList.add('ph-play');
            }
        }

        function scrollToSection(id) {
            document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
        }

        // SCROLL SPY LOGIC (Otomatis ganti navbar saat scroll)
        function initScrollSpy() {
            const sections = document.querySelectorAll('section');
            const navButtons = document.querySelectorAll('.nav-leaf');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        navButtons.forEach(btn => btn.classList.remove('active'));
                        const activeId = entry.target.id;
                        const activeButton = document.querySelector(`.nav-leaf[data-section="${activeId}"]`);
                        if (activeButton) activeButton.classList.add('active');
                    }
                });
            }, { root: null, threshold: 0.3 }); // 30% section terlihat = aktif

            sections.forEach(section => observer.observe(section));
        }

        function triggerRevealAnimations() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show-up');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.reveal-on-scroll').forEach(el => {
                el.classList.add('animate-up');
                observer.observe(el);
            });
        }

        function copyText(id) {
            navigator.clipboard.writeText(document.getElementById(id).innerText).then(() => alert('Nomor tersalin!'));
        }

        const targetDate = new Date("{{ $invitation->akad_datetime }}").getTime();
        setInterval(() => {
            const now = new Date().getTime();
            const diff = targetDate - now;
            if(diff > 0) {
                const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                document.getElementById('countdown').innerHTML = `<span>${d} Hari</span> <span class="mx-2">•</span> <span>${h} Jam</span> <span class="mx-2">•</span> <span>${m} Menit</span>`;
            }
        }, 1000);
    </script>
</body>
</html>