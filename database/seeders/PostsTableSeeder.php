<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Jeremykenedy\LaravelPosts\Domain\Models\Post;

class PostsTableSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::whereHas('roles', fn ($q) => $q->where('slug', 'admin'))->first();
        if (! $admin) {
            return;
        }

        $posts = [
            [
                'title' => 'Welcome to Laravel Auth',
                'slug' => 'welcome-to-laravel-auth',
                'body' => "Welcome to the Laravel Auth modernized platform! This project demonstrates a full-featured authentication and admin system built on Laravel 13 with 23 composable packages.\n\nFeatures include user management, role-based access control, social authentication, theme management, activity logging, and much more.\n\nThis blog system is powered by the laravel-posts package and supports draft, published, and archived statuses with auto-generated slugs and excerpts.",
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Getting Started with Themes',
                'slug' => 'getting-started-with-themes',
                'body' => "Laravel Auth comes with 22 built-in themes based on Bootswatch. You can select your preferred theme from the theme selector page.\n\nEach theme provides a unique accent color that changes the look of navigation, buttons, and links throughout the application.\n\nAdmins can manage themes from the admin panel, including creating custom themes and toggling their availability.",
                'status' => 'published',
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Understanding Roles and Permissions',
                'slug' => 'understanding-roles-and-permissions',
                'body' => "The platform uses a level-based role system with four default roles:\n\n- Super Admin (Level 10): Full system access\n- Admin (Level 5): User management, settings, and content\n- User (Level 1): Standard authenticated access\n- Unverified (Level 0): Awaiting email verification\n\nPermissions can be assigned to roles for granular access control. The system supports Blade directives like @role, @permission, and @level for easy view-level authorization.",
                'status' => 'published',
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $data) {
            Post::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, ['user_id' => $admin->id]),
            );
        }
    }
}
