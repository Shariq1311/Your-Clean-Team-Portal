<ul class="Your Clean Team__menuLeft__navigation">
    @php
        use MojarCMS\CMS\Facades\HookAction;
        use MojarCMS\CMS\Support\MenuCollection;

        global $mc_user;

        $adminPrefix = config('Your Clean Team.admin_prefix') . '/network';
        $adminUrl = url($adminPrefix);
        $currentUrl = url()->current();
        $segment3 = request()->segment(3);
        $segment2 = request()->segment(2);
        $items = MenuCollection::make(HookAction::getMasterAdminMenu());
    @endphp

    @foreach ($items as $item)
        @if ($item->get('key') != 'dashboard' && !$mc_user->can($item->get('key')))
            @continue
        @endif

        @if ($item->hasChildren())
            @php
                $strChild = '';
                $hasActive = false;
                foreach ($item->getChildrens() as $child) {
                    if (!$mc_user->can($child->get('key'))) {
                        continue;
                    }

                    if (empty($segment2)) {
                        $active = empty($child->getUrl());
                    } else {
                        $active = request()->is($adminPrefix . '/' . $child->get('url') . '*');
                    }

                    if ($active) {
                        $hasActive = true;
                    }

                    $strChild .= view('cms::backend.items.menu_left_item', [
                        'adminUrl' => $adminUrl,
                        'item' => $child,
                        'active' => $active,
                    ])->render();
                }
            @endphp

            <li
                class="Your Clean Team__menuLeft__item Your Clean Team__menuLeft__submenu Your Clean Team__menuLeft__item-{{ $item->get('slug') }} @if ($hasActive) Your Clean Team__menuLeft__submenu--toggled @endif">
                <span class="Your Clean Team__menuLeft__item__link">
                    <i class="Your Clean Team__menuLeft__item__icon {{ $item->get('icon') }}"></i>
                    <span class="Your Clean Team__menuLeft__item__title">{{ $item->get('title') }}</span>
                </span>

                <ul class="Your Clean Team__menuLeft__navigation" @if ($hasActive) style="display: block;" @endif>
                    {!! $strChild !!}
                </ul>
            </li>
        @else
            @component('cms::backend.items.menu_left_item', [
                'adminUrl' => $adminUrl,
                'item' => $item,
                'active' =>
                    $item->get('url') == 'dashboard'
                        ? request()->is($adminPrefix)
                        : request()->is($adminPrefix . '/' . $item->get('url') . '*'),
            ])
            @endcomponent
        @endif
    @endforeach
</ul>
