<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens; // Trait for API token management
use Laravel\Jetstream\HasProfilePhoto; // Trait for managing profile photos
use Spatie\Permission\Traits\HasRoles; // Trait for managing roles and permissions with Spatie package
use Illuminate\Notifications\Notifiable; // Trait to enable notifications
use Laravel\Fortify\TwoFactorAuthenticatable; // Trait for two-factor authentication
use Illuminate\Database\Eloquent\Factories\HasFactory; // Trait for Eloquent factories
use Illuminate\Contracts\Auth\MustVerifyEmail; // Interface for email verification
use Illuminate\Foundation\Auth\User as Authenticatable; // Base User class for authentication

class User extends Authenticatable implements MustVerifyEmail
{
    // Use relevant traits for the User model to handle API tokens, profile photos, roles, notifications, etc.
    use HasApiTokens;
    use HasFactory; // Factory support for seeding and testing
    use HasProfilePhoto; // Enable profile photo functionality in Jetstream
    use Notifiable; // Enable notifications to be sent to the user
    use TwoFactorAuthenticatable; // Enable two-factor authentication support
    use HasRoles; // Enable roles and permissions management

    /**
     * The attributes that are mass assignable.
     *
     * These are the attributes that can be mass-assigned when creating or updating a user.
     * It includes user information such as name, email, associated center, profile photo, and password.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // User's full name
        'email', // User's email address
        'center_id', // Foreign key referencing the economic center
        'profile_photo_path', // Path to the user's profile photo
        'password', // User's password
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * These attributes will not be included when the model is converted to an array or JSON.
     * Password, remember token, and two-factor details are hidden for security purposes.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // Don't expose the password when serializing the model
        'remember_token', // Don't expose the remember token
        'two_factor_recovery_codes', // Don't expose the recovery codes for two-factor authentication
        'two_factor_secret', // Don't expose the two-factor secret key
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * This is used to append additional data when the model is converted to an array or JSON.
     * In this case, it appends the user's profile photo URL.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url', // Appends the profile photo URL for easy access
    ];

    /**
     * Get the attributes that should be cast.
     *
     * This is used for type casting attributes to specific data types.
     * For example, casting the `email_verified_at` to a datetime format and the `password` to a hashed string.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Cast `email_verified_at` to a datetime object
            'password' => 'hashed', // Ensure the password is stored as a hashed string
        ];
    }

    /**
     * Get the economic center associated with the user.
     *
     * This defines a relationship where each user belongs to a specific economic center.
     * The `center_id` is the foreign key that links to the `economic_center` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function economicCenter()
    {
        return $this->belongsTo(EconomicCenter::class, 'center_id', 'id');
    }
}
