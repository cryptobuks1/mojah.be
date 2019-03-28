<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailingListAuthor extends Model
{
    protected $fillable = ['email', 'display_name'];

    protected $appends = ['gravatar', 'author_url'];

    public function messages()
    {
        return $this->hasMany('App\MailingListMessage');
    }

    public function topics()
    {
        return $this->hasMany('App\MailingListTopic');
    }

    public function getGravatarAttribute()
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "https://www.gravatar.com/avatar/$hash";
    }

    public function getDisplayNameAttribute($value)
    {
        return strlen($value) > 0 ? $value : 'Anonymous';
    }

    public function getAuthorUrlAttribute()
    {
        return '/mailing-lists/author/'. $this->id;
    }
}
