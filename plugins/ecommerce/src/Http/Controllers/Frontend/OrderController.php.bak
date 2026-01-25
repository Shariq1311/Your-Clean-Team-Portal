<?php

namespace Mojahid\Ecommerce\Http\Controllers\Frontend;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;
use MojarCMS\CMS\Contracts\HookActionContract;
use MojarCMS\CMS\Http\Controllers\FrontendController;
use Mojahid\Ecommerce\Http\Resources\OrderResource;
use Mojahid\Ecommerce\Models\DownloadLink;
use Mojahid\Ecommerce\Models\Order;
use Symfony\Component\HttpFoundation\StreamedResponse;
use MojarCMS\CMS\Facades\HookAction;
use Illuminate\Http\Request;

class OrderController extends FrontendController
{
    public function __construct(
        protected HookActionContract $hookAction
    ) {
    }

    public function download(Order $order): View|Factory|Response|string
    {
        abort_unless($order->isPaymentCompleted(), 403);

        $pages = $this->hookAction->getProfilePages()
            ->where('show_menu', true)
            ->map(function ($item) {
                $item['active'] = $item['slug'] === 'ecommerce/orders';
                return $item;
            })
            ->toArray();

        $title = __('Download').": #{$order->code}";

        $page = [
            'title' => $title,
            'contents' => 'ecomm::frontend.profile.orders.download',
        ];

        $order->load([
            'downloadableProducts' => fn ($q) => $q
                ->with(['downloadLinks'])
                ->select(['posts.id', 'posts.title', 'posts.slug'])
        ]);

        return $this->view(
            'theme::profile.index',
            array_merge(
                compact('pages', 'page', 'title'),
                [
                    'order' => OrderResource::make($order)->resolve(),
                ]
            )
        );
    }

    public function details(Request $request, string $token)
    {
        $order = Order::where('token', $token)
            ->where('user_id', auth()->id())
            ->with(['orderItems', 'paymentMethod'])
            ->firstOrFail();

        $title = __('Order').": #{$order->code}";
        $pages = collect(HookAction::getProfilePages());
        $user = auth()?->user();

        $page = [
            'title' => $title,
            'key' => 'order-detail',
            'contents' => view()->exists('theme::profile.orders.details') ? 
                          'theme::profile.orders.details' : 
                          'ecomm::frontend.profile.orders.details',
            'data' => [
                'order' => OrderResource::make($order)->resolve(),
            ]
        ];

        return $this->view('theme::profile.index', compact(
            'title',
            'pages',
            'page',
            'user'
        ));
    }

    /**
     * Display list of customer orders
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $userId = auth()->id();
        $orders = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('ecomm::frontend.customer.orders', [
            'orders' => $orders
        ]);
    }
    
    /**
     * Display order details
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id): View
    {
        $userId = auth()->id();
        $order = Order::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();
            
        $order->load(['orderItems.post']);
        
        return view('ecomm::frontend.customer.order-detail', [
            'order' => $order
        ]);
    }

}
