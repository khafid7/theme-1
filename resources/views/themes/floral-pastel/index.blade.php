<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Pinyon+Script&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    @vite(['resources/css/floral-pastel.css'])
</head>
<body style="overflow: hidden;"> 

    <div class="mobile-container">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div id="petals-container"></div>

        @if($invitation->music_file)
        <div class="music-box" onclick="toggleMusic()" id="musicBtn" style="display:none;">
            <i class="ph-fill ph-music-note"></i>
        </div>
        <audio id="bgMusic" loop>
            <source src="{{ asset($invitation->music_file) }}" type="audio/mpeg">
        </audio>
        @endif

        <section class="hero" id="heroCover" style="background-image: url('{{ $invitation->cover_image }}');">
            <div class="hero-box">
                <p style="text-transform: uppercase; letter-spacing: 2px; font-size: 0.8rem;">The Wedding Of</p>
                <h1 class="hero-names">
                    {{ $invitation->groom_nickname }} <br> & <br> {{ $invitation->bride_nickname }}
                </h1>
                <p style="margin-bottom: 20px;">
                    {{ \Carbon\Carbon::parse($invitation->akad_datetime)->translatedFormat('l, d F Y') }}
                </p>
                <div style="background: rgba(255,255,255,0.6); padding: 8px 20px; border-radius: 50px; display:inline-block;">
                    <small>Kepada Yth.</small>
                    <div style="font-weight: bold; font-size: 1.1rem; color: var(--secondary);">Tamu Undangan</div>
                </div>
                <br>
                <button class="btn-open" onclick="openInvitation()">Buka Undangan</button>
            </div>
        </section>

        <div id="mainContent">

            <div class="hero-inside">
                <img src="{{ $invitation->hero_image }}" alt="Romantic Couple">
                <div class="hero-inside-overlay">
                    <h2 style="font-size: 3rem; margin:0; line-height: 1;">We Are Getting Married!</h2>
                    <p style="margin-top: 10px;">Mohon doa restu dari Bapak/Ibu/Saudara/i</p>
                </div>
            </div>
            
            <section class="section" style="padding-top: 0;">
                <div class="glass-card">
                    <i class="ph-duotone ph-flower-lotus" style="font-size: 2.5rem; color: var(--primary);"></i>
                    <p style="margin-top: 15px; font-style: italic;">"{{ $invitation->quote }}"</p>
                </div>
            </section>

            <section class="section" style="padding-top: 0;">
                <h2 class="section-title">Mempelai</h2>
                <div class="glass-card">
                    <div style="margin-bottom: 30px;">
                        <img src="{{ $invitation->groom_photo }}" class="couple-img">
                        <h3 style="font-size: 2rem; color: var(--primary);">{{ $invitation->groom_name }}</h3>
                        <p style="font-size: 0.9rem;">Putra Bpk {{ $invitation->groom_father }} & Ibu {{ $invitation->groom_mother }}</p>
                        <a href="https://instagram.com/{{ $invitation->groom_instagram }}" target="_blank" style="color: var(--secondary); text-decoration: none; display: block; margin-top: 5px;">
                            <i class="ph-logo ph-instagram-logo"></i> @ {{ $invitation->groom_instagram }}
                        </a>
                    </div>
                    
                    <div style="font-family: var(--font-heading); font-size: 2.5rem; color: #ccc;">&</div>
                    
                    <div style="margin-top: 30px;">
                        <img src="{{ $invitation->bride_photo }}" class="couple-img">
                        <h3 style="font-size: 2rem; color: var(--primary);">{{ $invitation->bride_name }}</h3>
                        <p style="font-size: 0.9rem;">Putri Bpk {{ $invitation->bride_father }} & Ibu {{ $invitation->bride_mother }}</p>
                        <a href="https://instagram.com/{{ $invitation->bride_instagram }}" target="_blank" style="color: var(--secondary); text-decoration: none; display: block; margin-top: 5px;">
                            <i class="ph-logo ph-instagram-logo"></i> @ {{ $invitation->bride_instagram }}
                        </a>
                    </div>
                </div>
            </section>

            @if(!empty($invitation->love_stories))
            <section class="section" style="padding-top: 0;" id="story">
                <h2 class="section-title">Love Story</h2>
                <div class="glass-card" style="text-align: left;">
                    <div class="timeline">
                        @foreach($invitation->love_stories as $story)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <span class="story-year">{{ $story['year'] }}</span>
                            <h4 class="story-title">{{ $story['title'] }}</h4>
                            <p>{{ $story['story'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            <section class="section" style="padding-top: 0;">
                <h2 class="section-title">Save The Date</h2>
                <div class="glass-card">
                    
                    <div class="countdown-box" id="countdown">
                        <div class="timer-item"><span id="days">00</span><small>HARI</small></div>
                        <div class="timer-item"><span id="hours">00</span><small>JAM</small></div>
                        <div class="timer-item"><span id="minutes">00</span><small>MENIT</small></div>
                        <div class="timer-item"><span id="seconds">00</span><small>DETIK</small></div>
                    </div>

                    <div class="event-item">
                        <h3>{{ $invitation->akad_title }}</h3>
                        <p style="font-weight: 500; margin: 5px 0; color: #333;">
                            {{ \Carbon\Carbon::parse($invitation->akad_datetime)->translatedFormat('l, d F Y') }}
                        </p>
                        <p>{{ \Carbon\Carbon::parse($invitation->akad_datetime)->format('H:i') }} WIB - Selesai</p>
                        <p style="margin-top: 5px; font-size: 0.9rem;"><strong>{{ $invitation->akad_location }}</strong></p>
                        <a href="{{ $invitation->akad_map_link }}" target="_blank" class="btn-map">Google Maps</a>
                    </div>

                    <div class="event-item">
                        <h3>{{ $invitation->resepsi_title }}</h3>
                        <p style="font-weight: 500; margin: 5px 0; color: #333;">
                            {{ \Carbon\Carbon::parse($invitation->resepsi_datetime)->translatedFormat('l, d F Y') }}
                        </p>
                        <p>{{ \Carbon\Carbon::parse($invitation->resepsi_datetime)->format('H:i') }} WIB - Selesai</p>
                        <p style="margin-top: 5px; font-size: 0.9rem;"><strong>{{ $invitation->resepsi_location }}</strong></p>
                        <a href="{{ $invitation->resepsi_map_link }}" target="_blank" class="btn-map">Google Maps</a>
                    </div>
                </div>
            </section>

            @if(!empty($invitation->gallery_photos))
            <section class="section" style="padding-top: 0;">
                <h2 class="section-title">Our Moments</h2>
                <div class="glass-card">
                    <div class="gallery-grid">
                        @foreach($invitation->gallery_photos as $foto)
                            <img src="{{ $foto }}" class="gallery-item">
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            <section class="section" style="padding-top: 0;">
                <h2 class="section-title">Wedding Gift</h2>
                <div class="glass-card">
                    <p style="margin-bottom: 20px;">Doa restu Anda merupakan karunia yang sangat berarti bagi kami.</p>
                    <div class="bank-container">
                        <h3 style="margin: 0;">{{ $invitation->bank_name }}</h3>
                        <p style="font-size: 1.5rem; font-weight: bold; letter-spacing: 1px; margin: 10px 0;">
                            {{ $invitation->bank_number }}
                        </p>
                        <p>a.n {{ $invitation->bank_holder }}</p>
                        <button onclick="navigator.clipboard.writeText('{{ $invitation->bank_number }}'); alert('Disalin!')" style="margin-top: 15px; background: white; border: none; padding: 8px 20px; border-radius: 20px; cursor: pointer; color: var(--secondary); font-weight: bold;">
                            Salin Nomor
                        </button>
                    </div>
                    
                    <div style="margin-top: 25px;">
                        <h4 style="text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">Kirim Kado</h4>
                        <p style="margin: 5px 0; font-size: 0.9rem;">{{ $invitation->gift_address }}</p>
                    </div>
                </div>
            </section>

            <section class="section" style="padding-bottom: 50px; padding-top: 0;">
                <h2 class="section-title">Kirim Ucapan</h2>
                <div class="glass-card">
                    @if(session('success'))
                        <div style="background: rgba(255,255,255,0.8); color: var(--secondary); padding: 10px; border-radius: 10px; margin-bottom: 20px; text-align:center;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('kirim.ucapan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="invitation_slug" value="{{ $invitation->slug }}">
                        
                        <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                        <select name="kehadiran" class="form-control" required>
                            <option value="Hadir">Hadir</option>
                            <option value="Tidak Hadir">Tidak Hadir</option>
                            <option value="Ragu-ragu">Ragu-ragu</option>
                        </select>
                        <textarea name="ucapan" class="form-control" rows="3" placeholder="Tulis doa restu..." required></textarea>
                        <button type="submit" class="btn-submit">Kirim</button>
                    </form>

                    <div style="margin-top: 30px; text-align: left; max-height: 300px; overflow-y: auto;">
                        @if($invitation->comments->count() > 0)
                            @foreach($invitation->comments->sortByDesc('created_at') as $comment)
                            <div style="border-bottom: 1px solid rgba(0,0,0,0.05); padding: 15px 0;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <strong style="color: var(--secondary);">{{ $comment->nama }}</strong>
                                    <span class="{{ $comment->kehadiran == 'Hadir' ? 'badge-hadir' : 'badge-absen' }}">{{ $comment->kehadiran }}</span>
                                </div>
                                <p style="margin-top: 5px; font-size: 0.9rem;">{{ $comment->ucapan }}</p>
                                <small style="color: #aaa;">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            @endforeach
                        @else
                            <p style="text-align: center; color: #999;">Belum ada ucapan.</p>
                        @endif
                    </div>
                </div>
            </section>

            <footer style="padding: 20px; text-align: center; font-size: 0.8rem;">
                <h2 style="font-family: var(--font-heading); margin-bottom: 10px;">{{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</h2>
            </footer>
        </div>
    </div>

    <script>
        function createPetals() {
            const container = document.getElementById('petals-container');
            for (let i = 0; i < 15; i++) {
                const petal = document.createElement('div');
                petal.classList.add('petal');
                const size = Math.random() * 15 + 10;
                petal.style.width = `${size}px`; petal.style.height = `${size}px`;
                petal.style.left = `${Math.random() * 100}%`;
                petal.style.animationDuration = `${Math.random() * 5 + 5}s`;
                petal.style.animationDelay = `${Math.random() * 5}s`;
                container.appendChild(petal);
            }
        }
        createPetals();

        function openInvitation() {
            document.getElementById('heroCover').classList.add('open');
            document.body.style.overflow = 'auto'; 
            const audio = document.getElementById('bgMusic');
            if(audio) {
                document.getElementById('musicBtn').style.display = 'flex';
                audio.play();
                document.getElementById('musicBtn').classList.add('spin');
            }
        }

        function toggleMusic() {
            const audio = document.getElementById('bgMusic');
            const btn = document.getElementById('musicBtn');
            if(audio.paused) { audio.play(); btn.classList.add('spin'); } 
            else { audio.pause(); btn.classList.remove('spin'); }
        }

        const targetDate = new Date("{{ $invitation->akad_datetime }}").getTime();
        setInterval(function() {
            const now = new Date().getTime();
            const distance = targetDate - now;
            if (distance < 0) return;
            document.getElementById("days").innerText = Math.floor(distance / (1000 * 60 * 60 * 24));
            document.getElementById("hours").innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            document.getElementById("minutes").innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            document.getElementById("seconds").innerText = Math.floor((distance % (1000 * 60)) / 1000);
        }, 1000);
    </script>
</body>
</html>