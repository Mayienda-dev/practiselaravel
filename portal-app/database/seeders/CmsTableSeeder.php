<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cmsRecords = [
            [
                'id' => 1,
                'title' => 'About us',
                'url' => 'about-us',
                'description' => 'This is an about us page',
                'meta_title' => 'testing',
                'meta_description' => 'testing about us',
                'meta_keywords' => 'About, About-us',
                'status' => 1
            ],
            [
                'id' => 2,
                'title' => 'Privacy policy',
                'url' => 'privacy-policy',
                'description' => 'This is our privacy policy',
                'meta_title' => 'Privacy and Policy',
                'meta_description' => 'The privacy policy',
                'meta_keywords' => 'Privacy, Privacy policy',
                'status' => 1
            ],
            [
                'id' => 3,
                'title' => 'Terms & Conditions',
                'url' => 'terms-conditions',
                'description' => 'This is are our terms and conditions',
                'meta_title' => 'testing',
                'meta_description' => 'testing terms & conditions',
                'meta_keywords' => 'Terms, Conditions',
                'status' => 1
            ],
        ];

        CmsPage::insert($cmsRecords);
    }
}
