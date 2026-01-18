<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invitation;
use Carbon\Carbon;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Royal Glass
        Invitation::create([
            // 1. CONFIG
            'slug' => 'romeo-juliet', // Ini nanti jadi link: domain.com/romeo-juliet
            'theme' => 'royal-glass',
            'is_active' => true,

            // 2. MEMPELAI PRIA
            'groom_name' => 'Romeo Pratama, S.Kom',
            'groom_nickname' => 'Romeo',
            'groom_father' => 'Bpk. Adam',
            'groom_mother' => 'Ibu Hawa',
            'groom_instagram' => 'romeo_pratama',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1000',

            // 3. MEMPELAI WANITA
            'bride_name' => 'Juliet Kusuma, S.Ak',
            'bride_nickname' => 'Juliet',
            'bride_father' => 'Bpk. Capulet',
            'bride_mother' => 'Ibu Lady',
            'bride_instagram' => 'juliet_kusuma',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=1000',

            // 4. ACARA 1 (AKAD)
            'akad_title' => 'Akad Nikah',
            'akad_datetime' => Carbon::parse('2026-02-20 08:00:00'), // Format: YYYY-MM-DD HH:MM:SS
            'akad_location' => 'Masjid Al-Ikhlas',
            'akad_address' => 'Jl. Merpati No. 10, Jakarta Selatan',
            'akad_map_link' => 'https://goo.gl/maps/contoh1',

            // 5. ACARA 2 (RESEPSI)
            'resepsi_title' => 'Resepsi Pernikahan',
            'resepsi_datetime' => Carbon::parse('2026-02-20 11:00:00'),
            'resepsi_location' => 'Grand Ballroom Hotel',
            'resepsi_address' => 'Jl. Sudirman Kav. 50, Jakarta Pusat',
            'resepsi_map_link' => 'https://goo.gl/maps/contoh2',

            // 6. GIFT (Rekening Bank - Cuma 1 Sesuai Request)
            'bank_name' => 'BCA',
            'bank_number' => '123 456 7890',
            'bank_holder' => 'Romeo Pratama',
            
            // Alamat Kado Fisik
            'gift_address' => 'Jl. Kebahagiaan No. 10, Jakarta Selatan',
            'gift_map_link' => 'https://goo.gl/maps/contoh3',

            // 7. CONTENT & ASSETS
            'music_file' => 'music/wedding-song.mp3', // Pastikan file ini ada di public/music
            'cover_image' => 'https://images.unsplash.com/photo-1621621667797-e06afc217fb0?q=80&w=1000',
            'hero_image' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=1000',  // Foto Bingkai
            'quote' => 'Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri...',
            
            // DATA JSON: LOVE STORY
            'love_stories' => [
                [
                    'year' => '2018',
                    'title' => 'First Meet',
                    'story' => 'Kami bertemu di perpustakaan kota saat hujan deras.'
                ],
                [
                    'year' => '2023',
                    'title' => 'She Said Yes',
                    'story' => 'Lamaran romantis di bawah kaki gunung Bromo.'
                ],
                [
                    'year' => '2026',
                    'title' => 'The Big Day',
                    'story' => 'Insya Allah kami akan mengikat janji suci.'
                ]
            ],
            
            // DATA JSON: GALLERY PHOTOS
            'gallery_photos' => [
                'https://images.unsplash.com/photo-1511285560982-1351cdeb9821?q=80&w=600',
                'https://images.unsplash.com/photo-1621621667797-e06afc217fb0?q=80&w=600',
                'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=600',
                'https://images.unsplash.com/photo-1606800052052-a08af7148866?q=80&w=600',
                'https://images.unsplash.com/photo-1519225421980-715cb0202128?q=80&w=600',
                'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?q=80&w=600',
            ]
        ]);

        //Rustic Green
        Invitation::create([
            // 1. CONFIG
            'slug' => 'dilan-milea', // Ini nanti jadi link: domain.com/romeo-juliet
            'theme' => 'rustic-green',
            'is_active' => true,

            // 2. MEMPELAI PRIA
            'groom_name' => 'Dilan Gunawan',
            'groom_nickname' => 'Dilan',
            'groom_father' => 'Bpk. Adam',
            'groom_mother' => 'Ibu Hawa',
            'groom_instagram' => 'dilan_gunawan',
            'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1000',

            // 3. MEMPELAI WANITA
            'bride_name' => 'Milea Sulastri',
            'bride_nickname' => 'Milea',
            'bride_father' => 'Bpk. Capulet',
            'bride_mother' => 'Ibu Lady',
            'bride_instagram' => 'milea_sulastri',
            'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=1000',

            // 4. ACARA 1 (AKAD)
            'akad_title' => 'Akad Nikah',
            'akad_datetime' => Carbon::parse('2026-02-20 08:00:00'), // Format: YYYY-MM-DD HH:MM:SS
            'akad_location' => 'Masjid Al-Ikhlas',
            'akad_address' => 'Jl. Merpati No. 10, Jakarta Selatan',
            'akad_map_link' => 'https://goo.gl/maps/contoh1',

            // 5. ACARA 2 (RESEPSI)
            'resepsi_title' => 'Resepsi Pernikahan',
            'resepsi_datetime' => Carbon::parse('2026-02-20 11:00:00'),
            'resepsi_location' => 'Grand Ballroom Hotel',
            'resepsi_address' => 'Jl. Sudirman Kav. 50, Jakarta Pusat',
            'resepsi_map_link' => 'https://goo.gl/maps/contoh2',

            // 6. GIFT (Rekening Bank - Cuma 1 Sesuai Request)
            'bank_name' => 'BCA',
            'bank_number' => '123 456 7890',
            'bank_holder' => 'Dilan Gunawan',
            
            // Alamat Kado Fisik
            'gift_address' => 'Jl. Kebahagiaan No. 10, Jakarta Selatan',
            'gift_map_link' => 'https://goo.gl/maps/contoh3',

            // 7. CONTENT & ASSETS
            'music_file' => 'music/wedding-song.mp3', // Pastikan file ini ada di public/music
            'cover_image' => 'https://images.unsplash.com/photo-1621621667797-e06afc217fb0?q=80&w=1000',
            'hero_image' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=1000',  // Foto Bingkai
            'quote' => 'Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri...',
            
            // DATA JSON: LOVE STORY
            'love_stories' => [
                [
                    'year' => '2018',
                    'title' => 'First Meet',
                    'story' => 'Kami bertemu di perpustakaan kota saat hujan deras.'
                ],
                [
                    'year' => '2023',
                    'title' => 'She Said Yes',
                    'story' => 'Lamaran romantis di bawah kaki gunung Bromo.'
                ],
                [
                    'year' => '2026',
                    'title' => 'The Big Day',
                    'story' => 'Insya Allah kami akan mengikat janji suci.'
                ]
            ],
            
            // DATA JSON: GALLERY PHOTOS
            'gallery_photos' => [
                'https://images.unsplash.com/photo-1511285560982-1351cdeb9821?q=80&w=600',
                'https://images.unsplash.com/photo-1621621667797-e06afc217fb0?q=80&w=600',
                'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=600',
                'https://images.unsplash.com/photo-1606800052052-a08af7148866?q=80&w=600',
                'https://images.unsplash.com/photo-1519225421980-715cb0202128?q=80&w=600',
                'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?q=80&w=600',
            ]
        ]);
    }
}