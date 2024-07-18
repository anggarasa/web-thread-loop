<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Posting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posting>
 */
class PostingFactory extends Factory
{
    protected $model = Posting::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $faker = \Faker\Factory::create();
        // $imagePath = 'posting-image';

        // // Generate a random image
        // $imageFile = $faker->image(storage_path("app/public/{$imagePath}"), 640, 480, null, false);

        // // Generate a random video (you might need to have a set of dummy videos to copy)
        // $dummyVideos = ['video1.mp4', 'video2.mp4', 'video3.mp4']; // Add your own dummy video names here
        // $randomVideo = $faker->randomElement($dummyVideos);

        // // Simulate video file creation
        // $videoFile = "{$imagePath}/{$randomVideo}";
        // Storage::disk('public')->put("{$imagePath}/{$randomVideo}", file_get_contents(database_path("factories/dummy-videos/{$randomVideo}")));

        return [
            'user_id' => 2,
            // 'posting_image' => "{$imagePath}/{$imageFile}",
            'deskripsi' => $this->faker->sentence,
        ];
    }

    public function video(): static
    {
        $faker = \Faker\Factory::create();
        $imagePath = 'posting-image';

        // Generate a random video (you might need to have a set of dummy videos to copy)
        $dummyVideos = ['video1.mp4', 'video2.mp4', 'video3.mp4']; // Add your own dummy video names here
        $randomVideo = $faker->randomElement($dummyVideos);

        // Simulate video file creation
        $videoFile = "{$imagePath}/{$randomVideo}";
        Storage::disk('public')->put("{$imagePath}/{$randomVideo}", file_get_contents(database_path("factories/dummy-videos/{$randomVideo}")));
        return $this->state(fn (array $attributes) => [
            'posting_video' => $videoFile,

        ]);
    }
}
