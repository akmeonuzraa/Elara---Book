<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Publisher;
use App\Models\Genre;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MassiveDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Starting massive data generation...');
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // 1. Créer 100 auteurs
        $this->command->info('Creating 100 authors...');
        $authors = [];
        $firstNames = ['Ahmed', 'Mohammed', 'Fatima', 'Hassan', 'Aisha', 'Omar', 'Layla', 'Ali', 'Zainab', 'Youssef',
                       'John', 'Jane', 'Robert', 'Mary', 'James', 'Patricia', 'Michael', 'Jennifer', 'William', 'Linda'];
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez',
                      'Alami', 'Benali', 'Cherkaoui', 'El Amrani', 'Fassi', 'Tahiri', 'Ziani', 'Idrissi', 'Khalil', 'Mansouri'];
        $nationalities = ['Moroccan', 'American', 'British', 'French', 'Spanish', 'Egyptian', 'Saudi', 'Lebanese', 'Algerian', 'Tunisian'];
        
        for ($i = 1; $i <= 100; $i++) {
            $authors[] = [
                'name' => $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)],
                'nationality' => $nationalities[array_rand($nationalities)],
                'birth_date' => date('Y-m-d', strtotime('-' . rand(30, 80) . ' years')),
                'biography' => 'Renowned author with multiple bestselling books.',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Author::insert($authors);
        
        // 2. Créer 50 éditeurs
        $this->command->info('Creating 50 publishers...');
        $publishers = [];
        $publisherNames = ['Penguin Books', 'HarperCollins', 'Simon & Schuster', 'Macmillan', 'Hachette',
                          'Oxford University Press', 'Cambridge Press', 'Dar Al Kitab', 'Arab Scientific Publishers',
                          'Bloomsbury', 'Random House', 'Scholastic', 'Wiley', 'McGraw-Hill', 'Pearson'];
        
        for ($i = 1; $i <= 50; $i++) {
            $publishers[] = [
                'name' => $publisherNames[array_rand($publisherNames)] . ' ' . $i,
                'email' => 'contact' . $i . '@publisher.com',
                'phone' => '0' . rand(600000000, 699999999),
                'address' => rand(1, 999) . ' Publisher Street, City',
                'website' => 'https://publisher' . $i . '.com',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Publisher::insert($publishers);
        
        // 3. Créer 5000 livres par lots
        $this->command->info('Creating 5000 books...');
        $genres = Genre::all()->pluck('id')->toArray();
        $bookTitles = [
            'The Art of', 'Introduction to', 'Advanced', 'Mastering', 'Complete Guide to',
            'Understanding', 'The Science of', 'Modern', 'Classical', 'Contemporary',
            'History of', 'Principles of', 'Fundamentals of', 'Secrets of', 'The Power of'
        ];
        $subjects = [
            'Programming', 'Mathematics', 'Physics', 'Chemistry', 'Biology', 'Literature',
            'History', 'Philosophy', 'Psychology', 'Economics', 'Business', 'Marketing',
            'Engineering', 'Medicine', 'Law', 'Education', 'Art', 'Music', 'Sports', 'Cooking'
        ];
        
        $batchSize = 500;
        $totalBooks = 5000;
        
        for ($i = 0; $i < $totalBooks; $i += $batchSize) {
            $books = [];
            
            for ($j = 0; $j < $batchSize && ($i + $j) < $totalBooks; $j++) {
                $num = $i + $j + 1;
                $title = $bookTitles[array_rand($bookTitles)] . ' ' . $subjects[array_rand($subjects)];
                
                $books[] = [
                    'title' => $title . ' Vol. ' . rand(1, 5),
                    'isbn' => '978-' . rand(0, 9) . '-' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT) . '-' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT) . '-' . rand(0, 9),
                    'author_id' => rand(1, 100),
                    'publisher_id' => rand(1, 50),
                    'genre_id' => $genres[array_rand($genres)],
                    'description' => 'A comprehensive book covering essential topics in ' . $subjects[array_rand($subjects)] . '. Perfect for students and professionals alike.',
                    'publication_year' => rand(1990, 2024),
                    'language' => rand(0, 1) ? 'English' : (rand(0, 1) ? 'French' : 'Arabic'),
                    'total_copies' => rand(1, 20),
                    'available_copies' => rand(1, 20),
                    'price' => rand(50, 500) + (rand(0, 99) / 100),
                    'pages' => rand(100, 1200),
                    'edition' => rand(1, 5) . 'st Edition',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            
            Book::insert($books);
            $this->command->info("Inserted " . ($i + $batchSize) . " books...");
        }
        
        // 4. Créer 1000 membres
        $this->command->info('Creating 1000 members...');
        $memberTypes = ['student', 'teacher', 'staff', 'public'];
        
        for ($i = 0; $i < 1000; $i += $batchSize) {
            $members = [];
            
            for ($j = 0; $j < $batchSize && ($i + $j) < 1000; $j++) {
                $num = $i + $j + 1;
                $members[] = [
                    'member_id' => 'MEM' . str_pad($num, 6, '0', STR_PAD_LEFT),
                    'name' => $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)],
                    'email' => 'member' . $num . '@example.com',
                    'phone' => '0' . rand(600000000, 699999999),
                    'address' => rand(1, 999) . ' Street Name, City, Morocco',
                    'member_type' => $memberTypes[array_rand($memberTypes)],
                    'membership_date' => date('Y-m-d', strtotime('-' . rand(1, 365) . ' days')),
                    'expiry_date' => date('Y-m-d', strtotime('+' . rand(30, 365) . ' days')),
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            
            Member::insert($members);
            $this->command->info("Inserted " . ($i + $batchSize) . " members...");
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Massive data generation completed!');
        $this->command->info('Generated: 100 authors, 50 publishers, 5000 books, 1000 members');
    }
}