<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Family;
use App\Models\Educator;
use App\Models\Carematch;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'FCN Administrator',
            'email' => 'admin@futurecareproject.com.au',
            'password' => Hash::make('Admin@FCN2026'),
        ]);

        // Sample families
        $families = [
            ['parent_name' => 'Sarah Johnson', 'suburb' => 'Toowoomba', 'postcode' => '4350', 'care_type' => 'Family Day Care', 'status' => 'pending', 'wait_time' => '1-3 months'],
            ['parent_name' => 'James O\'Brien', 'suburb' => 'Dalby', 'postcode' => '4405', 'care_type' => 'Family Day Care', 'status' => 'matched', 'wait_time' => '3-6 months'],
            ['parent_name' => 'Aisha Mohammed', 'suburb' => 'Roma', 'postcode' => '4455', 'care_type' => 'In-Home Care', 'status' => 'waitlisted', 'wait_time' => '6-12 months'],
            ['parent_name' => 'Linda Williams', 'suburb' => 'Warwick', 'postcode' => '4370', 'care_type' => 'Family Day Care', 'status' => 'pending', 'wait_time' => 'Just looking'],
            ['parent_name' => 'Minh Nguyen', 'suburb' => 'Toowoomba', 'postcode' => '4350', 'care_type' => 'Family Day Care', 'status' => 'matched', 'wait_time' => '1-3 months'],
            ['parent_name' => 'Priya Patel', 'suburb' => 'Chinchilla', 'postcode' => '4413', 'care_type' => 'Long Day Care', 'status' => 'waitlisted', 'wait_time' => '3-6 months'],
            ['parent_name' => 'Rachel Kim', 'suburb' => 'Toowoomba', 'postcode' => '4350', 'care_type' => 'Family Day Care', 'status' => 'pending', 'wait_time' => '1-3 months'],
            ['parent_name' => 'Thomas Brown', 'suburb' => 'Stanthorpe', 'postcode' => '4380', 'care_type' => 'In-Home Care', 'status' => 'waitlisted', 'wait_time' => 'Over 12 months'],
        ];

        foreach ($families as $i => $f) {
            Family::create(array_merge($f, [
                'reference_number' => 'FCN-F-' . str_pad($i + 1001, 4, '0', STR_PAD_LEFT),
                'email' => strtolower(str_replace(['\'', ' '], ['', '.'], $f['parent_name'])) . '@email.com.au',
                'phone' => '04' . rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(100, 999),
                'children_count' => rand(1, 3),
                'children_ages' => ['2 years', '4 years'],
                'days_required' => ['Monday', 'Tuesday', 'Wednesday'],
                'privacy_consent' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
            ]));
        }

        // Sample educators
        $educators = [
            ['name' => 'Maria Santos', 'suburb' => 'Toowoomba', 'postcode' => '4350', 'qualification' => 'Certificate III in ECEC', 'blue_card_number' => '1234567/8', 'insurance_status' => 'valid', 'status' => 'verified', 'blue_card_expiry' => '2026-06-30'],
            ['name' => 'Linda Tran', 'suburb' => 'Toowoomba', 'postcode' => '4350', 'qualification' => 'Diploma of ECEC', 'blue_card_number' => '2345678/9', 'insurance_status' => 'valid', 'status' => 'active', 'blue_card_expiry' => '2026-12-31'],
            ['name' => 'Anne Murphy', 'suburb' => 'Roma', 'postcode' => '4455', 'qualification' => 'Studying Certificate III', 'blue_card_number' => '3456789/0', 'insurance_status' => 'pending', 'status' => 'pending', 'blue_card_expiry' => '2026-05-20'],
            ['name' => 'David Chen', 'suburb' => 'Warwick', 'postcode' => '4370', 'qualification' => 'Bachelor of Education', 'blue_card_number' => '4567890/1', 'insurance_status' => 'valid', 'status' => 'verified', 'blue_card_expiry' => '2027-01-15'],
            ['name' => 'Susan Walsh', 'suburb' => 'Dalby', 'postcode' => '4405', 'qualification' => 'Certificate III in ECEC', 'blue_card_number' => '5678901/2', 'insurance_status' => 'valid', 'status' => 'active', 'blue_card_expiry' => '2025-03-01'],
        ];

        foreach ($educators as $i => $e) {
            Educator::create(array_merge($e, [
                'reference_number' => 'FCN-E-' . str_pad($i + 2001, 4, '0', STR_PAD_LEFT),
                'email' => strtolower(str_replace(' ', '.', $e['name'])) . '@email.com.au',
                'phone' => '04' . rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(100, 999),
                'care_types' => ['Family Day Care', 'In-Home Care'],
                'availability' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday'],
                'max_children' => rand(3, 5),
                'age_groups' => '0-5 years',
                'training_needs' => ['Business setup support'],
                'privacy_consent' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
            ]));
        }

        // Sample matches
        Carematch::create([
            'family_id' => 2,
            'educator_id' => 2,
            'status' => 'confirmed',
            'notes' => 'Auto-matched by system.',
        ]);

        Carematch::create([
            'family_id' => 5,
            'educator_id' => 1,
            'status' => 'confirmed',
            'notes' => 'Auto-matched by system.',
        ]);
    }
}