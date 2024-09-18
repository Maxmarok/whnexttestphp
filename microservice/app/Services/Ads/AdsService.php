<?php

namespace App\Services\Ads;

use App\Models\Ads;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class AdsService implements AdsInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAd(int $id, ?bool $fields = false): ?Ads
    {
        return Ads::fields($fields)->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getAds(string $sort = Ads::DEFAULT_SORT, string $type = Ads::DEFAULT_TYPE): LengthAwarePaginator
    {
        return Ads::orderBy($sort, $type)->fields()->paginate(Ads::PAGE_LIMIT);
    }

    /**
     * {@inheritDoc}
     */
    public function createAd(array $data): Ads
    {
        $ad = Ads::create($data);
        if(!$ad) throw new Exception('Create error');
        return $ad;
    }
}