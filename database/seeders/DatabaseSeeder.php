<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\AssessmentSeeder;
use Database\Seeders\AssesmentQuestionSeeder;
use Database\Seeders\UserAnswerSeeder;
use Database\Seeders\PaymentSeeder;
use Database\Seeders\ConsultationSeeder;
use Database\Seeders\ReviewSeeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\JournalSeeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            AssessmentSeeder::class,
            AssesmentQuestionSeeder::class,
            UserAnswerSeeder::class,
            DoctorSeeder::class,
            PaymentSeeder::class,
            ConsultationSeeder::class,
            ReviewSeeder::class,
            ArticleSeeder::class,
            JournalSeeder::class,
            PesanSeeder::class
        ]);


    }
}
