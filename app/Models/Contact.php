<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';
    protected $guarded = [];
    protected $filterable = [];

    public function scopeEmail($query, $email)
    {
        if (!empty($email)) {
            $query->where('email', 'like', '%' . $email . '%');
        }
        return $query;
    }

    public function scopeStatus($query, $status)
    {
        if (!empty($status)) {
            $query->where('status', $status);
        }
        return $query;
    }

    public function get_feedbacks($params = [])
    {
        $feedback = $this->query()
            ->email(@$params['email'])
            ->status(@$params['status'])
            ->orderBy('created_at', 'desc');

        return !empty($params['limit']) ? $feedback->paginate($params['limit']) : $feedback->get();
    }
}
