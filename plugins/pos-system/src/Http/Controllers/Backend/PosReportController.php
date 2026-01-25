<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use MojarCMS\CMS\Http\Controllers\BackendController;
use Mojahid\PosSystem\Models\PosOrder;
use Mojahid\PosSystem\Models\PosSession;

final class PosReportController extends BackendController
{
    public function index(): View
    {
        $this->addBreadcrumb([
            'title' => trans('POS Reports'),
            'url' => route('admin.pos-system.reports.index'),
        ]);

        $title = trans('POS Reports');

        return $this->view('pos::backend.report.index', compact('title'));
    }

    public function sales(Request $request): View
    {
        $this->addBreadcrumb([
            'title' => trans('POS Reports'),
            'url' => route('admin.pos-system.reports.index'),
        ]);

        $this->addBreadcrumb([
            'title' => trans('Sales Report'),
            'url' => route('admin.pos-system.reports.sales'),
        ]);

        // Default to last 7 days if no dates provided
        $dateFrom = $request->get('date_from', now()->subDays(7)->format('Y-m-d'));
        $dateTo = $request->get('date_to', now()->format('Y-m-d'));

        $salesData = PosOrder::where('status', 'completed')
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->selectRaw('
                DATE(created_at) as date,
                COUNT(*) as total_orders,
                SUM(total_amount) as total_sales,
                SUM(CASE WHEN payment_method = "cash" THEN total_amount ELSE 0 END) as cash_sales,
                SUM(CASE WHEN payment_method = "card" THEN total_amount ELSE 0 END) as card_sales,
                SUM(CASE WHEN payment_method = "digital" THEN total_amount ELSE 0 END) as digital_sales
            ')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        $totals = [
            'total_orders' => $salesData->sum('total_orders'),
            'total_sales' => $salesData->sum('total_sales'),
            'cash_sales' => $salesData->sum('cash_sales'),
            'card_sales' => $salesData->sum('card_sales'),
            'digital_sales' => $salesData->sum('digital_sales'),
        ];

        $title = trans('Sales Report');

        return $this->view('pos::backend.report.sales', compact(
            'title',
            'salesData',
            'totals',
            'dateFrom',
            'dateTo'
        ));
    }

    public function sessions(Request $request): View
    {
        $this->addBreadcrumb([
            'title' => trans('POS Reports'),
            'url' => route('admin.pos-system.reports.index'),
        ]);

        $this->addBreadcrumb([
            'title' => trans('Session Report'),
            'url' => route('admin.pos-system.reports.sessions'),
        ]);

        $dateFrom = $request->get('date_from', now()->subDays(30)->format('Y-m-d'));
        $dateTo = $request->get('date_to', now()->format('Y-m-d'));

        $sessions = PosSession::with('user')
            ->whereBetween('opened_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->orderBy('opened_at', 'desc')
            ->get();

        $totals = [
            'total_sessions' => $sessions->count(),
            'active_sessions' => $sessions->where('status', 'active')->count(),
            'closed_sessions' => $sessions->where('status', 'closed')->count(),
            'total_sales' => $sessions->sum(function ($session) {
                return $session->getTotalSales();
            }),
            'total_transactions' => $sessions->sum('total_transactions'),
        ];

        $title = trans('Session Report');

        return $this->view('pos::backend.report.sessions', compact(
            'title',
            'sessions',
            'totals',
            'dateFrom',
            'dateTo'
        ));
    }

    public function products(Request $request): View
    {
        $this->addBreadcrumb([
            'title' => trans('POS Reports'),
            'url' => route('admin.pos-system.reports.index'),
        ]);

        $this->addBreadcrumb([
            'title' => trans('Product Report'),
            'url' => route('admin.pos-system.reports.products'),
        ]);

        $dateFrom = $request->get('date_from', now()->subDays(30)->format('Y-m-d'));
        $dateTo = $request->get('date_to', now()->format('Y-m-d'));

        // Get completed orders first, then get their items (following same pattern as sales/sessions)
        $completedOrderIds = PosOrder::where('status', 'completed')
            ->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'])
            ->pluck('id');

        $productSales = \Mojahid\PosSystem\Models\PosOrderItem::whereIn('pos_order_id', $completedOrderIds)
            ->selectRaw('
                product_name,
                product_sku,
                SUM(quantity) as total_quantity,
                SUM(total_amount) as total_revenue,
                COUNT(DISTINCT pos_order_id) as times_sold,
                AVG(product_price) as unit_price,
                MAX(created_at) as last_sold
            ')
            ->groupBy('product_name', 'product_sku')
            ->orderBy('total_revenue', 'desc')
            ->limit(50)
            ->get();

        $totals = [
            'products_sold' => $productSales->count(),
            'total_quantity' => $productSales->sum('total_quantity'),
            'total_revenue' => $productSales->sum('total_revenue'),
            'avg_price' => $productSales->avg('unit_price') ?: 0,
        ];

        $title = trans('Product Report');

        return $this->view('pos::backend.report.products', compact(
            'title',
            'productSales',
            'totals',
            'dateFrom',
            'dateTo'
        ));
    }
} 