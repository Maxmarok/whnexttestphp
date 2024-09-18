<?php

namespace App\Services\Ads;

use App\Models\Ads;
use Illuminate\Pagination\LengthAwarePaginator;

interface AdsInterface
{
    /**
     * Получение конкретного объявления по ID с опциональным запросом доп. полей
     * @param int $id
     * @param ?bool $fields
     * @return \App\Models\Ads
     */
    public function getAd(int $id, ?bool $fields = false): ?Ads;

    /**
     * Получение списка объявления с возможностью сортировки
     * @param string $sort Поле сортировки
     * @param string $type Тип сортировки
     * @return \Illuminate\Pagination\LengthAwarePaginator;
     */
    public function getAds(string $sort = Ads::DEFAULT_SORT, string $type = Ads::DEFAULT_TYPE): LengthAwarePaginator;

    /**
     * Создание нового объявления
     * @param array $data
     * @return \App\Models\Ads
     * @throws Exception
     */
    public function createAd(array $data): Ads;
}