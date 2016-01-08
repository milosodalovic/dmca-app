<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Notice extends Model
{
    protected $fillable = [
        'infringing_title',
        'infringing_link',
        'original_link',
        'original_description',
        'template',
        'content_removed',
        'provider_id'
    ];

    /**
     * Get the recepient/provider  for the DMCA notice
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
       return $this->belongsTo('App\Provider', 'provider_id');
    }

    /**
     * Return the owner of the DMCA notice
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the email address of the recepient of the DMCA
     * @return string
     */
    public function getRecipientEmail()
    {
        return $this->recipient->copyright_email;
    }

    /**
     * Return email of the DMCA owner
     * @return string
     */
    public function getOwnerEmail()
    {
        return $this->user->email;
    }

//    /**
//     * Open a new notice
//     * @param array $attributes
//     * @return static
//     */
//    public static function open(array $attributes)
//    {
//        return new static($attributes);
//    }
//
//    public function useTemplate($template)
//    {
//        $this->template=$template;
//
//        return $this;
//    }
}
