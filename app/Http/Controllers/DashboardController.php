<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $dashboardService;
    public function __construct()
    {

        $this->dashboardService = new DashboardService();
    }
    public function index()
    {
        //]
        $totalProducts = $this->dashboardService->getTotalProducts();
        $totalCategories = $this->dashboardService->getTotalCategories();
        $totalUsers = $this->dashboardService->getTotalUsers();
        $totalOrders = $this->dashboardService->getTotalOrders();
        $totalRevenue = $this->dashboardService->getTotalRevenue();
        $totalInventoryValue = $this->dashboardService->getTotalInventoryValue();
        $topExpensiveProducts = $this->dashboardService->getTopExpensiveProducts();
        $topSellingProducts = $this->dashboardService->getTopSellingProducts();
        $topStockProducts = $this->dashboardService->getTopStockProducts();
        return view('dashboard.index', compact(
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'totalInventoryValue',
            'topExpensiveProducts',
            'topSellingProducts',
            'topStockProducts'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
