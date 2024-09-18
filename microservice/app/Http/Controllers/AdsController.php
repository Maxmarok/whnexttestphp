<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdRequest;
use App\Http\Requests\GetAdRequest;
use App\Http\Requests\GetAdsRequest;
use App\Models\Ads;
use App\Services\Ads\AdsInterface;
use Illuminate\Http\JsonResponse;

class AdsController extends Controller
{
    /**
     * @param \App\Services\Ads\AdsInterface $ad
     */
    public function __construct(
        private AdsInterface $ad,
    ){}

    /**
     * Получение конкретного объявления по ID с опциональным запросом доп. полей
     * @param \App\Http\Requests\GetAdRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAd(GetAdRequest $request): JsonResponse
    {
        $id = $request->input('id');
        $fields = $request->input('fields') ?? false;
        $data = $this->ad->getAd($id, $fields);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Получение списка объявления с возможностью сортировки
     * @param \App\Http\Requests\GetAdsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAds(GetAdsRequest $request): JsonResponse
    {
        $sort = $request->input('sort') ?? Ads::DEFAULT_SORT;
        $type = $request->input('type') ?? Ads::DEFAULT_TYPE;
        $data = $this->ad->getAds($sort, $type);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Создание нового объявления
     * @param \App\Http\Requests\CreateAdRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function createAd(CreateAdRequest $request): JsonResponse
    {
        $data = $request->validated();
        $ad = $this->ad->createAd($data);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $ad->id,
            ]
        ]);
    }
}
