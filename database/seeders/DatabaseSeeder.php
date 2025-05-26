<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Import model User yang benar
use Database\Seeders\UserSeeder; // Import UserSeeder
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserRoleSeeder;
use Database\Seeders\AssessmentSeeder;
use Database\Seeders\AssesmentQuestionSeeder;
use Database\Seeders\AnswerChoiceSeeder;
use Database\Seeders\AssesmentAnswerSeeder;
use Database\Seeders\UserAnswerSeeder;
use Database\Seeders\ConsultationSeeder;
use Database\Seeders\ReviewSeeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\JournalSeeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            UserRoleSeeder::class,
            AssessmentSeeder::class,
            AssesmentQuestionSeeder::class,
            AnswerChoiceSeeder::class,
            AssesmentAnswerSeeder::class,
            UserAnswerSeeder::class,
            ConsultationSeeder::class,
            ReviewSeeder::class,
            ArticleSeeder::class,
            JournalSeeder::class,

        ]);

        // User test tambahan dengan factory (opsional)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
