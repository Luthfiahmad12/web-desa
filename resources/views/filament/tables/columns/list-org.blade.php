<div class="p-4 bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-md">
    @php
        $structure = is_string($getState()) ? json_decode($getState(), true) : $getState();
    @endphp

    @if (is_array($structure))
        <ul class="list-disc space-y-2">
            @foreach ($structure as $key => $value)
                <li class="flex items-center justify-between">
                    <span class="font-semibold">{{ $key }} : </span>
                    <span class="text-blue-500">{{ $value }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-red-500">Invalid JSON</p>
    @endif
</div>
