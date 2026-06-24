<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@perpus.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'class' => null,
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@student.sch.id',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'phone' => '081298765432',
            'class' => 'XII IPA 1',
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@student.sch.id',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'phone' => '081211223344',
            'class' => 'XI IPS 2',
        ]);

        $categories = [
            ['name' => 'Fiksi', 'description' => 'Novel dan cerita fiksi', 'color' => '#6366f1'],
            ['name' => 'Pelajaran', 'description' => 'Buku pelajaran sekolah', 'color' => '#8b5cf6'],
            ['name' => 'Sains', 'description' => 'Buku sains dan teknologi', 'color' => '#06b6d4'],
            ['name' => 'Sejarah', 'description' => 'Buku sejarah dan biografi', 'color' => '#f59e0b'],
            ['name' => 'Agama', 'description' => 'Buku keagamaan', 'color' => '#10b981'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $books = [
            ['category_id' => 1, 'title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'isbn' => '978-979-1227-78-5', 'publisher' => 'Bentang Pustaka', 'published_year' => 2005, 'description' => 'Novel inspiratif tentang perjuangan anak-anak di Belitung.', 'stock' => 5, 'available' => 5, 'location' => 'Rak A-01'],
            ['category_id' => 1, 'title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'isbn' => '978-979-9738-00-1', 'publisher' => 'Hasta Mitra', 'published_year' => 1980, 'description' => 'Karya sastra klasik Indonesia.', 'stock' => 3, 'available' => 3, 'location' => 'Rak A-02'],
            ['category_id' => 2, 'title' => 'Matematika Kelas X', 'author' => 'Tim Kurikulum', 'isbn' => '978-602-1234-01-1', 'publisher' => 'Erlangga', 'published_year' => 2022, 'description' => 'Buku pelajaran matematika SMA kelas X.', 'stock' => 10, 'available' => 10, 'location' => 'Rak B-01'],
            ['category_id' => 2, 'title' => 'Fisika Kelas XI', 'author' => 'Tim Kurikulum', 'isbn' => '978-602-1234-02-2', 'publisher' => 'Erlangga', 'published_year' => 2022, 'description' => 'Buku pelajaran fisika SMA kelas XI.', 'stock' => 8, 'available' => 8, 'location' => 'Rak B-02'],
            ['category_id' => 3, 'title' => 'A Brief History of Time', 'author' => 'Stephen Hawking', 'isbn' => '978-055-3380-16-3', 'publisher' => 'Bantam', 'published_year' => 1988, 'description' => 'Eksplorasi kosmologi untuk pembaca umum.', 'stock' => 4, 'available' => 4, 'location' => 'Rak C-01'],
            ['category_id' => 3, 'title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'isbn' => '978-006-2316-09-7', 'publisher' => 'Harper', 'published_year' => 2011, 'description' => 'Sejarah singkat umat manusia.', 'stock' => 6, 'available' => 6, 'location' => 'Rak C-02'],
            ['category_id' => 4, 'title' => 'Sejarah Indonesia Modern', 'author' => 'M.C. Ricklefs', 'isbn' => '978-979-461-514-0', 'publisher' => 'Gadjah Mada Press', 'published_year' => 2008, 'description' => 'Sejarah Indonesia abad ke-20.', 'stock' => 3, 'available' => 3, 'location' => 'Rak D-01'],
            ['category_id' => 5, 'title' => 'Al-Quran Terjemah', 'author' => 'Kementerian Agama', 'isbn' => '978-979-579-001-4', 'publisher' => 'Balai Pustaka', 'published_year' => 2015, 'description' => 'Al-Quran dan terjemahannya.', 'stock' => 7, 'available' => 7, 'location' => 'Rak E-01'],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        Borrow::create([
            'user_id' => 2,
            'book_id' => 1,
            'borrow_date' => now()->subDays(3),
            'due_date' => now()->addDays(4),
            'status' => 'approved',
        ]);

        Book::find(1)->update(['available' => 4]);
    }
}
