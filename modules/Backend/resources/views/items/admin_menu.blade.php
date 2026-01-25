@foreach ($items as $item)
    @if ($item->hasChildren())
        <li class="Your Clean Team__menuLeft__item Your Clean Team__menuLeft__submenu Your Clean Team__menuLeft__item-{{ $item->get('url') }}">
            <span class="Your Clean Team__menuLeft__item__link">
                <i class="Your Clean Team__menuLeft__item__icon {{ $item->get('icon') }}"></i>

                <span class="Your Clean Team__menuLeft__item__title">{{ $item->get('title') }}</span>
            </span>

            <ul class="Your Clean Team__menuLeft__navigation">
                @foreach ($item->getChildrens() as $child)
                    <li class="Your Clean Team__menuLeft__item Your Clean Team__menuLeft__item-{{ $child->get('url') }}">
                        <a class="Your Clean Team__menuLeft__item__link" href="{{ admin_url($child->get('url')) }}">
                            <span class="Your Clean Team__menuLeft__item__title">{{ trans($child->get('title')) }}</span>
                            {{-- <i class="Your Clean Team__menuLeft__item__icon fe fe-film"></i> --}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    @else
        <li class="Your Clean Team__menuLeft__item Your Clean Team__menuLeft__item-{{ $item->get('url') }}">
            <a class="Your Clean Team__menuLeft__item__link" href="{{ admin_url($item->get('url')) }}">
                <i class="Your Clean Team__menuLeft__item__icon {{ $item->get('icon') }}"></i>
                <span class="Your Clean Team__menuLeft__item__title">{{ $item->get('title') }}</span>

            </a>
        </li>
    @endif
@endforeach
