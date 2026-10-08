<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Promo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Users
        User::updateOrCreate(
            ['email' => 'admin@chia.com'],
            [
                'name' => 'Admin Chia',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'natabintang24@gmail.com'],
            [
                'name' => 'Nathapradja Bintang Ramadhany',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // 2. Categories
        $catChia = Category::create([
            'name' => 'Chia Seeds',
            'slug' => 'chia-seeds',
            'description' => 'Biji chia organik kualitas premium kaya akan serat, omega-3, dan antioksidan alami.',
            'is_active' => true,
        ]);

        $catSuperSeeds = Category::create([
            'name' => 'Superfood Seeds & Mix',
            'slug' => 'superfood-seeds-mix',
            'description' => 'Kombinasi aneka biji-bijian superfood alami untuk melengkapi asupan nutrisi harian Anda.',
            'is_active' => true,
        ]);

        $catPowder = Category::create([
            'name' => 'Superfood Powder',
            'slug' => 'superfood-powder',
            'description' => 'Bubuk superfood murni dari tanaman pilihan untuk campuran smoothie, juice, dan yogurt bowl.',
            'is_active' => true,
        ]);

        $catSnacks = Category::create([
            'name' => 'Healthy Bites & Granola',
            'slug' => 'healthy-bites-granola',
            'description' => 'Camilan sehat berbahan dasar chia seed dan gandum utuh panggang tanpa tambahan pemanis buatan.',
            'is_active' => true,
        ]);

        // 3. Products
        $products = [
            [
                'category_id' => $catChia->id,
                'name' => 'Chia Seeds Premium Organic 250g',
                'slug' => 'chia-seeds-premium-organic-250g',
                'price' => 35000,
                'summary' => 'Biji chia organik grade A pilihan terbaik, siap tabur untuk infused water dan sarapan sehat.',
                'description' => 'Chia Seeds by Amidyas Superfood dipanen dari pertanian organik pilihan dengan proses pengolahan higienis bersertifikasi. Biji chia kami kaya akan asam lemak Omega-3, serat makanan larut air, kalsium, magnesium, dan protein nabati tinggi. Sangat ideal dikonsumsi harian untuk menjaga kesehatan jantung, melancarkan pencernaan, dan menjaga rasa kenyang lebih lama.',
                'details' => [
                    'Kemasan' => 'Pouch Zipper Food Grade 250 gram',
                    'Komposisi' => '100% Raw Organic Black & White Chia Seeds',
                    'Saran Penyajian' => 'Rendam 1-2 sendok makan dalam 250ml air, jus, atau susu selama 10-15 menit hingga mengembang. Cocok sebagai topping oatmeal, salad, dan puding.',
                    'Manfaat' => 'Tinggi Omega-3, melancarkan metabolisme, kaya serat alami, membantu program diet sehat.',
                    'Masa Simpan' => '12 Bulan pada suhu ruang kering dan sejuk.'
                ],
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $catChia->id,
                'name' => 'Chia Seeds Premium Organic Family Pack 500g',
                'slug' => 'chia-seeds-premium-organic-family-pack-500g',
                'price' => 65000,
                'summary' => 'Kemasan hemat 500g untuk porsi keluarga yang ingin konsisten menerapkan gaya hidup sehat harian.',
                'description' => 'Kemasan ekonomis Family Pack 500 gram dirancang untuk memenuhi kebutuhan nutrisi seluruh anggota keluarga. Chia Seeds Amidyas bebas pengawet, non-GMO, dan tanpa pestisida kimia sintetis.',
                'details' => [
                    'Kemasan' => 'Standing Pouch Alumunium Foil Zipper 500 gram',
                    'Komposisi' => '100% Organik Chia Seeds',
                    'Saran Penyajian' => 'Campurkan ke dalam adonan roti, pancake, smoothies, atau overnight oats.',
                    'Manfaat' => 'Menjaga energi stamina harian, mendukung daya ingat, menjaga kestabilan gula darah.',
                    'Masa Simpan' => '12 Bulan.'
                ],
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $catChia->id,
                'name' => 'Organic White Chia Seeds 200g',
                'slug' => 'organic-white-chia-seeds-200g',
                'price' => 42000,
                'summary' => 'Biji chia putih langka dengan rasa lebih lembut, cocok untuk bakery dan dessert premium.',
                'description' => 'Biji chia putih organik varietas istimewa dengan tekstur yang sangat halus dan rasa gurih alami. Cocok bagi Anda yang menginginkan tampilan sajian puding chia atau smoothie yang lebih bersih dan estetik tanpa mengurangi kandungan gizi superfood.',
                'details' => [
                    'Kemasan' => 'Jar Kedap Udara 200 gram',
                    'Komposisi' => '100% White Chia Seeds Organic',
                    'Saran Penyajian' => 'Gunakan 1 sendok makan untuk puding almond chia atau topping chia yogurt.',
                    'Manfaat' => 'Tinggi antioksidan, mineral zinc, dan protein nabati bebas gluten.',
                    'Masa Simpan' => '12 Bulan.'
                ],
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $catSuperSeeds->id,
                'name' => 'Super 4-Seeds Mix Power Booster 250g',
                'slug' => 'super-4-seeds-mix-power-booster-250g',
                'price' => 48000,
                'summary' => 'Campuran seimbang Chia Seeds, Flax Seeds, Pumpkin Seeds, dan Sunflower Seeds matang.',
                'description' => 'Kombinasi 4 biji superfood terbaik dunia dalam satu kemasan praktis! Dirancang khusus untuk memberikan spektrum nutrisi lengkap mulai dari asam lemak esensial, zinc untuk daya tahan tubuh, hingga serat pangan tinggi.',
                'details' => [
                    'Kemasan' => 'Pouch 250 gram',
                    'Komposisi' => 'Chia Seeds, Brown Flaxseeds, Roasted Pumpkin Seeds, Roasted Sunflower Seeds',
                    'Saran Penyajian' => 'Taburkan 2 sendok makan di atas salad segar, sup labu, atau buah potong.',
                    'Manfaat' => 'Meningkatkan imunitas, memelihara elastisitas kulit, dan meningkatkan fokus kerja.',
                    'Masa Simpan' => '10 Bulan.'
                ],
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $catSuperSeeds->id,
                'name' => 'Roasted Golden Flaxseed & Chia 200g',
                'slug' => 'roasted-golden-flaxseed-chia-200g',
                'price' => 38000,
                'summary' => 'Perpaduan biji rami emas dan chia seed yang dipanggang dengan suhu rendah tanpa minyak.',
                'description' => 'Diolah dengan metode slow-roasting sehingga menjaga enzim dan nutrisi esensial tetap utuh serta mengeluarkan aroma harum nutty yang lezat.',
                'details' => [
                    'Kemasan' => 'Pouch 200 gram',
                    'Komposisi' => 'Golden Flaxseeds Panggang, Chia Seeds',
                    'Saran Penyajian' => 'Dapat langsung dimakan atau diblender halus bersama smoothies.',
                    'Manfaat' => 'Membantu menstabilkan kolesterol dan tekanan darah.',
                    'Masa Simpan' => '8 Bulan.'
                ],
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => $catPowder->id,
                'name' => 'Pure Chia Seed Micro-Powder 150g',
                'slug' => 'pure-chia-seed-micro-powder-150g',
                'price' => 45000,
                'summary' => 'Bubuk chia seed giling halus dingin (cold-milled), larut sempurna dalam minuman.',
                'description' => 'Bagi Anda yang menyukai minuman tanpa sensasi butiran biji, Chia Micro-Powder adalah pilihan paling tepat. Diproses dengan teknik cold-milling bebas panas sehingga omega-3 tidak teroksidasi.',
                'details' => [
                    'Kemasan' => 'Alufoil Pouch 150 gram',
                    'Komposisi' => '100% Tepung Biji Chia Murni',
                    'Saran Penyajian' => 'Larutkan 1 sendok teh dalam jus, susu oat, kopi hangat, atau sup.',
                    'Manfaat' => 'Penyerapan nutrisi lebih cepat dan mudah dicerna.',
                    'Masa Simpan' => '12 Bulan.'
                ],
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => $catSnacks->id,
                'name' => 'Artisan Chia Granola Honey Berry 300g',
                'slug' => 'artisan-chia-granola-honey-berry-300g',
                'price' => 52000,
                'summary' => 'Oat giling panggang dengan madu hutan alami, dried cranberry, dan chia seeds renyah.',
                'description' => 'Granola homemade dari bahan-bahan segar pilihan tanpa pengawet dan perisa sintetik. Renyah, harum, dan memberikan energi instan tahan lama untuk sarapan maupun camilan santai.',
                'details' => [
                    'Kemasan' => 'Standing Pouch Zipper 300 gram',
                    'Komposisi' => 'Rolled Oats, Chia Seeds, Madu Hutan Murni, Dried Cranberries, Almond Slices, Minyak Kelapa.',
                    'Saran Penyajian' => 'Sajikan bersama susu dingin atau yoghurt bowl favorit Anda.',
                    'Manfaat' => 'Sumber karbohidrat kompleks, menjaga kadar energi sepanjang hari.',
                    'Masa Simpan' => '6 Bulan.'
                ],
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }

        // 4. Promos
        Promo::create([
            'title' => 'Diskon 15% untuk Pembelian Pertama!',
            'badge_text' => 'PROMO SPESIAL PENGGUNA BARU',
            'description' => 'Mulai perjalanan hidup sehatmu hari ini bersama Chia by Amidyas Superfood. Nikmati potongan harga khusus untuk pemesanan perdana semua varian chia seed.',
            'button_text' => 'Klaim Promo via WhatsApp',
            'button_link' => '#contact',
            'start_date' => now()->startOfMonth(),
            'end_date' => now()->addMonths(2)->endOfMonth(),
            'is_active' => true,
        ]);

        Promo::create([
            'title' => 'Paket Bundling Healthy Starter Pack',
            'badge_text' => 'PAKET HEMAT',
            'description' => 'Beli 1 Pouch Chia Seeds 250g + 1 Pouch Artisan Chia Granola dan dapatkan gratis sendok takar kayu eksklusif.',
            'button_text' => 'Lihat Detail Paket',
            'button_link' => '/produk',
            'start_date' => now()->startOfMonth(),
            'end_date' => now()->addMonths(1)->endOfMonth(),
            'is_active' => true,
        ]);

        // 5. Company Profile
        CompanyProfile::create([
            'company_name' => 'Chia by Amidyas Superfood',
            'tagline' => 'Kebaikan Alam untuk Hidup Lebih Sehat & Berenergi',
            'short_description' => 'Amidyas Superfood adalah produsen dan penyedia produk pangan sehat alami berkualitas tinggi yang berfokus pada biji chia organik dan ragam superfood bergizi tinggi untuk keluarga modern Indonesia.',
            'about_us' => "Berawal dari kepedulian kami terhadap pentingnya nutrisi murni bagi kesehatan jangka panjang di tengah tingginya konsumsi makanan olahan instan, Chia by Amidyas Superfood hadir sebagai solusi pangan bernutrisi padat (nutrient-dense food).\n\nKami bekerja sama langsung dengan para petani organik tepercaya yang menerapkan prinsip keberlanjutan. Setiap butir chia seed melalui tahap pembersihan ganda, seleksi kualitas ketat, dan pengemasan kedap udara berstandar food grade agar kemurnian serta kesegarannya tetap terjaga hingga ke tangan Anda.",
            'vision' => 'Menjadi pelopor gaya hidup sehat berbasis bahan alami terdepan di Indonesia yang dipercaya karena kualitas, kemurnian, dan dampak positifnya bagi kesehatan masyarakat.',
            'mission' => "1. Menyediakan produk superfood organik murni dengan standar mutu dan higienitas tertinggi.\n2. Mengedukasi masyarakat luas mengenai pentingnya pola makan seimbang dan manfaat bahan pangan alami.\n3. Memberikan pelayanan ramah, responsif, dan tepercaya bagi seluruh pelanggan serta mitra bisnis kami.\n4. Mendukung ekosistem pertanian ramah lingkungan dan berkelanjutan.",
            'values' => [
                [
                    'title' => '100% Alami & Organik',
                    'desc' => 'Bebas dari bahan pengawet, pewarna kimia, pestisida sintetis, dan rekayasa genetika (Non-GMO).'
                ],
                [
                    'title' => 'Nutrisi Padat Berkualitas',
                    'desc' => 'Diproses secara higienis untuk menjaga kandungan vitamin, omega-3, protein, dan antioksidan tetap utuh.'
                ],
                [
                    'title' => 'Kemasan Higienis & Aman',
                    'desc' => 'Menggunakan material kemasan zipper food-grade kedap udara untuk menjamin kesegaran produk.'
                ],
                [
                    'title' => 'Pelayanan Ramah & Amanah',
                    'desc' => 'Kami selalu siap membantu konsultasi produk dan melayani kebutuhan kesehatan Anda dengan sepenuh hati.'
                ]
            ],
            'image' => null,
        ]);

        // 6. Contact
        Contact::create([
            'address' => 'Gedung Skye Digipreneur, Jl. Amidyas Raya No. 24, Jakarta Selatan, DKI Jakarta 12560',
            'phone' => '+62 858-7174-6229',
            'whatsapp' => '085871746229',
            'email' => 'natabintang24@gmail.com',
            'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.28509689408!2d106.75884961640625!3d-6.229569499999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e49fe37bbd%3A0x60074a3832c3cb16!2sJakarta%20Selatan%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'instagram' => 'https://instagram.com/chia.amidyas',
            'tiktok' => 'https://tiktok.com/@chia.amidyas',
            'facebook' => 'https://facebook.com/chia.amidyas',
            'operational_hours' => 'Senin - Sabtu: 08.00 - 17.00 WIB (Minggu & Hari Libur Nasional Tutup)',
            'custom_links' => [
                [
                    'platform' => 'whatsapp',
                    'title' => 'WhatsApp CS Amidyas',
                    'url' => 'https://wa.me/6285871746229?text=Halo%20Amidyas%20Superfood%2C%20saya%20ingin%20berkonsultasi%20mengenai%20produk.',
                    'badge' => 'Respon Cepat',
                ],
                [
                    'platform' => 'shopee',
                    'title' => 'Shopee Official Store',
                    'url' => 'https://shopee.co.id',
                    'badge' => 'Gratis Ongkir & Garansi Asli',
                ],
                [
                    'platform' => 'grabfood',
                    'title' => 'GrabFood Official',
                    'url' => 'https://food.grab.com',
                    'badge' => 'Pesan Siap Antar',
                ],
                [
                    'platform' => 'gofood',
                    'title' => 'GoFood Delivery',
                    'url' => 'https://gofood.co.id',
                    'badge' => 'Pengiriman Cepat',
                ],
            ],
        ]);
    }
}
