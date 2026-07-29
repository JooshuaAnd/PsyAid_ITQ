<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinceModel extends Model
{
    protected $table            = 'provinces';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name'];

    /**
     * Fetch all provinces with Redis Caching (24h TTL)
     */
    public function getAllCached(): array
    {
        $cacheKey = 'all_provinces';
        $cache    = service('cache');

        try {
            $cachedData = $cache->get($cacheKey);
            if ($cachedData !== null && is_array($cachedData)) {
                return $cachedData;
            }
        } catch (\Throwable $e) {
            // Fallback to DB query
        }

        $data = $this->orderBy('name', 'ASC')->findAll();

        try {
            $cache->save($cacheKey, $data, 86400);
        } catch (\Throwable $e) {
            // Ignore cache write errors
        }

        return $data;
    }
}
