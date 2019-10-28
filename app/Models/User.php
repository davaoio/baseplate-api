<?php

namespace App\Models;

use App\Observers\UserObserver;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail, HasMedia
{
    use Notifiable, HasRoles, HasMediaTrait;

    /**
     * The default guard to use
     * This will use by laravel permission package to determine the guard to use
     *
     * @var string
     */
    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verification_code', 'phone_number_verification_code',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        // register model observer
        static::observe(UserObserver::class);
    }

    /*
    |--------------------------------------------------------------------------
    | JWT configuration
    |--------------------------------------------------------------------------
    */

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | Media Collections
    |--------------------------------------------------------------------------
    */

    /**
     * Register media collections
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')->width(254);
            });
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    /**
     * User avatar
     */
    public function avatar()
    {
        return $this->morphOne(Media::class, 'model')->where('collection_name', 'avatar');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Search from name, email or phone number
     *
     */
    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->where('first_name', 'LIKE', "%$search%")
                ->orWhere('last_name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('phone_number', 'LIKE', "%$search%");
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Mutator methods
    |--------------------------------------------------------------------------
    */

    /**
     * Remove the plus (+) sign for every phone number
     *
     * @param string $value
     * @return void
     */
    public function setPhoneNumberAttribute(?string $value)
    {
        if ($value) {
            $this->attributes['phone_number'] = static::cleanPhoneNumber($value);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor methods
    |--------------------------------------------------------------------------
    */

    /**
     * Converts the first character of each word in user's first name to uppercase
     *
     * @param string $firstName
     * @return string
     */
    public function getFirsNameAttribute(?string $firstName) : string
    {
        return ucwords($firstName);
    }

    /**
     * Converts the first character of each word in user's last name to uppercase
     *
     * @param string $lastName
     * @return string
     */
    public function getLastNameAttribute(?string $lastName) : string
    {
        return ucwords($lastName);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if the user email or phone number is verified
     *
     * @return boolean
     */
    public function isVerified() : bool
    {
        return !empty($this->email_verified_at) || !empty($this->phone_number_verified_at);
    }

    /**
     * Check if the user email is verified
     *
     * @return boolean
     */
    public function isEmailVerified() : bool
    {
        return !empty($this->email_verified_at);
    }

    /**
     * Check if the user phone_number is verified
     *
     * @return boolean
     */
    public function isPhoneNumberVerified() : bool
    {
        return !empty($this->phone_number_verified_at);
    }

    /**
     * Check if the user has email
     *
     * @return boolean
     */
    public function hasEmail() : bool
    {
        return !empty($this->email);
    }

    /**
     * Check if the user has phone_number
     *
     * @return boolean
     */
    public function hasPhoneNumber() : bool
    {
        return !empty($this->phone_number);
    }

    /**
     * User Default avatar
     *
     * @return string
     */
    public function defaultAvatar() : string
    {
        return public_path().'/images/default-profile.png';
    }

    /*
    |--------------------------------------------------------------------------
    | Static Helper methods
    |--------------------------------------------------------------------------
    */

    /**
     * Remove plus (+) sign for phone numbers
     *
     * @param string $value
     * @return string
     */
    public static function cleanPhoneNumber(?string $value) : string
    {
        return str_replace('+', '', $value);
    }
}
