<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $table = 'pengaduans';
    protected $fillable = ['id_kategori', 'nama', 'NIS', 'lokasi', 'tanggal', 'Keterangan', 'gambar', 'status'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('id', $search);
        });
    }
    public function Kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class);
    }
}
