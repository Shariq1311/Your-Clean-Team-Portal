@php
    $langs = array_merge(trans('cms::app', [], 'en'), trans('cms::app'));
    $plugins = \MojarCMS\CMS\Facades\Plugin::all(true)
        ->map(fn($item) => Arr::only($item, ['name', 'description']))
        ->values();
    $themeKeys = get_config('theme_activation_codes', []);
    $themes = \MojarCMS\CMS\Facades\Theme::all(true)
        ->map(function ($item) use ($themeKeys) {
            $results = Arr::only($item, ['name', 'title', 'description', 'version']);
            $results['active'] = mc_current_theme() == $item['name'];
            if ($key = Arr::get($themeKeys, \Illuminate\Support\Str::snake($item['name']))) {
                $results['key'] = Arr::only($key, ['token', 'certificate']);
            }

            return $results;
        })
        ->values();
@endphp
<script type="text/javascript">
    /**
     * Your Clean Team - THE BEST CMS FOR LARAVEL PROJECT
     *
     * @package    Your Clean Team/cms
     * @link       https://Your Clean Team.com
     * @license    GNU V2
     */
    const Your Clean Team = {
        adminPrefix: "{{ config('Your Clean Team.admin_prefix') }}",
        adminUrl: "{{ url(config('Your Clean Team.admin_prefix')) }}",
        lang: @json($langs),
        plugins: @json($plugins),
        themes: @json($themes)
    }
</script>
