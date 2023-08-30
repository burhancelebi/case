<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Services\CampaignService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CampaignController extends Controller
{
    public function __construct(private readonly CampaignService $campaignService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->campaignService->getCampaigns();
    }

    /**
     * @param int $order_id
     * @return array
     */
    public function applyCampaign(int $order_id): array
    {
        return $this->campaignService->applyCampaign($order_id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CampaignRequest $request): CampaignResource
    {
        return $this->campaignService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
