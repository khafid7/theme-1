<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</title>
    @vite(['resources/css/boho.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

<div class="app-container">

    @if($invitation->music_file)
    <div class="music-btn" id="musicBtn" onclick="toggleMusic()">
        <i class="ph-fill ph-music-note text-xl" id="musicIcon"></i>
    </div>
    <audio id="bgMusic" loop>
        <source src="{{ asset($invitation->music_file) }}" type="audio/mpeg">
    </audio>
    @endif

    <div class="gate-overlay" id="gate" style="background-image: url('{{ $invitation->cover_image }}');">
        <div class="absolute inset-0 bg-[#3D322C]/40"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#3D322C] via-transparent to-transparent opacity-90"></div>
        
        <div class="relative z-10 text-center text-[#F9F5F0] px-8 pb-16 w-full">
            <div class="p-8 rounded-t-[100px] rounded-b-xl backdrop-blur-md bg-[#3D322C]/40 border border-[#F9F5F0]/20 shadow-2xl">
                <p class="text-[10px] tracking-[0.4em] uppercase opacity-70 mb-4 font-bold">The Wedding Of</p>
                
                <h1 class="font-serif text-5xl mb-2 leading-none italic">
                    {{ $invitation->groom_nickname }} <br> 
                    <span class="text-3xl font-sans not-italic text-[#DBCDBA]">&</span> <br> 
                    {{ $invitation->bride_nickname }}
                </h1>

                <div class="w-12 h-px bg-[#DBCDBA]/60 mx-auto my-6"></div>
                
                <p class="text-[10px] uppercase tracking-widest mb-2 opacity-60">Kepada Yth:</p>
                <h3 class="font-serif text-xl font-bold capitalize mb-8">{{ request('to', 'Tamu Undangan') }}</h3>

                <button onclick="openInvitation()" class="bg-[#F9F5F0] text-[#3D322C] px-8 py-4 rounded-full text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-[#DBCDBA] transition shadow-lg flex items-center gap-2 mx-auto">
                    Buka Undangan
                </button>
            </div>
        </div>
    </div>

    <section id="page-home" class="page-section active flex flex-col items-center pt-10 px-6 overflow-y-auto pb-40">
        <div class="animate-up w-full">
            <p class="text-xs text-terra font-bold uppercase tracking-[0.3em] mb-6 text-center">Save The Date</p>
            
            <div class="relative w-full h-[50vh] mb-8">
                <div class="absolute inset-0 border border-terra rounded-t-[150px] translate-x-2 translate-y-2 opacity-30"></div>
                <img src="{{ $invitation->hero_image }}" class="w-full h-full object-cover rounded-t-[150px] shadow-xl border-[6px] border-white relative z-10">
            </div>

            <div class="text-center">
                <h1 class="font-serif text-4xl text-coffee mb-2 italic">
                    {{ $invitation->groom_nickname }} <span class="text-terra not-italic">&</span> {{ $invitation->bride_nickname }}
                </h1>
                <p class="text-sm font-bold text-terra uppercase tracking-wide mb-6">
                    {{ \Carbon\Carbon::parse($invitation->akad_datetime)->translatedFormat('l, d F Y') }}
                </p>
                
                <div id="countdown" class="flex justify-center gap-4 mb-8 text-coffee font-serif italic text-xl"></div>
                
                <p class="text-xs text-coffee opacity-60 leading-relaxed max-w-xs mx-auto">"{{ $invitation->quote }}"</p>
            </div>
        </div>
    </section>

    <section id="page-couple" class="page-section scrollable pt-20 px-6 pb-40">
        <h2 class="font-serif text-4xl text-coffee text-center mb-10 italic animate-up">The Couple</h2>

        <div class="flex flex-col items-center mb-12 animate-up">
            <div class="couple-frame-wrapper">
                <div class="couple-deco"></div>
                <img src="{{ $invitation->groom_photo }}" class="couple-arch">
            </div>
            <h3 class="font-serif text-3xl text-terra font-bold mt-2">{{ $invitation->groom_name }}</h3>
            <p class="text-[10px] text-coffee uppercase tracking-[0.2em] opacity-50 mb-3 mt-1">The Groom</p>
            <p class="text-xs text-coffee text-center opacity-80 leading-relaxed">Putra Bpk {{ $invitation->groom_father }} <br>& Ibu {{ $invitation->groom_mother }}</p>
            @if($invitation->groom_instagram)
            <a href="https://instagram.com/{{ $invitation->groom_instagram }}" class="mt-3 text-terra border-b border-terra text-xs pb-0.5">@ {{ $invitation->groom_instagram }}</a>
            @endif
        </div>

        <div class="flex flex-col items-center animate-up">
            <div class="couple-frame-wrapper">
                <div class="couple-deco"></div>
                <img src="{{ $invitation->bride_photo }}" class="couple-arch">
            </div>
            <h3 class="font-serif text-3xl text-terra font-bold mt-2">{{ $invitation->bride_name }}</h3>
            <p class="text-[10px] text-coffee uppercase tracking-[0.2em] opacity-50 mb-3 mt-1">The Bride</p>
            <p class="text-xs text-coffee text-center opacity-80 leading-relaxed">Putri Bpk {{ $invitation->bride_father }} <br>& Ibu {{ $invitation->bride_mother }}</p>
            @if($invitation->bride_instagram)
            <a href="https://instagram.com/{{ $invitation->bride_instagram }}" class="mt-3 text-terra border-b border-terra text-xs pb-0.5">@ {{ $invitation->bride_instagram }}</a>
            @endif
        </div>
    </section>

    <section id="page-story" class="page-section scrollable pt-20 px-6 pb-40">
        <h2 class="font-serif text-4xl text-coffee text-center mb-10 italic animate-up">Our Journey</h2>
        
        @if(!empty($invitation->love_stories))
        <div class="ml-4 animate-up">
            @foreach($invitation->love_stories as $story)
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <span class="text-terra font-bold text-xs mb-1 block">{{ $story['year'] }}</span>
                <h4 class="font-serif text-xl text-coffee mb-3">{{ $story['title'] }}</h4>
                <div class="boho-card p-5 mb-0">
                    <p class="text-xs text-gray-600 leading-relaxed">{{ $story['story'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-sm text-gray-500">Love is a beautiful journey.</p>
        @endif
    </section>

    <section id="page-event" class="page-section scrollable pt-20 px-6 pb-40">
        <h2 class="font-serif text-4xl text-coffee text-center mb-10 italic animate-up">The Event</h2>

        <div class="boho-card text-center animate-up">
            <h3 class="font-serif text-3xl text-terra mb-2 italic">{{ $invitation->akad_title }}</h3>
            <p class="text-[10px] font-bold text-coffee uppercase tracking-[0.15em] mb-6 border-b border-[#DBCDBA] pb-4 inline-block">
                {{ \Carbon\Carbon::parse($invitation->akad_datetime)->translatedFormat('l, d F Y') }}
            </p>
            
            <div class="mb-4">
                <p class="text-sm font-bold text-coffee">{{ \Carbon\Carbon::parse($invitation->akad_datetime)->format('H:i') }} WIB - Selesai</p>
            </div>
            <p class="text-xs text-gray-600 mb-6 px-4">{{ $invitation->akad_location }}</p>
            <a href="{{ $invitation->akad_map_link }}" class="inline-block bg-[#F2EBE5] text-terra px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-[#DBCDBA] transition">Open Map</a>
        </div>

        <div class="boho-card text-center mt-6 animate-up">
            <h3 class="font-serif text-3xl text-terra mb-2 italic">{{ $invitation->resepsi_title }}</h3>
            <p class="text-[10px] font-bold text-coffee uppercase tracking-[0.15em] mb-6 border-b border-[#DBCDBA] pb-4 inline-block">
                {{ \Carbon\Carbon::parse($invitation->resepsi_datetime)->translatedFormat('l, d F Y') }}
            </p>
            
            <div class="mb-4">
                <p class="text-sm font-bold text-coffee">{{ \Carbon\Carbon::parse($invitation->resepsi_datetime)->format('H:i') }} WIB - Selesai</p>
            </div>
            <p class="text-xs text-gray-600 mb-6 px-4">{{ $invitation->resepsi_location }}</p>
            <a href="{{ $invitation->resepsi_map_link }}" class="inline-block bg-[#F2EBE5] text-terra px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-[#DBCDBA] transition">Open Map</a>
        </div>
    </section>

    <section id="page-gallery" class="page-section scrollable pt-20 px-6 pb-40">
        <h2 class="font-serif text-4xl text-coffee text-center mb-8 italic animate-up">Gallery</h2>
        <div class="grid grid-cols-2 gap-2 animate-up">
            @foreach($invitation->gallery_photos as $photo)
                <img src="{{ $photo }}" class="w-full aspect-[3/4] object-cover rounded-md grayscale-[20%] hover:grayscale-0 transition duration-500">
            @endforeach
        </div>
    </section>

    <section id="page-wishes" class="page-section scrollable pt-20 px-6 pb-40">
        
        <div class="animate-up">
            <h2 class="font-serif text-4xl text-coffee text-center mb-8 italic">Wedding Gift</h2>
            
            <div class="gift-card-boho">
                <p class="text-[10px] uppercase tracking-[0.2em] opacity-60 mb-3">Digital Envelope</p>
                <div class="w-8 h-px bg-terra mx-auto mb-4"></div>
                <p class="font-bold text-lg mb-1">{{ $invitation->bank_name }}</p>
                <h2 class="text-3xl mb-4 text-terra">{{ $invitation->bank_number }}</h2>
                <p class="text-sm mb-8 opacity-80">a.n {{ $invitation->bank_holder }}</p>
                
                <button onclick="copyText('rekNum')" class="bg-white border border-terra text-terra px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-terra hover:text-white transition">
                    Salin Nomor
                </button>
                <div id="rekNum" style="display:none">{{ $invitation->bank_number }}</div>
            </div>

            @if($invitation->gift_address)
            <div class="text-center mt-6 p-4 rounded border border-dashed border-[#DBCDBA] bg-[#fffbf5]">
                <p class="text-[10px] font-bold text-terra uppercase tracking-widest mb-2">Kirim Kado Fisik</p>
                <p class="text-xs text-gray-500 italic">{{ $invitation->gift_address }}</p>
            </div>
            @endif
        </div>

        <hr class="border-t border-[#DBCDBA] my-10 mx-auto w-1/2">

        <div class="animate-up">
            <h2 class="font-serif text-3xl text-coffee text-center mb-8 italic">Wishes</h2>

            <div class="boho-card">
                @if(session('success'))
                    <div class="bg-[#F2EBE5] text-terra px-4 py-3 rounded text-xs text-center mb-6 font-bold tracking-wide">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('kirim.ucapan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="invitation_slug" value="{{ $invitation->slug }}">
                    
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="form-input" required>
                    <select name="kehadiran" class="form-input cursor-pointer bg-transparent">
                        <option value="Hadir">Saya Akan Hadir</option>
                        <option value="Tidak Hadir">Maaf, Tidak Bisa Hadir</option>
                        <option value="Ragu-ragu">Masih Ragu</option>
                    </select>
                    <textarea name="ucapan" rows="3" placeholder="Tuliskan doa restu..." class="form-input resize-none" required></textarea>
                    
                    <button type="submit" class="btn-terra mt-2">Kirim Ucapan</button>
                </form>
            </div>

            <div class="space-y-4 pb-4">
                @foreach($invitation->comments->sortByDesc('created_at') as $comment)
                <div class="bg-white border-b border-[#E0D8CC] p-4 flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#E0D8CC] text-coffee flex items-center justify-center font-bold text-xs shrink-0">
                        {{ substr($comment->nama, 0, 1) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <strong class="text-terra text-sm">{{ $comment->nama }}</strong>
                            <span class="text-[9px] text-gray-400 uppercase tracking-wide">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-coffee italic opacity-80">"{{ $comment->ucapan }}"</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="bottom-nav" id="bottomNav">
        <div class="nav-item active" onclick="switchPage('home', this)"><i class="ph-bold ph-house"></i></div>
        <div class="nav-item" onclick="switchPage('couple', this)"><i class="ph-bold ph-heart"></i></div>
        <div class="nav-item" onclick="switchPage('story', this)"><i class="ph-bold ph-book-open-text"></i></div>
        <div class="nav-item" onclick="switchPage('event', this)"><i class="ph-bold ph-calendar-check"></i></div>
        <div class="nav-item" onclick="switchPage('gallery', this)"><i class="ph-bold ph-image"></i></div>
        <div class="nav-item" onclick="switchPage('wishes', this)"><i class="ph-bold ph-chat-circle-text"></i></div>
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
        if(audio) audio.play();
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
        if(target.classList.contains('scrollable') || pageId === 'home') target.scrollTop = 0;

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
            const d = Math.floor(diff / (1000 * 60 * 60 * 24));
            const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            
            document.getElementById('countdown').innerHTML = `
                <span>${d} Hari</span> <span class="text-xs text-terra">•</span> 
                <span>${h} Jam</span> <span class="text-xs text-terra">•</span> 
                <span>${m} Menit</span>
            `;
        }
    }, 1000);
</script>
</body>
</html>