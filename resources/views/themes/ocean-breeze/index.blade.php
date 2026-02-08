<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</title>
    @vite(['resources/css/ocean.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

<div class="app-container">

    @if($invitation->music_file)
    <div class="music-btn" id="musicBtn" onclick="toggleMusic()">
        <i class="ph-fill ph-music-note text-lg" id="musicIcon"></i>
    </div>
    <audio id="bgMusic" loop>
        <source src="{{ asset($invitation->music_file) }}" type="audio/mpeg">
    </audio>
    @endif

    <div class="gate-overlay" id="gate" style="background-image: url('{{ $invitation->cover_image }}');">
        <div class="absolute inset-0 bg-[#1F4E79]/60 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#1F4E79] via-transparent to-transparent"></div>
        
        <div class="relative z-10 text-center text-white px-6">
            <p class="text-xs tracking-[0.3em] uppercase opacity-90 mb-4">The Wedding Of</p>
            <h1 class="font-serif text-5xl md:text-6xl mb-2 drop-shadow-lg leading-tight">
                {{ $invitation->groom_nickname }} <br> 
                <span class="text-3xl text-gold font-serif italic">&</span> <br> 
                {{ $invitation->bride_nickname }}
            </h1>
            <p class="mt-4 mb-8 text-sm opacity-90">{{ \Carbon\Carbon::parse($invitation->akad_datetime)->translatedFormat('l, d F Y') }}</p>
            
            <div class="bg-white/10 backdrop-blur-md border border-white/20 px-6 py-3 rounded-xl inline-block mb-8">
                <p class="text-[10px] uppercase tracking-widest opacity-70 mb-1">Kepada Yth:</p>
                <h3 class="font-serif text-lg capitalize font-bold">{{ request('to', 'Tamu Undangan') }}</h3>
            </div>
            <br>
            <button onclick="openInvitation()" class="bg-white text-[#1F4E79] px-8 py-3 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-[#A9D6E5] transition transform hover:scale-105 shadow-xl flex items-center gap-2 mx-auto">
                <i class="ph-bold ph-envelope-open"></i> Buka Undangan
            </button>
        </div>
    </div>

    <section id="page-home" class="page-section active flex flex-col items-center pt-0">
        <div class="relative w-full h-[55vh]">
            <img src="{{ $invitation->hero_image }}" class="w-full h-full object-cover rounded-b-[40px] shadow-lg">
            <div class="absolute inset-0 bg-gradient-to-t from-[#F0F8FF] to-transparent rounded-b-[40px]"></div>
        </div>
        <div class="px-6 -mt-8 w-full relative z-10">
            <div class="ocean-card text-center">
                <p class="text-xs text-gold uppercase tracking-widest mb-2">Save The Date</p>
                <h1 class="font-serif text-3xl text-deep-blue mb-4">
                    {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}
                </h1>
                
                <div id="countdown" class="flex justify-center gap-2 mb-4"></div>
                
                <p class="text-xs text-gray-500 italic">"{{ $invitation->quote }}"</p>
            </div>
        </div>
    </section>

    <section id="page-couple" class="page-section scrollable pt-20 px-6">
        <h2 class="font-serif text-3xl text-deep-blue text-center mb-10">Mempelai</h2>

        <div class="couple-wrapper">
            <div class="couple-bg-blob"></div>
            <div class="couple-photo-box">
                <img src="{{ $invitation->groom_photo }}" alt="Groom">
            </div>
            <div class="relative z-10">
                <h3 class="font-serif text-2xl text-deep-blue font-bold">{{ $invitation->groom_name }}</h3>
                <p class="text-xs text-gold font-bold uppercase tracking-widest mb-2">The Groom</p>
                <p class="text-xs text-gray-500">Putra Bpk {{ $invitation->groom_father }} <br>& Ibu {{ $invitation->groom_mother }}</p>
                @if($invitation->groom_instagram)
                <a href="https://instagram.com/{{ $invitation->groom_instagram }}" class="inline-block mt-2 text-deep-blue"><i class="ph-fill ph-instagram-logo text-xl"></i></a>
                @endif
            </div>
        </div>

        <div class="text-center my-8 text-3xl text-gold font-serif">&</div>

        <div class="couple-wrapper">
            <div class="couple-bg-blob"></div>
            <div class="couple-photo-box">
                <img src="{{ $invitation->bride_photo }}" alt="Bride">
            </div>
            <div class="relative z-10">
                <h3 class="font-serif text-2xl text-deep-blue font-bold">{{ $invitation->bride_name }}</h3>
                <p class="text-xs text-gold font-bold uppercase tracking-widest mb-2">The Bride</p>
                <p class="text-xs text-gray-500">Putri Bpk {{ $invitation->bride_father }} <br>& Ibu {{ $invitation->bride_mother }}</p>
                @if($invitation->bride_instagram)
                <a href="https://instagram.com/{{ $invitation->bride_instagram }}" class="inline-block mt-2 text-deep-blue"><i class="ph-fill ph-instagram-logo text-xl"></i></a>
                @endif
            </div>
        </div>
    </section>

    <section id="page-story" class="page-section scrollable pt-20 px-6">
        <h2 class="font-serif text-3xl text-deep-blue text-center mb-8">Kisah Kami</h2>
        
        @if(!empty($invitation->love_stories))
        <div class="timeline">
            @foreach($invitation->love_stories as $story)
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="ocean-card p-4 mb-0">
                    <span class="text-gold font-bold text-xs bg-gold/10 px-2 py-1 rounded">{{ $story['year'] }}</span>
                    <h4 class="font-serif text-lg text-deep-blue mt-2 mb-1">{{ $story['title'] }}</h4>
                    <p class="text-xs text-gray-600 leading-relaxed">{{ $story['story'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-gray-500 text-sm">Every love story is beautiful.</p>
        @endif
    </section>

    <section id="page-event" class="page-section scrollable pt-20 px-6">
        <h2 class="font-serif text-3xl text-deep-blue text-center mb-8">Acara</h2>

        <div class="ocean-card border-l-4 border-l-[#1F4E79]">
            <div class="flex justify-between">
                <h3 class="font-serif text-xl text-deep-blue font-bold">{{ $invitation->akad_title }}</h3>
                <i class="ph-duotone ph-hands-praying text-2xl text-deep-blue opacity-50"></i>
            </div>
            <hr class="my-3 border-gray-100">
            <p class="text-sm font-bold mb-1">{{ \Carbon\Carbon::parse($invitation->akad_datetime)->translatedFormat('l, d F Y') }}</p>
            <p class="text-xs text-gray-600 mb-3">Pukul {{ \Carbon\Carbon::parse($invitation->akad_datetime)->format('H:i') }} WIB</p>
            <p class="text-xs text-gray-500 bg-gray-50 p-2 rounded">{{ $invitation->akad_location }}</p>
            <a href="{{ $invitation->akad_map_link }}" class="inline-block mt-3 text-xs font-bold text-deep-blue underline">Google Maps</a>
        </div>

        <div class="ocean-card border-l-4 border-l-[#D4C5A0]">
            <div class="flex justify-between">
                <h3 class="font-serif text-xl text-deep-blue font-bold">{{ $invitation->resepsi_title }}</h3>
                <i class="ph-duotone ph-wine text-2xl text-gold opacity-80"></i>
            </div>
            <hr class="my-3 border-gray-100">
            <p class="text-sm font-bold mb-1">{{ \Carbon\Carbon::parse($invitation->resepsi_datetime)->translatedFormat('l, d F Y') }}</p>
            <p class="text-xs text-gray-600 mb-3">Pukul {{ \Carbon\Carbon::parse($invitation->resepsi_datetime)->format('H:i') }} WIB</p>
            <p class="text-xs text-gray-500 bg-gray-50 p-2 rounded">{{ $invitation->resepsi_location }}</p>
            <a href="{{ $invitation->resepsi_map_link }}" class="inline-block mt-3 text-xs font-bold text-gold underline">Google Maps</a>
        </div>
    </section>

    <section id="page-gallery" class="page-section scrollable pt-20 px-4">
        <h2 class="font-serif text-3xl text-deep-blue text-center mb-6">Galeri</h2>
        <div class="gallery-grid mb-12">
            @foreach($invitation->gallery_photos as $photo)
                <img src="{{ $photo }}" class="gallery-img">
            @endforeach
        </div>
    </section>

    <section id="page-wishes" class="page-section scrollable pt-20 px-6">
        
        <h2 class="font-serif text-3xl text-deep-blue text-center mb-6">Wedding Gift</h2>
        
        <div class="gift-card-cc">
            <div class="flex justify-between items-center mb-6">
                <span class="text-xs uppercase tracking-widest opacity-80">Bank Transfer</span>
                <i class="ph-fill ph-bank text-xl"></i>
            </div>
            <p class="text-sm uppercase opacity-90 mb-1">{{ $invitation->bank_name }}</p>
            <h2 class="font-mono text-2xl tracking-widest mb-6" id="rekNum">{{ $invitation->bank_number }}</h2>
            <div class="flex justify-between items-end">
                <div>
                    <p class="text-[9px] uppercase opacity-70">Atas Nama</p>
                    <p class="font-bold text-sm tracking-wide">{{ $invitation->bank_holder }}</p>
                </div>
                <button onclick="copyText('rekNum')" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded text-[10px] backdrop-blur-sm transition">
                    <i class="ph-bold ph-copy inline mr-1"></i> Salin
                </button>
            </div>
        </div>

        @if($invitation->gift_address)
        <div class="ocean-card text-center border-dashed border-2 mb-10">
            <p class="text-xs font-bold text-deep-blue">Kirim Kado Fisik</p>
            <p class="text-xs text-gray-500 mt-1">{{ $invitation->gift_address }}</p>
        </div>
        @endif

        <hr class="border-t border-gray-300 my-8 w-1/2 mx-auto">

        <h2 class="font-serif text-3xl text-deep-blue text-center mb-8">Ucapan & Doa</h2>

        <div class="ocean-card">
            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded text-xs text-center mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('kirim.ucapan') }}" method="POST">
                @csrf
                <input type="hidden" name="invitation_slug" value="{{ $invitation->slug }}">
                <input type="text" name="nama" placeholder="Nama Lengkap" class="form-input" required>
                <select name="kehadiran" class="form-input cursor-pointer text-gray-600">
                    <option value="Hadir">Saya Akan Hadir</option>
                    <option value="Tidak Hadir">Maaf, Tidak Bisa Hadir</option>
                    <option value="Ragu-ragu">Masih Ragu</option>
                </select>
                <textarea name="ucapan" rows="3" placeholder="Tuliskan doa restu..." class="form-input resize-none" required></textarea>
                <button type="submit" class="btn-primary">KIRIM UCAPAN</button>
            </form>
        </div>

        <div class="space-y-4 pb-4">
            @foreach($invitation->comments->sortByDesc('created_at') as $comment)
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex gap-3">
                <div class="w-8 h-8 rounded-full bg-gray-100 text-deep-blue flex items-center justify-center font-bold text-xs shrink-0">
                    {{ substr($comment->nama, 0, 1) }}
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <strong class="text-deep-blue text-sm">{{ $comment->nama }}</strong>
                        <span class="text-[9px] text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-xs text-gray-600 italic">"{{ $comment->ucapan }}"</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <div class="bottom-nav" id="bottomNav">
        <div class="nav-item active" onclick="switchPage('home', this)"><i class="ph-fill ph-house"></i></div>
        <div class="nav-item" onclick="switchPage('couple', this)"><i class="ph-fill ph-heart"></i></div>
        <div class="nav-item" onclick="switchPage('story', this)"><i class="ph-fill ph-book-open-text"></i></div>
        <div class="nav-item" onclick="switchPage('event', this)"><i class="ph-fill ph-calendar-check"></i></div>
        <div class="nav-item" onclick="switchPage('gallery', this)"><i class="ph-fill ph-image"></i></div>
        <div class="nav-item" onclick="switchPage('wishes', this)"><i class="ph-fill ph-chat-circle-text"></i></div>
    </div>

</div>

<script>
    function openInvitation() {
        document.getElementById('gate').classList.add('open');
        setTimeout(() => {
            document.getElementById('bottomNav').classList.add('visible');
            document.getElementById('musicBtn').classList.add('visible');
        }, 800);
        const audio = document.getElementById('bgMusic');
        if(audio) {
            audio.play();
            document.getElementById('musicBtn').classList.add('spin');
        }
    }

    function toggleMusic() {
        const audio = document.getElementById('bgMusic');
        const btn = document.getElementById('musicBtn');
        const icon = document.getElementById('musicIcon');
        
        if (audio.paused) {
            audio.play();
            btn.classList.add('spin');
            icon.classList.replace('ph-pause', 'ph-music-note');
        } else {
            audio.pause();
            btn.classList.remove('spin');
            icon.classList.replace('ph-music-note', 'ph-pause');
        }
    }

    function switchPage(pageId, element) {
        document.querySelectorAll('.page-section').forEach(el => el.classList.remove('active'));
        const target = document.getElementById('page-' + pageId);
        target.classList.add('active');
        if(target.classList.contains('scrollable')) target.scrollTop = 0;

        document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
    }

    function copyText(id) {
        navigator.clipboard.writeText(document.getElementById(id).innerText).then(() => alert('Nomor Rekening Disalin!'));
    }

    const targetDate = new Date("{{ $invitation->akad_datetime }}").getTime();
    setInterval(() => {
        const now = new Date().getTime();
        const diff = targetDate - now;
        if(diff > 0) {
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const secs = Math.floor((diff % (1000 * 60)) / 1000);
            
            const boxClass = "bg-[#F0F8FF] p-2 rounded-lg text-center w-14 shadow-sm border border-[#A9D6E5]";
            const numClass = "block font-bold text-lg text-[#1F4E79]";
            const labelClass = "text-[9px] uppercase tracking-wide text-gray-500";
            
            document.getElementById('countdown').innerHTML = `
                <div class="${boxClass}"><span class="${numClass}">${days}</span><span class="${labelClass}">Hari</span></div>
                <div class="${boxClass}"><span class="${numClass}">${hours}</span><span class="${labelClass}">Jam</span></div>
                <div class="${boxClass}"><span class="${numClass}">${mins}</span><span class="${labelClass}">Mnt</span></div>
                <div class="${boxClass}"><span class="${numClass}">${secs}</span><span class="${labelClass}">Dtk</span></div>
            `;
        }
    }, 1000);
</script>
</body>
</html>