@props(['id', 'ctrl'])

@php
    $rule = Config::get('gds.enum.ruleBtn');
    $btnInArea = Config::get('gds.enum.btnInArea');

    $ctrl = array_key_exists($ctrl, $btnInArea) ? $ctrl : 'default';
    $listBtn = $btnInArea[$ctrl];
    $html = '';

    foreach ($listBtn as $index => $item) {
        $button = $rule[$item];
        $link = route($routePrefix . $button['route'], [$ctrl => $id]);

        if ($button['route'] == 'destroy') {
            $html .= sprintf(
                '<form action="%s" method="POST" style="display:inline;" id="delete-form-%d">
                    %s
                    %s
                    <i class="fa %s text-secondary delete-icon" aria-hidden="true" style="cursor: pointer;" onclick="confirmDeleteItem(%d)"></i>
                </form>',
                $link,
                $index,
                csrf_field(),
                method_field('DELETE'),
                $button['icon'],
                $index
            );
        } else {
            $html .= sprintf(
                '<a href="%s" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="%s">
                    <i class="fa %s text-secondary" aria-hidden="true"></i>
                </a>',
                $link,
                $button['title'],
                $button['icon']
            );
        }
    }
@endphp

{!! $html !!}

<script>
    function confirmDeleteItem(index) {
        if (confirm('Are you sure?')) {
            $('#delete-form-'+index).submit();
        }
    }
</script>
