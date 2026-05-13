<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Setting model yang diperkuat dengan:
 * - Static set() untuk simpan/update satu key
 * - Static getMany() untuk ambil banyak key sekaligus
 * - Static group() yang sudah ada
 * - Static get() yang sudah ada
 */
class Setting extends Model
{
    protected $fillable = ['group', 'key', 'value'];

    // ---- Read Helpers ----

    public static function get(string $key, string $default = ''): string
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function group(string $group): array
    {
        return static::where('group', $group)->pluck('value', 'key')->toArray();
    }

    /** Ambil banyak grup sekaligus */
    public static function groups(array $groups): array
    {
        return static::whereIn('group', $groups)->pluck('value', 'key')->toArray();
    }

    // ---- Write Helpers ----

    public static function set(string $key, mixed $value, string $group = 'general'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }

    /**
     * Upload file dan simpan path-nya ke setting.
     * Hapus file lama jika ada.
     */
    public static function upload(string $key, \Illuminate\Http\UploadedFile $file, string $folder, string $group = 'general'): string
    {
        $old = static::where('key', $key)->value('value');
        if ($old && Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }
        $path = $file->store($folder, 'public');
        static::set($key, $path, $group);
        return $path;
    }
}
