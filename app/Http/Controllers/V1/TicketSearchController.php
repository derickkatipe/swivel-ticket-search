<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DomainModels\TicketSearch;

/**
 * Class TicketSearchController
 * @package App\Http\Controllers\V1
 */
class TicketSearchController extends Controller
{
    /**
     * @var TicketSearch
     */
    private $ticketSearch;

    /**
     * TicketSearchController constructor.
     * @param TicketSearch $ticketSearch
     */
    public function __construct(
        TicketSearch $ticketSearch
    ) {
        $this->ticketSearch = $ticketSearch;
    }

    /**
     * Get search type list
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getSearchTypeList()
    {
        try {
            $data = $this->ticketSearch->getSearchTypeList();

            return response()->json(compact('data'),200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get allowed fields for the selected type
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSearchFieldListForSearchType(Request $request)
    {
        try {
            $arrInput = $request->all();
            $data = $this->ticketSearch->getSearchFieldListForSearchType($arrInput);

            return response()->json(compact('data'),200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get ticket information for selected filters
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchResults(Request $request)
    {
        try {
            $arrInput = $request->all();
            $data = $this->ticketSearch->searchResults($arrInput);

            return response()->json(compact('data'),200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
