<?php

namespace Database\Seeders;

use App\Repositories\RoomRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $repository = app(RoomRepository::class);

        $rooms = [
            [
                'published' => true,
                'price' => 85.00,
                'sl' => [
                    'title' => 'Standardna enoposteljna soba',
                    'description' => 'Idealna izbira za poslovne potnike. Soba nudi udobno posteljo, delovno mizo in hiter brezžični internet.',
                ],
                'en' => [
                    'title' => 'Standard Single Room',
                    'description' => 'The perfect choice for business travelers. Features a comfortable bed, a work desk, and high-speed Wi-Fi.',
                ],
            ],
            [
                'price' => 120.00,
                'sl' => [
                    'title' => 'Klasična dvoposteljna soba',
                    'description' => 'Udobna in svetla soba z zakonsko posteljo, primerna za pare. Vključuje mini bar in sodobno kopalnico.',
                ],
                'en' => [
                    'title' => 'Classic Double Room',
                    'description' => 'A cozy and bright room with a queen-size bed, suitable for couples. Includes a mini-bar and a modern bathroom.',
                ],
            ],
            [
                'price' => 145.00,
                'sl' => [
                    'title' => 'Družinska soba z balkonom',
                    'description' => 'Prostorna soba z dodatnimi ležišči in prostornim balkonom, kjer lahko uživate v jutranji kavi.',
                ],
                'en' => [
                    'title' => 'Family Room with Balcony',
                    'description' => 'Spacious room with additional beds and a large balcony, perfect for enjoying your morning coffee.',
                ],
            ],
            [
                'price' => 180.00,
                'sl' => [
                    'title' => 'Superior soba ob bazenu',
                    'description' => 'Elegantno opremljena soba z direktnim dostopom do zunanjega bazena in privatnim ležalnikom.',
                ],
                'en' => [
                    'title' => 'Superior Poolside Room',
                    'description' => 'Elegantly furnished room with direct access to the outdoor pool and a private sun lounger.',
                ],
            ],
            [
                'price' => 250.00,
                'sl' => [
                    'title' => 'Premium Alpine Suita',
                    'description' => 'Naša prestižna suita s panoramskim razgledom na gore, lastno savno in kaminom za romantične večere.',
                ],
                'en' => [
                    'title' => 'Premium Alpine Suite',
                    'description' => 'Our prestigious suite with panoramic mountain views, a private sauna, and a fireplace for romantic evenings.',
                ],
            ],
            [
                'price' => 110.00,
                'sl' => [
                    'title' => 'Dvoposteljna soba Twin',
                    'description' => 'Soba z ločenima ležiščema, primerna za prijatelje ali sodelavce. Ponuja ves potrebni mir in udobje.',
                ],
                'en' => [
                    'title' => 'Twin Double Room',
                    'description' => 'Room with separate twin beds, ideal for friends or colleagues. Offers all the peace and comfort you need.',
                ],
            ],
            [
                'price' => 450.00,
                'sl' => [
                    'title' => 'Predsedniški apartma',
                    'description' => 'Vrhunec luksuza. Tri ločene spalnice, velika dnevna soba, kuhinja in 24-urna strežba.',
                ],
                'en' => [
                    'title' => 'Presidential Penthouse',
                    'description' => 'The ultimate luxury experience. Three separate bedrooms, a large living area, a kitchen, and 24-hour room service.',
                ],
            ],
        ];

        foreach ($rooms as $roomData) {
            $repository->create([
                'published' => true,
                'price' => $roomData['price'],
                'title' => [
                    'sl' => $roomData['sl']['title'],
                    'en' => $roomData['en']['title'],
                ],
                'description' => [
                    'sl' => $roomData['sl']['description'],
                    'en' => $roomData['en']['description'],
                ],
                'sl' => [
                    'active' => true,
                ],
                'en' => [
                    'active' => true,
                ],
            ]);
        }
    }
}
