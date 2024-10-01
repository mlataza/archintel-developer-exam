@if (session('status'))
@if (session('status-type') == 'green')
<x-green-alert>
    {{ session('status') }}
</x-green-alert>
@elseif (session('status-type') == 'info')
<x-info-alert>
    {{ session('status') }}
</x-info-alert>
@else
<x-yellow-alert>
    {{ session('status') }}
</x-yellow-alert>
@endif
@endif